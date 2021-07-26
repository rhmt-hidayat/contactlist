<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Transaksi extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model(array('M_crud', 'M_master', 'M_transaksi'));
            $cookie = get_cookie('schlemmer');
            if($this->session->userdata('logged') == FALSE)
            {
                delete_cookie('schlemmer');
                redirect('Login', 'refresh');
            }
        }

        function index()
        {
            $data['judul'] = "S-INA | Contact List Transaction";
            $data['data'] = $this->M_master->loadTransaksi();
            $data['defect'] = $this->M_master->loadDefect();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Transaksi/index', $data);
            $this->load->view('Include/footer');
        }

        function add()
        {
            $data['judul'] = "S-INA | Add New Contact List";
            $data['noTransaksi'] = $this->automaticNO();
            $data['karyawan'] = $this->M_master->loadKaryawan();
            $data['project'] = $this->M_master->loadProject();
            $data['mesin'] = $this->M_master->loadMachine();
            $data['defect'] = $this->M_master->loadDefect();
            $data['type'] = $this->M_master->loadType();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Transaksi/add', $data);
            $this->load->view('Include/footer');
        }

        function automaticNO()
        {
            $prefix = "CTL-";
            $date = date("Ymd");
            $getMaxNo = $this->M_transaksi->getMaxNo($date);
            foreach($getMaxNo as $G)
            {
                $nomor = $G->kode;
            }

            $nourut = substr($nomor,14, -3);
            $kodeSekarang = $nourut + 1;
            $noUrutBaru = sprintf("%03s", $kodeSekarang);
            $kodeTransaksi = $date."-".$noUrutBaru;
            //$kodeTransaksi = $date;

            return $kodeTransaksi;
        }

        function getMaterial()
        {
            $id = $this->input->post('id');
            $dataMaterial = $this->M_transaksi->getMaterialByProject($id);
            echo json_encode($dataMaterial);
        }


        function insert()
        {
            $kode = $this->input->post('kode');
            $tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
            $pelapor = $this->input->post('pelapor');
            $shift = $this->input->post('shift');
            $project = $this->input->post('project');
            $material = $this->input->post('material');
            $mesin = $this->input->post('mesin');
            $lot = $this->input->post('lot');
            $total_qty = $this->input->post('total_qty');
            $defect_qty = $this->input->post('defect_qty');
            $type = $this->input->post('type');
            $pilih = $this->input->post('defect');
            if($pilih == '')
            {
                $defect = '';
            }
            else
            {
                $defect = implode(",", $this->input->post('defect'));
            }
            $abnormal = $this->input->post('abnormal');
            $root_couse = $this->input->post('root_couse');
            $temporary = $this->input->post('temporary');
            $time = $this->input->post('time');
            $qty_sortir = $this->input->post('qty_sortir');
            $qty_ok = $this->input->post('qty_ok');
            $qty_ng = $this->input->post('qty_ng');
            $working_hour = $this->input->post('working_hour');
            $result = $this->input->post('result');
            $longterm = $this->input->post('longterm');
            $reported = $this->input->post('reported');
            $finish = $this->input->post('finish');
            $verified = $this->input->post('verified');

            $data = array(
                'kode' => $kode,
                'tanggal' => $tanggal,
                'reported' => $pelapor,
                'shift' => $shift,
                'project' => $project,
                'product_drawing' => $material,
                'machine_no' => $mesin,
                'lot_no' => $lot,
                'total_product' => $total_qty,
                'defect_qty' => $defect_qty,
                'abn_type' => $type,
                'defect' => json_encode($defect),
                'situation' => $abnormal,
                'root' => $root_couse,
                'temporary' => $temporary,
                'stop_time' => $time,
                'qty_sortir' => $qty_sortir,
                'qty_ok' => $qty_ok,
                'qty_ng' => $qty_ng,
                'working_hour' => $working_hour,
                'result' => $result,
                'longterm' => $longterm,
                'improvement' => $reported,
                'finish' => $finish,
                'status' => 'Close',
                'verified' => $verified,
            );
            // var_dump($data);
            $insert = $this->db->insert('transaksi', $data);
            if($insert)
            {
                $this->session->set_flashdata('sukses', 'Successfully added new transaksi');
                redirect('Transaksi', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Failed to add new transaksi');
                redirect('Transaksi', 'refresh');
            }
        }

        function edit($id)
        {
            $result = $this->M_master->cekDatabyID('transaksi', $id);
            // var_dump($result);
            if(count($result) > 0)
            {
                foreach($result as $baris)
                {
                    $kode           = $baris->kode;
                    $tanggal        = $baris->tanggal;
                    $pelapor        = $baris->reported;
                    $shift          = $baris->shift;
                    $project        = $baris->project;
                    $material       = $baris->product_drawing;
                    $mesin          = $baris->machine_no;
                    $lot            = $baris->lot_no;
                    $total_qty      = $baris->total_product;
                    $defect_qty     = $baris->defect_qty;
                    $type           = $baris->abn_type;
                    $defect         = $baris->defect;
                    $abnormal       = $baris->situation;
                    $root_couse     = $baris->root;
                    $temporary      = $baris->temporary;
                    $time           = $baris->stop_time;
                    $qty_sortir     = $baris->qty_sortir;
                    $qty_ok         = $baris->qty_ok;
                    $qty_ng         = $baris->qty_ng;
                    $working_hour   = $baris->working_hour;
                    $result         = $baris->result;
                    $longterm       = $baris->longterm;
                    $reported       = $baris->improvement;
                    $finish         = $baris->finish;
                    $verified       = $baris->verified;
                    
                }

                $data['edit'] = array(
                    'id'              => $id,
                    'kode'            => $kode,
                    'tanggal'         => $tanggal,
                    'reported'        => $pelapor,
                    'shift'           => $shift,
                    'project'         => $project,
                    'product_drawing' => $material,
                    'machine_no'      => $mesin,
                    'lot_no'          => $lot,
                    'total_product'   => $total_qty,
                    'defect_qty'      => $defect_qty,
                    'abn_type'        => $type,
                    'defect'          => json_encode($defect),
                    'situation'       => $abnormal,
                    'root'            => $root_couse,
                    'temporary'       => $temporary,
                    'stop_time'       => $time,
                    'qty_sortir'      => $qty_sortir,
                    'qty_ok'          => $qty_ok,
                    'qty_ng'          => $qty_ng,
                    'working_hour'    => $working_hour,
                    'result'          => $result,
                    'longterm'        => $longterm,
                    'improvement'     => $reported,
                    'finish'          => $finish,
                    'status'          => 'Close',
                    'verified'        => $verified,
                );
                $data['judul'] = "S-INA | Edit Contact List";
                $data['noTransaksi'] = $this->automaticNO();
                $data['karyawan'] = $this->M_master->loadKaryawan();
                $data['project'] = $this->M_master->loadProject();
                $data['mesin'] = $this->M_master->loadMachine();
                $data['defect'] = $this->M_master->loadDefect();
                $data['type'] = $this->M_master->loadType();
                $data['material_edit'] = $this->M_master->loadMaterialByProject($project);
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Transaksi/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Transaksi not found');
                redirect('Transaksi', 'refresh');
            }
        }

        function update()
        {
            $id = $this->input->post('id');
            $kode = $this->input->post('kode');
            $tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
            $timestamp = strtotime($tanggal);
            $pelapor = $this->input->post('pelapor');
            $shift = $this->input->post('shift');
            $project = $this->input->post('project');
            $material = $this->input->post('material');
            $mesin = $this->input->post('mesin');
            $lot = $this->input->post('lot');
            $total_qty = $this->input->post('total_qty');
            $defect_qty = $this->input->post('defect_qty');
            $type = $this->input->post('type');
            $defect = implode(",", $this->input->post('defect'));
            $abnormal = $this->input->post('abnormal');
            $root_couse = $this->input->post('root_couse');
            $temporary = $this->input->post('temporary');
            $time = $this->input->post('time');
            $qty_sortir = $this->input->post('qty_sortir');
            $qty_ok = $this->input->post('qty_ok');
            $qty_ng = $this->input->post('qty_ng');
            $working_hour = $this->input->post('working_hour');
            $result = $this->input->post('result');
            $longterm = $this->input->post('longterm');
            $reported = $this->input->post('reported');
            $finish = $this->input->post('finish');
            $verified = $this->input->post('verified');

            $data = array(
                'kode' => $kode,
                'tanggal' => $tanggal,
                'reported' => $pelapor,
                'shift' => $shift,
                'project' => $project,
                'product_drawing' => $material,
                'machine_no' => $mesin,
                'lot_no' => $lot,
                'total_product' => $total_qty,
                'defect_qty' => $defect_qty,
                'abn_type' => $type,
                'defect' => json_encode($defect),
                'situation' => $abnormal,
                'root' => $root_couse,
                'temporary' => $temporary,
                'stop_time' => $time,
                'qty_sortir' => $qty_sortir,
                'qty_ok' => $qty_ok,
                'qty_ng' => $qty_ng,
                'working_hour' => $working_hour,
                'result' => $result,
                'longterm' => $longterm,
                'improvement' => $reported,
                'finish' => $finish,
                'status' => 'Close',
                'verified' => $verified,
            );

            $where = array('id' => $id);
            $update = $this->M_crud->update('transaksi', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Data');
                redirect('Transaksi', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Transaksi', 'refresh');
            }
        }

        function delete()
        {
            $id = $this->input->post('id');
            $where = array('id' => $id);

            $update = $this->M_crud->delete('transaksi', $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menghapus Data');
                redirect('Transaksi', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data');
                redirect('Transaksi', 'refresh');
            }
        }
    }