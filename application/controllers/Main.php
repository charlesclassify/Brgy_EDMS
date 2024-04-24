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
    public function test()
    {
        $this->load->view('main/header');
        $this->load->view('main/test');
        $this->load->view('main/footer');
    }
}
