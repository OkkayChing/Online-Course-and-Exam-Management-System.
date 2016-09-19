<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Course extends MS_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('course_model');
        $this->load->model('exam_model');
        $this->load->model('admin_model');
    }

    public function index($message = '')
    { 
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['user_role'] = $this->admin_model->get_user_role();
        $data['categories'] = $this->exam_model->get_categories();
         
        $data['message'] = $message;
        $data['courses'] = $this->course_model->get_all_courses();
        $data['content'] = $this->load->view('content/view_course_list', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
            // echo "<pre/>"; print_r($data['courses']); exit();
        
        $this->load->view('home', $data);
    }

    public function course_summary($id, $message = '')
    { 
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['message'] = $message;
        $data['course'] = $this->course_model->get_course_by_id($id);
        $data['sections'] = $this->course_model->get_sections($id);
        $data['content'] = $this->load->view('content/view_course_summary', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $this->load->view('home', $data);
    }

    public function view_all_courses($message = '')
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('login_control'));
        }

        $userId = $this->session->userdata('user_id');
        $data = array();
        $data['class'] = 91; // class control value left digit for main manu rigt digit for submenu
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', '', TRUE);
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['categories'] = $this->exam_model->get_subcategories();
        if ($this->session->userdata('user_role_id') < 4) {
            $data['courses'] = $this->course_model->get_all_courses();
            $data['content'] = $this->load->view('content/view_all_courses', $data, TRUE);
        } else {
            $data['courses'] = $this->course_model->get_user_courses($userId);
            $data['content'] = $this->load->view('content/view_user_courses', $data, TRUE);
        }
        $data['footer'] = $this->load->view('footer/admin_footer', '', TRUE);
        $this->load->view('dashboard', $data);
    }


    public function view_course_by_category($cat_id)
    {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['courses'] = $this->course_model->get_courses_by_category($cat_id);
        $data['categories'] = $this->exam_model->get_categories();
        $data['category_name'] = $this->db->get_where('sub_categories', array('id' => $cat_id))->row()->sub_cat_name;
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['user_role'] = $this->admin_model->get_user_role();
        $data['content'] = $this->load->view('content/view_course_list', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $this->load->view('home', $data);
    }

    public function courses_type($type)
    {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['categories'] = $this->exam_model->get_categories();
      //    $data['mock_count'] = $this->exam_model->mock_count($data['categories']);
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['user_role'] = $this->admin_model->get_user_role();
            $data['courses'] = $this->course_model->get_courses_by_price($type);
        if($type === 'free'){
            $data['category_name'] = 'Free';
        }else if($type === 'paid'){
            $data['category_name'] = 'Paid';
        }else{
            redirect(base_url('course'));
        }
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $data['content'] = $this->load->view('content/view_course_list', $data, TRUE);
        $this->load->view('home', $data);

    }

    public function create_course($message = '', $cat_id = '')
    {     
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('login_control'));
        }
        $userId = $this->session->userdata('user_id');
        $data = array();
        $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['cat_id'] = $cat_id;
        $data['categories'] = $this->exam_model->get_categories();
        $data['content'] = $this->load->view('form/course_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function save_course($message = '')
    {
          // echo "<pre/>"; print_r($this->input->post()); exit();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category', 'Sub Category', 'required|integer');
        $this->form_validation->set_rules('course_title', 'Course Title', 'required');
        $this->form_validation->set_rules('course_intro', 'Course Introduction', 'required');
        $this->form_validation->set_rules('course_description', 'Course Description', 'required');
        $this->form_validation->set_rules('course_requirement', 'Course Requirements', 'required');
        $this->form_validation->set_rules('target_audience', 'Course Audience', 'required');
        $this->form_validation->set_rules('what_i_get', 'What I Get', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            // redirect(base_url('course/create_course'));
            $this->create_course();
        } else {
          //  echo "<pre/>"; print_r($this->input->post()); exit();
            $form_info = array();
            if ($_FILES['feature_image']['name']) {
                $config['upload_path'] = './course-images/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = uniqid();
                $config['overwrite'] = TRUE;
                $config['max_size'] = '150';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('feature_image')) {
                    $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                    $this->session->set_flashdata('message',$error['error']);
                    redirect(base_url('course/ctreat_course'));
                } else {
                    $upload_data = $this->upload->data();
                    $title_id = $this->course_model->add_course_title($upload_data['file_name']);
                }
            }else{
                $title_id = $this->course_model->add_course_title();
            }

            if ($title_id) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Course created successfully!.'
                        . '</div>';
                $course_title = $this->input->post('course_title');
                $this->ctreat_course_sections($title_id, $course_title, $message);
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->ctreat_course($message);
            }
        }
    }

    public function ctreat_course_sections($title_id = 0, $course_title = 'Create Sections', $message = '')
    {
        $data = array();
        $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['course_title'] = $course_title;
        $data['title_id'] = $title_id;
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $data['content'] = $this->load->view('form/section_form', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function add_section($course_id = '', $message = '')
    {//        exit($course_id);
        $data = array();
        $data['class'] = 91; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        // $data['sections'] = $this->course_model->get_sections($course_id);
        $data['course_id'] = $course_id;
        $data['course_title'] = $this->db->get_where('courses', array('course_id' => $course_id))->row()->course_title;
        $data['content'] = $this->load->view('form/section_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }
    public function save_sections()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('section[0]', 'Section Title 1', 'required');
        $this->form_validation->set_rules('course_id', 'Course Id', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->ctreat_course_sections($this->input->post('course_id'));
        } else {
            if ($this->course_model->save_course_sections()) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Sections created successfully!.'
                        . '</div>';
                $this->session->set_flashdata('message', $message);              
                redirect(base_url('course/add_course_videos/'.$this->input->post('course_id')));
            }else{
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->ctreat_course_sections($this->input->post('course_id'), $this->input->post('course_title'), $message);                
            }
        }        
    }

    // public function view_my_quizs($message = '')
    // {
    //     $userId = $this->session->userdata('user_id');
    //     $data = array();
    //     $data['class'] = 91; // class control value left digit for main manu rigt digit for submenu
    //     $data['header'] = $this->load->view('header/admin_head', '', TRUE);
    //     $data['top_navi'] = $this->load->view('header/admin_top_navigation', '', TRUE);
    //     $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
    //     $data['message'] = $message;
    //     $data['categories'] = $this->course_model->get_categories();
    //     if ($this->session->userdata('user_role_id') <= 3) {
    //         $data['quizs'] = $this->course_model->get_all_quizs();
    //         $data['content'] = $this->load->view('content/view_all_quizs', $data, TRUE);
    //     } else {
    //         $data['quizs'] = $this->course_model->get_user_quizs($userId);
    //         $data['content'] = $this->load->view('content/view_user_quizs', $data, TRUE);
    //     }
    //     $data['footer'] = $this->load->view('footer/admin_footer', '', TRUE);
    //     $this->load->view('dashboard', $data);
    // }

    // public function view_my_quiz_detail($id, $message = '')
    // {
    //     if (!is_numeric($id)) {
    //         show_404();
    //     }
    //     $data = array();
    //     $data['class'] = 91;   // class control value left digit for main manu rigt digit for submenu
    //     $data['header'] = $this->load->view('header/admin_head', '', TRUE);
    //     $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
    //     $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
    //     $data['message'] = $message;
    //     $data['quiz_title'] = $this->course_model->get_quiz_by_id($id);
    //     if (!(empty($data['quiz_title'])) && (($this->session->userdata('user_role_id') <= 3) OR ($data['quiz_title']->user_id == $this->session->userdata('user_id')))) {
    //         $data['quizs'] = $this->course_model->get_quiz_detail($id);
    //         $data['quiz_ans'] = $this->course_model->get_quiz_answers($data['quizs']);
    //         $data['content'] = $this->load->view('content/quiz_detail', $data, TRUE);
    //         $data['modal'] = $this->load->view('modals/update_question', $data, TRUE);
    //         $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
    //         $this->load->view('dashboard', $data);
    //     } else {
    //         show_404();
    //     }
    // }
    // public function add_quiz($section_id = '', $message = '')
    // {     
    //   //  echo "<pre/>"; print_r($this->session->all_userdata()); exit();
    //     $userId = $this->session->userdata('user_id');
    //     $data = array();
    //     $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
    //     $data['header'] = $this->load->view('header/admin_head', '', TRUE);
    //     $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
    //     $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
    //     $data['message'] = $message;
    //     $data['section_id'] = $section_id;
    //     $data['course_id'] =$this->db->get_where('course_sections', array('section_id' => $section_id))->row()->course_id;
        
    //     $course_id =$data['course_id'];
    //     $data['course_title'] = $this->db->get_where('courses', array('course_id' => $course_id))->row()->course_title;
    //     $data['section_name'] = $this->db->get_where('course_sections', array('section_id' => $section_id))->row()->section_name;
    //     $data['categories'] = $this->exam_model->get_categories();
    //     $data['content'] = $this->load->view('form/quiz_form', $data, TRUE);
    //     $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
    //     $this->load->view('dashboard', $data);
    // }

    // public function create_quiz($section_id = '', $message = '')
    // {
    //     $this->load->library('form_validation');
        
    //     $this->form_validation->set_rules('quiz_title', 'Quiz Title', 'required|min_length[3]');
    //     $this->form_validation->set_rules('passing_score', 'Passing Score', 'required|integer|less_than[100]');
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->quiz_form();
    //     } else {
    //         $form_info = array();
    //         if ($_FILES['feature_image']['name']) {
    //             $config['upload_path'] = './quiz-images/';
    //             $config['allowed_types'] = 'gif|jpg|png';
    //             $config['file_name'] = uniqid();
    //             $config['overwrite'] = TRUE;
    //             $config['max_size'] = '150';
    //             $config['max_width'] = '1024';
    //             $config['max_height'] = '768';

    //             $this->load->library('upload', $config);
    //             if (!$this->upload->do_upload('feature_image')) {
    //                 $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
    //                 $this->session->set_flashdata('message',$error['error']);
    //                 redirect(base_url('course/add_quiz'));
    //             } else {
    //                 $upload_data = $this->upload->data();
    //                 $title_id = $this->course_model->add_quiz_title($upload_data['file_name']);
    //             }
    //         }else{
    //             $title_id = $this->course_model->add_quiz_title();
    //         }

    //          if ($title_id) {
    //             $message = '<div class="alert alert-success alert-dismissable">'
    //                     . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
    //                     . 'Exam created successfully! Now creat questions.'
    //                     . '</div>';
    //             $quiz_title = $this->input->post('quiz_title');
    //             $this->quiz_question_form($message, $title_id, $quiz_title);
    //         } else {
    //             $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
    //             $this->quiz_form($message);
    //         }
    //     }
    // }
    // public function quiz_question_form($message = '', $title_id = 0, $quiz_title = 'Create Question', $question_no = 1)
    // {
    //     $data = array();
    //     $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
    //     $data['header'] = $this->load->view('header/admin_head', '', TRUE);
    //     $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
    //     $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
    //     $data['message'] = $message;
    //     $data['question_no'] = $question_no;
    //     $data['quiz_title'] = $quiz_title;
    //     $data['title_id'] = $title_id;
    //     $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
    //     $data['categories'] = $this->exam_model->get_categories();
    //     $data['content'] = $this->load->view('form/quiz_question_form', $data, TRUE);
    //     $this->load->view('dashboard', $data);
    // }
    // public function quiz_form($message = '', $cat_id = '')
    // {     
    //   //  echo "<pre/>"; print_r($this->session->all_userdata()); exit();
    //     $userId = $this->session->userdata('user_id');
    //     $data = array();
    //     $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
    //     $data['header'] = $this->load->view('header/admin_head', '', TRUE);
    //     $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
    //     $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
    //     $data['message'] = $message;
    //     $data['cat_id'] = $cat_id;
    //     $data['categories'] = $this->exam_model->get_categories();
    //     $data['content'] = $this->load->view('form/quiz_form', $data, TRUE);
    //     $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
    //     $this->load->view('dashboard', $data);
    // }

    // public function add_more_quiz_question($id = '', $message = '')
    // {
    //     if (!is_numeric($id)) {
    //         show_404();
    //     }
    //     $quizs = $this->course_model->get_quiz_title($id);
    //     if ((empty($quizs)) OR ($quizs->user_id != $this->session->userdata('user_id'))) {
    //         $message = '<div class="alert alert-danger alert-dismissable">'
    //                 . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
    //                 . 'Only the author can add questions.'
    //                 . '</div>';
    //         $this->view_my_quizs($message);
    //     } else {
    //         $quiz_title = $quizs->title_name;
    //         $title_id = $quizs->title_id;
    //         $question_no = $this->exam_model->question_count_by_id($id) + 1;
    //         $this->quiz_question_form($message, $title_id, $quiz_title, $question_no);
    //     }
    // }

    // public function create_quiz_question($message = '')
    // {
    //     //      echo "<pre>";                print_r($this->input->post());                exit();
    //     $this->load->library('form_validation');
    //     $this->form_validation->set_rules('question', 'Question', 'required');
    //     $this->form_validation->set_rules('right_ans', 'At Least One Correct Answer', 'required');
    //     $this->form_validation->set_rules('ans_type', 'Answer Type', 'required');
    //     $this->form_validation->set_rules('options[1]', 'Option 1', 'required');
    //     $this->form_validation->set_rules('options[2]', 'Option 2', 'required');
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->quiz_question_form('', $this->input->post('ques_id'));
    //     } else{
    //         $file_name = ''; $file_type = '';
    //         if ($_FILES['media']['name']) {
    //             $config['upload_path'] = './question-media/'.$this->input->post('media_type').'/';

    //             if ($this->input->post('media_type') == 'image') {
    //                 $config['allowed_types'] = 'gif|jpg|png';
    //             }elseif ($this->input->post('media_type') == 'video') {
    //                 $config['allowed_types'] = 'mp4|ogg|webm';
    //             }elseif ($this->input->post('media_type') == 'audio') {
    //                 $config['allowed_types'] = 'application/ogg|mp3|wav';
    //             }

    //             $config['file_name'] = uniqid();
    //             $config['overwrite'] = TRUE;

    //             $this->load->library('upload', $config);
    //             if (!$this->upload->do_upload('media')) {
    //                 $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
    //                 $this->session->set_flashdata('message',$error['error']);
    //                 redirect(base_url('course/add_more_question/'.$this->input->post('ques_id')));
    //             } else {
    //                 $upload_data = $this->upload->data();
    //                 $file_name = $this->input->post('media_type').'/'.$upload_data['file_name'];
    //                 $file_type = $this->input->post('media_type');
    //             }
    //         }else if($this->input->post('media', TRUE)){
    //             $file_name = $this->input->post('media');
    //             $file_type = $this->input->post('media_type');
    //         }

    //         if ($this->course_model->add_quiz_question($file_name, $file_type)){
    //             if ($this->input->post('done')) {
    //                 $quiz_id = $this->input->post('quiz_id', TRUE);
    //                 $quiz_title = $this->input->post('quiz_title', TRUE);
    //                 $message = '<div class="alert alert-success alert-dismissable">'
    //                         . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
    //                         . 'Success! Set the time allowed to take ' . $quiz_title . ' quiz and the number of questions havae to answer.'
    //                         . '</div>';
    //                 $this->set_time_n_random_ques_no($quiz_id, $quiz_title, $message);
    //             } else {
    //                 $message = '<div class="alert alert-success alert-dismissable">'
    //                         . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
    //                         . 'Successfully Added!'
    //                         . '</div>';
    //                 $quiz_title = $this->input->post('quiz_title');
    //                 $title_id = $this->input->post('ques_id');
    //                 $question_no = $this->input->post('ques_no') + 1;
    //                 $this->quiz_question_form($message, $title_id, $quiz_title, $question_no);
    //             }
    //         } else {
    //             $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
    //             $this->quiz_question_form($message);
    //         }
    //     }
    // }
    
 // public function set_time_n_random_ques_no($id, $quiz_title = '', $message = '')
 //    {
 //        $data = array();
 //        $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
 //        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
 //        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
 //        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
 //        $data['ques_count'] = $this->course_model->question_count_by_id($id);
 //        $data['message'] = $message;
 //        $data['quiz_title'] = $quiz_title;
 //        $data['quiz_id'] = $id;
 //        $data['content'] = $this->load->view('form/set_time_n_random_ques_no', $data, TRUE);
 //        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
 //        $this->load->view('dashboard', $data);
 //    }

    // public function update_time_n_random_ques_no()
    // {
    //     $ques_count = $this->input->post('ques_count', TRUE)+1;
    //     $data = array();
    //     $this->load->library('form_validation');
    //     $this->form_validation->set_rules('duration', 'Time Duration', 'required|min_length[5]|max_length[8]');
    //     $this->form_validation->set_rules('random_ques', 'Total Random Question', 'required|integer|less_than['.$ques_count.']');
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->set_time_n_random_ques_no($this->input->post('quiz_id', TRUE),$this->input->post('quiz_title', TRUE));
    //     } else {
    //         if ($this->course_model->set_time_n_random_ques_no()) {
    //             $message = '<div class="alert alert-success alert-dismissable">'
    //                     . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
    //                     . 'Successfully done!'
    //                     . '</div>';
    //             $this->view_my_mocks($message);
    //         } else {
    //             $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
    //             $this->set_time_n_random_ques_no($this->input->post('quiz_id', TRUE),$this->input->post('quiz_title', TRUE),$message);
    //         }
    //     }
    // }



    // public function view_quiz_summery($id = '', $message = '')
    // {
    //     if (!is_numeric($id)) show_404();

    //     $data = array();
    //     $data['header'] = $this->load->view('header/head', '', TRUE);
    //     $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
    //     $data['quiz'] = $this->course_model->get_quiz_by_id($id);
    //     if (!$data['quiz']) show_404();
    //     $data['message'] = $message;
    //     $data['content'] = $this->load->view('content/quiz_summery', $data, TRUE);
    //     $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
    //     $this->load->view('home', $data);
    // }

    // public function view_quiz_instructions($id = '', $message = '')
    // {
    //     if (!is_numeric($id)) {
    //         show_404();
    //     }
    //     if (!$this->session->userdata('log')) {
    //         $this->session->set_userdata('back_url', current_url());
    //         $message = '<div class="alert alert-danger alert-dismissable">'
    //                 . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
    //                 . 'Please login to start the exam!</div>';
    //         $this->session->set_flashdata('message', $message);
    //         redirect(base_url('login_control'));
    //     }
    //     $data = array();
    //     $data['header'] = $this->load->view('header/head', '', TRUE);
    //     $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
    //     $data['message'] = $message;
    //     $data['quiz'] = $this->course_model->get_quiz_by_id($id);
    //     if (!$data['quiz']) {
    //         show_404();
    //     }
    //     $data['content'] = $this->load->view('content/quiz_instructions', $data, TRUE);
    //     $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
    //     $this->load->view('home', $data);
    // }

    // public function start_quiz($id = '', $message = '')
    // {
    //     $this->load->helper('cookie');
    //     if (($id == '') OR !is_numeric($id)) {
    //         show_404();
    //     }
    //     if (!$this->session->userdata('log')) {
    //         $this->session->set_userdata('back_url', current_url());
    //         redirect(base_url('login_control'));
    //     }
    //     $data = array();
    //     $data['header'] = $this->load->view('header/head', '', TRUE);
    //     $data['message'] = $message;
    //     $data['quiz'] = $this->course_model->get_quiz_by_id($id);
    //     if (!$data['quiz']) {
    //         show_404();
    //     }
    //     // if ($data['quiz']->exam_price != 0) {
    //     //     $user_info = $this->db->get_where('users', array('user_id' => $this->session->userdata('user_id')))->row();
    //     //     if (($user_info->subscription_id == 0) OR ($user_info->subscription_end <= now())) {
    //     //         $payment_token = $this->course_model->get_pay_token($id, $this->session->userdata('pay_id'));
    //     //         if (!$payment_token) {
    //     //             redirect('exam_control/payment_process/' . $id, 'refresh');
    //     //         }
    //     //     }
    //     // }
        
    //     if($this->input->cookie('QuizTimeDuration')){
    //         $data['duration'] = $this->input->cookie('QuizTimeDuration', TRUE)-1;
    //     } else {
    //         $data['duration'] = $data['quiz']->duration;
    //     }

    //     $total_questions = $this->course_model->get_quiz_detail($id);
    //     $counter = count($total_questions);
    //     $questions = array();
    //     $i=0;
    //     do{
    //         $index = rand(0, $counter-1);
    //         if (array_key_exists($index, $questions)) {
    //             continue;
    //         }
    //         $questions[$index] = $total_questions[$index];
    //         $i++ ;
    //     }while($i < $data['quiz']->random_ques_no);
            
    //     $data['questions'] = $questions;
    //     $data['ques_count'] = $counter;
    //     $data['answers'] = $this->course_model->get_quiz_answers($data['questions']);
    //     $data['content'] = $this->load->view('content/start_quiz', $data, TRUE);
    //     $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
    //     $this->load->view('home', $data);
    //     $this->session->unset_userdata('pay_id');
    //     $this->session->unset_userdata('payment_token');
    // }

    public function add_course_ppts($course_id = '', $message = '')
    {
        //        exit($course_id);
        $data = array();
        $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['sections'] = $this->course_model->get_sections($course_id);
        $data['course_id'] = $course_id;

        $data['course_title'] = $this->db->get_where('courses', array('course_id' => $course_id))->row()->course_title;
        $data['content'] = $this->load->view('form/add_course_ppts_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }
    public function upload_course_ppts($message = '')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('section', 'Select Section', 'required|integer');
        $this->form_validation->set_rules('ppt_title', 'Ppt Title', 'required');
        // $this->form_validation->set_rules('free', 'free');
        if ($this->form_validation->run() == FALSE) {
            $this->add_course_ppts($this->input->post('course_id'));
        } else {
            $form_info = array();
            if ($_FILES['media']['name']) {
                $path_parts = pathinfo($_FILES["media"]["name"]);
                $extension = $path_parts['extension'];

                $directory = $this->input->post('course_id');
                if (!is_dir('course_ppts/'.$directory)) {
                    mkdir('./course_ppts/' . $directory, 0777, TRUE);
                }
                $config['upload_path'] = './course_ppts/'.$directory.'/';
                $config['allowed_types'] = '';
                $config['file_name'] = $this->input->post('section').'_'.$this->input->post('ppt_title').'.'.$extension;
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('media')) {
                    $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                    $this->session->set_flashdata('message',$error['error']);
                    redirect(base_url('course/add_course_ppts/'.$this->input->post('course_id')));
                } else {
                    $upload_data = $this->upload->data();
                    $ppt_id = $this->course_model->add_course_ppt($upload_data['file_name']);
                }
            }else if($this->input->post('youtube')){
                $ppt_id = $this->course_model->add_course_ppt_youtube();
            }

            if ($ppt_id) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Ppt added successfully!.'
                        . '</div>';
                $this->session->set_flashdata('message', $message);
                if ($this->input->post('done')) {
                    redirect(base_url('course/course_detail/'.$this->input->post('course_id')));
                } else {
                    redirect(base_url('course/add_course_ppts/'.$this->input->post('course_id')));
                }
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('course/add_course_ppts/'.$this->input->post('course_id')));
            }
        }
    }

    public function add_course_docs_selected_section($section_id = '', $message = '')
    {
        //        exit($course_id);
        $data = array();
        $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['section_id'] = $section_id;

        $data['courses'] = $this->course_model->get_courses($section_id);
        $data['course_id'] =$this->db->get_where('course_sections', array('section_id' => $section_id))->row()->course_id;
        
        $course_id =$data['course_id'];
        $data['course_title'] = $this->db->get_where('courses', array('course_id' => $course_id))->row()->course_title;
        $data['section_name'] = $this->db->get_where('course_sections', array('section_id' => $section_id))->row()->section_name;
        $data['content'] = $this->load->view('form/add_course_docs_selected_section_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }
    public function upload_course_docs_selected_section($message = '')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('section', 'Select Section', 'required|integer');
        $this->form_validation->set_rules('doc_title', 'Doc Title', 'required');
        // $this->form_validation->set_rules('faudioree', 'free');
        if ($this->form_validation->run() == FALSE) {
            $this->add_course_docs($this->input->post('course_id'));
        } else {
            $form_info = array();
            if ($_FILES['media']['name']) {
                $path_parts = pathinfo($_FILES["media"]["name"]);
                $extension = $path_parts['extension'];

                $directory = $this->input->post('course_id');
                if (!is_dir('course_docs/'.$directory)) {
                    mkdir('./course_docs/' . $directory, 0777, TRUE);
                }
                $config['upload_path'] = './course_docs/'.$directory.'/';
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['file_name'] = $this->input->post('section').'_'.$this->input->post('doc_title').'.'.$extension;
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('media')) {
                    $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                    $this->session->set_flashdata('message',$error['error']);
                    redirect(base_url('course/add_course_docs/'.$this->input->post('course_id')));
                } else {
                    $upload_data = $this->upload->data();
                    $doc_id = $this->course_model->add_course_doc($upload_data['file_name']);
                }
            }else if($this->input->post('youtube')){
                $doc_id = $this->course_model->add_course_doc_youtube();
            }

            if ($doc_id) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Doc added successfully!.'
                        . '</div>';
                $this->session->set_flashdata('message', $message);
                if ($this->input->post('done')) {
                    redirect(base_url('course/section_detail/'.$this->input->post('section')));
                } else {
                    redirect(base_url('course/add_course_docs_selected_section/'.$this->input->post('section')));
                }
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('course/add_course_docs_selected_section/'.$this->input->post('section')));
            }
        }
    }
    public function add_course_docs($course_id = '', $message = '')
    {
        //        exit($course_id);
        $data = array();
        $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['sections'] = $this->course_model->get_sections($course_id);
        $data['course_id'] = $course_id;
        $data['course_title'] = $this->db->get_where('courses', array('course_id' => $course_id))->row()->course_title;
        $data['content'] = $this->load->view('form/add_course_docs_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function upload_course_docs($message = '')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('section', 'Select Section', 'required|integer');
        $this->form_validation->set_rules('doc_title', 'Doc Title', 'required');
        // $this->form_validation->set_rules('free', 'free');
        if ($this->form_validation->run() == FALSE) {
            $this->add_course_docs($this->input->post('course_id'));
        } else {
            $form_info = array();
            if ($_FILES['media']['name']) {
                $path_parts = pathinfo($_FILES["media"]["name"]);
                $extension = $path_parts['extension'];

                $directory = $this->input->post('course_id');
                if (!is_dir('course_docs/'.$directory)) {
                    mkdir('./course_docs/' . $directory, 0777, TRUE);
                }
                $config['upload_path'] = './course_docs/'.$directory.'/';
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['file_name'] = $this->input->post('section').'_'.$this->input->post('doc_title').'.'.$extension;
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('media')) {
                    $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                    $this->session->set_flashdata('message',$error['error']);
                    redirect(base_url('course/add_course_docs/'.$this->input->post('course_id')));
                } else {
                    $upload_data = $this->upload->data();
                    $doc_id = $this->course_model->add_course_doc($upload_data['file_name']);
                }
            }else if($this->input->post('youtube')){
                $doc_id = $this->course_model->add_course_doc_youtube();
            }

            if ($doc_id) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Doc added successfully!.'
                        . '</div>';
                $this->session->set_flashdata('message', $message);
                if ($this->input->post('done')) {
                    redirect(base_url('course/course_detail/'.$this->input->post('course_id')));
                } else {
                    redirect(base_url('course/add_course_docs/'.$this->input->post('course_id')));
                }
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('course/add_course_docs/'.$this->input->post('course_id')));
            }
        }
    }
    public function add_course_audios_selected_section($section_id = '', $message = '')
    {
        //        exit($course_id);
        $data = array();
        $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['section_id'] = $section_id;
        $data['courses'] = $this->course_model->get_courses($section_id);
        $data['course_id'] =$this->db->get_where('course_sections', array('section_id' => $section_id))->row()->course_id;
        
        $course_id =$data['course_id'];
        $data['course_title'] = $this->db->get_where('courses', array('course_id' => $course_id))->row()->course_title;
        $data['section_name'] = $this->db->get_where('course_sections', array('section_id' => $section_id))->row()->section_name;
        $data['content'] = $this->load->view('form/add_course_audios_selected_section_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }
    public function upload_course_audios_selected_section($message = '')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('section', 'Select Section', 'required|integer');
        $this->form_validation->set_rules('audio_title', 'Audio Title', 'required');
        // $this->form_validation->set_rules('free', 'free');
        if ($this->form_validation->run() == FALSE) {
            $this->add_course_audios($this->input->post('course_id'));
        } else {
            $form_info = array();
            if ($_FILES['media']['name']) {
                $path_parts = pathinfo($_FILES["media"]["name"]);
                $extension = $path_parts['extension'];

                $directory = $this->input->post('course_id');
                if (!is_dir('course_audios/'.$directory)) {
                    mkdir('./course_audios/' . $directory, 0777, TRUE);
                }
                $config['upload_path'] = './course_audios/'.$directory.'/';
                $config['allowed_types'] = 'mp3|wav';
                $config['file_name'] = $this->input->post('section').'_'.$this->input->post('audio_title').'.'.$extension;
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('media')) {
                    $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                    $this->session->set_flashdata('message',$error['error']);
                    redirect(base_url('course/add_course_audios/'.$this->input->post('course_id')));
                } else {
                    $upload_data = $this->upload->data();
                    $audio_id = $this->course_model->add_course_audio($upload_data['file_name']);
                }
            }else if($this->input->post('youtube')){
                $audio_id = $this->course_model->add_course_audio_youtube();
            }

            if ($audio_id) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Audio added successfully!.'
                        . '</div>';
                $this->session->set_flashdata('message', $message);
                if ($this->input->post('done')) {
                    redirect(base_url('course/section_detail/'.$this->input->post('section')));
                } else {
                    redirect(base_url('course/add_course_audios_selected_section/'.$this->input->post('section')));
                }
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('course/add_course_audios_selected_section/'.$this->input->post('section')));
            }
        }
    }
    public function add_course_audios($course_id = '', $message = '')
    {
        //        exit($course_id);
        $data = array();
        $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['sections'] = $this->course_model->get_sections($course_id);
        $data['course_id'] = $course_id;
        $data['course_title'] = $this->db->get_where('courses', array('course_id' => $course_id))->row()->course_title;
        $data['content'] = $this->load->view('form/add_course_audios_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }
     public function upload_course_audios($message = '')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('section', 'Select Section', 'required|integer');
        $this->form_validation->set_rules('audio_title', 'Audio Title', 'required');
        // $this->form_validation->set_rules('free', 'free');
        if ($this->form_validation->run() == FALSE) {
            $this->add_course_audios($this->input->post('course_id'));
        } else {
            $form_info = array();
            if ($_FILES['media']['name']) {
                $path_parts = pathinfo($_FILES["media"]["name"]);
                $extension = $path_parts['extension'];

                $directory = $this->input->post('course_id');
                if (!is_dir('course_audios/'.$directory)) {
                    mkdir('./course_audios/' . $directory, 0777, TRUE);
                }
                $config['upload_path'] = './course_audios/'.$directory.'/';
                $config['allowed_types'] = 'mp3|wav';
                $config['file_name'] = $this->input->post('section').'_'.$this->input->post('audio_title').'.'.$extension;
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('media')) {
                    $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                    $this->session->set_flashdata('message',$error['error']);
                    redirect(base_url('course/add_course_audios/'.$this->input->post('course_id')));
                } else {
                    $upload_data = $this->upload->data();
                    $audio_id = $this->course_model->add_course_audio($upload_data['file_name']);
                }
            }else if($this->input->post('youtube')){
                $audio_id = $this->course_model->add_course_audio_youtube();
            }

            if ($audio_id) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Audio added successfully!.'
                        . '</div>';
                $this->session->set_flashdata('message', $message);
                if ($this->input->post('done')) {
                    redirect(base_url('course/course_detail/'.$this->input->post('course_id')));
                } else {
                    redirect(base_url('course/add_course_audios/'.$this->input->post('course_id')));
                }
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('course/add_course_audios/'.$this->input->post('course_id')));
            }
        }
    }
    public function add_course_videos_selected_section($section_id = '', $message = '')
    {
        //        exit($course_id);
        $data = array();
        $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['section_id'] = $section_id;
        $data['courses'] = $this->course_model->get_courses($section_id);
        $data['course_id'] =$this->db->get_where('course_sections', array('section_id' => $section_id))->row()->course_id;

        $course_id =$data['course_id'];
        $data['course_title'] = $this->db->get_where('courses', array('course_id' => $course_id))->row()->course_title;
        $data['section_name'] = $this->db->get_where('course_sections', array('section_id' => $section_id))->row()->section_name;
        $data['content'] = $this->load->view('form/add_course_videos_selected_section_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }
    public function upload_course_videos_selected_section($message = '')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('section', 'Select Section', 'required|integer');
        $this->form_validation->set_rules('video_title', 'Video Title', 'required');
        // $this->form_validation->set_rules('faudioree', 'free');
        if ($this->form_validation->run() == FALSE) {
            $this->add_course_videos($this->input->post('course_id'));
        } else {
            $form_info = array();
            if ($_FILES['media']['name']) {
                $path_parts = pathinfo($_FILES["media"]["name"]);
                $extension = $path_parts['extension'];

                $directory = $this->input->post('course_id');
                if (!is_dir('course_videos/'.$directory)) {
                    mkdir('./course_videos/' . $directory, 0777, TRUE);
                }
                $config['upload_path'] = './course_videos/'.$directory.'/';
                $config['allowed_types'] = 'mp4|flv|avi|mpeg|ogg|webm';
                $config['file_name'] = $this->input->post('section').'_'.$this->input->post('video_title').'.'.$extension;
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('media')) {
                    $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                    $this->session->set_flashdata('message',$error['error']);
                    redirect(base_url('course/add_course_videos/'.$this->input->post('course_id')));
                } else {
                    $upload_data = $this->upload->data();
                    $video_id = $this->course_model->add_course_video($upload_data['file_name']);
                }
            }else if($this->input->post('youtube')){
                $video_id = $this->course_model->add_course_video_youtube();
            }

            if ($video_id) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Video added successfully!.'
                        . '</div>';
                $this->session->set_flashdata('message', $message);
                if ($this->input->post('done')) {
                    redirect(base_url('course/section_detail/'.$this->input->post('section')));
                } else {
                    redirect(base_url('course/add_course_videos_selected_section/'.$this->input->post('section')));
                }
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('course/add_course_videos_selected_section/'.$this->input->post('section')));
            }
        }
    }
    public function add_course_videos($course_id = '', $message = '')
    {
        //        exit($course_id);
        $data = array();
        $data['class'] = 92; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['sections'] = $this->course_model->get_sections($course_id);
        $data['course_id'] = $course_id;
        $data['course_title'] = $this->db->get_where('courses', array('course_id' => $course_id))->row()->course_title;
        $data['content'] = $this->load->view('form/add_course_videos_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function upload_course_videos($message = '')
    {
        // echo "<pre/>"; print_r($_FILES); echo "<pre/>"; print_r($_POST); exit();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('section', 'Select Section', 'required|integer');
        $this->form_validation->set_rules('video_title', 'Video Title', 'required');
        // $this->form_validation->set_rules('free', 'free');
        if ($this->form_validation->run() == FALSE) {
            $this->add_course_videos($this->input->post('course_id'));
        } else {
            $form_info = array();
            if ($_FILES['media']['name']) {
                $path_parts = pathinfo($_FILES["media"]["name"]);
                $extension = $path_parts['extension'];

                $directory = $this->input->post('course_id');
                if (!is_dir('course_videos/'.$directory)) {
                    mkdir('./course_videos/' . $directory, 0777, TRUE);
                }
                $config['upload_path'] = './course_videos/'.$directory.'/';
                $config['allowed_types'] = 'mp4|flv|avi|mpeg|ogg|webm';
                $config['file_name'] = $this->input->post('section').'_'.$this->input->post('video_title').'.'.$extension;
                $config['overwrite'] = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('media')) {
                    $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                    $this->session->set_flashdata('message',$error['error']);
                    redirect(base_url('course/add_course_videos/'.$this->input->post('course_id')));
                } else {
                    $upload_data = $this->upload->data();
                    $video_id = $this->course_model->add_course_video($upload_data['file_name']);
                }
            }else if($this->input->post('youtube')){
                $video_id = $this->course_model->add_course_video_youtube();
            }

            if ($video_id) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Video added successfully!.'
                        . '</div>';
                $this->session->set_flashdata('message', $message);
                if ($this->input->post('done')) {
                    redirect(base_url('course/course_detail/'.$this->input->post('course_id')));
                } else {
                    redirect(base_url('course/add_course_videos/'.$this->input->post('course_id')));
                }
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('course/add_course_videos/'.$this->input->post('course_id')));
            }
        }
    }

    public function course_detail($id, $message = '')
    {        
        if (!is_numeric($id)) {
            show_404();
        }
        $data = array();
        $data['class'] = 91;   // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['courses'] = $this->course_model->get_course_detail($id);
        $data['sections'] = $this->course_model->get_sections($id);
        $data['content'] = $this->load->view('content/course_detail', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $data['extra_footer'] = $this->load->view('plugin_scripts/drag-n-drop','', TRUE);
        $this->load->view('dashboard', $data);
    }

    public function section_detail($id, $message = '')
    {        
        if (!is_numeric($id)) show_404();
        
        $data = array();
        $data['class'] = 91;   // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        //        $data['courses'] = $this->course_model->get_course_detail($id);
        $data['section'] = $this->course_model->get_section_detail($id);
        $data['videos'] = $this->course_model->get_section_videos($id, $data['section']->course_id);
        $data['quizs'] = $this->course_model->get_all_quizs($id);
        $data['content'] = $this->load->view('content/section_detail', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $data['extra_footer'] = $this->load->view('plugin_scripts/drag-n-drop','', TRUE);
         //echo "<pre/>"; print_r($data['videos']); exit();
        $this->load->view('dashboard', $data);
    }
   

    public function edit_course_detail($id, $message = '')
    {        
        if (!is_numeric($id)) {
            show_404();
        }
        $data = array();
        $data['class'] = 91;   // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['courses'] = $this->course_model->get_course_detail($id);
        $data['content'] = $this->load->view('form/edit_course_detail', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }
    public function update_course($id, $message = '')
    {
        if (!is_numeric($id)) {
            show_404();
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category', 'Category', 'required|integer');
        $this->form_validation->set_rules('course_title', 'Course Title', 'required');
        $this->form_validation->set_rules('course_intro', 'Course Introduction', 'required');
        $this->form_validation->set_rules('course_description', 'Course Description', 'required');
        $this->form_validation->set_rules('course_requirement', 'Course Requirements', 'required');
        $this->form_validation->set_rules('target_audience', 'Course Audience', 'required');
        $this->form_validation->set_rules('what_i_get', 'What I Get', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->course_model->update_course_title($id);
        } else {
          //  echo "<pre/>"; print_r($this->input->post()); exit();
            $form_info = array();
            if ($_FILES['feature_image']['name']) {
                $config['upload_path'] = './course-images/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = uniqid();
                $config['overwrite'] = TRUE;
                $config['max_size'] = '150';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('feature_image')) {
                    $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                    $this->session->set_flashdata('message',$error['error']);
                    redirect(base_url('course/edit_course_detail/'.$id));
                } else {
                    $upload_data = $this->upload->data();
                    $title_id = $this->course_model->update_course_title($id, $upload_data['file_name']);
                }
            }else{
                // echo "<pre/>"; print_r($this->input->post()); exit();
                $title_id = $this->course_model->update_course_title($id);
            }

            if ($title_id) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Course updated successfully!.'
                        . '</div>';
                    $this->session->set_flashdata('message',$message);
                    redirect(base_url('course/view_all_courses'));
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                    $this->session->set_flashdata('message',$message);
                    redirect(base_url('course/edit_course_detail/'.$id));
            }
        }
    }
    function delete_course($id)
    {
        if (!is_numeric($id)) {
            show_404();
        }
        $have_sections = $this->db->get_where('course_sections', array('course_id' => $id))->result();
        
               
        if (!empty($have_sections)) {
            //echo "<pre/>"; print_r($have_video); exit();
            $message = '<div class="alert alert-danger">This course has sections. Please delete all sections on the course and try again.</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('course/course_detail/'.$have_sections[0]->course_id));
        }else{
            $course_id = $this->db->get_where('courses', array('course_id' => $id))->row()->course_id;
            $this->db->where('course_id', $id);
            $this->db->delete('courses');
            if ($this->db->affected_rows() == 1) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Course deleted successfully!.'
                        . '</div>';
            }else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            }
            $this->session->set_flashdata('message', $message);
            redirect(base_url('course/view_all_courses/'.$course_id));
        }
    }
    
    function delete_video($id)
    {
        if (!is_numeric($id)) show_404(); 
        $user_id = $this->session->userdata('user_id');
        $user_role_id = $this->session->userdata('user_role_id');
        $video = $this->db->where('video_id', $id)->get('course_videos')->row();
        if ($user_role_id > 2) {
            $author = $this->db->where('course_id', $video->course_id)->get('courses')->row()->created_by;
            if ($author != $user_id) {
                exit('<h2>You are not Authorised person to do this!</h2>');
            }
        }

        $this->db->where('video_id', $id)->delete('course_videos');

        if (unlink('course_videos/'.$video->course_id.'/'.$video->video_link)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'The video has deleted successfully.'
                    . '</div>';
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url('course/section_detail/'.$video->section_id));
    }

    public function save_order()
    {
         $order = $_POST['ID'];
         $k  = 1;

         $str = implode(",", $order);
        // echo "<pre/>"; print_r($order); exit();
        foreach ($order as $k => $val){
            $data['orderList'] = $k;
            $this->db->where('section_id', $val)->update('course_sections', $data);
            
        }
        $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Saved successfully!.'
                        . '</div>';
        echo $message;
        
    }

    public function save_order_vdo()
    {
         $order = $_POST['ID'];
         $k  = 1;

         $str = implode(",", $order);
        // echo "<pre/>"; print_r($order); exit();
        foreach ($order as $k => $val){
            $data['orderList'] = $k;
            $this->db->where('video_id', $val)->update('course_videos', $data);

        }
        $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Saved successfully!.'
                        . '</div>';
        echo $message;
    }

    

    function update_section()
    {
        //        print_r($_POST);        exit();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('section_id', 'Section Id', 'required|integer');
        $this->form_validation->set_rules('section_name', 'Section Name', 'required');
        $this->form_validation->set_rules('section_title', 'Section Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->course_detail($this->input->post('course_id'));
        } else {
            if ($this->course_model->update_section()) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Section updated successfully!.'
                        . '</div>';
            }else{
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            }
            $this->course_detail($this->input->post('course_id'), $message);
        }
    }

    function update_video()
    {
        //        print_r($_POST);        exit();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('video_id', 'Video Id', 'required|integer');
        $this->form_validation->set_rules('video_title', 'Video Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->course_detail($this->input->post('course_id'));
        } else {
            if ($this->course_model->update_video()) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Video updated successfully!.'
                        . '</div>';
            }else{
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            }
            $this->section_detail($this->input->post('section_id'), $message);
        }
    }

    function delete_section($id)
    {
        if (!is_numeric($id)) {
            show_404();
        }
        $have_video = $this->db->get_where('course_videos', array('section_id' => $id))->result();
        if (!empty($have_video)) {
            //echo "<pre/>"; print_r($have_video); exit();
            $message = '<div class="alert alert-danger">This section has videos. Please delete all videos on the section and try again.</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('course/course_detail/'.$have_video[0]->course_id));
        }else{
            $course_id = $this->db->get_where('course_sections', array('section_id' => $id))->row()->course_id;
            $this->db->where('section_id', $id);
            $this->db->delete('course_sections');
            if ($this->db->affected_rows() == 1) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Section deleted successfully!'
                        . '</div>';
            }else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            }
            $this->session->set_flashdata('message', $message);
            redirect(base_url('course/course_detail/'.$course_id));
        }
    }
    public function enroll($id = NULL, $message = '')
    {
        if (($id == '') OR !is_numeric($id))  show_404();
        if (!$this->session->userdata('log')){
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('login_control'));
        } 
        $course_info = $this->db->get_where('courses', array('course_id' => $id))->row();
        $payment_settings = $this->admin_model->get_paypal_settings();
        $currency = $this->db->select('currency.currency_code,currency.currency_symbol')
                        ->from('paypal_settings')
                        ->join('currency', 'currency.currency_id = paypal_settings.currency_id')
                        ->get()->row_array();
        if ($payment_settings->sandbox == 1)  $mode = TRUE; else $mode = FALSE;

        $settings = array(
            'username' => $payment_settings->api_username,
            'password' => $payment_settings->api_pass,
            'signature' => $payment_settings->api_signature,
            'test_mode' => $mode
        );
        $params = array(
            'amount' => $course_info->course_price,
            'currency' => $currency['currency_code'],
            'description' => $course_info->course_title,
            'return_url' => base_url('course/payment_complete/'.$id),
            'cancel_url' => base_url('course/course_summary/'.$id)
        );
            // echo "<pre/>"; print_r($params); exit();

        $this->load->library('merchant');
        $this->merchant->load('paypal_express');
        $this->merchant->initialize($settings);
        $response = $this->merchant->purchase($params);

        if ($response->status() == Merchant_response::FAILED) {
            $message = $response->message();
            echo('Error processing payment: ' . $message);
        }
    }

    public function payment_complete($id)
    {
        $course_info = $this->db->get_where('courses', array('course_id' => $id))->row();
        $payment_settings = $this->admin_model->get_paypal_settings();
        $currency = $this->db->select('currency.currency_code,currency.currency_symbol')
                        ->from('paypal_settings')
                        ->join('currency', 'currency.currency_id = paypal_settings.currency_id')
                        ->get()->row_array();
        if ($payment_settings->sandbox == 1) {
            $mode = TRUE;
        }else{
            $mode = FALSE;
        }
        $settings = array(
            'username' => $payment_settings->api_username,
            'password' => $payment_settings->api_pass,
            'signature' => $payment_settings->api_signature,
            'test_mode' => $mode
        );
        $params = array(
            'amount' => $course_info->course_price,
            'currency' => $currency['currency_code'],
            'cancel_url' => base_url('course/course_summary/'.$id)
        );

        $this->load->library('merchant');
        $this->merchant->load('paypal_express');
        $this->merchant->initialize($settings);
        $response = $this->merchant->purchase_return($params);

        if ($response->success()) {
            $message = '<div class="alert alert-sucsess alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Payment Successful!</div>';
            $this->session->set_flashdata('message', $message);
            $data = array();
            $data['PayerID'] = $this->input->get('PayerID');
            $data['token'] = $this->input->get('token');
            $data['course_title'] = $course_info->course_title;
            $data['pay_amount'] = $course_info->course_price;
            $data['currency_code'] = $currency_code . ' ' . $currency_symbol;
            $data['method'] = 'PayPal';
            $data['gateway_reference'] = $response->reference();
            $paymentRefId = $this->set_payment_detail($data);

            $data['paymentRefId'] = $paymentRefId;
            $data['pur_ref_id'] = $id;
            $this->set_purchase_detail($data);

            $message .= '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Sessions are unlocked now.'
                    . '</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('course/course_summary/'.$id));
        } else {
            $message = $response->message();
            echo('Error processing payment: ' . $message);
        }
    }

    public function set_payment_detail($info)
    {
        $data = array();
        $data['payer_id'] = $info['PayerID'];
        $data['token'] = $info['token'];
        $data['pay_amount'] = $info['pay_amount'];
        $data['payment_type'] = 'Course';
        $data['currency_code'] = $info['currency_code'];
        $data['user_id_ref'] = $this->session->userdata('user_id');
        $data['payment_reference'] = $info['course_title'];
        $data['pay_date'] = date('Y-m-d');
        $data['pay_method'] = $info['method'];
        $data['gateway_reference'] = $info['gateway_reference'];
        $this->db->insert('payment_history', $data);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function set_purchase_detail($info)
    {
        $data = array();
        $data['type'] = 'Course';
        $data['user_id'] = $this->session->userdata('user_id');
        $data['pur_ref_id'] = $info['pur_ref_id'];
        $data['pur_date'] = date('Y-m-d');

        $data['payment_id'] = $info['paymentRefId'];

        $this->db->insert('puchase_history', $data);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    
}

