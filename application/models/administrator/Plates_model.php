<?php
    class Plates_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        function insert($data){
            try {
                $query = $this->db->insert('plates', $data);
                //var_dump($query);
                //print_r($this->db);
                return array('status' => '1', 'msg' => 'Vehicle added successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There is problem adding vehicle.');
            }
        }
        
        function update($data,$vehicleID){
            try {
                $this->db->where('Vehicles_vehicleID', $vehicleID);
                $query = $this->db->update('plates',$data);
                //print_r($this->db);
                return array('status' => '1', 'msg' => 'Vehicle updated successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There is problem updating vehicle.');
            }
        }
    }
?>