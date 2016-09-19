<?php

Class Settings_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_settings($code)
    {
        $this->db->where('code', $code);
        $result = $this->db->get('settings');
        $return = array();
        foreach ($result->result() as $results) {
            $return[$results->setting_key] = $results->setting;
        }
        return $return;
    }

    public function save_settings($code, $values)
    {
        $settings = $this->get_settings($code);

        //loop through the settings and add each one as a new row
        foreach ($values as $key => $value) {
            if (array_key_exists($key, $settings)) {      //if the key currently exists, update the setting
                $update = array('setting' => $value);
                $this->db->where('code', $code);
                $this->db->where('setting_key', $key);
                $this->db->update('settings', $update);
            } else {       //if the key does not exist, add it
                $insert = array('code' => $code, 'setting_key' => $key, 'setting' => $value);
                $this->db->insert('settings', $insert);
            }
        }
    }
    
    //delete any settings having to do with this particular code
    public function delete_settings($code)
    {
        $this->db->where('code', $code);
        $this->db->delete('settings');
    }

    //this deletes a specific setting
    public function delete_setting($code, $setting_key)
    {
        $this->db->where('code', $code);
        $this->db->where('setting_key', $setting_key);
        $this->db->delete('settings');
    }

}
