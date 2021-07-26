<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Project extends CI_Controller
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
            $data['judul'] = "S-INA | Master Project";
            $data['data'] = $this->M_master->loadProject();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Project/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $kode       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('kode')))));
            $nama       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));

            $result = $this->M_master->cekDataProject($kode);
            if(count($result) > 0)
            {
                $this->session->set_flashdata('error', 'No. mesin already exist!');
                redirect('Project', 'refresh');
            }
            else
            {
                $data = array(
                    'kode_project'      => $kode,
                    'nama_project'     => $nama,
                    'status'      => '1',
                );

                $insert = $this->M_crud->insert('project', $data);
                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Successfully added new Project');
                    redirect('Project', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to add new Project');
                    redirect('Project', 'refresh');
                }
            }
        }

        function edit($id)
        {
            $result = $this->M_master->cekDatabyID('project', $id);
            if(count($result) > 0)
            {
                foreach($result as $baris)
                {
                    $kode       = $baris->kode_project;
                    $nama      = $baris->nama_project;
                }

                $data['edit'] = array(
                    'id'            => $id,
                    'kode_project'      => $kode,
                    'nama_project'     => $nama,
                );
                $data['judul'] = "S-INA | Master Project";
                $data['data'] = $this->M_master->loadProject();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Project/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Project not found');
                redirect('Project', 'refresh');
            }
        }

        function update()
        {
            $id = $this->input->post('id');
            $kode = htmlspecialchars(htmlentities(html_escape(strtoupper($this->input->post('kode')))));
            $nama = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));

            $data = array(
                'kode_project'          => $kode,
                'nama_project'          => $nama,
            );
            
            $where = array('id' => $id);
            $update = $this->M_crud->update('project', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Data');
                redirect('Project', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Project', 'refresh');
            }
        }

        function delete()
        {
            $id = $this->input->post('id');
            $where = array('id' => $id);

            $update = $this->M_crud->delete('project', $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menghapus Data');
                redirect('Project', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data');
                redirect('Project', 'refresh');
            }
        }
    }