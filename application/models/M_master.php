<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_master extends CI_Model
    {
        function loadUser()
        {
            $this->db->order_by('nama', 'ASC');
            return $this->db->get('user_admin')->result();
        }

        function cekData($params,$email)
        {
            $this->db->where($params, $email);

            return $this->db->get('user_admin')->result();
        }

        //Load Data
        function loadMachine()
        {
            $this->db->order_by('id', 'ASC');
            return $this->db->get('mesin')->result();
        }

        function loadMaterial()
        {
            $this->db->select('material.*, satuan.nama_satuan as namaSatuan, project.nama_project as namaProject');
            $this->db->from('material');
            $this->db->join('satuan', 'material.satuan = satuan.id', 'LEFT');
            $this->db->join('project', 'material.id_project = project.id', 'LEFT');
            $this->db->where('material.status', '1');
            $this->db->order_by('material.id', 'ASC');
            
            return $this->db->get()->result();
        }

        function loadMat()
        {
            $this->db->order_by('id', 'ASC');
            return $this->db->get('material')->result();
        }

        function loadMaterialByProject($project)
        {
            $this->db->where('id_project', $project);
            
            return $this->db->get('material')->result();
        }

        function loadProject()
        {
            $this->db->order_by('id', 'ASC');
            return $this->db->get('project')->result();
        }

        function loadSatuan()
        {
            $this->db->order_by('id', 'ASC');
            return $this->db->get('satuan')->result();
        }

        function loadDefect()
        {
            $this->db->order_by('id', 'ASC');
            return $this->db->get('defect_list')->result();
        }

        function loadType()
        {
            $this->db->order_by('id', 'ASC');
            return $this->db->get('abnormality_type')->result();
        }

        function loadTransaksi()
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->order_by('transaksi.id', 'ASC');
            return $this->db->get()->result();
        }

        function cekDatabyID($table, $id)
        {
            $this->db->where('id', $id);

            return $this->db->get($table)->result();
        }

        //Cek Kode
        function cekDataMachine($no_mesin)
        {
            $this->db->where('no_mesin', $no_mesin);
            $this->db->where('status', '1');
            return $this->db->get('mesin')->result();
        }

        function cekDataProject($kode)
        {
            $this->db->where('kode_project', $kode);
            $this->db->where('status', '1');
            return $this->db->get('project')->result();
        }

        function cekDataSatuan($kode)
        {
            $this->db->where('kode_satuan', $kode);
            $this->db->where('status', '1');
            return $this->db->get('satuan')->result();
        }

        function cekDataMaterial($kode)
        {
            $this->db->where('kode_material', $kode);
            $this->db->where('status', '1');
            return $this->db->get('material')->result();
        }

        function cekDataDefect($kode)
        {
            $this->db->where('kode_defect', $kode);
            $this->db->where('status', '1');
            return $this->db->get('defect_list')->result();
        }

        function cekDataType($kode)
        {
            $this->db->where('kode_type', $kode);
            $this->db->where('status', '1');
            return $this->db->get('abnormality_type')->result();
        }

        function loadKaryawan()
        {
            $this->db->order_by('NIK', "ASC");
            return $this->db->get('karyawan')->result();
        }
    }