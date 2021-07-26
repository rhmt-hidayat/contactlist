<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Material extends CI_Controller
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
            $data['judul'] = "S-INA | Master Material";
            $data['data'] = $this->M_master->loadMaterial();
            $data['project'] = $this->M_master->loadProject();
            $data['satuan'] = $this->M_master->loadSatuan();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Material/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $kode       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('kode')))));
            $nama       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));
            $spesifikasi = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('spesifikasi')))));
            $satuan = $this->input->post('satuan');
            $project = $this->input->post('project');

            $result = $this->M_master->cekDataMaterial($kode);
            if(count($result) > 0)
            {
                $this->session->set_flashdata('error', 'Kode material already exist!');
                redirect('Material', 'refresh');
            }
            else
            {
                $data = array(
                    'kode_material'      => $kode,
                    'nama_material'     => $nama,
                    'spesifikasi'       => $spesifikasi,
                    'satuan'            => $satuan,
                    'id_project'        => $project,
                    'status'      => '1',
                );

                $insert = $this->M_crud->insert('material', $data);
                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Successfully added new Material');
                    redirect('Material', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to add new Material');
                    redirect('Material', 'refresh');
                }
            }
        }

        function edit($id)
        {
            $result = $this->M_master->cekDatabyID('material', $id);
            if(count($result) > 0)
            {
                foreach($result as $baris)
                {
                    $kode       = $baris->kode_material;
                    $nama      = $baris->nama_material;
                    $spesifikasi   = $baris->spesifikasi;
                    $project      = $baris->id_project;
                    $satuan      = $baris->satuan;
                }

                $data['edit'] = array(
                    'id'            => $id,
                    'kode_material'      => $kode,
                    'nama_material'     => $nama,
                    'spesifikasi'       => $spesifikasi,
                    'id_project'        => $project,
                    'satuan'            => $satuan,
                );
                $data['judul'] = "S-INA | Master Material";
                $data['data'] = $this->M_master->loadMaterial();
                $data['project'] = $this->M_master->loadProject();
                $data['satuan'] = $this->M_master->loadSatuan();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Material/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Material not found');
                redirect('Material', 'refresh');
            }
        }

        function update()
        {
            $id = $this->input->post('id');
            $kode = htmlspecialchars(htmlentities(html_escape(strtoupper($this->input->post('kode')))));
            $nama = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));
            $spesifikasi = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('spesifikasi')))));
            $satuan = $this->input->post('satuan');
            $project = $this->input->post('project');

            $data = array(
                'kode_material'          => $kode,
                'nama_material'          => $nama,
                'spesifikasi'            => $spesifikasi,
                'satuan'                 => $satuan,
                'id_project'             => $project,
            );
            
            $where = array('id' => $id);
            $update = $this->M_crud->update('material', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Data');
                redirect('Material', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Material', 'refresh');
            }
        }

        function delete()
        {
            $id = $this->input->post('id');
            $where = array('id' => $id);

            $update = $this->M_crud->delete('material', $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menghapus Data');
                redirect('Material', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data');
                redirect('Material', 'refresh');
            }
        }
    }