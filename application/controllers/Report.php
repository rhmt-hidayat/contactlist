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
            //Filter waktu dan kriteria
            if($this->input->post('filter') && $this->input->post('kriteria'))
            {
                $filter = $this->input->post('filter');
                $tanggal = $this->input->post('tanggal');
                $tgl1 = $this->input->post('tgl1');
                $tgl2 = $this->input->post('tgl2');
                $bulan = $this->input->post('bulan');
                $tahun = date("Y");
                $periode = $this->input->post('periode');
                if ($periode !== ''){
                    $result = $this->M_transaksi->getWaktu($periode);
                    foreach ($result as $row){
                        $tgl_awal = $row->tgl_periode1;
                        $tgl_akhir = $row->tgl_periode2;
                    }
                }
                $kriteria = $this->input->post('kriteria');
                $project = $this->input->post('form_project');
                $material = $this->input->post('form_material');
                $mesin = $this->input->post('form_mesin');
                $reported = $this->input->post('form_reported');
                $status = $this->input->post('form_status');

                if($filter == '1')
                {
                    if($kriteria == '1'){
                        $data['laporan'] = $this->laporanHarianProject($tanggal, $project);
                    }else if($kriteria == '2'){
                        $data['laporan'] = $this->laporanHarianMaterial($tanggal, $material);
                    }else if($kriteria == '3'){
                        $data['laporan'] = $this->laporanHarianMesin($tanggal, $mesin);
                    }else if($kriteria == '4'){
                        $data['laporan'] = $this->laporanHarianReported($tanggal, $reported);
                    }else if($kriteria == '5'){
                        $data['laporan'] = $this->laporanHarianStatus($tanggal, $status);
                    }else{
                        $data['laporan'] = $this->laporanHarian($tanggal);
                    }
                }
                elseif($filter == '2')
                {
                    if($kriteria == '1'){
                        $data['laporan'] = $this->laporanMingguanProject($tgl1, $tgl2, $project);
                    }else if($kriteria == '2'){
                        $data['laporan'] = $this->laporanMingguanMaterial($tgl1, $tgl2, $material);
                    }else if($kriteria == '3'){
                        $data['laporan'] = $this->laporanMingguanMesin($tgl1, $tgl2, $mesin);
                    }else if($kriteria == '4'){
                        $data['laporan'] = $this->laporanMingguanReported($tgl1, $tgl2, $reported);
                    }else if($kriteria == '5'){
                        $data['laporan'] = $this->laporanMingguanStatus($tgl1, $tgl2, $status);
                    }else{
                        $data['laporan'] = $this->laporanMingguan($tgl1, $tgl2);
                    }
                }
                elseif($filter == '3')
                {
                    if($kriteria == '1'){
                        $data['laporan'] = $data['laporan'] = $this->laporanBulanProject($bulan, $tahun, $project);
                    }else if($kriteria == '2'){
                        $data['laporan'] = $data['laporan'] = $this->laporanBulanMaterial($bulan, $tahun, $material);
                    }else if($kriteria == '3'){
                        $data['laporan'] = $data['laporan'] = $this->laporanBulanMesin($bulan, $tahun, $mesin);
                    }else if($kriteria == '4'){
                        $data['laporan'] = $data['laporan'] = $this->laporanBulanReported($bulan, $tahun, $reported);
                    }else if($kriteria == '5'){
                        $data['laporan'] = $data['laporan'] = $this->laporanBulanStatus($bulan, $tahun, $status);
                    }else{
                        $data['laporan'] = $this->laporanBulan($bulan, $tahun);
                    }
                }
                elseif($filter == '4')
                {
                    if($kriteria == '1'){
                        $data['laporan'] = $this->laporanPeriodeProject($tgl_awal, $tgl_akhir, $project);
                    }else if($kriteria == '2'){
                        $data['laporan'] = $this->laporanPeriodeMaterial($tgl_awal, $tgl_akhir, $material);
                    }else if($kriteria == '3'){
                        $data['laporan'] = $this->laporanPeriodeMesin($tgl_awal, $tgl_akhir, $mesin);
                    }else if($kriteria == '4'){
                        $data['laporan'] = $this->laporanPeriodeReported($tgl_awal, $tgl_akhir, $reported);
                    }else if($kriteria == '5'){
                        $data['laporan'] = $this->laporanPeriodeStatus($tgl_awal, $tgl_akhir, $status);
                    }else{
                        $data['laporan'] = $this->laporanPeriode($tgl_awal, $tgl_akhir);
                    }
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pilih Filter');
                    redirect('Report', 'refresh');
                }
                // echo count($data);
     
                $data['judul'] = "S-INA | Contact List | Report";
                $data['defect'] = $this->M_master->loadDefect();
                $data['type'] = $this->M_master->loadType();
                $data['periode'] = $this->M_master->loadPeriode();
                $data['project'] = $this->M_master->loadProject();
                $data['material'] = $this->M_master->loadMaterial();
                $data['mesin'] = $this->M_master->loadMachine();
                $data['reported'] = $this->M_master->loadKaryawan();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Report/index');
                $this->load->view('Include/footer');
            }
            //Filter waktu
            else if($this->input->post('filter'))
            {
                $filter = $this->input->post('filter');
                $tanggal = $this->input->post('tanggal');
                $tgl1 = $this->input->post('tgl1');
                $tgl2 = $this->input->post('tgl2');
                $bulan = $this->input->post('bulan');
                $tahun = date("Y");
                $periode = $this->input->post('periode');
                if ($periode !== ''){
                    $result = $this->M_transaksi->getWaktu($periode);
                    foreach ($result as $row){
                        $tgl_awal = $row->tgl_periode1;
                        $tgl_akhir = $row->tgl_periode2;
                    }
                }

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
                elseif($filter == '4')
                {
                    $data['laporan'] = $this->laporanPeriode($tgl_awal, $tgl_akhir);
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pilih Filter');
                    redirect('Report', 'refresh');
                }
                // echo count($data);
     
                $data['judul'] = "S-INA | Contact List | Report";
                $data['defect'] = $this->M_master->loadDefect();
                $data['type'] = $this->M_master->loadType();
                $data['periode'] = $this->M_master->loadPeriode();
                $data['project'] = $this->M_master->loadProject();
                $data['material'] = $this->M_master->loadMaterial();
                $data['mesin'] = $this->M_master->loadMachine();
                $data['reported'] = $this->M_master->loadKaryawan();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Report/index');
                $this->load->view('Include/footer');
            }
            //Filter kriteria
            else if($this->input->post('kriteria'))
            {
                $kriteria = $this->input->post('kriteria');
                $project = $this->input->post('form_project');
                $material = $this->input->post('form_material');
                $mesin = $this->input->post('form_mesin');
                $reported = $this->input->post('form_reported');
                $status = $this->input->post('form_status');
                // var_dump($project);

                if($kriteria == '1'){
                    $data['laporan'] = $this->laporanProject($project);
                }else if($kriteria == '2'){
                    $data['laporan'] = $this->laporanMaterial($material);
                }else if($kriteria == '3'){
                    $data['laporan'] = $this->laporanMesin($mesin);
                }else if($kriteria == '4'){
                    $data['laporan'] = $this->laporanReported($reported);
                }else if($kriteria == '5'){
                    $data['laporan'] = $this->laporanStatus($status);
                }else
                {
                    $this->session->set_flashdata('error', 'Pilih Filter');
                    redirect('Report', 'refresh');
                }
                // echo count($data);

                $data['judul'] = "S-INA | Contact List | Report";
                $data['defect'] = $this->M_master->loadDefect();
                $data['type'] = $this->M_master->loadType();
                $data['periode'] = $this->M_master->loadPeriode();
                $data['project'] = $this->M_master->loadProject();
                $data['material'] = $this->M_master->loadMaterial();
                $data['mesin'] = $this->M_master->loadMachine();
                $data['reported'] = $this->M_master->loadKaryawan();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Report/index');
                $this->load->view('Include/footer');
            }
            else
            {
                $data['judul'] = "S-INA | Contact List | Report";
                $data['defect'] = $this->M_master->loadDefect();
                $data['type'] = $this->M_master->loadType();
                $data['periode'] = $this->M_master->loadPeriode();
                $data['project'] = $this->M_master->loadProject();
                $data['material'] = $this->M_master->loadMaterial();
                $data['mesin'] = $this->M_master->loadMachine();
                $data['reported'] = $this->M_master->loadKaryawan();
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

        function laporanPeriode($tgl_periode1, $tgl_periode2)
        {
            $result = $this->M_transaksi->getPeriode($tgl_periode1, $tgl_periode2);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanHarianProject($tanggal, $project)
        {
            $result = $this->M_transaksi->getHarianProject($tanggal, $project);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanHarianMaterial($tanggal, $material)
        {
            $result = $this->M_transaksi->getHarianProject($tanggal, $material);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanHarianMesin($tanggal, $mesin)
        {
            $result = $this->M_transaksi->getHarianMesin($tanggal, $mesin);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanHarianReported($tanggal, $reported)
        {
            $result = $this->M_transaksi->getHarianReported($tanggal, $reported);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanHarianStatus($tanggal, $status)
        {
            $result = $this->M_transaksi->getHarianStatus($tanggal, $status);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanMingguanProject($tgl1, $tgl2, $project)
        {
            $tanggal_1 = new DateTime(date('Y-m-d', strtotime($tgl1)));
            $tanggal_2 = new DateTime(date('Y-m-d', strtotime($tgl2)));
            $minggu = $tanggal_2 ->diff($tanggal_1);
            $selisih = $minggu->d;
            //return $selisih;
            
            if($selisih <= 7){
                $result = $this->M_transaksi->getMinggu($tgl1, $tgl2, $project);
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

        function laporanMingguanMaterial($tgl1, $tgl2, $material)
        {
            $tanggal_1 = new DateTime(date('Y-m-d', strtotime($tgl1)));
            $tanggal_2 = new DateTime(date('Y-m-d', strtotime($tgl2)));
            $minggu = $tanggal_2 ->diff($tanggal_1);
            $selisih = $minggu->d;
            //return $selisih;
            
            if($selisih <= 7){
                $result = $this->M_transaksi->getMinggu($tgl1, $tgl2, $material);
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

        function laporanMingguanMesin($tgl1, $tgl2, $mesin)
        {
            $tanggal_1 = new DateTime(date('Y-m-d', strtotime($tgl1)));
            $tanggal_2 = new DateTime(date('Y-m-d', strtotime($tgl2)));
            $minggu = $tanggal_2 ->diff($tanggal_1);
            $selisih = $minggu->d;
            //return $selisih;
            
            if($selisih <= 7){
                $result = $this->M_transaksi->getMinggu($tgl1, $tgl2, $mesin);
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

        function laporanMingguanReported($tgl1, $tgl2, $reported)
        {
            $tanggal_1 = new DateTime(date('Y-m-d', strtotime($tgl1)));
            $tanggal_2 = new DateTime(date('Y-m-d', strtotime($tgl2)));
            $minggu = $tanggal_2 ->diff($tanggal_1);
            $selisih = $minggu->d;
            //return $selisih;
            
            if($selisih <= 7){
                $result = $this->M_transaksi->getMinggu($tgl1, $tgl2, $reported);
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

        function laporanMingguanStatus($tgl1, $tgl2, $status)
        {
            $tanggal_1 = new DateTime(date('Y-m-d', strtotime($tgl1)));
            $tanggal_2 = new DateTime(date('Y-m-d', strtotime($tgl2)));
            $minggu = $tanggal_2 ->diff($tanggal_1);
            $selisih = $minggu->d;
            //return $selisih;
            
            if($selisih <= 7){
                $result = $this->M_transaksi->getMinggu($tgl1, $tgl2, $status);
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

        function laporanBulanProject($bulan, $tahun, $project)
        {
            $result = $this->M_transaksi->getBulan($bulan, $tahun, $project);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanBulanMaterial($bulan, $tahun, $material)
        {
            $result = $this->M_transaksi->getBulan($bulan, $tahun, $material);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanBulanMesin($bulan, $tahun, $mesin)
        {
            $result = $this->M_transaksi->getBulan($bulan, $tahun, $mesin);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanBulanReported($bulan, $tahun, $reported)
        {
            $result = $this->M_transaksi->getBulan($bulan, $tahun, $reported);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanBulanStatus($bulan, $tahun, $status)
        {
            $result = $this->M_transaksi->getBulan($bulan, $tahun, $status);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanPeriodeProject($tgl_periode1, $tgl_periode2, $project)
        {
            $result = $this->M_transaksi->getPeriode($tgl_periode1, $tgl_periode2, $project);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanPeriodeMaterial($tgl_periode1, $tgl_periode2, $material)
        {
            $result = $this->M_transaksi->getPeriode($tgl_periode1, $tgl_periode2, $material);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanPeriodeMesin($tgl_periode1, $tgl_periode2, $mesin)
        {
            $result = $this->M_transaksi->getPeriode($tgl_periode1, $tgl_periode2, $mesin);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanPeriodeReported($tgl_periode1, $tgl_periode2, $reported)
        {
            $result = $this->M_transaksi->getPeriode($tgl_periode1, $tgl_periode2, $reported);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanPeriodeStatus($tgl_periode1, $tgl_periode2, $status)
        {
            $result = $this->M_transaksi->getPeriode($tgl_periode1, $tgl_periode2, $status);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanProject($project)
        {
            $result = $this->M_transaksi->getProject($project);
            // var_dump($result);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }
        function laporanMaterial($material)
        {
            $result = $this->M_transaksi->getMaterial($material);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }
        function laporanMesin($mesin)
        {
            $result = $this->M_transaksi->getMesin($mesin);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }
        function laporanReported($reported)
        {
            $result = $this->M_transaksi->getReported($reported);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }
        function laporanStatus($status)
        {
            $result = $this->M_transaksi->getStatus($status);
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