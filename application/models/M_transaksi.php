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
            $this->db->where('transaksi.tanggal',$tanggal);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getHarianProject($tanggal, $project)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal',$tanggal);
            $this->db->where('transaksi.project', $project);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getHarianMaterial($tanggal, $material)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal',$tanggal);
            $this->db->where('transaksi.poduct_drawing', 'desc', $material);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getHarianMesin($tanggal, $mesin)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal',$tanggal);
            $this->db->where('transaksi.machine_no', 'desc', $mesin);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getHarianReported($tanggal, $reported)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal',$tanggal);
            $this->db->where('transaksi.reported', 'desc', $reported);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getHarianStatus($tanggal, $status)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal',$tanggal);
            $this->db->where('transaksi.status', 'desc', $status);
            $this->db->order_by('transaksi.id', 'ASC');

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
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getMingguProject($tgl1, $tgl2, $project)
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
            $this->db->where('transaksi.project', $project);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getMingguMaterial($tgl1, $tgl2, $material)
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
            $this->db->where('transaksi.poduct_drawing', 'desc', $material);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getMingguMesin($tgl1, $tgl2, $mesin)
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
            $this->db->where('transaksi.machine_no', 'desc', $mesin);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getMingguReported($tgl1, $tgl2, $reported)
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
            $this->db->where('transaksi.reported', 'desc', $reported);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getMingguStatus($tgl1, $tgl2, $status)
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
            $this->db->where('transaksi.status', 'desc', $status);
            $this->db->order_by('transaksi.id', 'ASC');

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
            $this->db->order_by('transaksi.id', 'ASC');
            
            return $this->db->get()->result();
        }

        function getBulanProject($bulan, $tahun, $project)
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
            $this->db->where('transaksi.project', $project);
            $this->db->order_by('transaksi.id', 'ASC');
            
            return $this->db->get()->result();
        }

        function getBulanMaterial($bulan, $tahun, $material)
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
            $this->db->where('transaksi.poduct_drawing', 'desc', $material);
            $this->db->order_by('transaksi.id', 'ASC');
            
            return $this->db->get()->result();
        }

        function getBulanMesin($bulan, $tahun, $mesin)
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
            $this->db->where('transaksi.machine_no', 'desc', $mesin);
            $this->db->order_by('transaksi.id', 'ASC');
            
            return $this->db->get()->result();
        }

        function getBulanReported($bulan, $tahun, $reported)
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
            $this->db->where('transaksi.reported', 'desc', $reported);
            $this->db->order_by('transaksi.id', 'ASC');
            
            return $this->db->get()->result();
        }

        function getBulanStatus($bulan, $tahun, $status)
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
            $this->db->where('transaksi.status', 'desc', $status);
            $this->db->order_by('transaksi.id', 'ASC');
            
            return $this->db->get()->result();
        }

        function getPeriode($tgl_periode1, $tgl_periode2)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal >=',$tgl_periode1);
            $this->db->where('transaksi.tanggal <=',$tgl_periode2);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getPeriodeProject($tgl_periode1, $tgl_periode2, $project)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal >=',$tgl_periode1);
            $this->db->where('transaksi.tanggal <=',$tgl_periode2);
            $this->db->where('transaksi.project', $project);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getPeriodeMaterial($tgl_periode1, $tgl_periode2, $material)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal >=',$tgl_periode1);
            $this->db->where('transaksi.tanggal <=',$tgl_periode2);
            $this->db->where('transaksi.poduct_drawing', 'desc', $material);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getPeriodeMesin($tgl_periode1, $tgl_periode2, $mesin)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal >=',$tgl_periode1);
            $this->db->where('transaksi.tanggal <=',$tgl_periode2);
            $this->db->where('transaksi.machine_no', 'desc', $mesin);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getPeriodeReported($tgl_periode1, $tgl_periode2, $reported)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal >=',$tgl_periode1);
            $this->db->where('transaksi.tanggal <=',$tgl_periode2);
            $this->db->where('transaksi.reported', 'desc', $reported);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getPeriodeStatus($tgl_periode1, $tgl_periode2, $status)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.tanggal >=',$tgl_periode1);
            $this->db->where('transaksi.tanggal <=',$tgl_periode2);
            $this->db->where('transaksi.status', 'desc', $status);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getWaktu($periode)
        {
            $this->db->where('id', $periode);
            return $this->db->get('periode')->result();
        }

        function getProject($project)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.project', $project);
            $this->db->order_by('transaksi.id', 'ASC');
            
            return $this->db->get()->result();
        }
        function getMaterial($material)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.product_drawing', $material);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }
        function getMesin($mesin)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.machine_no', $mesin);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }
        function getReported($reported)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.reported', $reported);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }
        function getStatus($status)
        {
            $this->db->select('transaksi.*, mesin.no_mesin as namaMesin, project.nama_project as namaProject, user1.nama as namaKaryawan1, user2.nama as namaKaryawan2, user3.nama as namaKaryawan3');
            $this->db->from('transaksi');
            $this->db->join('mesin', 'transaksi.machine_no = mesin.id', 'LEFT');
            $this->db->join('project', 'transaksi.project = project.id', 'LEFT');
            $this->db->join('karyawan as user1', 'transaksi.reported = user1.NIK', 'LEFT');
            $this->db->join('karyawan as user2', 'transaksi.improvement = user2.NIK', 'LEFT');
            $this->db->join('karyawan as user3', 'transaksi.verified = user3.NIK', 'LEFT');
            $this->db->where('transaksi.status', $status);
            $this->db->order_by('transaksi.id', 'ASC');

            return $this->db->get()->result();
        }

        function getCountProject($project, $tanggal)
        {
            $data = $this->db->query("SELECT A.product_drawing, A.project, IFNULL(COUNT(A.product_drawing),0) as 'Semua', ( SELECT IFNULL(COUNT(B.product_drawing),0) FROM transaksi AS B WHERE B.status ='1' AND B.project = '$project' AND (B.product_drawing = A.product_drawing AND B.project = A.project) GROUP BY B.product_drawing, B.project ) AS 'Open', ( SELECT IFNULL(COUNT(C.product_drawing),0) FROM transaksi AS C WHERE C.status IN('2','3') AND C.project = '$project' AND (C.product_drawing = A.product_drawing AND C.project = A.project) GROUP BY C.product_drawing, C.project ) AS 'OnGoing', ( SELECT IFNULL(COUNT(D.product_drawing),0) FROM transaksi AS D WHERE D.status ='0' AND D.project = '$project' AND (D.product_drawing = A.product_drawing AND D.project = A.project) GROUP BY D.product_drawing, D.project ) AS 'Close' FROM transaksi AS A WHERE A.project = '$project' AND tanggal <= '$tanggal' GROUP BY A.product_drawing, A.project");
            $hasil = $data->result();
            return $hasil;
        }

        function getGrafik($project, $tanggal)
        {
            // $this->db->group_by('product_drawing');
            // $this->db->select('product_drawing');
            // $this->db->select("count(kode) as CountCase");
            // $this->db->where('transaksi.project', $project);
            // $this->db->where('transaksi.tanggal <=',$tanggal);
            // return $this->db->from('transaksi')
            //     ->get()
            //     ->result();

            $data = $this->db->query("SELECT A.product_drawing, A.project, IFNULL(COUNT(A.product_drawing),0) as 'Semua', ( SELECT IFNULL(COUNT(B.product_drawing),0) FROM transaksi AS B WHERE B.status ='1' AND B.project = '$project' AND (B.product_drawing = A.product_drawing AND B.project = A.project) GROUP BY B.product_drawing, B.project ) AS 'Open', ( SELECT IFNULL(COUNT(C.product_drawing),0) FROM transaksi AS C WHERE C.status IN('2','3') AND C.project = '$project' AND (C.product_drawing = A.product_drawing AND C.project = A.project) GROUP BY C.product_drawing, C.project ) AS 'OnGoing', ( SELECT IFNULL(COUNT(D.product_drawing),0) FROM transaksi AS D WHERE D.status ='0' AND D.project = '$project' AND (D.product_drawing = A.product_drawing AND D.project = A.project) GROUP BY D.product_drawing, D.project ) AS 'Close' FROM transaksi AS A WHERE A.project = '$project' AND tanggal <= '$tanggal' GROUP BY A.product_drawing, A.project");
            $hasil = $data->result();
            return $hasil;
        }
    }