<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class User_control extends MS_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('log')) {
            redirect(base_url());
        }
        $this->load->model('user_model');
        $this->load->model('admin_model');
    }

    public function index($message = '')
    {
        $data = array();
        $data['class'] = 11; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', $data, TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['users'] = $this->user_model->get_all_users();
        $data['user_role'] = $this->admin_model->get_user_role();
        $data['content'] = $this->load->view('content/view_all_users', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function view_banned_users($message = '')
    {
        $data = array();
        $data['class'] = 13; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', $data, TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['users'] = $this->user_model->get_benned_users();
        $data['content'] = $this->load->view('content/view_banned_users', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    // public function user_add_form($message = '')
    // {
    //     $data = array();
    //     $data['class'] = 12; // class control value left digit for main manu rigt digit for submenu
    //     $data['header'] = $this->load->view('header/admin_head', $data, TRUE);
    //     $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
    //     $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
    //     $data['message'] = $message;
    //     $data['user_role'] = $this->admin_model->get_user_role();
    //     $data['content'] = $this->load->view('form/user_add_form', $data, TRUE);
    //     $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
    //     $this->load->view('dashboard', $data);
    // }

    public function add_user()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Name', 'required');
        $this->form_validation->set_rules('user_email', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('user_pass', 'Password', 'required|min_length[4]');
        $this->form_validation->set_rules('user_passcf', 'Confirm Password', 'required|min_length[4]|matches[user_pass]');
        $this->form_validation->set_rules('user_role', 'User Type', 'callback_user_role_check');
        if ($this->form_validation->run() == FALSE) {
            $this->user_add_form();
        } else {
            date_default_timezone_set($this->session->userdata['time_zone']);
            $this->load->model('login_model');
            $info = array();
            $info['user_name'] = $this->input->post('user_name', TRUE);
            $info['user_email'] = $this->input->post('user_email', TRUE);
            $info['user_phone'] = $this->input->post('user_phone', TRUE);
            $info['user_role_id'] = $this->input->post('user_role', TRUE);
            $info['user_pass'] = md5($this->input->post('user_pass'));
            $info['user_from'] = date('Y-m-d H:i:s');
            $info['active'] = 1;
            if (!($info['user_role_id'] > $this->session->userdata('user_role_id'))) {
                show_404();
            }
            if ($this->login_model->register($info)) {
                $from = $this->session->userdata['support_email'];
                $to = $info['user_email'];
                $suject = 'You are added with ' . $this->session->userdata['brand_name'];
                $message_body = 'Initial Login info:</br> User Name: ' . $info['user_email'] 
                        . '</br>Password: ' . $this->input->post('user_pass') . '</br></br>'
                        . 'Use this link to login: ' . base_url('login_control') . '</br></br>'
                        . 'Note: Change you password after login.';
                $config = Array(
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE
                );
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from($from);
                $this->email->to($to);
                $this->email->subject($suject);
                $this->email->message($message_body);
                $this->email->send();

                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'User Added Successfully! User name and Password sent to the user\'s mail address.'
                        . '</div>';
                $this->index($message);
            } else {
                $message = '<div class="alert alert-danger alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . '"' . $info['user_email'] . '" is already used by another account. Try another email.</div>';
                $this->user_add_form($message);
            } 
        }
    }

    public function user_add_form($message = '')
    {
        $data = array();
        $data['class'] = 12; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', $data, TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['user_role'] = $this->admin_model->get_user_role();
        $data['content'] = $this->load->view('form/user_add_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }    

    public function update_user_data()
    {
        echo ($this->user_model->update_user_data()) ? 'TRUE' : 'FALSE';
    }

    public function deactivate_user_account($id)
    {        
        if (!is_numeric($id) OR ($this->session->userdata('user_role_id') > $id)){
            show_404();
        }
        if ($this->user_model->deactivate_user_account($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Deactivated successfully.!'
                    . '</div>';
            $this->index($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->index($message);
        }
    }

    public function ban_user_account($id)
    {
        if (!is_numeric($id) OR ($this->session->userdata('user_role_id') >= $id)) {
            show_404();
        }
        if ($this->user_model->ban_user_account($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'This account has banned successfully.!'
                    . '</div>';
            $this->index($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->index($message);
        }
    }

    public function activate_user_account($id)
    {
        if (!is_numeric($id) OR ($this->session->userdata('user_role_id') >= $id)) {
            show_404();
        }
        if ($this->user_model->activate_user_account($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Activated successfully.!'
                    . '</div>';
            $this->view_banned_users($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->view_banned_users($message);
        }
    }

    public function unban_user_account($id)
    {
        if (!is_numeric($id) OR ($this->session->userdata('user_role_id') >= $id)) {
            show_404();
        }
        if ($this->user_model->unban_user_account($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Unbanned successfully.!'
                    . '</div>';
            $this->view_banned_users($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->view_banned_users($message);
        }
    }

}