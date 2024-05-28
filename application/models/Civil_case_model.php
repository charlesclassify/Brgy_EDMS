<?php

class Civil_case_model extends CI_Model
{
    function get_all_civil_case()
    {
        $this->db->where('isDelete', 'no');
        $query = $this->db->get('civil_case');
        $result = $query->result();
        return $result;
    }

    function add_civil_case()
    {
        $civil_case_no = (string) $this->input->post('civil_case_no');
        $date_filed = $this->input->post('date_filed');
        $civil_case_name =  $this->input->post('civil_case_name');
        $complainant = (string) $this->input->post('complainant');
        $respondent = (string) $this->input->post('respondent');
        $purok =  $this->input->post('purok');
        $complaint =  $this->input->post('complaint');
        $relief =  $this->input->post('relief');

        $data = array(
            'civil_case_no' => $civil_case_no,
            'date_filed' => $date_filed,
            'civil_case_name' => $civil_case_name,
            'complainant' => $complainant,
            'respondent' => $respondent,
            'purok' => $purok,
            'complaint' => $complaint,
            'relief' => $relief,

        );

        $response = $this->db->insert('civil_case', $data);

        if ($response) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
}
