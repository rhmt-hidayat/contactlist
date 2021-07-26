<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Defect extends CI_Controller
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
            $data['judul'] = "S-INA | Master Defect";
            $data['data'] = $this->M_master->loadDefect();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Defect/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $kode       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('kode')))));
            $nama       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));

            $result = $this->M_master->cekDataDefect($kode);
            if(count($result) > 0)
            {
                $this->session->set_flashdata('error', 'Kode Defect already exist!');
                redirect('Defect', 'refresh');
            }
            else
            {
                $data = array(
                    'kode_defect'      => $kode,
                    'nama_defect'     => $nama,
                    'status'      => '1',
                );

                $insert = $this->M_crud->insert('defect_list', $data);
                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Successfully added new Defect');
                    redirect('Defect', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to add new Defect');
                    redirect('Defect', 'refresh');
                }
            }
        }

        function edit($id)
        {
            $result = $this->M_master->cekDatabyID('defect_list', $id);
            if(count($result) > 0)
            {
                foreach($result as $baris)
                {
                    $kode       = $baris->kode_defect;
                    $nama      = $baris->nama_defect;
                }

                $data['edit'] = array(
                    'id'            => $id,
                    'kode_defect'      => $kode,
                    'nama_defect'     => $nama,
                );
                $data['judul'] = "S-INA | Master Defect";
                $data['data'] = $this->M_master->loadDefect();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Defect/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Defect not found');
                redirect('Defect', 'refresh');
            }
        }

        function update()
        {
            $id = $this->input->post('id');
            $kode = htmlspecialchars(htmlentities(html_escape(strtoupper($this->input->post('kode')))));
            $nama = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));

            $data = array(
                'kode_defect'          => $kode,
                'nama_defect'          => $nama,
            );
            
            $where = array('id' => $id);
            $update = $this->M_crud->update('defect_list', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Data');
                redirect('Defect', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Defect', 'refresh');
            }
        }

        function delete()
        {
            $id = $this->input->post('id');
            $where = array('id' => $id);

            $update = $this->M_crud->delete('defect_list', $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menghapus Data');
                redirect('Defect', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data');
                redirect('Defect', 'refresh');
            }
        }
    }