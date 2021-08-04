<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Total extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model(array('M_crud', 'M_master', 'M_transaksi'));
            $cookie = get_cookie('recruitment');
            if($this->session->userdata('logged') == FALSE)
            {
                delete_cookie('dokumen');
                redirect('Login', 'refresh');
            }
        }

        function index()
        {
            if($this->input->post('form_project'))
            {
                $tanggal = $this->input->post('tanggal');
                $project = $this->input->post('form_project');
                $data['laporan'] = $this->laporanCountProject($project, $tanggal);
                $data['grafik'] = $this->tampilGrafik($project, $tanggal);
                $data['judul'] = "S-INA | Contact List | Total Report";
                $data['project'] = $this->M_master->loadProject();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Total/index');
                $this->load->view('Include/footer'); 
            }else{
                $data['judul'] = "S-INA | Contact List | Total Report";
                $data['project'] = $this->M_master->loadProject();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Total/index');
                $this->load->view('Include/footer'); 
            } 
        }

        function laporanCountProject($project, $tanggal)
        {
            $result = $this->M_transaksi->getCountProject($project, $tanggal);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Total', 'refresh');
            }
        }

        function tampilGrafik($project, $tanggal)
        {
            $result = $this->M_transaksi->getGrafik($project, $tanggal);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Total', 'refresh');
            }
        }
    }