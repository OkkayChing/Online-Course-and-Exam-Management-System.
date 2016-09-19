<?php

class Membership_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_memberships()
    {
        $result = $this->db->get('price_table')->result();
        return $result;
    }
    public function get_features()
    {
        $result = $this->db->get('feature_list')->result();
        return $result;
    }

    public function save_offer()
    {
        $data = array();
        $data['price_table_title'] = $this->input->post('membership_type', TRUE);
        $data['price_table_cost'] = $this->input->post('price', TRUE);
        $data['offer_type'] = $this->input->post('validity_type', TRUE);
        $data['offer_duration'] = $this->input->post('validity_period', TRUE);

        $this->db->insert('price_table', $data);
        if ($this->db->affected_rows() == 1) {
            $features = $this->input->post('feature', TRUE);
            $info = array();
            $info['parent_id'] = $this->db->insert_id();
            foreach ($features as $value) {
                if (!empty($value) AND ($value != '')) {
                    $info['feature_item'] = $value;
                    $this->db->insert('feature_list', $info);
                }
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_offer()
    {
        $membership_id = $this->input->post('membership_id', TRUE);
        $data = array();
        $data['price_table_title'] = $this->input->post('membership_type', TRUE);
        $data['price_table_cost'] = $this->input->post('price', TRUE);
        $data['offer_type'] = $this->input->post('validity_type', TRUE);
        $data['offer_duration'] = $this->input->post('validity_period', TRUE);

        $this->db->where('price_table_id', $membership_id);
        $this->db->update('price_table', $data);

        $features = $this->input->post('feature', TRUE);
        $info = array();
        $info['parent_id'] = $membership_id;
        foreach ($features as $key => $value) {
            if (!empty($value) AND ($value != '')) {
                $info['feature_item'] = $value;
                $this->db->where('feature_id', $key);
                $this->db->where('parent_id', $membership_id);
                $this->db->update('feature_list', $info);
            }
        }
        return TRUE;
    }

    public function delete_offer($id)
    {
        if ($this->session->userdata('user_role_id') > 2) return FALSE;

        $this->db->where('price_table_id', $id);
        $this->db->delete('price_table');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_offer_by_id($id)
    {
        $result = $this->db->select('*')
                        ->from('price_table')
                        ->where('price_table_id', $id)
                        ->get()->row();
        return $result;        
    }

    public function get_features_by_parent_id($id)
    {
        $result = $this->db->select('*')
                        ->from('feature_list')
                        ->where('parent_id', $id)
                        ->get()->result();
        return $result;        
    }

    public function set_top_offer()
    {
        $old_data = $this->db->get_where('price_table', array('price_table_top' => 1))->row()->price_table_id;
        $reset = array();
        $reset['price_table_top'] = 0;
        $this->db->where('price_table_id', $old_data);
        $this->db->update('price_table', $reset);

        $info = array();
        $info['price_table_top'] = 1;
        $this->db->where('price_table_id', $this->input->post('membership_id', TRUE));
        $this->db->update('price_table', $info);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }        
    }

    public function save_features()
    {
        $features = $this->input->post('feature', TRUE);
        $info = array();
        $info['parent_id'] = $this->input->post('membership_id', TRUE);

        foreach ($features as $value) {
            if (!empty($value) AND ($value != '')) {
                $info['feature_item'] = $value;
                $this->db->insert('feature_list', $info);
            }
        }
        return TRUE;
    }

}
