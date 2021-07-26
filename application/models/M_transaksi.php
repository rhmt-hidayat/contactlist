<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_transaksi extends CI_Model
    {
        function getMaxNo($date)
        {
            // $query = "SELECT MAX(kode) FROM transaksi WHERE mid(kode,5,8) = $date";
            $this->db->select_max('kode');
            $this->db->where('LEFT(kode, 8)=', $date);
            return $this->db->get('transaksi')->result();
        }

        function getMaterialByProject($id)
        {
            $this->db->select('*');
            $this->db->from('material');
            $this->db->where('status', '1');
            $this->db->where('id_project', $id);
            return $this->db->get()->result();
        }

        function getTanggal($tanggal)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            if ($tanggal !== null) {
                $this->db->where('transaksi.tanggal',$tanggal);
            }
            return $this->db->get()->result();
        }

        function getMinggu($tgl1, $tgl2)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal >=',$tgl1);
            $this->db->where('transaksi.tanggal <=',$tgl2);
            return $this->db->get()->result();
        }

        function getBulan($bulan, $tahun)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('MONTH(transaksi.tanggal)', $bulan);
            $this->db->where('YEAR(transaksi.tanggal)', $tahun);
            return $this->db->get()->result();
        }
    }