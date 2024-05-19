<?php

class User_model extends CI_Model
{
    public function insertuser($data)
    {
        $this->db->insert('user', $data);
    }

    public function createuser()
    {
        $username = (string) $this->input->post('username');
        $first_name = (string) $this->input->post('first_name');
        $last_name = (string) $this->input->post('last_name');
        $password = (string) $this->input->post('password');
        $barangay = (string) $this->input->post('barangay');
        $role = (string) $this->input->post('role');

        $data = array(
            'username' => $username,
            'firstname' => $first_name,
            'lastname' => $last_name,
            'barangay' => $barangay,
            'password' => sha1($password),
            'role' => $role,
            'status' => 'active'
        );

        $response = $this->db->insert('user', $data);

        if ($response) {
            return $this->db->insert_id();
        } else {
            return False;
        }
    }

    function get_all_users()
    {
        $this->db->where('isDelete', 'no');
        $query = $this->db->get('user');
        $row = $query->result();

        return $row;
    }
}
