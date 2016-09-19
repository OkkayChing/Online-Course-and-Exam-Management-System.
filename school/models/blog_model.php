<?php

class Blog_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        if ($this->session->userdata('user_role_id') < 4) {
            $this->db->select('*')
                ->order_by('blog.blog_id', 'desc')
                ->from('blog')
                ->join('users','users.user_id = blog.author_id','left');
        }else{
            $this->db->select('*')
                ->where('blog.author_id',$this->session->userdata('user_id'))
                ->order_by('blog.blog_id', 'desc')
                ->from('blog')
                ->join('users','users.user_id = blog.author_id','left');            
        }
        return $this->db->get()->result();
    }

    public function get_blog_by_id($id)
    {
        return $this->db->where('blog_id', $id)
                ->get('blog')->row();
    }

    public function save()
    {
        date_default_timezone_set($this->session->userdata['time_zone']);
        $data = array();
        $data['blog_title'] = $this->input->post('blog_title', TRUE);
        $data['blog_body'] = mysql_real_escape_string($this->input->post('post_descr', TRUE));
        $data['author_id'] = $this->session->userdata['user_id'];
        $data['blog_post_date'] = date('Y-m-d');

        $this->db->insert('blog', $data);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update($id)
    {

        $data = array();
        $data['blog_title'] = $this->input->post('blog_title', TRUE);
        $data['blog_body'] = mysql_real_escape_string($this->input->post('blog_body', TRUE));

        $this->db->where('blog_id', $id);
        $this->db->update('blog', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete($id)
    {
        $this->db->where('blog_id', $id);
        $this->db->delete('blog');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_blogs($per_page, $offset)
    {
        $this->db->select('*')
                ->order_by('blog.blog_id', 'desc')
                ->limit($per_page, $offset)
                ->from('blog')
                ->join('users','users.user_id = blog.author_id','left');
        return $this->db->get()->result();
    }
    public function get_post($id)
    {
        $this->db->select('*')
                ->where('blog.blog_id', $id)
                ->from('blog')
                ->join('users','users.user_id = blog.author_id','left');
        return $this->db->get()->row();
    }

    public function get_latest_blogs($count){
        $result = $this->db->select('*')
                        ->order_by('blog.blog_id', 'desc')
                        ->from('blog')
                        ->limit($count)
                        ->join('users','users.user_id = blog.author_id','left')
                        ->get()->result();
        return $result;
    }

    public function find()
    {
        $keyword = $this->input->post('keyword', TRUE);
     //   echo "<pre/>"; print_r($keyword); exit();
        $this->db->select('*')
                ->order_by('blog.blog_id', 'desc')
                ->like('blog.blog_title', $keyword)
                ->or_like('blog.blog_body', $keyword)
                ->from('blog')
                ->join('users','users.user_id = blog.author_id','left');
        return $this->db->get()->result();
    }

    public function get_post_comments($id)
    {
        return $this->db->where('blog_comments.blog_id', $id)
                        ->order_by('blog_comments.comment_id', 'desc')
                        ->from('blog_comments')
                        ->join('users','users.user_id = blog_comments.comment_author_id')
                        ->get()
                        ->result();
    }
    public function save_comment()
    {
        date_default_timezone_set($this->session->userdata['time_zone']);
        $data['comment_body'] = $this->input->post('blog_comment',TRUE);
        $data['blog_id'] = $this->input->post('blog_id',TRUE);
        $data['comment_author_id'] = $this->session->userdata('user_id');
        $data['comment_date'] = date('Y-m-d');

        $this->db->insert('blog_comments', $data);
    }
}