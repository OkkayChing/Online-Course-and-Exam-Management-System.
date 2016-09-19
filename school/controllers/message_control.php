<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Message_control extends MS_Controller
{
    public function __construct()
    {
        parent::__construct();
    
        $this->load->model('admin_model');
        if (!$this->session->userdata('log')) {
            redirect(base_url('login_control'));
        }
    }

    public function index($message = '')
    {
        $data = array();
        $data['class'] = 36; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['messages'] = $this->admin_model->get_messages();
        $data['modal'] = $this->load->view('modals/email_compose', '', TRUE);
        $data['content'] = $this->load->view('admin/view_messages', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function open_message($id = '', $message = '')
    {
        $data = array();
        $data['class'] = 36; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['message'] = $this->admin_model->open_message($id);
        $data['msg_replies'] = $this->admin_model->get_replies($data['message']->message_id);
        $data['content'] = $this->load->view('admin/open_messages', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function reply_message($id, $message = '')
    {
        if ((!is_numeric($id))) {
            return FALSE;
        }
        $data = array();
        $data['class'] = 36; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['msg_info'] = $this->admin_model->open_message($id);
        $data['content'] = $this->load->view('form/email_reply', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function send_message()
    {
        if ($this->input->post('token') == $this->session->userdata('token')) {
            exit('Can\'t re-submit the form');
        }
        if ($this->input->post('save')) {
            if ($this->admin_model->save_message()) {
                $this->session->set_userdata('token', $this->input->post('token'));
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Saved successfully.!'
                        . '</div>';
                $this->index($message);
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->index($message);
            }
        } else {
            $from = $this->session->userdata['support_email'];
            $to = $this->input->post('to', TRUE);
            $suject = $this->input->post('subject', TRUE);
            $message = $this->input->post('message', TRUE);
            if ($this->admin_model->save_message('send')) {
                $config = Array(
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE);
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from($from);
                $this->email->to($to);
                $this->email->subject($suject);
                $this->email->message($message);
                if ($this->email->send()) {
                    $this->session->set_userdata('token', $this->input->post('token'));
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'Send successfully.!'
                            . '</div>';
                } else {
                    $message = show_error($this->email->print_debugger());
                }
                $this->index($message);
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                $this->index($message);
            }
        }
    }

    public function send_reply()
    {
        $from = $this->session->userdata['support_email'];
        $to = $this->input->post('to', TRUE);
        $suject = $this->input->post('subject', TRUE);
        $message = $this->input->post('reply_message', TRUE);
        if ($this->admin_model->save_reply()) {
            $config = Array(
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE);
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($suject);
            $this->email->message($message);
            if ($this->email->send()) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Send successfully.!'
                        . '</div>';
            } else {
                $message = show_error($this->email->print_debugger());
            }
            $this->index($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->index($message);
        }
    }

    public function send_draft_message()
    {
        $from = $this->session->userdata['support_email'];
        $to = $this->input->post('to', TRUE);
        $suject = $this->input->post('subject', TRUE);
        $message = $this->input->post('reply_message', TRUE);
        if ($this->admin_model->send_draft_message()) {
            $config = Array(
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE);
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($suject);
            $this->email->message($message);
            if ($this->email->send()) {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Send successfully.!'
                        . '</div>';
            } else {
                $message = show_error($this->email->print_debugger());
            }
            $this->index($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->index($message);
        }
    }

    public function move_message($field, $id)
    {
        if ((!is_numeric($id)) OR ($this->session->userdata('user_role_id') > 3)) {
            return FALSE;
        }
        if ($this->admin_model->update_message($id, $field)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Moved successfully.!'
                    . '</div>';
            $this->index($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->index($message);
        }
    }

    public function delete_message($id)
    {
        if ((!is_numeric($id)) OR ($this->session->userdata('user_role_id') > 2)) {
            return FALSE;
        }
        if ($this->admin_model->delete_message($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Successfully Deleted!'
                    . '</div>';
            $this->index($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->index($message);
        }
    }

    public function contact_form($message = '')
    {
        $data = array();
        $data['class'] = 42; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['content'] = $this->load->view('form/contact_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function contact()
    {
        if ($this->input->post('token') == $this->session->userdata('token')) {
            exit('Can\'t re-submit the form');
        }
        $sender = $this->input->post('name', TRUE);
        $sender_email = $this->input->post('email', TRUE);
        if ($this->admin_model->save_message('inbox', $sender, $sender_email)) {
            $this->session->set_userdata('token', $this->input->post('token'));
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Send successfully.!'
                    . '</div>';
            $this->contact_form($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->contact_form($message);
        }
    }
}
