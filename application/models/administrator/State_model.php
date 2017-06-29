<?php
    class State_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        function all(){
            $this->db->select("*");
            $this->db->from("states");
            $this->db->order_by('StateID','asc');
            $query = $this->db->get();
            $this->db->last_query();
            return $query->result();
        }
        
        function insert($data){
            try {
                $query = $this->db->insert('states', $data);
                return array('status' => '1', 'msg' => 'State added successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There is problem adding state.');
            }
        }
        
        function update($data,$stateID){
            try{
                $this->db->where('StateID', $stateID);
                $query = $this->db->update('states',$data);
                return array('status' => '1', 'msg' => 'State updated successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem updating state.');
            }
        }
        
        function single($stateID){
            $this->db->select("*");
            $this->db->from("states");
            $this->db->where('StateID', $stateID);
            $query = $this->db->get();
            return $query->result();
        }
        
        function delete($stateIDs){
            try{
                $this->db->where_in("StateID", explode(',',$stateIDs));
                $this->db->delete("states");
                return array('status' => '1', 'msg' => 'State(s) deleted successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem deleting state(s).');
            }
        }
    }
?>