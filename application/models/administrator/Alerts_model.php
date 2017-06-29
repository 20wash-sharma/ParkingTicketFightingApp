<?php

    class Alerts_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        public function selectAlerts($userID){
            $this->db->select('*');
            $this->db->from('alertpreferances');
            $this->db->where('user_UserID', $userID);
            $query = $this->db->get();
            if($query -> num_rows() > 1)
            {
                $sql = "select a.AlertsID, ap.sendalert, a.description, ap.alertType, (case when alertType='twitter' then (select twitter from user where UserID = '" . $userID . "') else (case when alertType='facebook' then (select facebook from user where UserID = '" . $userID . "') else (case when alertType='text' then (select phone from user where UserID='" . $userID . "') else (case when alertType='email' then (select email from user where UserID='" . $userID . "') end) end) end) end) alertDest from alerts a inner join alertshistory ah on a.AlertsID = ah.alerts_alertsID inner join alertpreferances ap on ah.alertpreferances_alertpreferancesID = ap.AlertpreferancesID where ap.user_UserID = '" . $userID . "'";
                //$sql = "select a.AlertsID, ap.sendalert, a.description, ap.alertType, (case when alertType='twitter' then (select twitter from user where UserID = '" . $userID . "') else (case when alertType='facebook' then (select facebook from user where UserID = '" . $userID . "') else (case when alertType='text' then (select phone from user where UserID='" . $userID . "') end) end) end) alertDest from alerts a inner join alertshistory ah on a.AlertsID = ah.alerts_alertsID inner join alertpreferances ap on ah.alertpreferances_alertpreferancesID = ap.AlertpreferancesID where ap.user_UserID = '" . $userID . "'";
                //$sql = "select a.AlertsID, ap.sendalert, a.description, ap.alertType  from alerts a inner join alertshistory ah on a.AlertsID = ah.alerts_alertsID inner join alertpreferances ap on ah.alertpreferances_alertpreferancesID = ap.AlertpreferancesID where ap.user_UserID = '" . $userID . "'";
            }else{
                $sql = "select AlertsID, 0 sendalert, description, 0 alertType ,'' alertDest from alerts";
            }
            $query = $this->db->query($sql);
            //echo $this->db->last_query();
            return $query->result();
        }
        
        public function delete($userID){
            try{
                $this->db->where("alertpreferances_user_UserID", $userID);
                $this->db->delete("alertshistory");
                $this->db->where("user_UserID", $userID);
                $this->db->delete("alertpreferances");
                return array('status' => '1', 'msg' => 'Role deleted successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem deleting role.');
            }
        }
        
        public function insertPreference($data){
            try {
                $this->db->insert('alertpreferances', $data);
                $AlertpreferancesID = $this->db->insert_id();
                return $AlertpreferancesID;
            } catch (Exception $e) {
                return 0;
            }
        }
        
        public function insertAlert($data){
            try {
                $this->db->insert('alertshistory', $data);
                return array('status' => '1', 'msg' => 'Alert setting saved successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There is problem saving alert setting.');
            }
        }
    }