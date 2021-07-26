<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Type extends CI_Controller
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
            $data['judul'] = "S-INA | Master Abnormality Type";
            $data['data'] = $this->M_master->loadType();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Type/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $kode       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('kode')))));
            $nama       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));

            $result = $this->M_master->cekDataType($kode);
            if(count($result) > 0)
            {
                $this->session->set_flashdata('error', 'Kode Type already exist!');
                redirect('Type', 'refresh');
            }
            else
            {
                $data = array(
                    'kode_type'      => $kode,
                    'nama_type'     => $nama,
                    'status'      => '1',
                );

                $insert = $this->M_crud->insert('abnormality_type', $data);
                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Successfully added new Type');
                    redirect('Type', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to add new Type');
                    redirect('Type', 'refresh');
                }
            }
        }

        function edit($id)
        {
            $result = $this->M_master->cekDatabyID('abnormality_type', $id);
            if(count($result) > 0)
            {
                foreach($result as $baris)
                {
                    $kode       = $baris->kode_type;
                    $nama      = $baris->nama_type;
                }

                $data['edit'] = array(
                    'id'            => $id,
                    'kode_type'      => $kode,
                    'nama_type'     => $nama,
                );
                $data['judul'] = "S-INA | Master Abnormality Type";
                $data['data'] = $this->M_master->loadType();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Type/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Type not found');
                redirect('Type', 'refresh');
            }
        }

        function update()
        {
            $id = $this->input->post('id');
            $kode = htmlspecialchars(htmlentities(html_escape(strtoupper($this->input->post('kode')))));
            $nama = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));

            $data = array(
                'kode_type'          => $kode,
                'nama_type'          => $nama,
            );
            
            $where = array('id' => $id);
            $update = $this->M_crud->update('abnormality_type', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Data');
                redirect('Type', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Type', 'refresh');
            }
        }

        function delete()
        {
            $id = $this->input->post('id');
            $where = array('id' => $id);

            $update = $this->M_crud->delete('abnormality_type', $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menghapus Data');
                redirect('Type', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data');
                redirect('Type', 'refresh');
            }
        }
    }