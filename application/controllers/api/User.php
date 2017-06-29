<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'/libraries/REST_Controller.php';
    
    class User extends REST_Controller
    {
        function __construct()
        {
            parent::__construct();

            $this->load->model('administrator/User_model');
            $this->load->model('administrator/Vehicles_model');
            $this->load->model('administrator/Alerts_model');
            
            // Configure limits on our controller methods. Ensure
            // you have created the 'limits' table and enabled 'limits'
            // within application/config/rest.php
            $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
            $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
            $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
        }
        
        function checklogin_post()
        {
            if(!$this->post('username'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('password'))
            {
                $this->response(NULL, 400);
            }
            $userName = $this->post('username');
            $password = $this->post('password');
            
            $ret = $this->User_model->checkLogin($userName, md5($password));
            //$this->response($ret['status']);
            if($ret['status'] == 1):
                $token = md5(uniqid($userName, true));
                $this->User_model->insertToken($token,$ret['data'][0]->UserID);
                $ret['token']=$token;
                $this->response($ret,200);
            else:
                $this->response($ret);
            endif;
        }
        
        function register_post()
        {
            if(!$this->post('email'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('password'))
            {
                $this->response(NULL, 400);
            }
            $email = $this->post('email');
            $password = $this->post('password');
            $data = array(
                'creationtime' => date('Y-m-d'),
                'firstname' => '',
                'lastname' => '',
                'username' => $email,
                'email' => $email,
                'password' => md5 ($password),
                'status' => 1
            );
            $ret = $this->User_model->insert($data, 23);
            if($ret == null):
                $retBack = array('status'=>'0','msg'=>'There is problem adding user.');
            else:
                $retBack = $ret;
            endif;
            $this->response($ret,400);
        }
        
        function update_post(){
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
            
            $firstname = $this->post('firstname');
            $lastname = $this->post('lastname');
            $email = $this->post('email');            
            $password = $this->post('password');
            if($password == NULL || $password == ''):
                $data = array(
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email
                );
            else:
                $data = array(
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => md5($password)
                );
            endif;
            $ret = $this->User_model->update($data, $userID, 23);
            if($ret == null):
                $retBack = array('status'=>'0','msg'=>'There is problem updating user data.');
            else:
                $retBack = $ret;
            endif;
            $this->response($ret,200);
        }
        
        function getallalerts_post(){
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
            
            $alerts = $this->Alerts_model->selectAlerts($userID);
            $this->response($alerts,200);
        }
        
        function savealerts_post(){
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
            
            $formElementStatus = $this->input->post('alertID');
            $formElementSel = $this->input->post('alertType');
            $formElementStatusChk = $this->input->post('alertStatus');
            //print_r($formElementStatus);
            //print_r($formElementSel);
            $this->Alerts_model->delete($userID);
            try {
                for($count = 0;$count < count($formElementStatus);$count++):
                    $data1 = array(
                        'creationtime' => date('Y-m-d'),
                        'updatetime' => date('Y-m-d'),
                        'sendalert' => $formElementStatusChk[$count],
                        'user_UserID' => $userID,
                        'alertType' => $formElementSel[$count]
                    );
                    $AlertpreferancesID = $this->Alerts_model->insertPreference($data1);
                    $data = array(
                        'creationtime' => date('Y-m-d'),
                        'alerts_alertsID' => $formElementStatus[$count],
                        'alertpreferances_alertpreferancesID' => $AlertpreferancesID,
                        'alertpreferances_user_UserID' => $userID
                    );
                    $this->Alerts_model->insertAlert($data);
                endfor;
                $ret = array('status'=>'1','msg'=>'Alert settings updated successfully.');
            } catch (Exception $e) {
                $ret = array('status'=>'0','msg'=>'There is problem updating alert settings permission.');
            }
            echo json_encode($ret);
        }
    }