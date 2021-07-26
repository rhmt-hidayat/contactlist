<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Satuan extends CI_Controller
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
            $data['judul'] = "S-INA | Master Satuan";
            $data['data'] = $this->M_master->loadSatuan();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Satuan/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $kode       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('kode')))));
            $nama       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));

            $result = $this->M_master->cekDataSatuan($kode);
            if(count($result) > 0)
            {
                $this->session->set_flashdata('error', 'Kode Satuan already exist!');
                redirect('Satuan', 'refresh');
            }
            else
            {
                $data = array(
                    'kode_satuan'      => $kode,
                    'nama_satuan'     => $nama,
                    'status'      => '1',
                );

                $insert = $this->M_crud->insert('satuan', $data);
                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Successfully added new Satuan');
                    redirect('Satuan', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to add new Satuan');
                    redirect('Satuan', 'refresh');
                }
            }
        }

        function edit($id)
        {
            $result = $this->M_master->cekDatabyID('satuan', $id);
            if(count($result) > 0)
            {
                foreach($result as $baris)
                {
                    $kode       = $baris->kode_satuan;
                    $nama      = $baris->nama_satuan;
                }

                $data['edit'] = array(
                    'id'            => $id,
                    'kode_satuan'      => $kode,
                    'nama_satuan'     => $nama,
                );
                $data['judul'] = "S-INA | Master Satuan";
                $data['data'] = $this->M_master->loadSatuan();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Satuan/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Satuan not found');
                redirect('Satuan', 'refresh');
            }
        }

        function update()
        {
            $id = $this->input->post('id');
            $kode = htmlspecialchars(htmlentities(html_escape(strtoupper($this->input->post('kode')))));
            $nama = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));

            $data = array(
                'kode_satuan'          => $kode,
                'nama_satuan'          => $nama,
            );
            
            $where = array('id' => $id);
            $update = $this->M_crud->update('satuan', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Data');
                redirect('Satuan', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Satuan', 'refresh');
            }
        }

        function delete()
        {
            $id = $this->input->post('id');
            $where = array('id' => $id);

            $update = $this->M_crud->delete('satuan', $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menghapus Data');
                redirect('Satuan', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data');
                redirect('Satuan', 'refresh');
            }
        }
    }