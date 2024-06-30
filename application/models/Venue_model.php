<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Venue_model extends CI_Model
{

    public function read()
    {
        $query = $this->db->get('venue');
        return $query->result();
    }

    public function read_by($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('venue');
        return $query->row();
    }
}
