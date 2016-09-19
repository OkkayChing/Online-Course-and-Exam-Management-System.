<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Noticeboard extends MS_Controller
{
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->model('noticeboard_model');
    }

    public function index($message = '')
    {
        $data = array();
        $data['class'] = 34; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        $data['notices'] = $this->noticeboard_model->get_notice();
        $data['content'] = $this->load->view('admin/view_noticeboeard', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function notice($id = '')
    {
        if(!is_numeric($id))  show_404();

        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['notice'] = $this->noticeboard_model->get_active_notice_by_id($id);
        if(empty($data['notice']))  show_404();
        $data['content'] = $this->load->view('content/view_notice', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $this->load->view('home', $data);
    }

    public function notices()
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('admin'));
        }
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['notices'] = $this->noticeboard_model->get_active_notice();
        // echo "<pre/>"; print_r($data['notices'] ); exit();
        $data['content'] = $this->load->view('content/view_all_notice', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('home', $data);
    }

    public function add($message = '')
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('admin'));
        }
        $data = array();
        $data['class'] = 34; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
  //      $data['extra_footer'] = $this->load->view('plugin_scripts/datepicker', '', TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $data['content'] = $this->load->view('form/notice_form', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function save()
    {
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('notice_title', 'Notice Title', 'required');
        $this->form_validation->set_rules('notice_descr', 'Description ', 'required');
        $this->form_validation->set_rules('daterange', 'Date Range ', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->add();
        } else {
            if ($this->session->userdata['user_role_id'] < 3) {
                if ($this->noticeboard_model->save()) {
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'notice added successfully!'
                            . '</div>';
                        $this->index($message);
                } else {
                    $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
                    $this->add($message);
                }
            } else {
                exit('<h2>You are not Authorised person to do this!</h2>');
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
        $data['class'] = 34; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', $data, TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['notice'] = $this->noticeboard_model->get_notice_by_id($id);
        $data['message'] = $message;
        $data['content'] = $this->load->view('form/notice_edit_form', $data, TRUE);
        $data['footer'] = $this->load->view('footer/admin_footer', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function update($id = '')
    {
        if (!is_numeric($id)) return FALSE;

        if ($this->noticeboard_model->update($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'notice updated successfully!'
                    . '</div>';
                $this->index($message);
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred! Please try again.</div>';
            $this->edit($id, $message);
        }
    }   

    public function delete($id)
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('admin'));
        }
        if (!is_numeric($id)) return FALSE;
        
        if ($this->noticeboard_model->delete($id)) {
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
}
