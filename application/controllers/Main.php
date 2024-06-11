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

    function login_submit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == TRUE) {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $this->load->model('user_model');
                $user = $this->user_model->checkPassword($password, $username);
                if ($user) {
                    $session_data = array(
                        'username' => $user->username,
                        'role' => $user->role,
                    );

                    $this->session->set_userdata('UserLoginSession', $session_data);

                    redirect(base_url('main/dashboard'));
                } else {
                    $this->session->set_flashdata('error', 'Username or Password is Wrong');
                    redirect(base_url('main/'));
                }
            } else {
                $this->session->set_flashdata('error', 'Fill all the required fields');
                redirect(base_url('main/'));
            }
        }
    }

    public function index()
    {
        $this->load->view('main/login');
    }
    public function dashboard()
    {
        $this->load->model('criminal_case_model');
        $this->data['criminal'] = $this->criminal_case_model->get_total_criminal_count();
        $this->load->model('civil_case_model');
        $this->data['civil'] = $this->civil_case_model->get_total_civil_count();
        $this->load->view('main/header');
        $this->load->view('main/dashboard', $this->data);
        $this->load->view('main/footer');
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
        $this->load->model('barangay_model');
        $this->data['barangay'] = $this->barangay_model->get_all_barangay();
        $this->load->view('main/header');
        $this->load->view('main/add_user', $this->data);
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
        $this->load->model('barangay_model');
        $this->data['barangay'] = $this->barangay_model->get_all_barangay();
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
                $base_dir = 'C:' . DIRECTORY_SEPARATOR . 'xampp' . DIRECTORY_SEPARATOR . 'htdocs' . DIRECTORY_SEPARATOR . 'Brgy_edms' . DIRECTORY_SEPARATOR .
                    'uploads' . DIRECTORY_SEPARATOR . 'Criminal Case';


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

    public function add_criminal_attachments_modal($criminal_case_id)
    {
        $this->load->model('criminal_case_model');
        $this->data['criminal_case'] = $this->criminal_case_model->get_criminal_case($criminal_case_id);
        $this->load->view('main/add_criminal_attachments_modal', $this->data);
    }

    public function submit_add_criminal_attachments()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $criminal_case_id = $this->input->post('criminal_case_id');
            $this->load->model('criminal_case_model');
            $criminal_case = $this->criminal_case_model->get_criminal_case($criminal_case_id);

            if ($criminal_case) {
                $criminal_case_no = str_replace('/', '-', $criminal_case->criminal_case_no);
                $date_filed = $this->input->post('date_filed');

                // Define the directory structure
                $upload_dir = 'uploads/Criminal Case/' . $criminal_case_no;

                if (!is_dir($upload_dir)) {
                    $this->session->set_flashdata('error', 'The directory for this criminal case does not exist.');
                    redirect('main/criminal_cases');
                    return;
                }

                $config['upload_path'] = $upload_dir;
                $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
                $config['max_size'] = 2048;

                $this->load->library('upload', $config);

                $file_paths = [
                    'form_7_path' => '',
                    'notice_of_hearing_path' => '',
                    'summon_path' => '',
                    'pangkat_path' => '',
                    'settlement_path' => ''
                ];

                $file_fields = [
                    'file_upload_form_7' => 'Form 7',
                    'file_upload_notice_of_hearing' => 'Notice of Hearing',
                    'file_upload_summon' => 'Summon',
                    'file_upload_pangkat' => 'Pangkat',  // Corrected this line
                    'file_upload_settlement' => 'Settlement'
                ];

                foreach ($file_fields as $field => $prefix) {
                    if (!empty($_FILES[$field]['name'])) {
                        $config['file_name'] = $prefix . '-' . $criminal_case_no . '-' . $date_filed . '.' . pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload($field)) {
                            $file_data = $this->upload->data();
                            // Store relative file path
                            $file_paths[strtolower(str_replace(' ', '_', $prefix)) . '_path'] = $upload_dir . '/' . $file_data['file_name'];
                        } else {
                            $error = $this->upload->display_errors();
                            $this->session->set_flashdata('error', $error);
                            redirect('main/criminal_cases');
                            return;
                        }
                    }
                }

                // Update database with file paths
                $response = $this->criminal_case_model->update_criminal_case_path(
                    $criminal_case_id,
                    $file_paths['form_7_path'],
                    $file_paths['notice_of_hearing_path'],
                    $file_paths['summon_path'],
                    $file_paths['pangkat_path'],
                    $file_paths['settlement_path']
                );

                if ($response) {
                    $this->session->set_flashdata('success', 'Attachments added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add attachments.');
                }

                redirect('main/criminal_cases');
            } else {
                $this->session->set_flashdata('error', 'Invalid criminal case ID.');
                redirect('main/criminal_cases');
            }
        }
    }

    public function view_criminal_case_modal($criminal_case_id)
    {
        $this->load->model('criminal_case_model');
        $this->data['criminal'] = $this->criminal_case_model->get_criminal_case($criminal_case_id);
        $this->load->view('main/view_criminal_case_modal', $this->data);
    }

    public function edit_criminal_case_modal($criminal_case_id)
    {
        $this->load->model('criminal_case_model');
        $this->data['criminal'] = $this->criminal_case_model->get_criminal_case($criminal_case_id);
        $this->load->view('main/edit_criminal_case_modal', $this->data);
    }

    public function submit_edit_criminal_case()
    {
    }

    // public function view_criminal_case_file($criminal_case_id)
    // {
    //     $this->load->model('criminal_case_model');
    //     $file_path = $this->criminal_case_model->get_file_path($criminal_case_id);

    //     if ($file_path) {
    //         $this->data['file_path'] = $file_path;
    //         $this->load->view('main/header');
    //         $this->load->view('main/view_criminal_case_file', $this->data);
    //         $this->load->view('main/footer');
    //     } else {
    //         show_404();
    //     }
    // }


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
        $this->submit_add_civil_case();
        $this->load->view('main/add_civil_case_modal');
    }

    public function submit_add_civil_case()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->form_validation->set_rules('civil_case_no', 'Civil Case No.', 'trim|required');
            $this->form_validation->set_rules('date_filed', 'Date Filed', 'trim|required');
            $this->form_validation->set_rules('civil_case_name', 'Civil Case Name', 'trim|required');
            $this->form_validation->set_rules('complainant', 'Complainant', 'trim|required');
            $this->form_validation->set_rules('respondent', 'Respondent', 'trim|required');
            $this->form_validation->set_rules('purok', 'Purok', 'trim|required');
            $this->form_validation->set_rules('complaint', 'Complaint', 'trim|required');
            $this->form_validation->set_rules('relief', 'Relief', 'trim|required');

            if ($this->form_validation->run() != FALSE) {
                log_message('debug', 'Form validation passed.');

                // Extract civil case number and date filed from POST data
                $civil_case_no = $this->input->post('civil_case_no');
                $date_filed = $this->input->post('date_filed');

                // Define the base directory path
                $base_dir = 'C:' . DIRECTORY_SEPARATOR . 'xampp' . DIRECTORY_SEPARATOR . 'htdocs' . DIRECTORY_SEPARATOR . 'Brgy_edms' . DIRECTORY_SEPARATOR .
                    'uploads' . DIRECTORY_SEPARATOR . 'Civil Case';

                // Create the directory for the specific civil case
                $civil_case_dir = $base_dir . DIRECTORY_SEPARATOR . str_replace('/', '-', $civil_case_no);
                if (!is_dir($civil_case_dir)) {
                    mkdir($civil_case_dir, 0777, true);
                }

                // Handle file upload
                $config['upload_path'] = $civil_case_dir;
                $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
                $config['max_size'] = 2048;

                // Generate the new file name
                $file_ext = pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
                $new_file_name = str_replace('/', '-', $civil_case_no) . ' - ' . $date_filed . '.' . $file_ext;

                $config['file_name'] = $new_file_name;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file_upload')) {
                    $file_data = $this->upload->data();
                    $file_path = $civil_case_dir . DIRECTORY_SEPARATOR . $file_data['file_name'];

                    // Save form data along with file path
                    $this->load->model('civil_case_model');
                    $response = $this->civil_case_model->add_civil_case($file_path);

                    if ($response) {
                        log_message('debug', 'Civil case added successfully.');
                        $this->session->set_flashdata('success', 'Civil Case added successfully.');
                    } else {
                        log_message('debug', 'Failed to add civil case.');
                        $this->session->set_flashdata('error', 'Failed to add civil Case.');
                    }
                    redirect('main/civil_cases');
                } else {
                    $error = $this->upload->display_errors();
                    log_message('debug', 'File upload failed: ' . $error);
                    $this->session->set_flashdata('error', $error);
                    redirect('main/civil_cases');
                }
            } else {
                log_message('debug', 'Form validation failed.');
            }
        }
    }

    public function add_civil_attachments_modal($civil_case_id)
    {
        $this->load->model('civil_case_model');
        $this->data['civil_case'] = $this->civil_case_model->get_civil_case($civil_case_id);
        $this->load->view('main/add_civil_attachments_modal', $this->data);
    }

    public function submit_add_civil_attachments()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $civil_case_id = $this->input->post('civil_case_id');
            $this->load->model('civil_case_model');
            $civil_case = $this->civil_case_model->get_civil_case($civil_case_id);

            if ($civil_case) {
                $civil_case_no = str_replace('/', '-', $civil_case->civil_case_no);
                $date_filed = $this->input->post('date_filed');

                // Define the directory structure
                $upload_dir = 'C:/xampp/htdocs/Brgy_edms/uploads/Civil Case/' . $civil_case_no;

                if (!is_dir($upload_dir)) {
                    $this->session->set_flashdata('error', 'The directory for this civil case does not exist.');
                    redirect('main/civil_cases');
                    return;
                }

                $config = [
                    'upload_path'   => $upload_dir,
                    'allowed_types' => 'gif|jpg|png|pdf|doc|docx',
                    'max_size'      => 2048
                ];

                $this->load->library('upload', $config);

                $file_paths = [
                    'form_7_path' => '',
                    'notice_of_hearing_path' => '',
                    'summon_path' => '',
                    'pangkat_path' => '',
                    'settlement_path' => ''
                ];

                $file_fields = [
                    'file_upload_form_7' => 'Form 7',
                    'file_upload_notice_of_hearing' => 'Notice of Hearing',
                    'file_upload_summon' => 'Summon',
                    'file_upload_notice_for_constitution_of_pangkat' => 'Pangkat',
                    'file_upload_settlement' => 'Settlement'
                ];

                foreach ($file_fields as $field => $prefix) {
                    if (!empty($_FILES[$field]['name'])) {
                        $file_extension = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
                        $config['file_name'] = $prefix . '-' . $civil_case_no . '-' . $date_filed . '.' . $file_extension;
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload($field)) {
                            $file_data = $this->upload->data();
                            $file_paths[strtolower(str_replace(' ', '_', $prefix)) . '_path'] = $upload_dir . '/' . $file_data['file_name'];
                        } else {
                            $error = $this->upload->display_errors();
                            $this->session->set_flashdata('error', $error);
                            redirect('main/civil_cases');
                            return;
                        }
                    }
                }

                // Update database with file paths
                $response = $this->civil_case_model->update_civil_case_path(
                    $civil_case_id,
                    $file_paths['form_7_path'],
                    $file_paths['notice_of_hearing_path'],
                    $file_paths['summon_path'],
                    $file_paths['pangkat_path'],
                    $file_paths['settlement_path']
                );

                if ($response) {
                    $this->session->set_flashdata('success', 'Attachments added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add attachments.');
                }

                redirect('main/civil_cases');
            } else {
                $this->session->set_flashdata('error', 'Invalid civil case ID.');
                redirect('main/civil_cases');
            }
        }
    }

    public function view_civil_case_modal($civil_case_id)
    {
        $this->load->model('civil_case_model');
        $this->data['civil'] = $this->civil_case_model->get_civil_case($civil_case_id);
        $this->load->view('main/view_civil_case_modal', $this->data);
    }

    public function edit_civil_case_modal($civil_case_id)
    {
        $this->load->model('civil_case_model');
        $this->data['civil'] = $this->civil_case_model->get_civil_case($civil_case_id);
        $this->load->view('main/edit_civil_case_modal', $this->data);
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
    public function barangay()
    {
        $this->load->model('barangay_model');
        $this->data['barangay'] = $this->barangay_model->get_all_barangay();
        $this->load->view('main/header');
        $this->load->view('main/barangay', $this->data);
        $this->load->view('main/footer');
    }
    public function add_barangay()
    {
        $this->submit_add_barangay();
        $this->load->view('main/header');
        $this->load->view('main/add_barangay');
        $this->load->view('main/footer');
    }
    public function submit_add_barangay()
    {
        $this->form_validation->set_rules('barangay', 'Barangay Validation Error', 'trim|required');
        $this->form_validation->set_rules('city_municipality', 'City/Municipality Validation Error', 'trim|required');
        $this->form_validation->set_rules('province', 'Province Validation Error', 'trim|required');

        if ($this->form_validation->run() != FALSE) {
            $this->load->model('barangay_model');
            $response = $this->barangay_model->add_barangay();
            if ($response) {
                $success_message = 'Barangay added successfully.';
                $this->session->set_flashdata('success', $success_message);
            } else {
                $error_message = 'Barangay was not added.';
                $this->session->set_flashdata('error', $error_message);
            }
            redirect('main/barangay');
        }
    }

    function deactivate_barangay($barangay_id)
    {
        $this->load->model('barangay_model');

        $response = $this->barangay_model->deactivate_barangay($barangay_id);

        if ($response) {
            $success_message = 'Barangay deactivated successfully.';
            $this->session->set_flashdata('success', $success_message);
        } else {
            $error_message = 'Barangay was not deactivated successfully.';
            $this->session->set_flashdata('error', $error_message);
        }
        redirect('main/barangay');
    }

    function reactivate_barangay($barangay_id)
    {
        $this->load->model('barangay_model');

        $response = $this->barangay_model->reactivate_barangay($barangay_id);

        if ($response) {
            $success_message = 'Barangay activated successfully.';
            $this->session->set_flashdata('success', $success_message);
        } else {
            $error_message = 'Barangay was not activated successfully.';
            $this->session->set_flashdata('error', $error_message);
        }
        redirect('main/barangay');
    }

    public function edit_barangay($barangay_id)
    {
        $this->submit_edit_barangay();
        $this->load->model('barangay_model');
        $this->data['barangay'] = $this->barangay_model->get_barangay($barangay_id);
        $this->load->view('main/header');
        $this->load->view('main/edit_barangay', $this->data);
        $this->load->view('main/footer');
    }

    public function submit_edit_barangay()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            log_message('debug', 'Form is submitted.');

            $this->form_validation->set_rules('barangay', 'Barangay', 'trim|required');

            if ($this->form_validation->run() != FALSE) {
                log_message('debug', 'Form validation passed.');

                $this->load->model('barangay_model');
                $response = $this->barangay_model->edit_barangay();

                if ($response) {
                    log_message('debug', 'Barangay updated successfully.');
                    $this->session->set_flashdata('success', 'Barangay updated successfully.');
                } else {
                    log_message('debug', 'Barangay update failed.');
                    $this->session->set_flashdata('error', 'Barangay was not updated successfully.');
                }
                redirect('main/barangay');
            } else {
                log_message('debug', 'Form validation failed.');
            }
        }
    }
}
