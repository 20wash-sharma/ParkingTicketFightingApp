<?php
    class Role_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        function insert($data){
            try {
                $query = $this->db->insert('role', $data);
                if($query == FALSE)
                {
                    //print_r($this->db);
                    $error = $this->db->conn_id->errno;
                    if($error == 1062)
                        return array('status' => '0', 'msg' => 'This role already exists.');
                }
                return array('status' => '1', 'msg' => 'Role added successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There is problem adding role.');
            }
        }
        
        function update($data,$roleID){
            try{
                $this->db->where('RoleID', $roleID);
                $query = $this->db->update('role',$data);
                if($query == FALSE)
                {
                    //print_r($this->db);
                    $error = $this->db->conn_id->errno;
                    if($error == 1062)
                        return array('status' => '0', 'msg' => 'This role already exists.');
                }
                return array('status' => '1', 'msg' => 'Role updated successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem updating role.');
            }
        }
        
        function all($roleLevel){
            $this->db->select("*");
            $this->db->from("role");
            $this->db->where("level>=",$roleLevel);
            $this->db->order_by("level",'asc');
            $query = $this->db->get();
            return $query->result();
        }
        
        function single($roleID){
            $this->db->select("*");
            $this->db->from("role");
            $this->db->where('RoleID', $roleID);
            $query = $this->db->get();
            return $query->result();
        }
        
        function delete($roleIDs){
            try{
                $this->db->where_in("RoleID", explode(',',$roleIDs));
                $this->db->delete("role");
                return array('status' => '1', 'msg' => 'Role deleted successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem deleting role.');
            }
        }
    }
?>