<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_login extends CI_Model
    {
        private $table = "user_admin";
        private $pk = "userid";

        function cekEmail($email)
        {
            $this->db->where('email', $email);

            return $this->db->get('user_admin');
        }

        public function update($data, $id_user)
        {
            $this->db->where($this->pk, $id_user);
            $this->db->update($this->table, $data);
        }

        public function get_by_cookie($cookie)
        {
            $this->db->where('cookie', $cookie);
            return $this->db->get($this->table);
        }
    }
