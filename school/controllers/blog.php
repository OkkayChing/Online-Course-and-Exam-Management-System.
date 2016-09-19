<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Blog extends MS_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('blog_model');
        $this->load->library('pagination');
    }

    public function index()
    {
        ///// Pagination config
        $config['base_url'] = base_url('blog/index');
        $config['total_rows'] = $this->db->count_all('blog');

        $config['per_page'] = 2; 
        $config['num_links'] = 3; 
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '&laquo;';
        $config['next_link'] = '&raquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $row = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['blogs'] = $this->blog_model->get_blogs($config['per_page'], $row);
        $data['content'] = $this->load->view('content/blog_page', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $this->load->view('home', $data);
    }

    public function view_all($message = '')
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('admin'));
        }

        $data = array();
        $data['class'] = 71; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['blogs'] = $this->blog_model->get_all();
        $data['message'] = $message;
        $data['content'] = $this->load->view('admin/view_all_blog', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function post($id = '')
    {
        if(!is_numeric($id))  show_404();

        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['post'] = $this->blog_model->get_post($id);
        $data['post_comments'] = $this->blog_model->get_post_comments($id);
        $data['content'] = $this->load->view('content/blog_post_single', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $this->load->view('home', $data);
    }

    public function find()
    {
        $_POST = $_GET;
        $this->load->library('form_validation');

        $this->form_validation->set_rules('keyword', 'Search keyword', 'required|min_length[3]|xss_clean');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message', validation_errors('<div class="alert alert-warning">', '</div>'));
            redirect(base_url('blog'));
        }else{
            $data = array();
            $data['header'] = $this->load->view('header/head', '', TRUE);
            $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
            $data['blogs'] = $this->blog_model->find();
            $data['content'] = $this->load->view('content/blog_page', $data, TRUE);
            $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
            $this->load->view('home', $data);            
        }

    }

    public function add($message = '')
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('admin'));
        }
        $data = array();
        $data['class'] = 72; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $data['content'] = $this->load->view('form/blog_form', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function save()
    {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('blog_title', 'Blog Title', 'required');
        $this->form_validation->set_rules('post_descr', 'Content ', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->add();
        } else {
            if ($this->blog_model->save()) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Post added successfully!'
                        . '</div>';
                    $this->view_all($message);
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->add($message);
            }
        }
    }

    public function edit($id = '' , $message = '')
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('admin'));
        }
        if (!is_numeric($id)) return FALSE;
        $data = array();
        $data['class'] = 72; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['blog'] = $this->blog_model->get_blog_by_id($id);
        $data['message'] = $message;
        $data['content'] = $this->load->view('form/blog_edit_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function update($id = '')
    {
        if (!is_numeric($id)) return FALSE;
        if ($this->blog_model->update($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Post updated successfully!'
                    . '</div>';
                $this->view_all($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->edit($id, $message);
        }
    }   

    public function delete($id)
    {
        if (!is_numeric($id)) return FALSE;
        
        if ($this->blog_model->delete($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Successfully Deleted!'
                    . '</div>';
            $this->view_all($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->view_all($message);
        }
    }

    public function comment()
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('login_control'));
        }
        $this->blog_model->save_comment();
        redirect(base_url('blog/post/'.$this->input->post('blog_id',TRUE)));
    }

}
