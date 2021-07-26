<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Report extends CI_Controller
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
            if($this->input->post('filter'))
            {
                $filter = $this->input->post('filter');
                $tanggal = $this->input->post('tanggal');
                $tgl1 = $this->input->post('tgl1');
                $tgl2 = $this->input->post('tgl2');
                $bulan = $this->input->post('bulan');
                $tahun = date("Y");

                if($filter == '1')
                {
                    $data['laporan'] = $this->laporanHarian($tanggal);
                }
                elseif($filter == '2')
                {
                    $data['laporan'] = $this->laporanMingguan($tgl1, $tgl2);
                }
                elseif($filter == '3')
                {
                    $data['laporan'] = $this->laporanBulan($bulan, $tahun);
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pilih Filter');
                    redirect('Report', 'refresh');
                }
                // echo count($data);
     
                $data['judul'] = "S-INA | Contact List | Report";
                $data['defect'] = $this->M_master->loadDefect();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Report/index');
                $this->load->view('Include/footer');
            }
            else
            {
                $data['judul'] = "S-INA | Contact List | Report";
                $data['defect'] = $this->M_master->loadDefect();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Report/index');
                $this->load->view('Include/footer');     
            }
        }

        function laporanHarian($tanggal)
        {
            $result = $this->M_transaksi->getTanggal($tanggal);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanMingguan($tgl1, $tgl2)
        {
            $tanggal_1 = new DateTime(date('Y-m-d', strtotime($tgl1)));
            $tanggal_2 = new DateTime(date('Y-m-d', strtotime($tgl2)));
            $minggu = $tanggal_2 ->diff($tanggal_1);
            $selisih = $minggu->d;
            //return $selisih;
            
            if($selisih <= 7){
                $result = $this->M_transaksi->getMinggu($tgl1, $tgl2);
                if(count($result) > 0)
                {
                    return $result;
                }else
                {
                    $this->session->set_flashdata('error', 'Data Tidak Ada');
                    redirect('Report', 'refresh');
                } 
            }else{
                    $this->session->set_flashdata('error', 'Input tanggal tidak lebih dari satu minggu');
                    redirect('Report', 'refresh'); 
                }
        }

        function laporanBulan($bulan, $tahun)
        {
            $result = $this->M_transaksi->getBulan($bulan, $tahun);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }
    }