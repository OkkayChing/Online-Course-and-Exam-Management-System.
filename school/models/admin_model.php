<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_role()
    {
        $result = $this->db->get('user_role')->result();
        return $result;
    }
    
    public function set_subscription($info)
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('users', $info);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }    
    public function get_payment_history()
    {
        $result = $this->db->select('*')
                ->from('payment_history')
                ->order_by("pay_date", "desc")
                ->join('users', 'users.user_id = payment_history.user_id_ref', 'left')
                ->get()->result();
        return $result;
    }

   public function get_mock_detail($id)
    {
        $result = $this->db->select('*')
                ->where('title_id', $id)
                ->from('exam_title')
                ->join('sub_categories', 'sub_categories.id = exam_title.category_id')
                ->join('categories', 'sub_categories.cat_id = categories.category_id')
                ->join('users', 'users.user_id = exam_title.user_id')
                ->get()
                ->row();
        return $result;
    }
    /**
     * @name        get_user_mocks
     * @desc        Get an array of exam_title objects.
     * @param       id      (int)   
     */
    public function get_user_mocks($id)
    {
        if (!is_numeric($id)) {
            return FALSE;
        }
        $this->db->select('*')
                ->select("exam_title.active AS exam_active")
                ->from('exam_title')
                ->where('user_id', $id)
                ->join('categories', 'categories.category_id = exam_title.category_id');
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_messages()
    {
        $this->db->select('messages.*, COUNT(messages_reply.message_reply_id) as numOfReply')
                ->from('messages')
                ->order_by("messages.message_date", "desc")
                ->join('messages_reply', 'messages.message_id = messages_reply.message_id_fk', 'left')
                ->group_by('message_id');

        $result = $this->db->get()->result();
        return $result;
    }

    public function open_message($id)
    {
        $this->db->select('*')
                ->where('message_id', $id)
                ->from('messages');
        $result = $this->db->get()->row();
        if ($result) {
            $data = array();
            $data['message_read'] = 1;
            $this->db->where('message_id', $id);
            $this->db->update('messages', $data);
            return $result;
        } else {
            return FALSE;
        }
    }

    public function get_replies($id)
    {
        $this->db->select('*')
                ->order_by("replied_time", "asc")
                ->where('message_id_fk', $id)
                ->from('messages_reply');
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_my_profile_info()
    {
        $userId = $this->session->userdata('user_id');
        $this->db->select('*')
                ->from('users')
                ->where('users.user_id', $userId)
                ->join('user_role', 'user_role.user_role_id = users.user_role_id');
        $result = $this->db->get()->row();
        return $result;
    }

    public function save_message($folder = 'draft', $sender = '', $sender_email = '', $send_to = '')
    {
        date_default_timezone_set($this->session->userdata['time_zone']);
        $info = array();
        if ($sender == '') {
            $info['message_sender'] = $this->session->userdata['user_name'];
        } else {
            $info['message_sender'] = $sender;
        }
        if ($sender_email == '') {
            $info['sender_email'] = $this->session->userdata['support_email'];
        } else {
            $info['sender_email'] = $sender_email;
        }
        if ($send_to == '') {
            $info['message_send_to'] = $this->input->post('to', TRUE);
        } else {
            $info['message_send_to'] = $this->session->userdata['support_email'];
        }
        $info['message_subject'] = $this->input->post('subject', TRUE);
        $info['message_body'] = $this->input->post('message', TRUE);
        $info['message_date'] = date('Y-m-d H:i:s');
        $info['message_folder'] = $folder;
        $this->db->insert('messages', $info);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function save_reply()
    {
        date_default_timezone_set($this->session->userdata['time_zone']);
        $info = array();
        $info['message_id_fk'] = $this->input->post('message_id', TRUE);
        $info['replied_messages'] = $this->input->post('reply_message', TRUE);
        $info['replied_by'] = $this->session->userdata['user_id'];
        $info['replied_time'] = date('Y-m-d H:i:s');
        $this->db->insert('messages_reply', $info);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function send_draft_message()
    {
        $id = $this->input->post('message_id', TRUE);
        date_default_timezone_set($this->session->userdata['time_zone']);
        $info = array();
        $info['message_sender'] = $this->session->userdata['user_name'];
        $info['sender_email'] = $this->session->userdata['support_email'];
        $info['message_send_to'] = $this->input->post('to', TRUE);
        $info['message_subject'] = $this->input->post('subject', TRUE);
        $info['message_body'] = $this->input->post('reply_message', TRUE);
        $info['message_date'] = date('Y-m-d H:i:s');
        $info['message_folder'] = 'send';
        $info['message_read'] = 0;
        $this->db->where('message_id', $id);
        $this->db->update('messages', $info);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function create_category($cat_name)
    {
        $info = array();
        $info['category_name'] = $cat_name;
        $info['created_by'] = $info['last_modified_by'] = $this->session->userdata['user_id'];
        $if_exist = $this->db->get_where('categories', array('category_name' => $cat_name), 1)->result();
        if ($if_exist) {
            return FALSE;
        } else {
            $this->db->insert('categories', $info);
            if ($this->db->affected_rows() == 1) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        }
    }
public function create_subcategory($sub_cat_name)
    {
        $info = array();
        $info['sub_cat_name'] = $sub_cat_name;
        $info['cat_id'] = $this->input->post('category', TRUE);
        $info['created_by'] = $info['last_modified_by'] = $this->session->userdata['user_id'];
        $if_exist = $this->db->get_where('sub_categories', array('sub_cat_name' => $sub_cat_name), 1)->result();
        if ($if_exist) {
            return FALSE;
        } else {
            $this->db->insert('sub_categories', $info);
            if ($this->db->affected_rows() == 1) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        }
    }
    public function get_subcategories_by_cat_id($id)
    {
        $this->db->select('*');
        $this->db->where('cat_id', $id);
        $this->db->from('sub_categories');
        $result = $this->db->get()->result();
        return $result;
    }

    public function add_mock_title($upload_data = '')
    {
        date_default_timezone_set($this->session->userdata['time_zone']);
        $info = array();
        $info['category_id'] = $this->input->post('category', TRUE);
        $info['title_name'] = $this->input->post('mock_title', TRUE);
        $info['user_id'] = $this->session->userdata['user_id'];
        $info['syllabus'] = $this->input->post('mock_syllabus', TRUE);
        $info['pass_mark'] = $this->input->post('passing_score', TRUE);
        $info['exam_price'] = ($this->input->post('price'))?$this->input->post('price', TRUE):0;
        $info['exam_created'] = date('Y-m-d H:i:s');
        $info['public'] = $this->input->post('public', TRUE);
        $info['course_id'] = $this->input->post('course_id', TRUE);
        $info['feature_img_name'] = ($upload_data == '')?'':$upload_data;
        $info['last_modified_by'] = $this->session->userdata['user_id'];
        $if_exist = $this->db->get_where('exam_title', array('title_name' => $info['title_name']), 1)->result();
        if ($if_exist) {
            return FALSE;
        } else {
            $this->db->insert('exam_title', $info);
            if ($this->db->affected_rows() == 1) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        }
    }

    public function mute_category($id)
    {
        $data = array();
        $data['active'] = 0;
        $data['last_modified_by'] = $this->session->userdata['user_id'];
        $this->db->where('category_id', $id);
        $this->db->update('categories', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function mute_subcategory($id)
    {
        $data = array();
        $data['sub_cat_active'] = 0;
        $data['last_modified_by'] = $this->session->userdata['user_id'];
        $this->db->where('cat_id', $id);
        $this->db->update('sub_categories', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function mute_exam($id)
    {
        $data = array();
        $data['active'] = 0;
        $data['last_modified_by'] = $this->session->userdata['user_id'];
        $this->db->where('title_id', $id);
        $this->db->update('exam_title', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add_question($file_name = '', $file_type = '')
    {
        /**************INSERT QUESTION********************** */
        $info = array();
        $info['question'] = $this->input->post('question', TRUE);
        $info['exam_id'] = $this->input->post('ques_id', TRUE);
        $info['option_type'] = $this->input->post('ans_type', TRUE);
        $info['media_type'] = $file_type;
        $info['media_link'] = $file_name;
        $this->db->insert('questions', $info);
        $last_ques_id = $this->db->insert_id();
        if ($last_ques_id) {
            /*             * ************INSERT ANSWERS********************** */
            $data = array();
            $data['ques_id'] = $last_ques_id;
            $opt = array_filter($this->input->post('options'));
            $r_ans = array_filter($this->input->post('right_ans'));
            foreach ($opt as $key => $option) {
                $data['answer'] = $option;
                if (isset($r_ans[$key]) && $r_ans[$key] != '') {
                    $data['right_ans'] = 1;
                } else {
                    $data['right_ans'] = 0;
                }
                $this->db->insert('answers', $data);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function set_time_n_random_ques_no()
    {
        $data = array();
        $data['time_duration'] = $this->input->post('duration', TRUE);
        $data['random_ques_no'] = $this->input->post('random_ques', TRUE);
        $this->db->where('title_id', (int) $this->input->post('exam_id', TRUE));
        $this->db->update('exam_title', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function activate_category($id)
    {
        if ($this->session->userdata('user_role_id') > 3) {
            return FALSE;
        }
        $data = array();
        $data['active'] = 1;
        $data['last_modified_by'] = $this->session->userdata['user_id'];
        $this->db->where('category_id', (int) $id);
        $this->db->update('categories', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_category_name()
    {
        if ($this->session->userdata('user_role_id') > 3) {
            return FALSE;
        }
        $data = array();
        $data['category_name'] = $this->input->post('value', TRUE);
        $data['last_modified_by'] = $this->session->userdata['user_id'];
        $if_exist = $this->db->get_where('categories', array('category_name' => $data['category_name']), 1)->result();
        if ($if_exist) {
            return FALSE;
        } else {
            $this->db->where('category_id', (int) $this->input->post('pk'));
            $this->db->update('categories', $data);
            if ($this->db->affected_rows() == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function update_mock($id, $upload_data = '')
    {
        date_default_timezone_set($this->session->userdata['time_zone']);
        $info = array();
        $info['category_id'] = $this->input->post('category', TRUE);
        $info['title_name'] = $this->input->post('mock_title', TRUE);
        $info['user_id'] = $this->session->userdata['user_id'];
        $info['syllabus'] = $this->input->post('mock_syllabus', TRUE);
        $info['pass_mark'] = $this->input->post('passing_score', TRUE);
        $info['exam_price'] = ($this->input->post('price'))?$this->input->post('price', TRUE):0;
        $info['time_duration'] = $this->input->post('duration', TRUE);
        $info['random_ques_no'] = $this->input->post('random_ques', TRUE);
        $info['exam_created'] = date('Y-m-d H:i:s');
        $info['public'] = $this->input->post('public', TRUE);
        $info['course_id'] = $this->input->post('course_id', TRUE);
        $info['last_modified_by'] = $this->session->userdata['user_id'];

        if ($upload_data != '') {
            $info['feature_img_name'] = $upload_data;
        }
        
        $this->db->where('title_id', $id);
        $this->db->update('exam_title', $info);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function update_mock_title()
    {
        $name = $this->input->post('name');
        $data = array();
        $data['last_modified_by'] = $this->session->userdata['user_id'];
        if ($this->session->userdata('user_role_id') > 3) {
            $this->db->where('user_id', (int) $this->session->userdata('user_id'));
        }
        $this->db->where('title_id', (int) $this->input->post('pk'));
        switch ($name) {
            case 'exam_title':
                $data['title_name'] = $this->input->post('value', TRUE);
                break;
            case 'exam_price':
                $data['exam_price'] = $this->input->post('value', TRUE);
                break;
            case 'cat_id':
                $data['category_id'] = $this->input->post('value', TRUE);
                break;
            case 'active':
                $data['active'] = $this->input->post('value', TRUE);
                break;
            case 'exam_syllabus':
                $data['syllabus'] = $this->input->post('value', TRUE);
                break;
            case 'passing_score':
                $data['pass_mark'] = $this->input->post('value', TRUE);
                break;
            default:
                return FALSE;
                break;
        }
        $this->db->update('exam_title', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_question()
    {
        $data = array();
        $data['question'] = $this->input->post('question', TRUE);
        $this->db->where('ques_id', (int) $this->input->post('ques_id'));
        $this->db->where('exam_id', (int) $this->input->post('exam_id'));
        $this->db->update('questions', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_answer($ques_id)
    {
        $name = $this->input->post('name');
        $data = array();
        if ($name == 'ans-text') {
            $data['answer'] = $this->input->post('value', TRUE);
        } elseif ($name == 'right-ans') {
            $type = $this->db->get_where('questions', array('ques_id' => $ques_id), 1)->row();
            if (($type->option_type == 'Radio') && ($this->input->post('value', TRUE) == 1)) {
                $have = $this->db->select('right_ans')
                        ->from('answers')
                        ->where('ques_id', $ques_id)
                        ->where('right_ans', 1)
                        ->get()
                        ->row();
                if ($have) {
                    return FALSE;
                } else {
                    $data['right_ans'] = $this->input->post('value', TRUE);
                }
            } else {
                $data['right_ans'] = $this->input->post('value', TRUE);
            }
        } else {
            return FALSE;
        }
        $this->db->where('ques_id', $ques_id);
        $this->db->where('ans_id', (int) $this->input->post('pk'));
        $this->db->update('answers', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_message($id, $field)
    {
        $data = array();
        switch ($field) {
            case 'trash':
                $data['trash'] = 1;
                break;
            case 'spam':
                $data['spam'] = 1;
                break;
            case 'untrash':
                $data['trash'] = 0;
                break;
            case 'unspam':
                $data['spam'] = 0;
                break;
            default:
                return FALSE;
                break;
        }
        $this->db->where('message_id', $id);
        $this->db->update('messages', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_password($info)
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('users', $info);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_profile_info()
    {
        $pk = (int) $this->input->post('pk');
        $name = $this->input->post('name');
        $data = array();
        $this->db->where('user_id', $this->session->userdata('user_id'));
        switch ($name) {
            case 'email':
                $data['user_name'] = $this->input->post('value', TRUE);
                break;
            case 'phone':
                $data['user_phone'] = $this->input->post('value', TRUE);
                break;
            default:
                return FALSE;
                break;
        }
        $this->db->update('users', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_category_name($id)
    {
        if ($this->session->userdata('user_role_id') > 3) {
            return FALSE;
        }
        $have_exam = $this->db->get_where('sub_categories', array('cat_id' => $id), 1)->result();
        if ($have_exam) {
            if ($this->mute_category($id)) {
                return 'muted';
            }
        } else {
            $this->db->where('category_id', $id);
            $this->db->delete('categories');
            if ($this->db->affected_rows() == 1) {
                return 'deleted';
            } else {
                return FALSE;
            }
        }
    }
public function delete_subcategory_name($id)
    {
        
            $this->db->where('id', $id);
            $this->db->delete('sub_categories');
            if ($this->db->affected_rows() == 1) {
                return 'deleted';
            } else {
                return FALSE;
            }
        
    }
    /**
     * Delete the exam with all questions and answers related to this exam.
     * @param type $id
     * @return boolean
     */
    public function delete_exam_with_all_questions($id)
    {
        $this->db->where('title_id', $id);
        $this->db->delete('exam_title');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Delete the question with all answers related to this question.
     * @param type $id
     * @return boolean
     */
    public function delete_question_with_answers($id)
    {
        $this->db->where('ques_id', $id);
        $this->db->delete('questions');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Delete single answers.
     * @param type $id
     * @return boolean
     */
    public function delete_answer($id)
    {
        $this->db->where('ans_id', $id);
        $this->db->delete('answers');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_message($id)
    {
        $this->db->where('message_id', $id);
        $this->db->delete('messages');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_paypal_settings()
    {
        return $this->db->get('paypal_settings')->row();
    }
}
