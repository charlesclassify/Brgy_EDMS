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
    public function criminal_cases()
    {
        $this->load->view('main/header');
        $this->load->view('main/criminal_cases');
        $this->load->view('main/footer');
    }
    public function civil_cases()
    {
        $this->load->view('main/header');
        $this->load->view('main/civil_cases');
        $this->load->view('main/footer');
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
