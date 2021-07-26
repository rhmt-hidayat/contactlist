<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Machine extends CI_Controller
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
            $data['judul'] = "S-INA | Master Machine";
            $data['data'] = $this->M_master->loadMachine();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Machine/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $no_mesin       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('no_mesin')))));
            $tonnage       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('tonnage')))));

            // $result = $this->M_master->cekDataMachine($no_mesin);
            // if(count($result) > 0)
            // {
            //     $this->session->set_flashdata('error', 'No. mesin already exist!');
            //     redirect('Machine', 'refresh');
            // }
            // else
            // {
                $data = array(
                    'no_mesin'      => $no_mesin,
                    'tonnage'     => $tonnage,
                    'status'      => '1',
                );

                $insert = $this->M_crud->insert('mesin', $data);
                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Successfully added new machine');
                    redirect('Machine', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to add new machine');
                    redirect('Machine', 'refresh');
                }
            // }
        }

        function edit($id)
        {
            $result = $this->M_master->cekDatabyID('mesin', $id);
            if(count($result) > 0)
            {
                foreach($result as $baris)
                {
                    $no_mesin       = $baris->no_mesin;
                    $tonnage      = $baris->tonnage;
                }

                $data['edit'] = array(
                    'id'            => $id,
                    'no_mesin'      => $no_mesin,
                    'tonnage'     => $tonnage,
                );
                $data['judul'] = "S-INA | Master Machine";
                $data['data'] = $this->M_master->loadMachine();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Machine/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Machine not found');
                redirect('Machine', 'refresh');
            }
        }

        function update()
        {
            $id = $this->input->post('id');
            $no_mesin = htmlspecialchars(htmlentities(html_escape(strtoupper($this->input->post('no_mesin')))));
            $tonnage = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('tonnage')))));

            $data = array(
                'no_mesin'          => $no_mesin,
                'tonnage'          => $tonnage,
            );
            
            $where = array('id' => $id);
            $update = $this->M_crud->update('mesin', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Data');
                redirect('Machine', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Machine', 'refresh');
            }
        }

        function delete()
        {
            $id = $this->input->post('id');
            $where = array('id' => $id);

            $delete = $this->M_crud->delete('mesin', $where);
            if($delete)
            {
                $this->session->set_flashdata('sukses', 'Successfully deleted machine data');
                redirect('Machine', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Failed to delete machine data');
                redirect('Machine', 'refresh');
            }
        }
    }