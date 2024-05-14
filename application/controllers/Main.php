<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
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
        $this->load->view('main/header');
        $this->load->view('main/user');
        $this->load->view('main/footer');
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
