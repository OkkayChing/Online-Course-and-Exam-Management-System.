<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Faq_control extends MS_Controller
{
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->model('admin_model');
        $this->load->model('system_model');
        if (!$this->session->userdata('log')) {
            redirect(base_url('login_control'));
        }
    }

    public function index($message = '')
    {
        $data = array();
        $data['class'] = 33; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['faqs'] = $this->system_model->get_faqs();
        $data['content'] = $this->load->view('admin/view_faqs', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function faq_form($message = '')
    {
        $data = array();
        $data['class'] = 33; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $data['content'] = $this->load->view('form/faq_form', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function add_faq()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('faq_q', 'Question', 'required|min_length[5]');
        $this->form_validation->set_rules('faq_ans', 'Answer ', 'required');
        $this->form_validation->set_rules('faq_grp_id', 'Group ', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->faq_form();
        } else {
            if ($this->session->userdata['user_role_id'] <= 3) {
                if ($this->system_model->add_faq()) {
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'FAQ added successfully!'
                            . '</div>';
                    if ($this->input->post('more')) {
                        $this->faq_form($message);
                    } else {
                        $this->index($message);
                    }
                } else {
                    $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                    $this->faq_form($message);
                }
            } else {
                exit('<h2>You are not Authorised person to do this!</h2>');
            }
       }
    }

    public function update_faq($id, $message = '')
    {

        if ($_POST) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('faq_q', 'Question', 'required|min_length[5]');
            $this->form_validation->set_rules('faq_ans', 'Answer ', 'required');
            $this->form_validation->set_rules('faq_grp_id', 'Group ', 'required');
            if ($this->form_validation->run() != FALSE) {
                if ($this->session->userdata['user_role_id'] <= 3) {
                    if ($this->system_model->update_faq($id)) {
                        $message = '<div class="alert alert-success alert-dismissable">'
                                . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                                . 'FAQ updated successfully!'
                                . '</div>';
                        $this->session->set_flashdata('message',$message);
                        redirect(base_url('faq_control'));
                    } else {
                        $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                        $this->session->set_flashdata('message',$message);
                        redirect(base_url('faq_control/update_faq/'.$id));
                    }
                } else {
                    exit('<h2>You are not Authorised person to do this!</h2>');
                }
           }
        }

        $data = array();
        $data['class'] = 33; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['faq_id'] = $id;
        $data['content'] = $this->load->view('form/faq_update_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function delete_faq($id)
    {
        if (!is_numeric($id)) show_404(); 

        if ($this->system_model->delete_faq($id)) {
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

   public function add_grp($message = '')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('faq_grp_name', 'Group Name', 'required');
        if ($this->form_validation->run() != FALSE) {
            if ($this->session->userdata['user_role_id'] <= 3) {
                if ($this->system_model->add_faq_grp()) {
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'Group added successfully!'
                            . '</div>';
                } else {
                    $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                }
            } else {
                exit('<h2>You are not Authorised person to do this!</h2>');
            }
        }
        $this->session->set_flashdata('message',$message);
        redirect(base_url('faq_control'));
    }

    public function update_faq_grp($id, $message = '')
    {
        if ($_POST) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('faq_grp_name', 'Group Name', 'required');
            if ($this->form_validation->run() != FALSE) {
                if ($this->session->userdata['user_role_id'] <= 3) {
                    if ($this->system_model->update_faq_grp($id)) {
                        $message = '<div class="alert alert-success alert-dismissable">'
                                . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                                . 'Group updated successfully!'
                                . '</div>';
                        $this->session->set_flashdata('message',$message);
                        redirect(base_url('faq_control'));
                    } else {
                        $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                        $this->session->set_flashdata('message',$message);
                        redirect(base_url('faq_control/update_faq_grp/'.$id));
                    }
                } else {
                    exit('<h2>You are not Authorised person to do this!</h2>');
                }
           }
        }

        $data = array();
        $data['class'] = 33; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['faq_grp_id'] = $id;
        $data['content'] = $this->load->view('form/faq_grp_update_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function delete_faq_grp($id)
    {
        if ($this->system_model->delete_faq_grp($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Successfully Deleted!'
                    . '</div>';
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
        }
        $this->session->set_flashdata('message',$message);
        redirect(base_url('faq_control'));
    }    
}
