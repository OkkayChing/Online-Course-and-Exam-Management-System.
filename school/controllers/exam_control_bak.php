<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Exam_control extends MS_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('exam_model');
        $this->load->model('admin_model');
    }

    public function index()
    {
       echo "test";
    }

    public function view_all_mocks($message = '')
    {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['mocks'] = $this->exam_model->get_all_mocks();
        $data['categories'] = $this->exam_model->get_categories();
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['user_role'] = $this->admin_model->get_user_role();
        $data['message'] = $message;
        $data['content'] = $this->load->view('content/view_mock_list', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $this->load->view('home', $data);
    }

    public function view_mocks_by_category($cat_id)
    {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['mocks'] = $this->exam_model->get_mocks_by_category($cat_id);
        $data['categories'] = $this->exam_model->get_categories();
        $data['category_name'] = $this->db->get_where('sub_categories', array('id' => $cat_id))->row()->sub_cat_name;
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['user_role'] = $this->admin_model->get_user_role();
        $data['content'] = $this->load->view('content/view_mock_list', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $this->load->view('home', $data);
    }


    public function mocks_type($type)
    {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['categories'] = $this->exam_model->get_categories();
      //    $data['mock_count'] = $this->exam_model->mock_count($data['categories']);
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['user_role'] = $this->admin_model->get_user_role();
            $data['mocks'] = $this->exam_model->get_mocks_by_price($type);
        if($type === 'free'){
            $data['category_name'] = 'Free';
        }else if($type === 'paid'){
            $data['category_name'] = 'Paid';
        }else{
            redirect(base_url('exam_control/view_all_mocks'));
        }
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $data['content'] = $this->load->view('content/view_mock_list', $data, TRUE);
        $this->load->view('home', $data);

    }

    public function view_exam_summery($id = '', $message = '')
    {
        if (!is_numeric($id)) show_404();

        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['mock'] = $this->exam_model->get_mock_by_id($id);
        if (!$data['mock']) show_404();
        $data['message'] = $message;
        $data['content'] = $this->load->view('content/exam_summery', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $this->load->view('home', $data);
    }

    public function view_exam_instructions($id = '', $message = '')
    {
        if (!is_numeric($id)) {
            show_404();
        }
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            $message = '<div class="alert alert-danger alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Please login to start the exam!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('login_control'));
        }
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/top_navigation', $data, TRUE);
        $data['message'] = $message;
        $data['mock'] = $this->exam_model->get_mock_by_id($id);
        if (!$data['mock']) {
            show_404();
        }
        $data['content'] = $this->load->view('content/exam_instructions', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $this->load->view('home', $data);
    }

    public function start_exam($id = '', $message = '')
    {
        $this->load->helper('cookie');
        if (($id == '') OR !is_numeric($id)) show_404();
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('login_control'));
        }
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['message'] = $message;
        $data['mock'] = $this->exam_model->get_mock_by_id($id);
        if (!$data['mock'])  show_404();
        if ($data['mock']->exam_price != 0) {
            $user_info = $this->db->get_where('users', array('user_id' => $this->session->userdata('user_id')))->row();
            if (($user_info->subscription_id == 0) OR ($user_info->subscription_end <= now())) {
                $payment_token = $this->exam_model->get_pay_token($id, $this->session->userdata('pay_id'));
                if (!$payment_token) {
                    redirect('exam_control/payment_process/' . $id, 'refresh');
                }
            }
        }
        
        if($this->input->cookie('ExamTimeDuration')){
            $data['duration'] = $this->input->cookie('ExamTimeDuration', TRUE)-1;
        } else {
            $data['duration'] = $data['mock']->duration;
        }

        $total_questions = $this->exam_model->get_mock_detail($id);
        $counter = count($total_questions);
        $questions = array();
        $i=0;
        do{
            $index = rand(0, $counter-1);
            if (array_key_exists($index, $questions)) {
                continue;
            }
            $questions[$index] = $total_questions[$index];
            $i++ ;
        }while($i < $data['mock']->random_ques_no);
            
        $data['questions'] = $questions;
        $data['ques_count'] = $counter;
        $data['answers'] = $this->exam_model->get_mock_answers($data['questions']);
        $data['content'] = $this->load->view('content/start_exam', $data, TRUE);
        $data['no_contact_form'] = TRUE;
        $data['footer'] = $this->load->view('footer/footer', $data, TRUE);
        $this->load->view('home', $data);
        $this->session->unset_userdata('pay_id');
        $this->session->unset_userdata('payment_token');
    }

    // public function payment_process($id = '', $message = '')
    // {
    //     if (($id == '') OR !is_numeric($id)) {
    //         show_404();
    //     }
    //     $item_info = $this->exam_model->get_item_detail($id);
    //     if (!$item_info) {
    //         show_404();
    //     }
    //     $payment_settings = $this->admin_model->get_paypal_settings();
    //     if ($payment_settings->sandbox == 1) {
    //         $mode = TRUE;
    //     }else{
    //         $mode = FALSE;
    //     }
    //     $settings = array(
    //         'username' => $payment_settings->api_username,
    //         'password' => $payment_settings->api_pass,
    //         'signature' => $payment_settings->api_signature,
    //         'test_mode' => $mode
    //     )
    //     $params = array(
    //         'amount' => $item_info->exam_price,
    //         'currency' => $currency_code,
    //         'description' => $item_info->title_name,
    //         'return_url' => base_url('exam_control/payment_complete/' . $id),
    //         'cancel_url' => base_url('exam_control/view_all_mocks'));

    //     $this->load->library('merchant');
    //     $this->merchant->load('paypal_express');
    //     $this->merchant->initialize($settings);
    //     $response = $this->merchant->purchase($params);

    //     if ($response->status() == Merchant_response::FAILED) {
    //         $message = $response->message();
    //         echo('Error processing payment: ' . $message);
    //         exit;
    //     } else {
    //         $data = array();
    //         $data['order_token'] = sha1(rand(0, 999999) . $id);
    //         $data['exam_id'] = $id;
    //         $set_token = $this->exam_model->set_order_token($data);
    //     }
    // }

    // public function payment_complete($id)
    // {
    //     $item_info = $this->exam_model->get_item_detail($id);
    //     $payment_settings = $this->admin_model->get_paypal_settings();
    //     if ($payment_settings->sandbox == 1) {
    //         $mode = TRUE;
    //     }else{
    //         $mode = FALSE;
    //     }
    //     $settings = array(
    //         'username' => $payment_settings->api_username,
    //         'password' => $payment_settings->api_pass,
    //         'signature' => $payment_settings->api_signature,
    //         'test_mode' => $mode
    //     )
    //     $params = array(
    //         'amount' => $item_info->exam_price,
    //         'currency' => $currency_code,
    //         'cancel_url' => base_url('exam_control/view_all_mocks')
    //     );

    //     $this->load->library('merchant');
    //     $this->merchant->load('paypal_express');
    //     $this->merchant->initialize($settings);
    //     $response = $this->merchant->purchase_return($params);

    //     if ($response->success()) {
    //         $message = '<div class="alert alert-sucsess alert-dismissable">'
    //                 . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
    //                 . 'Payment Successful!</div>';
    //         $this->session->set_flashdata('message', $message);
    //         $data = array();
    //         $data['PayerID'] = $this->input->get('PayerID');
    //         $data['token'] = $this->input->get('token');
    //         $data['exam_title'] = $item_info->title_name;
    //         $data['pay_amount'] = $item_info->exam_price;
    //         $data['currency_code'] = $currency_code . ' ' . $currency_symbol;
    //         $data['method'] = 'PayPal';
    //         $data['gateway_reference'] = $response->reference();
    //         $token_id = $this->exam_model->set_payment_detail($data);

    //         $this->session->set_userdata('payment_token', $data['token']);
    //         $this->session->set_userdata('pay_id', $token_id);

    //         redirect(base_url() . 'exam_control/view_exam_instructions/' . $id);
    //     } else {
    //         $message = $response->message();
    //         echo('Error processing payment: ' . $message);
    //         exit;
    //     }
    // }


    public function payment_process($id = '', $message = '')
    {
        if (($id == '') OR !is_numeric($id))  show_404(); 

        $item_info = $this->exam_model->get_item_detail($id);
        if (!$item_info)  show_404(); 
        
        $payment_settings = $this->admin_model->get_paypal_settings();
        if ($payment_settings->sandbox == 1) {
            $mode = TRUE;
        }else{
            $mode = FALSE;
        }
        $currency = $this->db->select('currency.currency_code,currency.currency_symbol')
                        ->from('paypal_settings')
                        ->join('currency', 'currency.currency_id = paypal_settings.currency_id')
                        ->get()->row_array();
        $settings = array(
            'username' => $payment_settings->api_username,
            'password' => $payment_settings->api_pass,
            'signature' => $payment_settings->api_signature,
            'test_mode' => $mode
        );
        $params = array(
            'amount' => $item_info->exam_price,
            'currency' => $currency['currency_code'],
            'description' => $item_info->title_name,
            'return_url' => base_url('exam_control/payment_complete/' . $id),
            'cancel_url' => base_url('exam_control/view_all_mocks')
        );

        $this->load->library('merchant');
        $this->merchant->load('paypal_express');
        $this->merchant->initialize($settings);
        $response = $this->merchant->purchase($params);

        if ($response->status() == Merchant_response::FAILED) {
            $message = $response->message();
            echo('Error processing payment: ' . $message);
            exit;
        } else {
            $data = array();
            $data['order_token'] = sha1(rand(0, 999999) . $id);
            $data['exam_id'] = $id;
            $set_token = $this->exam_model->set_order_token($data);
        }
    }

    public function payment_complete($id)
    {
        $item_info = $this->exam_model->get_item_detail($id);
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
            'amount' => $item_info->exam_price,
            'currency' => $currency['currency_code'],
            'cancel_url' => base_url('exam_control/view_all_mocks'));

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
            $data['exam_title'] = $item_info->title_name;
            $data['pay_amount'] = $item_info->exam_price;
            $data['currency_code'] = $currency_code . ' ' . $currency_symbol;
            $data['method'] = 'PayPal';
            $data['gateway_reference'] = $response->reference();
            $token_id = $this->exam_model->set_payment_detail($data);

            $this->session->set_userdata('payment_token', $data['token']);
            $this->session->set_userdata('pay_id', $token_id);

            redirect(base_url() . 'exam_control/view_exam_instructions/' . $id);
        } else {
            $message = $response->message();
            echo('Error processing payment: ' . $message);
            exit;
        }
    }

    public function view_results($message = '')
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('login_control'));
        }
        $userId = $this->session->userdata('user_id');
        $data = array();
        $data['class'] = 25; // class control value left digit for main manu rigt digit for submenu
        $data['header'] = $this->load->view('header/admin_head', '', TRUE);
        $data['top_navi'] = $this->load->view('header/admin_top_navigation', '', TRUE);
        $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
        $data['message'] = $message;
        if ($this->session->userdata('user_role_id') <= 4) {
            $data['results'] = $this->exam_model->get_all_results();
            $data['content'] = $this->load->view('content/view_all_results', $data, TRUE);
        } else {
            $data['results'] = $this->exam_model->get_my_results($userId);
            $data['content'] = $this->load->view('content/view_my_results', $data, TRUE);
        }
        $data['footer'] = $this->load->view('footer/admin_footer', '', TRUE);
        $this->load->view('dashboard', $data);
    }


    public function view_exam_detail($id = '', $message = '')
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('login_control'));
        }
        if (!is_numeric($id))  show_404(); 
        $author = $this->exam_model->view_result_detail($id);
        if (empty($author)) {
            $message = '<div class="alert alert-danger alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Not available!</div>';
            $this->view_results($message);
        } else {
            if (($author->participant_id != $this->session->userdata('user_id')) && ($this->session->userdata('user_id') > 4)) {
                exit('<h2>You are not Authorised person to do this!</h2>');
            } else {
                $data = array();
                $data['class'] = 25; // class control value left digit for main manu rigt digit for submenu
                $data['header'] = $this->load->view('header/admin_head', '', TRUE);
                $data['top_navi'] = $this->load->view('header/admin_top_navigation', '', TRUE);
                $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
                $data['message'] = $message;
                $data['results'] = $author;
                $data['content'] = $this->load->view('content/exam_detail', $data, TRUE);
                $data['footer'] = $this->load->view('footer/admin_footer', '', TRUE);
                $this->load->view('dashboard', $data);
            }
        }
    }

    public function view_result_detail($id = '', $message = '')
    {
        if (!$this->session->userdata('log')) {
            $this->session->set_userdata('back_url', current_url());
            redirect(base_url('login_control'));
        }
        if (!is_numeric($id)) {
            show_404();
        }
        $author = $this->exam_model->view_result_detail($id);
        if (empty($author)) {
            $message = '<div class="alert alert-danger alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Not available!</div>';
            $this->view_results($message);
        } else {
            if (($author->participant_id != $this->session->userdata('user_id')) && ($this->session->userdata('user_id') > 3)) {
                exit('<h2>You are not Authorised person to do this!</h2>');
            } else {
                $data = array();
                $data['class'] = 25; // class control value left digit for main manu rigt digit for submenu
                $data['header'] = $this->load->view('header/admin_head', '', TRUE);
                $data['top_navi'] = $this->load->view('header/admin_top_navigation', '', TRUE);
                $data['sidebar'] = $this->load->view('sidebar/admin_sidebar', $data, TRUE);
                $data['message'] = $message;
                $data['results'] = $author;
                $data['content'] = $this->load->view('content/result_detail', $data, TRUE);
                $data['footer'] = $this->load->view('footer/admin_footer', '', TRUE);
                $this->load->view('dashboard', $data);
            }
        }
    }

    public function delete_results($id = '')
    {
        if (!is_numeric($id)) {
            return FALSE;
        }
        $author = $this->exam_model->get_result_by_id($id);
        if (empty($author) OR (($author->user_id != $this->session->userdata('user_id')) && ($this->session->userdata('user_id') > 2))) {
            show_404();
        }
        if ($this->exam_model->delete_result($id)) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Successfully Deleted!'
                    . '</div>';
            $this->view_results($message);
        } else {
            $message = '<div class="alert alert-danger alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'An ERROR occurred! Please try again.</div>';
            $this->view_results($message);
        }
    }
}
