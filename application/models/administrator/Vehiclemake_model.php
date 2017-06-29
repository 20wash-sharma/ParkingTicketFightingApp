<?php
    class Vehiclemake_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        function insert($data){
            try {
                $query = $this->db->insert('vehiclemake', $data);
                if($query == FALSE)
                {
                    //print_r($this->db);
                    $error = $this->db->conn_id->errno;
                    if($error == 1062)
                        return array('status' => '0', 'msg' => 'This vehicle make already exists.');
                }
                return array('status' => '1', 'msg' => 'Vehicle make added successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There is problem adding vehicle make.');
            }
        }
        
        function update($data,$makeID){
            try{
                $this->db->where('VehiclemakeID	', $makeID);
                $query = $this->db->update('vehiclemake',$data);
                if($query == FALSE)
                {
                    //print_r($this->db);
                    $error = $this->db->conn_id->errno;
                    if($error == 1062)
                        return array('status' => '0', 'msg' => 'This vehicle make already exists.');
                }
                return array('status' => '1', 'msg' => 'Vehicle Make updated successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem updating vehicle make.');
            }
        }
        
        function all(){
            $this->db->select("*");
            $this->db->from("vehiclemake");
            $this->db->order_by('VehiclemakeID','desc');
            $query = $this->db->get();
            return $query->result();
        }
        
        function single($makeID){
            $this->db->select("*");
            $this->db->from("vehiclemake");
            $this->db->where('VehiclemakeID', $makeID);
            $query = $this->db->get();
            return $query->result();
        }
        
        function delete($makeIDs){
            try{
                $this->db->where_in("VehiclemakeID", explode(',',$makeIDs));
                $this->db->delete("vehiclemake");
                return array('status' => '1', 'msg' => 'Vehicle Make deleted successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem deleting vehicle make.');
            }
        }
    }
?>