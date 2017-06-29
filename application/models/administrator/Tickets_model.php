<?php
    class Tickets_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        function all(){
            $this->db->select("*");
            $this->db->from("tickets t");
            $this->db->join("user u","t.plates_Vehicles_user_UserID = u.userID","inner");
            $this->db->order_by('t.issueddatetime','desc');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
    }