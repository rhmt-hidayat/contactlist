<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class User extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model(array('M_crud', 'M_master'));
            $cookie = get_cookie('recruitment');
            if($this->session->userdata('logged') == FALSE)
            {
               delete_cookie('schlemmer');
               redirect('Login', 'refresh');
            }
        }

        function index()
        {
            $data['judul'] = "S-INA | Master User";
            $data['data'] = $this->M_master->loadUser();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('User/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $nama       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));
            $email      = $this->input->post('email');
            $level      = $this->input->post('level');
            $password   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $deskripsi  = $this->input->post('deskripsi');

            $result = $this->M_master->cekData('email', $email);
            if(count($result) > 0)
            {
                $this->session->set_flashdata('error', 'Email address already registered');
                redirect('User', 'refresh');
            }
            else
            {
                $data = array(
                    'nama'      => $nama,
                    'email'     => $email,
                    'level'     => $level,
                    'password'  => $password,
                    'deskripsi' => $deskripsi
                );

                $insert = $this->M_crud->insert('user_admin', $data);
                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Successfully added new user');
                    redirect('User', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to add new user');
                    redirect('User', 'refresh');
                }
            }
        }

        function edit($userid)
        {
            $result = $this->M_master->cekdata('userid', $userid);
            if(count($result) > 0)
            {
                foreach($result as $baris)
                {
                    $nama       = $baris->nama;
                    $email      = $baris->email;
                    $level      = $baris->level;
                    $deskripsi  = $baris->deskripsi;
                }

                $data['edit'] = array(
                    'nama'      => $nama,
                    'email'     => $email,
                    'level'     => $level,
                    'deskripsi' => $deskripsi,
                    'userid'    => $userid
                );
                $data['judul'] = "S-INA | Master User";
                $data['data'] = $this->M_master->loadUser();
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('User/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'User not found');
                redirect('User', 'refresh');
            }
        }

        function update()
        {
            $nama       = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));
            $email      = $this->input->post('email');
            $level      = $this->input->post('level');
            $deskripsi  = $this->input->post('deskripsi');
            $userid     = $this->input->post('userid');

            $result = $this->M_master->cekData('email', $email);
            if(count($result) > 0)
            {
                $data = array(
                    'nama'      => $nama,
                    'level'     => $level,
                    'deskripsi'  => $deskripsi
                );
            }
            else
            {
                $data = array(
                    'nama'      => $nama,
                    'email'     => $email,
                    'level'     => $level,
                    'deskripsi' => $deskripsi
                );
            }

            $where = array('userid' => $userid);

            $update = $this->M_crud->update('user_admin', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Successfully updated user data');
                redirect('User', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Failed to update user data');
                redirect('User', 'refresh');
            }
        }

        function changePassword()
        {
            $userid = $this->input->post('userid');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $data = array('password' => $password);
            $where = array('userid' => $userid);

            $update = $this->M_crud->update('user_admin', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Successfully updated user data');
                redirect('User', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Failed to update user data');
                redirect('User', 'refresh');
            }
        }

        function delete()
        {
            $userid = $this->input->post('userid');
            $where = array('userid' => $userid);

            $delete = $this->M_crud->delete('user_admin', $where);
            if($delete)
            {
                $this->session->set_flashdata('sukses', 'Successfully deleted user data');
                redirect('User', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Failed to delete user data');
                redirect('User', 'refresh');
            }
        }
    }