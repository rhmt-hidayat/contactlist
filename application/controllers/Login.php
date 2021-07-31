<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Login extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model(array('M_login'));
        }

        function index()
        {
            $cookie = get_cookie('schlemmer');
            if($this->session->userdata('logged'))
            {
                redirect('Dashboard', 'refresh');
            }
            elseif($cookie <> '')
            {
                $row = $this->M_login->get_by_cookie($cookie)->row();
                if($row)
                {
                    $this->DaftarSession($row);
                }
                else
                {
                   $this->load->view('Login/index');
                }
            }
            else
            {
                // $data = array(
                //     'email'     => set_value('email'),
                //     'password'  => set_value('password'),
                //     'remember'  => set_value('remember'),
                //     'message'   => $this->session->flashdata('message')
                // );
                $this->load->view('Login/index');
            }
            
        }

        function cekLogin()
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember');


            $row = $this->M_login->cekEmail($email, false)->row();
            if($row)
            {
                $verify = password_verify($password, $row->password);
                if($verify)
                {
                    if($remember)
                    {
                        $key = random_string('alnum', 64);
                        set_cookie('schlemmer', $key, 3600*24*30);
                        $update_key = array(
                            'cookie'        => $key,
                            'login_from'    => $this->input->ip_address(),
                            'last_login'    => date("Y-m-d H:i:s")
                        );
                        $this->M_login->update($update_key, $row->userid);
                    }
                    else
                    {
                        $data = array(
                            'last_login' => date("Y-m-d H:i:s"),
                            'login_from' => $this->input->ip_address()
                        );
                        $this->M_login->update($data, $row->userid);
                    }

                    $this->DaftarSession($row);
                }
                else
                {
                    $this->session->set_flashdata('message','Password Salah');
                    $this->index();                    
                }
            }
            else
            {
                $this->session->set_flashdata('message','Login Gagal');
                $this->index();
            }
        }

        function DaftarSession($row)
        {
            $sess = array(
                'logged'    => TRUE,
                'userid'   => $row->userid,
                'email'     => $row->email,
                'nama'      => $row->nama,
                'level'     => $row->level
            );
            $this->session->set_userdata($sess);
            // echo 1;
            // 2. Redirect ke home
            redirect('Dashboard');
        }

        function logout()
        {
            // delete cookie dan session
            $data = array(
                'cookie' => ''
            );

            $update = $this->M_login->update($data, $this->session->userdata('userid'));
            if($update)
            {
                delete_cookie('schlemmer');
                $this->session->sess_destroy();
                redirect('Login');
            }
            else
            {
                delete_cookie('schlemmer');
                $this->session->sess_destroy();
                redirect('Login');
            }
        }
    }