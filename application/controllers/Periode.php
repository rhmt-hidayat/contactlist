<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Periode extends CI_Controller
    {
        // function __construct()
        // {
        //     parent::__construct();
        //     $this->load->model(array('M_crud', 'M_master'));
        // }
        
        function __construct()
        {
            parent::__construct();
            $this->load->model(array('M_crud', 'M_master'));
            $cookie = get_cookie('schlemmer');
            if($this->session->userdata('logged') == FALSE)
            {
                delete_cookie('schlemmer');
                redirect('Login', 'refresh');
            }
        }

        function index()
        {
            $data['judul'] = "S-INA | Master Periode";
            $data['data'] = $this->M_master->loadPeriode();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Periode/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $nama = $this->input->post('nama');
            $tgl_periode1 = $this->input->post('tgl_periode1');
            $tgl_periode2 = $this->input->post('tgl_periode2');
            $data = array(
                'nama_periode' => $nama,
                'tgl_periode1' => $tgl_periode1,
                'tgl_periode2' => $tgl_periode2,
            );

            $insert = $this->M_crud->insert('periode', $data);
            if($insert)
            {
                $this->session->set_flashdata('sukses', 'Successfully added new Tanggal Periode');
                redirect('Periode', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Failed to add new Tanggal Periode');
                redirect('Periode', 'refresh');
            }
        }

        function edit($id)
        {
            $result = $this->M_master->cekDatabyID('periode', $id);
            if(count($result) > 0)
            {
                foreach($result as $baris)
                {
                    $nama          = $baris->nama_periode;
                    $tgl_periode1  = $baris->tgl_periode1;
                    $tgl_periode2  = $baris->tgl_periode2;
                }

                $data['edit'] = array(
                    'id'            => $id,
                    'nama_periode' => $nama,
                    'tgl_periode1' => $tgl_periode1,
                    'tgl_periode2' => $tgl_periode2,
                );
                $data['judul'] = "S-INA | Master Periode";
                $data['data'] = $this->M_master->loadPeriode();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Periode/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Tanggal Periode not found');
                redirect('Periode', 'refresh');
            }
        }

        function update()
        {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $tgl_periode1 = $this->input->post('tgl_periode1');
            $tgl_periode2 = $this->input->post('tgl_periode2');
            $data = array(
                'nama_periode' => $nama,
                'tgl_periode1' => $tgl_periode1,
                'tgl_periode2' => $tgl_periode2,
            );

            $where = array('id' => $id);
            $update = $this->M_crud->update('periode', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Tanggal Periode');
                redirect('Periode', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Tanggal Periode');
                redirect('Periode', 'refresh');
            }
        }

        function hapus()
        {
            $id = $this->input->post('id');
            $where = array('id' => $id); 

            $update = $this->M_crud->delete('periode', $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menghapus Tanggal Periode');
                redirect('Periode', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menghapus Tanggal Periode');
                redirect('Periode', 'refresh');
            }
        }
    }