<?php

class Criminal_case_model extends CI_Model
{
    function get_all_criminal_case()
    {
        $this->db->where('isDelete', 'no');
        $query = $this->db->get('criminal_case');
        $result = $query->result();
        return $result;
    }

    function get_criminal_case($criminal_case_id)
    {
        $this->db->where('criminal_case_id', $criminal_case_id);
        $query = $this->db->get('criminal_case');
        $row = $query->row();
        return $row;
    }

    public function add_criminal_case($file_path)
    {
        $data = array(
            'criminal_case_no' => $this->input->post('criminal_case_no'),
            'date_filed' => $this->input->post('date_filed'),
            'criminal_case_name' => $this->input->post('criminal_case_name'),
            'complainant' => $this->input->post('complainant'),
            'respondent' => $this->input->post('respondent'),
            'purok' => $this->input->post('purok'),
            'complaint' => $this->input->post('complaint'),
            'relief' => $this->input->post('relief'),
            'file_path' => $file_path
        );

        $response = $this->db->insert('criminal_case', $data);

        if ($response) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    function get_file_path($criminal_case_id)
    {
        $this->db->select('file_path');
        $this->db->from('criminal_case');
        $this->db->where('criminal_case_id', $criminal_case_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->file_path;
        } else {
            return false;
        }
    }
}
