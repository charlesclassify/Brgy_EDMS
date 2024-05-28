<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view('main/login');
    }
    public function dashboard()
    {
        $this->load->view('main/header');
        $this->load->view('main/dashboard');
        $this->load->view('main/footer');
    }
    public function bogart()
    {
        echo "bogart";
    }
    public function user()
    {
        $this->load->model('user_model');
        $this->data['users'] = $this->user_model->get_all_users();
        $this->load->view('main/header');
        $this->load->view('main/user', $this->data);
        $this->load->view('main/footer');
    }

    public function add_user()
    {
        $this->submit_add_user();
        $this->load->view('main/header');
        $this->load->view('main/add_user');
        $this->load->view('main/footer');
    }

    public function submit_add_user()
    {
        $this->form_validation->set_rules('first_name', 'First Name Validation Error', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name Validation Error', 'trim|required');
        $this->form_validation->set_rules('username', 'Username Validation Error', 'trim|required|is_unique[user.username]', array('is_unique' => 'The username is already taken.'));
        $this->form_validation->set_rules('password', 'Fassword Validation Error', 'trim|required');
        $this->form_validation->set_rules('barangay', 'Barangay Validation Error', 'trim|required');
        $this->form_validation->set_rules('role', 'Role Validation Error', 'trim|required');

        if ($this->form_validation->run() != FALSE) {
            $this->load->model('user_model');
            $response = $this->user_model->createuser();
            if ($response) {
                $success_message = 'User added successfully.';
                $this->session->set_flashdata('success', $success_message);
            } else {
                $error_message = 'User was not added.';
                $this->session->set_flashdata('error', $error_message);
            }
            redirect('main/user');
        }
    }

    public function edit_user($user_id)
    {
        $this->submit_edit_user();
        $this->load->model('user_model');
        $this->data['user'] = $this->user_model->get_user($user_id);
        $this->load->view('main/header');
        $this->load->view('main/edit_user', $this->data);
        $this->load->view('main/footer');
    }


    public function submit_edit_user()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            log_message('debug', 'Form is submitted.');

            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('barangay', 'barangay', 'trim|required');
            $this->form_validation->set_rules('role', 'role', 'trim|required');

            if ($this->form_validation->run() != FALSE) {
                log_message('debug', 'Form validation passed.');

                $this->load->model('user_model');

                $response = $this->user_model->edit_user();

                if ($response) {
                    log_message('debug', 'User updated successfully.');
                    $this->session->set_flashdata('success', 'User updated successfully.');
                } else {
                    log_message('debug', 'User update failed.');
                    $this->session->set_flashdata('error', 'User was not updated successfully.');
                }
                redirect('main/user');
            } else {
                log_message('debug', 'Form validation failed.');
            }
        }
    }

    function deactivate_user($user_id)
    {
        $this->load->model('user_model');

        $response = $this->user_model->deactivate_user($user_id);

        if ($response) {
            $success_message = 'User deactivated successfully.';
            $this->session->set_flashdata('success', $success_message);
        } else {
            $error_message = 'User was not deactivated successfully.';
            $this->session->set_flashdata('error', $error_message);
        }
        redirect('main/user');
    }

    function reactivate_user($user_id)
    {
        $this->load->model('user_model');

        $response = $this->user_model->reactivate_user($user_id);

        if ($response) {
            $success_message = 'User activated successfully.';
            $this->session->set_flashdata('success', $success_message);
        } else {
            $error_message = 'User was not activated successfully.';
            $this->session->set_flashdata('error', $error_message);
        }
        redirect('main/user');
    }

    function add_criminal_case()
    {
        $this->submit_add_criminal_case();
        $this->load->view('main/add_criminal_case_modal');
    }

    public function criminal_cases()
    {

        $this->load->model('criminal_case_model');
        $this->data['criminal'] = $this->criminal_case_model->get_all_criminal_case();
        $this->load->view('main/header');
        $this->load->view('main/criminal_cases', $this->data);
        $this->load->view('main/footer');
    }


    public function submit_add_criminal_case()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->form_validation->set_rules('criminal_case_no', 'Criminal Case No.', 'trim|required');
            $this->form_validation->set_rules('date_filed', 'Date Filed', 'trim|required');
            $this->form_validation->set_rules('criminal_case_name', 'Criminal Case Name', 'trim|required');
            $this->form_validation->set_rules('complainant', 'Complainant', 'trim|required');
            $this->form_validation->set_rules('respondent', 'Respondent', 'trim|required');
            $this->form_validation->set_rules('purok', 'Purok', 'trim|required');
            $this->form_validation->set_rules('complaint', 'Complaint', 'trim|required');
            $this->form_validation->set_rules('relief', 'Relief', 'trim|required');

            if ($this->form_validation->run() != FALSE) {
                log_message('debug', 'Form validation passed.');

                // Extract criminal case number and date filed from POST data
                $criminal_case_no = $this->input->post('criminal_case_no');
                $date_filed = $this->input->post('date_filed');

                // Define the base directory path
                $base_dir = 'C:' . DIRECTORY_SEPARATOR . 'Katarungang Pambarangay' . DIRECTORY_SEPARATOR . 'Criminal Case';

                // Create the directory for the specific criminal case
                $criminal_case_dir = $base_dir . DIRECTORY_SEPARATOR . str_replace('/', '-', $criminal_case_no);
                if (!is_dir($criminal_case_dir)) {
                    mkdir($criminal_case_dir, 0777, true);
                }

                // Handle file upload
                $config['upload_path'] = $criminal_case_dir;
                $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
                $config['max_size'] = 2048;

                // Generate the new file name
                $file_ext = pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
                $new_file_name = str_replace('/', '-', $criminal_case_no) . ' - ' . $date_filed . '.' . $file_ext;

                $config['file_name'] = $new_file_name;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file_upload')) {
                    $file_data = $this->upload->data();
                    $file_path = $criminal_case_dir . DIRECTORY_SEPARATOR . $file_data['file_name'];

                    // Save form data along with file path
                    $this->load->model('criminal_case_model');
                    $response = $this->criminal_case_model->add_criminal_case($file_path);

                    if ($response) {
                        log_message('debug', 'Criminal case added successfully.');
                        $this->session->set_flashdata('success', 'Criminal Case added successfully.');
                    } else {
                        log_message('debug', 'Failed to add criminal case.');
                        $this->session->set_flashdata('error', 'Failed to add Criminal Case.');
                    }
                    redirect('main/criminal_cases');
                } else {
                    $error = $this->upload->display_errors();
                    log_message('debug', 'File upload failed: ' . $error);
                    $this->session->set_flashdata('error', $error);
                    redirect('main/criminal_cases');
                }
            } else {
                log_message('debug', 'Form validation failed.');
            }
        }
    }
    public function view_criminal_case_file($criminal_case_id)
    {
        $this->load->model('criminal_case_model');
        $file_path = $this->criminal_case_model->get_file_path($criminal_case_id);

        if ($file_path) {
            $this->data['file_path'] = $file_path;
            $this->load->view('main/header');
            $this->load->view('main/view_criminal_case_file', $this->data);
            $this->load->view('main/footer');
        } else {
            show_404();
        }
    }


    public function civil_cases()
    {
        $this->load->model('civil_case_model');
        $this->data['civil'] = $this->civil_case_model->get_all_civil_case();
        $this->load->view('main/header');
        $this->load->view('main/civil_cases', $this->data);
        $this->load->view('main/footer');
    }

    public function add_civil_case()
    {
        $this->load->view('main/add_civil_case_modal');
    }

    public function submit_add_civil_case()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->form_validation->set_rules('civil_case_no', 'Civil Case No.', 'trim|required');
            $this->form_validation->set_rules('date_filed', 'Date Filed', 'trim|required');
            $this->form_validation->set_rules('civil_case_name', 'Civil Case Name', 'trim|required');
            $this->form_validation->set_rules('complainant', 'Complaint', 'trim|required');
            $this->form_validation->set_rules('respondent', 'Respondent', 'trim|required');
            $this->form_validation->set_rules('purok', 'Purok', 'trim|required');
            $this->form_validation->set_rules('complaint', 'Complaint', 'trim|required');
            $this->form_validation->set_rules('relief', 'Relief', 'trim|required');

            if ($this->form_validation->run() != FALSE) {
                log_message('debug', 'Form validation passed.');

                $this->load->model('civil_case_model');

                $response = $this->civil_case_model->add_civil_case();

                if ($response) {
                    log_message('debug', 'Civil case added successfully.');
                    $this->session->set_flashdata('success', 'Civil Case added successfully.');
                } else {
                    log_message('debug', 'Failed to add civil case.');
                    $this->session->set_flashdata('error', 'Failed to add Civil Case.');
                }
                redirect('main/civil_cases');
            } else {
                log_message('debug', 'Form validation failed.');
                $this->add_civil_case(); // Load the form again with validation errors
            }
        }
    }

    public function add_criminal_attachments_modal($criminal_case_id)
    {
        $this->load->model('criminal_case_model');
        $this->data['criminal_case'] = $this->criminal_case_model->get_criminal_case($criminal_case_id);
        $this->load->view('main/add_criminal_attachments_modal', $this->data);
    }
    public function logs()
    {
        $this->load->view('main/header');
        $this->load->view('main/logs');
        $this->load->view('main/footer');
    }
    public function reports()
    {
        $this->load->view('main/header');
        $this->load->view('main/reports');
        $this->load->view('main/footer');
    }
}
