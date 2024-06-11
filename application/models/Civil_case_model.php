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

    function get_civil_case($civil_case_id)
    {
        $this->db->where('civil_case_id', $civil_case_id);
        $query = $this->db->get('civil_case');
        $row = $query->row();
        return $row;
    }

    function add_civil_case($file_path)
    {
        $data = array(
            'civil_case_no' => $this->input->post('civil_case_no'),
            'date_filed' => $this->input->post('date_filed'),
            'civil_case_name' => $this->input->post('civil_case_name'),
            'complainant' => $this->input->post('complainant'),
            'respondent' => $this->input->post('respondent'),
            'purok' => $this->input->post('purok'),
            'complaint' => $this->input->post('complaint'),
            'relief' => $this->input->post('relief'),
            'file_path' => $file_path

        );

        $response = $this->db->insert('civil_case', $data);

        if ($response) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    function update_civil_case_path($civil_case_id, $form7, $hearing, $summon, $pangkat, $settlement)
    {
        $data = array();

        if (!empty($form7)) {
            $data['form_7_path'] = $form7;
        }
        if (!empty($hearing)) {
            $data['notice_of_hearing_path'] = $hearing;
        }
        if (!empty($summon)) {
            $data['summon_path'] = $summon;
        }
        if (!empty($pangkat)) {
            $data['pangkat_path'] = $pangkat;
        }
        if (!empty($settlement)) {
            $data['settlement_path'] = $settlement;
        }

        if (!empty($data)) {
            $this->db->where('civil_case_id', $civil_case_id);
            $response = $this->db->update('civil_case', $data);

            if ($response) {
                return $civil_case_id;
            } else {
                return FALSE;
            }
        } else {
            // No file paths to update
            return $civil_case_id;
        }
    }

    public function get_total_civil_count()
    {
        // Assuming your table is named 'product'
        $this->db->from('civil_case');
        return $this->db->count_all_results();
    }
}
