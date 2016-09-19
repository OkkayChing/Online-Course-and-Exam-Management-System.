<?php
class Noticeboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_notice()
    {
        $result = $this->db->get('noticeboard')->result();
        return $result;
    }
    public function get_active_notice()
    {
        date_default_timezone_set($this->session->userdata['time_zone']);

        $result = $this->db->where('notice_status', 1)
                    ->order_by('noticeboard.notice_id', 'desc')
                    ->where('notice_start <=', date('Y-m-d'))
                    ->where('notice_end >=', date('Y-m-d'))
                    ->get('noticeboard')
                    ->result(); 
        return $result;
    }

    public function get_active_notice_by_id($id)
    {
        return $this->db->where('notice_id', $id)
                ->where('notice_status', 1)
                ->get('noticeboard')->row();
    }

    public function get_notice_by_id($id)
    {
        $result = $this->db->get_where('noticeboard', array('notice_id' => $id))->row();
        return $result;
    }

    public function save()
    {
        if ($this->session->userdata['user_role_id'] > 2) {
            return FALSE;
        }

        $daterange = explode(' - ', $this->input->post('daterange'));

        $data = array();
        $data['notice_title'] = $this->input->post('notice_title', TRUE);
        $data['notice_descr'] = mysql_real_escape_string($this->input->post('notice_descr', TRUE));
        $data['notice_created_by'] = $this->session->userdata['user_id'];
        $data['notice_start'] = $daterange[0];
        $data['notice_end'] = $daterange[1];
        $data['notice_status'] = $this->input->post('notice_status', TRUE);

        $this->db->insert('noticeboard', $data);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update($id)
    {
        if ($this->session->userdata['user_role_id'] > 2) {
            return FALSE;
        }

        $daterange = explode(' - ', $this->input->post('daterange'));

        $data = array();
        $data['notice_title'] = $this->input->post('notice_title', TRUE);
        $data['notice_descr'] = mysql_real_escape_string($this->input->post('notice_descr', TRUE));
        $data['notice_start'] = $daterange[0];
        $data['notice_end'] = $daterange[1];
        $data['notice_status'] = $this->input->post('notice_status', TRUE);

        $this->db->where('notice_id', $id);
        $this->db->update('noticeboard', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete($id)
    {
        if ($this->session->userdata('user_role_id') > 2){
            return FALSE;
        }
        $this->db->where('notice_id', $id);
        $this->db->delete('noticeboard');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
