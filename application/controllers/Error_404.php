<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Error_404 extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        function index()
        {
            $data['judul'] = "404 Page Not Found";
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('404/index', $data);
            $this->load->view('Include/footer');
        }
    }