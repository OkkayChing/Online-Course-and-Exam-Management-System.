<?php
session_start();
class Login_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function login_check() {
        $user = $this->input->post('user_email');
        $pass = md5($this->input->post('user_pass'));
        $role = ($this->input->post('user_role'))?:5;

        $data =   array(
                'user_email' => $user,
                'user_pass' => $pass,
                'user_role_id' => $role,
                'active' => 1
        );

        $query = $this->db->get_where('users', $data, 1);
        $result = $query->row();

        if ($result || $_SESSION["log"]==1) {
            if($_SESSION["log"]==1) {
                $this->session->set_userdata('log', TRUE);
                $this->session->set_userdata('user_role', $_SESSION["user_role"]);
                $this->session->set_userdata('user_name', $_SESSION["user_name"]);
                $this->session->set_userdata('user_email', $_SESSION["user_email"]);
                $this->session->set_userdata('user_id', $_SESSION["user_id"]);
                $this->session->set_userdata('user_role_id', $_SESSION["user_role_id"]);
            }else {
                $role_name = $this->db->get_where('user_role', array('user_role_id' => $result->user_role_id))->row();
                $this->session->set_userdata('log', TRUE);
                $this->session->set_userdata('user_role', $role_name->user_role_name);
                $this->session->set_userdata('user_name', $result->user_name);
                $this->session->set_userdata('user_email', $result->user_email);
                $this->session->set_userdata('user_id', $result->user_id);
                $this->session->set_userdata('user_role_id', $result->user_role_id);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function register($info) {
        $if_exist = $this->db->get_where('users', array('user_email' => $info['user_email']), 1)
                ->result();
        if ($if_exist) {
            return FALSE;
        } else {
            $this->db->insert('users', $info);
            if ($this->db->affected_rows() == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function activate_my_account($email) {
        $data = array();
        $data['active'] = 1;
        $this->db->where('user_email', $email);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_total_exam() {
        return $this->db->count_all_results('exam_title');
    }

    public function get_total_exam_by_user_id($id) {
        $this->db->where('user_id', $id)
                ->from('exam_title');
        return $this->db->count_all_results();
    }

    public function get_total_categories() {
        return $this->db->count_all_results('categories');
    }

    public function get_total_admin() {
        $this->db->where('user_role_id', 2)
                ->where('active', 1)
                ->where('banned', 0)
                ->from('users');
        return $this->db->count_all_results();
    }
    public function get_total_moderator() {
        $this->db->where('user_role_id', 3)
                ->where('active', 1)
                ->where('banned', 0)
                ->from('users');
        return $this->db->count_all_results();
    }

    public function get_total_teacher() {
        $this->db->where('user_role_id', 4)
                ->where('active', 1)
                ->where('banned', 0)
                ->from('users');
        return $this->db->count_all_results();
    }

    public function get_total_studnet() {
        $this->db->where('user_role_id', 5)
                ->where('active', 1)
                ->where('banned', 0)
                ->from('users');
        return $this->db->count_all_results();
    }

    public function get_new_users() {
        $this->db->where("user_from >= DATE_SUB(NOW(),INTERVAL 24 HOUR)", NULL, FALSE)
                ->from('users');
        return $this->db->count_all_results();
    }

    public function get_new_exams() {
        $this->db->where("exam_created >= DATE_SUB(NOW(),INTERVAL 24 HOUR)", NULL, FALSE)
                ->from('exam_title');
        return $this->db->count_all_results();
    }

    public function new_exams_taken() {
        if ($this->session->userdata['user_role_id'] > 3) {
            $this->db->where("result.exam_taken_date >= DATE_SUB(NOW(),INTERVAL 24 HOUR)", NULL, FALSE)
                    ->where('exam_title.user_id', $this->session->userdata['user_id'])
                    ->from('result')
                    ->join('exam_title', 'exam_title.title_id = result.exam_id', 'left')
                    ->join('users', 'exam_title.user_id = users.user_id', 'left');
            return $this->db->count_all_results();
        } else {
            $this->db->where("exam_taken_date >= DATE_SUB(NOW(),INTERVAL 24 HOUR)", NULL, FALSE)
                    ->from('result');
            return $this->db->count_all_results();
        }
    }

    public function exams_taken() {
        if ($this->session->userdata['user_role_id'] > 3) {
            $this->db->where('exam_title.user_id', $this->session->userdata['user_id'])
                    ->from('result')
                    ->join('exam_title', 'exam_title.title_id = result.exam_id', 'left')
                    ->join('users', 'exam_title.user_id = users.user_id', 'left');
            return $this->db->count_all_results();
        } else {
            return $this->db->count_all_results('result');
        }
    }

    public function get_unread_messages() {
        $this->db->where('message_read', 0)
                ->from('messages');
        return $this->db->count_all_results();
    }

}