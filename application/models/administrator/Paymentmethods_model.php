<?php
    class Paymentmethods_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        function insert($data){
            try {
                $query = $this->db->insert('payment_accounts', $data);
                return array('status' => '1', 'msg' => 'Payment information added successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There is problem adding Payment information.');
            }
        }
        
        function update($data,$paymentaccountID){
            try{
                $this->db->where('PaymentaccountID', $paymentaccountID);
                $query = $this->db->update('payment_accounts',$data);
                return array('status' => '1', 'msg' => 'Payment information updated successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem updating payment information.');
            }
        }
        
        function all($userID){
            $this->db->select("*");
            $this->db->from("payment_accounts");
            $this->db->where("user_UserID",$userID);
            $this->db->order_by('PaymentaccountID','desc');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
        
        function single($paymentaccountID){
            $this->db->select("*");
            $this->db->from("payment_accounts");
            $this->db->where('PaymentaccountID', $paymentaccountID);
            $query = $this->db->get();
            return $query->result();
        }
        
        function delete($paymentaccountID){
            try{
                $this->db->where("PaymentaccountID", $paymentaccountID);
                $this->db->delete("payment_accounts");
                return array('status' => '1', 'msg' => 'Payment Information deleted successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There is problem deleting payment information.');
            }
        }
    }
?>