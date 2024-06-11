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

    function get_user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user');
        $row = $query->row();
        return $row;
    }
    function edit_user()
    {
        $user_id = (int) $this->input->post('user_id');
        $username = (string) $this->input->post('username');
        $first_name = (string) $this->input->post('first_name');
        $last_name = (string) $this->input->post('last_name');
        $password = (string) $this->input->post('password');
        $barangay = (string) $this->input->post('barangay');
        $role = (string) $this->input->post('role');

        $data = array(
            'firstname' => $first_name,
            'lastname' => $last_name,
            'username' => $username,
            'password' => sha1($password),
            'barangay' => $barangay,
            'role' => $role,
        );

        $this->db->where('user_id', $user_id);

        $response = $this->db->update('user', $data);

        if ($response) {
            return $user_id;
        } else {
            return FALSE;
        }
    }

    public function deactivate_user($user_id)
    {
        $data = array(
            'status' => 'deactivated',
        );
        $this->db->where('user_id', $user_id);
        $response = $this->db->update('user', $data);
        if ($response) {
            return $user_id;
        } else {
            return FALSE;
        }
    }

    public function reactivate_user($user_id)
    {
        $data = array(
            'status' => 'active',
        );
        $this->db->where('user_id', $user_id);
        $response = $this->db->update('user', $data);
        if ($response) {
            return $user_id;
        } else {
            return FALSE;
        }
    }

    function checkPassword($password, $username)
    {
        // Hash the input password using SHA1
        $hashed_password = sha1($password);

        // Retrieve user from database by username and hashed password
        $query = $this->db->query("SELECT * FROM user WHERE username = ? AND password = ?", array($username, $hashed_password));

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
}
