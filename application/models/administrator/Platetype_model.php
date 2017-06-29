<?php
    class Platetype_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        function insert($data){
            try {
                $query = $this->db->insert('platetypes', $data);
                //echo $this->db->last_query();
                return array('status' => '1', 'msg' => 'Plate types added successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There is problem adding plate types.');
            }
        }
        
        function update($data,$plateTypeID){
            try{
                $this->db->where('PlatetypesID', $plateTypeID);
                $query = $this->db->update('platetypes',$data);
                return array('status' => '1', 'msg' => 'Plate types updated successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem updating plate types.');
            }
        }
        
        function all(){
            $this->db->select("*");
            $this->db->from("platetypes");
            $this->db->order_by('PlatetypesID','desc');
            $query = $this->db->get();
            return $query->result();
        }
        
        function single($plateTypeID){
            $this->db->select("*");
            $this->db->from("platetypes");
            $this->db->where('PlatetypesID', $plateTypeID);
            $query = $this->db->get();
            return $query->result();
        }
        
        function delete($plateTypeID){
            try{
                $this->db->where_in("PlatetypesID", explode(',', $plateTypeID));
                $this->db->delete("platetypes");
                //echo $this->db->last_query();
                return array('status' => '1', 'msg' => 'Plate type deleted successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem deleting plate type.');
            }
        }
    }
?>