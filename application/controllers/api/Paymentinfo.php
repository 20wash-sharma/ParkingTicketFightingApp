<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'/libraries/REST_Controller.php';
    
    class Paymentinfo extends REST_Controller
    {
        function __construct()
        {
            parent::__construct();
            
            $this->load->model('administrator/Paymentmethods_model');

            // Configure limits on our controller methods. Ensure
            // you have created the 'limits' table and enabled 'limits'
            // within application/config/rest.php
            $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
            $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
            $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
        }
        
        function insertupdate_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            if(!$this->post('nickname'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('accountType'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('cardNumber'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('expiryDate'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('secureCode'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('billingAddress'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('billingCity'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('billingState'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('billingZip'))
            {
                $this->response(NULL, 400);
            }
            
            $paymentaccountID = $this->post('paymentaccountID');
            $nickname = $this->post('nickname');
            $accountType = $this->post('accountType');
            $cardNumber = $this->post('cardNumber');
            $expiryDate = $this->post('expiryDate');
            $secureCode = $this->post('secureCode');
            $billingAddress = $this->post('billingAddress');
            $billingCity = $this->post('billingCity');
            $billingState = $this->post('billingState');
            $billingZip = $this->post('billingZip');
            
            $data = array(
                'user_UserID' => $userID,
                'nickName' => $nickname,
                'creationtime' => date('Y-m-d'),
                'accounttype' => $accountType,
                'accountnumber' => $cardNumber,
                'routingnumber' => $secureCode,
                'experationdate' => $expiryDate
            );
            
            if($paymentaccountID > 0):
                $ret = $this->Paymentmethods_model->update($data, $paymentaccountID);
            else:
                $ret = $this->Paymentmethods_model->insert($data);
            endif;
            
            if($ret == null):
                $retBack = array('status'=>'0','msg'=>'There is problem adding data.');
            else:
                $retBack = $ret;
            endif;
            $this->response($retBack,400);
        }
        
        function all_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            $paymentsAccounts = $this->Paymentmethods_model->all($userID);
            $this->response($paymentsAccounts, 200);
        }
        
        function single_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            if(!$this->post('paymentaccountID'))
            {
                $this->response(NULL, 400);
            }
            
            $paymentaccountID = $this->post('paymentaccountID');
            
            $paymentsAccount = $this->Paymentmethods_model->single($paymentaccountID);
            $this->response($paymentsAccount, 200);
        }
        
        function delete_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            if(!$this->post('paymentaccountID'))
            {
                $this->response(NULL, 400);
            }
            
            $paymentaccountID = $this->post('paymentaccountID');
            
            $ret = $this->Paymentmethods_model->delete($paymentaccountID);
            if($ret == null):
                $retBack = array('status'=>'0','msg'=>'There is problem adding data.');
                $this->response($retBack,400);
            else:
                $retBack = $ret;
            endif;
            $this->response($retBack,200);
        }
    }