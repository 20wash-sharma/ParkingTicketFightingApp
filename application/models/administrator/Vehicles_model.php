<?php
    class Vehicles_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        function insert($data){
            try {
                $query = $this->db->insert('vehicles', $data);
                if($query == FALSE)
                {
                    //print_r($this->db);
                    $error = $this->db->conn_id->errno;
                    if($error == 1062)
                        return array('status' => '0', 'msg' => 'This vehicle already exists.');
                }
                //echo $this->db->last_query();
                $vehicleID = $this->db->insert_id();
                return array('status' => '1', 'vehicleID' => $vehicleID, 'msg' => 'Vehicle added successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There is problem adding vehicle.');
            }
        }
        
        function update($data,$vehicleID){
            try{
                $this->db->where('VehicleID', $vehicleID);
                $query = $this->db->update('vehicles',$data);
                return array('status' => '1', 'vehicleID' => $vehicleID, 'msg' => 'Vehicle updated successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem updating vehicle.');
            }
        }
        
        function all($userID){
            $this->db->select("*");
            $this->db->from("vehicles v");
            $this->db->join("vehiclemake vm","v.vehicleMake_vehicleMake = vm.VehiclemakeID","inner");
            $this->db->join("plates p","p.Vehicles_vehicleID = v.VehicleID", "inner");
            $this->db->join("states s","p.state_StateID = s.StateID","inner");
            $this->db->join("platetypes pt","p.plateTypes_plateTypesID = pt.PlatetypesID","inner");
            $this->db->where("user_UserID",$userID);
            $this->db->order_by('VehicleID','desc');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
        
        function allList($userID){
            $this->db->select("*");
            $this->db->from("vehicles v");
            $this->db->join("plates p", "v.VehicleID = p.Vehicles_vehicleID", "inner");
            $this->db->where("v.user_UserID",$userID);
            $this->db->order_by('v.VehicleID','desc');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
        
        function single($vehicleID){
            $this->db->select("*");
            $this->db->from("vehicles v");
            $this->db->join("plates p", "v.VehicleID = p.Vehicles_vehicleID", "inner");
            $this->db->where('v.VehicleID', $vehicleID);
            $query = $this->db->get();
            return $query->result();
        }
        function delete($vehicleID){
             try{
                  $this->db->where_in("VehicleID", explode(',',$vehicleID));
               
                if($this->db->delete("vehicles"))
                {
                    $this->db->where_in("Vehicles_vehicleID", explode(',',$vehicleID));
               
                  
                $this->db->delete("plates");  
                }
                else 
                {
                   return array('status'=>'0','msg'=>'There is problem deleting vehicle.');  
                }
               
                return array('status' => '1', 'msg' => 'Vehicle deleted successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem deleting vehicle.');
            }
           
        }
        function delete1($vehicleID){
            try{
                $this->db->where("VehicleID", $vehicleID);
                if($this->db->delete("vehicles"))
                {
                   $this->db->where("Vehicles_vehicleID", $vehicleID);
                $this->db->delete("plates");  
                }
                else 
                {
                   return array('status'=>'0','msg'=>'There is problem deleting vehicle.');  
                }
               
                return array('status' => '1', 'msg' => 'Vehicle deleted successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem deleting vehicle.');
            }
        }
    }
?>