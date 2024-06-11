<?php

class Barangay_model extends CI_Model
{
    public function insertbarangay($data)
    {
        $this->db->insert('barangay', $data);
    }

    public function add_barangay()
    {
        $barangay = (string) $this->input->post('barangay');
        $city_municipality = (string) $this->input->post('city_municipality');
        $province = (string) $this->input->post('province');

        $data = array(
            'barangay' => $barangay,
            'city_municipality' => $city_municipality,
            'province' => $province,
            'status' => 'active',
        );

        $response = $this->db->insert('barangay', $data);

        if ($response) {
            return $this->db->insert_id();
        } else {
            return False;
        }
    }
    function edit_barangay()
    {
        $barangay = $this->input->post('barangay');
        $barangay_id = $this->input->post('barangay_id');

        $data = array(
            'barangay' => $barangay,
        );

        $this->db->where('barangay_id', $barangay_id);

        $response = $this->db->update('barangay', $data);

        if ($response) {
            return $barangay_id;
        } else {
            return FALSE;
        }
    }

    function get_all_barangay()
    {
        $this->db->where('isDelete', 'no');
        $query = $this->db->get('barangay');
        $row = $query->result();
        return $row;
    }

    function get_barangay($barangay_id)
    {
        $this->db->where('barangay_id', $barangay_id);
        $query = $this->db->get('barangay');
        $row = $query->row();
        return $row;
    }
    public function deactivate_barangay($barangay_id)
    {
        $data = array(
            'status' => 'deactivated',
        );
        $this->db->where('barangay_id', $barangay_id);
        $response = $this->db->update('barangay', $data);
        if ($response) {
            return $barangay_id;
        } else {
            return FALSE;
        }
    }

    public function reactivate_barangay($barangay_id)
    {
        $data = array(
            'status' => 'active',
        );
        $this->db->where('barangay_id', $barangay_id);
        $response = $this->db->update('barangay', $data);
        if ($response) {
            return $barangay_id;
        } else {
            return FALSE;
        }
    }
}
