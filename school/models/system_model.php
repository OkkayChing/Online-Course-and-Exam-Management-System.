<?php
session_start();
class System_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_system_info()
    {
        return $this->db->get('settings')->row();
    }

    public function get_system_content()
    {
        return $this->db->get('content')->result();
    }

    public function get_currencies()
    {
        $this->db->order_by('currency_name', 'asc');
        return $this->db->get('currency')->result();
    }

    public function get_payment_settings()
    {
        $this->db->select('*')
                ->from('paypal_settings')
                ->where('paypal_settings.id', 1)
                ->join('currency', 'currency.currency_id = paypal_settings.currency_id','left');
        $result = $this->db->get()->row();
        return $result;
    }

    // public function get_about_us()
    // {
    //     $this->db->select('about_us');
    //     $result = $this->db->get('settings')->row();
    //     return $result;
    // }

    public function get_timezone()
    {
        return $this->db->get('timezone')->result();
    }

    public function set_system_info_to_session()
    {
        $result = $this->db->get_where('settings', array('brand_id' => 1))->row();
        // $total_exams = $this->db->count_all('exam_title');
        // $total_examinee = $this->db->where('user_role_id', 5)
        //                 ->from('users')
        //                 ->count_all_results();
        // $total_teacher = $this->db->where('user_role_id', 4)
        //                 ->from('users')
        //                 ->count_all_results();
        $currency = $this->db->select('currency.currency_code,currency.currency_symbol')
                        ->from('paypal_settings')
                        ->join('currency', 'currency.currency_id = paypal_settings.currency_id')
                        ->get()->row();
        if ($result || $_SESSION["log"]==1) {
            parse_str(parse_url($result->you_tube_url, PHP_URL_QUERY));

            $this->session->set_userdata('brand_name', $result->brand_name);
            $this->session->set_userdata('brand_tagline', $result->brand_tagline);
            $this->session->set_userdata('fb_url', $result->facbook_url);
            $this->session->set_userdata('googlep_url', $result->googleplus_url);
            $this->session->set_userdata('twtr_url', $result->twitter_url);
            $this->session->set_userdata('flkr_url', $result->flickr_url);
            $this->session->set_userdata('pinterest_url', $result->pinterest_url);
            $this->session->set_userdata('youtube_url', $result->you_tube_url);
            $this->session->set_userdata('support_email', $result->support_email);
            $this->session->set_userdata('time_zone', $result->local_time_zone);
            $this->session->set_userdata('commercial', $result->commercial);
            if (isset($currency)) {
                $this->session->set_userdata('currency_code', $currency->currency_code);
                $this->session->set_userdata('currency_symbol', $currency->currency_symbol);
            }
            if (isset($v)) {
                $this->session->set_userdata('yt_url', $v);
            }
            $this->session->set_userdata('show_video', $result->show_video_on_home);
            $this->session->set_userdata('student_can_register', $result->student_can_register);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_system_info()
    {
        date_default_timezone_set($this->session->userdata['time_zone']);
        if ($this->session->userdata['user_role_id'] > 2) {
            return FALSE;
        }
        $name = $this->input->post('name');
        $data = array();
        switch ($name) {
            case 'youtube':
                $data['you_tube_url'] = $this->input->post('value', TRUE);
                break;
            case 'facebook':
                $data['facbook_url'] = $this->input->post('value', TRUE);
                break;
            case 'twitter':
                $data['twitter_url'] = $this->input->post('value', TRUE);
                break;
            case 'flickr':
                $data['flickr_url'] = $this->input->post('value', TRUE);
                break;
            case 'googleplus':
                $data['googleplus_url'] = $this->input->post('value', TRUE);
                break;
            case 'pinterest':
                $data['pinterest_url'] = $this->input->post('value', TRUE);
                break;
            case 'linkedin':
                $data['linkedin_url'] = $this->input->post('value', TRUE);
                break;

            default:
                return FALSE;
                break;
        }
        $data['last_update'] = date('Y-m-d');
        $this->db->where('brand_id', (int) $this->input->post('pk', TRUE));
        $this->db->update('settings', $data);
        if ($this->db->affected_rows() == 1) {
            $this->set_system_info_to_session();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_content()
    {
        if ($this->session->userdata['user_role_id'] > 2) {
            return FALSE;
        }

        $name = $this->input->post('name');
        $data = array();
        $data['content_data'] = $this->input->post('value', TRUE);
        $this->db->where('content_id', (int) $this->input->post('pk', TRUE));
        $this->db->update('content', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function update_paypal_info()
    {
        if ($this->session->userdata['user_role_id'] != 1) {
            return FALSE;
        }
        $name = $this->input->post('name');
        $data = array();
        switch ($name) {
            case 'pp_sandbox':
                $data['sandbox'] = $this->input->post('value', TRUE);
                break;
            case 'pp_currency':
                $data['currency_id'] = $this->input->post('value', TRUE);
                break;
            case 'pp_user':
                $data['api_username'] = $this->input->post('value', TRUE);
                break;
            case 'pp_pass':
                $data['api_pass'] = $this->input->post('value', TRUE);
                break;
            case 'pp_sign':
                $data['api_signature'] = $this->input->post('value', TRUE);
                break;
            default:
                return FALSE;
                break;
        }

        $exist = $this->db->get_where('paypal_settings', array('id'=>1))->row();
        if (!empty($exist)) {
            $this->db->where('id', (int) $this->input->post('pk', TRUE));
            $this->db->update('paypal_settings', $data);
        }else{
            $data['id'] = 1;
            $this->db->insert('paypal_settings', $data);            
       }

        if ($this->db->affected_rows() == 1) {
            $this->set_system_info_to_session();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_faqs()
    {
        $result = $this->db->get('faqs')->result();
        return $result;
    }

    public function add_faq()
    {
        date_default_timezone_set($this->session->userdata['time_zone']);
        $data = array();
        $data['faq_ques'] = $this->input->post('faq_q', TRUE);
        $data['faq_ans'] = $this->input->post('faq_ans', TRUE);
        $data['faq_grp_id'] = $this->input->post('faq_grp_id', TRUE);
        $data['faq_created_by'] = $data['faq_last_modified_by'] = $this->session->userdata['user_id'];
        $data['faq_last_update'] = date('Y-m-d');
        $query = $this->db->select('faq_ques')->where('faq_ques', $data['faq_ques'])->get('faqs');
        if ($query->num_rows()) {
            return FALSE;
        }
        $this->db->insert('faqs', $data);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update_faq($id)
    {
        date_default_timezone_set($this->session->userdata['time_zone']);
        $data = array();
        $data['faq_ques'] = $this->input->post('faq_q', TRUE);
        $data['faq_ans'] = $this->input->post('faq_ans', TRUE);
        $data['faq_grp_id'] = $this->input->post('faq_grp_id', TRUE);
        $data['faq_last_modified_by'] = $this->session->userdata['user_id'];
        $data['faq_last_update'] = date('Y-m-d');
        $this->db->where('faq_id', $id);
        $this->db->update('faqs', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_faq($id)
    {
        if ($this->session->userdata('user_role_id') > 3){
            return FALSE;
        }
        $this->db->where('faq_id', $id);
        $this->db->delete('faqs');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add_faq_grp()
    {
        $data = array();
        $data['faq_grp_name'] = $this->input->post('faq_grp_name', TRUE);
        $this->db->insert('faq_grp', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_faq_grp($id)
    {
        $data = array();
        $data['faq_grp_name'] = $this->input->post('faq_grp_name', TRUE);
        $this->db->where('faq_grp_id', $id);
        $this->db->update('faq_grp', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_faq_grp($id)
    {
        if ($this->session->userdata('user_role_id') > 3){
            return FALSE;
        }
        $this->db->where('faq_grp_id', $id);
        $this->db->delete('faqs');

        $this->db->where('faq_grp_id', $id);
        $this->db->delete('faq_grp');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function set_system_info($data)
    {
        $if_exist = $this->db->count_all('settings');
        if ($if_exist) {
            return FALSE;
        } else {
            $this->db->insert('settings', $data);
            if ($this->db->affected_rows() == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function set_payment_info($data)
    {
        $if_exist = $this->db->count_all('paypal_settings');
        if ($if_exist) {
            return FALSE;
        } else {
            $this->db->insert('paypal_settings', $data);
            if ($this->db->affected_rows() == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
}
