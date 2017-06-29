<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/User_model');
        $this->load->model('administrator/Role_model');
        $this->load->model('administrator/Alerts_model');
        $this->load->model('administrator/Vehicles_model');
        $this->load->model('administrator/Paymentmethods_model');
    }

    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            if($this->session->permission != null):
                $this->permission = $this->session->permission;
            endif;
            
            if(!checkPermission('User','View', $this->permission)):
                redirect('administrator', 'refresh');
            endif;
            
            $roleLevel = $this->User_model->getLevelByUserID($session_data['id']);
            //var_dump($session_data);
            $userAll = $this->User_model->all($roleLevel);
            $this->data['result'] = $userAll;
            $this->data['scriptsfiles'] = array(
                                'plugins/datatables/jquery.dataTables.min.js',
                                'plugins/datatables/dataTables.colVis.min.js',
                                'plugins/datatables/dataTables.colReorder.min.js',
                                'usergrid.js',
                                'plugins/bootstrap/bootstrap-select.js'
                        );
            $session_data = $this->session->userdata('logged_in');
            $roleLevel = $this->User_model->getLevelByUserID($session_data['id']);
        
            $this->data['role'] = $this->Role_model->all($roleLevel);
            $this->render('administrator/user_view');
        }
        else
        {
          //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    public function alluserjson(){
        $session_data = $this->session->userdata('logged_in');
        $roleLevel = $this->User_model->getLevelByUserID($session_data['id']);
        $userAll = $this->User_model->all($roleLevel);
        $userArray=array();
        $index = 0;
        $count = 1;
        foreach($userAll as $item):
            $deleteCheckBox = '<input type="checkbox" class="checkboxDel" name="deleteRole" value="' . $item->UserID . '">';
            $statushtml = "";
            $userData = $this->session->userdataall;
            $roleID = $userData[0]->Role_roleID;
            $permission = $this->Permission_model->getPermissionsByRole($roleID);
            $viewProfile = checkPermission('Profile','View', $permission);
            $editUser = checkPermission('User','Edit', $permission);
            $deleteUser = checkPermission('User','Delete', $permission);
            
            if($editUser):
                if($item->status == 1):
                    $statushtml = '<a href="#" data-userID="' . $item->UserID . '" data-userStatus="1" class="userStatus label label-success">Active</a>';
                else:
                    $statushtml = '<a href="#" data-userID="' . $item->UserID . '" data-userStatus="0" class="userStatus label label-warning">Not Active</a>';
                endif;
            else:
                if($item->status == 1):
                    $statushtml = '<span class="label label-success">Active</span>';
                else:
                    $statushtml = '<span class="label label-warning">Not Active</span>';
                endif;
            endif;
            
            $actionhtml = "";
            if($viewProfile)
                $actionhtml .= '<a href="' . base_url() . 'index.php/administrator/user/profile/' . $item->username . '" class="btn btn-default btn-rounded btn-condensed btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Profile"><span class="fa fa-user"></span></a>';
            if($editUser)
                $actionhtml .= '<button class="edit btn btn-default btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#modal_User" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Profile" data-userID="' . $item->UserID . '"><span class="fa fa-pencil"></span></button>';
            if($deleteUser)
                $actionhtml .= '<button class="delete btn btn-danger btn-rounded btn-condensed btn-sm" data-userID="' . $item->UserID . '"><span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete User" data-userID="' . $item->UserID . '"></span></button>';
            $position = 0;
            if($deleteUser):
                $userArray[$index][$position] = $deleteCheckBox;
                $position++;
            endif;
            $userArray[$index][$position] = $count;
            $position++;
            $userArray[$index][$position] = $item->firstname . ' ' . $item->lastname;
            $position++;
            $userArray[$index][$position] = $item->email;
            $position++;
            $userArray[$index][$position] = $item->noOfVehicles;
            $position++;
            $userArray[$index][$position] = $item->noOfPaymentsAcc;
            $position++;
            $userArray[$index][$position] = $item->name;
            $position++;
            $userArray[$index][$position] = $statushtml;
            $position++;
            $userArray[$index][$position] = date('Y-m-d',strtotime($item->creationtime));
            $position++;
            if($actionhtml != ''):
                $userArray[$index][$position] = $actionhtml;
            endif;
            
            //$userArray[$index] = array($deleteCheckBox,$count, $item->firstname . ' ' . $item->lastname, $item->email, $item->noOfVehicles, $item->noOfPaymentsAcc, $item->name, $statushtml, date('Y-m-d',strtotime($item->creationtime)),$actionhtml);
            $index++;
            $count++;
        endforeach;
        
        echo json_encode(array('status'=>'1','data'=>$userArray));
    }
    
    public function addedit(){
        $userID = $this->input->post('userID');
        $roleID = $this->input->post('roleID');
        $password = $this->input->post('password');
        $activationCode = '';
        if($userID == 0){
            $activationCode = md5(uniqid(rand()));
        }
        if($password != null && $password != ''):
            $data = array(
                'creationtime' => date('Y-m-d'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => md5 ($password),
                'status' => $this->input->post('status'),
                'activationCode' => $activationCode
            );
        else:
            $data = array(
                'creationtime' => date('Y-m-d'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status'),
                'activationCode' => $activationCode
            );
        endif;
        
        $ret = NULL;
        if($userID > 0):
            $ret = $this->User_model->update($data, $userID, $roleID);
        else:
            $ret = $this->User_model->insert($data, $roleID);
        endif;
        
        if($ret == null):
            $ret = array('status'=>'0','msg'=>'There is problem adding user.');
        else:
            if($userID == 0):
                /*$email_config = Array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => '465',
                    'smtp_user' => 'samojbhattarai@gmail.com',
                    'smtp_pass' => '484857',
                    'mailtype'  => 'html',
                    'starttls'  => true,
                    'newline'   => "\r\n"
                );*/

                //$this->load->library('email', $email_config);
                $this->load->library('email');
                $this->email->from('sujen@technoessence.com', 'Sujen Maharjan');
                $this->email->to($this->input->post('email')); 
                //$this->email->cc('another@another-example.com'); 
                //$this->email->bcc('them@their-example.com'); 

                $this->email->subject('Account Activation');
                $message = 'Dear ' . $this->input->post('firstname') . ' ' . $this->input->post('lastname') . '<br/>';
                $message .= 'Your username is : ' . $this->input->post('username') . '<br/>';
                $message .= 'Please click the link below to activate your account<br/><a href="' . base_url() . 'index.php/login/activateaccount/' . $activationCode . '">Activate Account</a>';
                $this->email->message($message);	

                $this->email->send();

                //echo $this->email->print_debugger();
            endif;
        endif;
        echo json_encode($ret);
    }

    public function single(){
        $userId = $this->input->post('userID');
        $ret = $this->User_model->single($userId);
        echo json_encode($ret);
    }
    
    public function delete(){
        $userId = $this->input->post('userID');
        $ret = $this->User_model->delete($userId);
        echo json_encode($ret);
    }
    
    public function deleteselected(){
        $userIds = $this->input->post('userIDs');
        $ret = $this->User_model->delete($userIds);
        echo json_encode($ret);
    }
    
    public function changestatus(){
        $userID = $this->input->post('userID');
        $userStatus = $this->input->post('userStatus');
        $ret = $this->User_model->changeStatus($userID,$userStatus);
        echo json_encode($ret);
    }

    public function profile(){
        $userName = $this->uri->segment(4);
        $userDtl = $this->User_model->singleByUserName($userName);
        $this->data['userProfile'] = $userDtl;
        $this->data['alerts'] = $this->Alerts_model->selectAlerts($userDtl[0]->UserID);
        
        
        $session_data = $this->session->userdata('logged_in');
        $roleLevel = $this->User_model->getLevelByUserID($session_data['id']);
        
        if($userName != $this->session->userdataall[0]->username):
            if($this->session->permission != null):
                $this->permission = $this->session->permission;
            endif;

            if(!checkPermission('Profile','View', $this->permission)):
                redirect('administrator', 'refresh');
            endif;
            
        endif;
        
        $this->load->model('administrator/State_model');
        $this->load->model('administrator/Vehiclemake_model');
        $this->load->model('administrator/Platetype_model');
        
        $userDetail = $this->User_model->singleByUserName($userName);
        if($roleLevel > $userDetail[0]->level):
            redirect('administrator', 'refresh');
        endif;
        
        $this->data['userProfile'] = $userDetail;
        $this->data['userVehicles'] = $this->Vehicles_model->all($userDetail[0]->UserID);
        $this->data['userPayment'] = $this->Paymentmethods_model->all($userDetail[0]->UserID);
        $this->data['state'] = $this->State_model->all();
        $this->data['makes'] = $this->Vehiclemake_model->all();
        $this->data['platetype'] = $this->Platetype_model->all();
        $this->data['scriptsfiles'] = array(
            'plugins/bootstrap/bootstrap-select.js',
            'plugins/datatables/jquery.dataTables.min.js',
            'plugins/datatables/dataTables.colReorder.min.js',
            'plugins/datatables/dataTables.colVis.min.js',
            'vehiclegrid.js',
            'plugins/bootstrap/bootstrap-datepicker.js',
            'profileedit.js',
            'plugins/cropper/cropper.min.js',
            'demo_edit_profile.js',
            'plugins/jquery/jquery-migrate.min.js',
            'plugins/bootstrap/bootstrap-file-input.js',
            'plugins/form/jquery.form.js',
        );
        $this->render('administrator/profile_view');
    }
    
    public function editprofile(){
        $userName = $this->uri->segment(4);
        $userDtl = $this->User_model->singleByUserName($userName);
        $this->data['userProfile'] = $userDtl;
        $this->data['alerts'] = $this->Alerts_model->selectAlerts($userDtl[0]->UserID);
        $this->data['scriptsfiles'] = array(
                                'plugins/cropper/cropper.min.js',
                                'demo_edit_profile.js',
                                'plugins/jquery/jquery-migrate.min.js',
                                'plugins/bootstrap/bootstrap-file-input.js',
                                'plugins/form/jquery.form.js',
                                'profileedit.js',
                                'plugins/bootstrap/bootstrap-select.js'
                        );
        
        $this->render('administrator/profileedit_view');
    }
    
    public function changepassword(){
        $userID = $this->input->post('userID');
        $oldPassword = $this->input->post('oldpassword');
        $newPassword = $this->input->post('newpassword');
        
        $ret = $this->User_model->changePassword($userID, $oldPassword, $newPassword);
        echo json_encode($ret);
    }
    
    public function updateprofile(){
        $userID = $this->input->post('userID');
        $data = array(
            'firstname' => $this->input->post('firstName'),
            'lastname' => $this->input->post('lastName'),
            'email' => $this->input->post('email')
        );
        $ret = $this->User_model->updateProfile($userID, $data);
        echo json_encode($ret);
    }
    
    public function updatecontact(){
        $userID = $this->input->post('userID');
        $data = array(
            'phone' => $this->input->post('phone'),
            'twitter' => $this->input->post('twitter'),
            'facebook' => $this->input->post('facebook')
        );
        $ret = $this->User_model->updateContact($userID, $data);
        echo json_encode($ret);
    }
    
    public function updateprofileimage(){
        $userID = $this->input->post('userID');
        $userImg = $this->input->post('profileImg');
        
        $strPos = strpos($userImg,'uploads/') + strlen('uploads/');
        $userImg = substr($userImg, $strPos);
            
        $ret = $this->User_model->updateimage($userID, $userImg);
        echo $userID + '-' + $userImg;
        echo json_encode($ret);
    }


    public function uploadProfileImage(){
        $error       = false;
        $ds          = DIRECTORY_SEPARATOR; 
        $storeFolder = 'uploads';

        if (!empty($_FILES) && $_FILES['file']['tmp_name']) {    

            $tempFile = $_FILES['file']['tmp_name'];
            $fileName = time().'_'.$_FILES['file']['name'];

            // check image type
            $allowedTypes = array(IMAGETYPE_JPEG);// list of allowed image types
            $detectedType = exif_imagetype($tempFile);
            $error = !in_array($detectedType, $allowedTypes);
            // end of check

            if(!$error){

                $targetPath = dirname( '.' ) . $ds. $storeFolder . $ds;     
                $targetFile =  $targetPath. $fileName;

                if(move_uploaded_file($tempFile,$targetFile)){
                    echo '<div class="cropping-image-wrap"><img src="' . base_url() . 'uploads/'.$fileName.'" class="img-thumbnail" id="crop_image"/></div>';
                }

            }else{
                echo '<div class="alert alert-danger">This format of image is not supported</div>';
            }
        }else{
            echo '<div class="alert alert-danger">How did you do that?O_o</div>';
        }
    }
    
    public function cropimage(){
        $imgr = new imageResizing();
        $ds          = DIRECTORY_SEPARATOR;
        if($_POST['cp_img_path']){    
            //$image = "/your/path/to/app/".$_POST['cp_img_path'];
            $image = $_POST['cp_img_path'];
            $strPos = strpos($image,'uploads');
            $image = dirname( '.' ) . $ds. substr($image, $strPos);
            $imgr->load($image);

            $imgX = intval($_POST['ic_x']);
            $imgY = intval($_POST['ic_y']);
            $imgW = intval($_POST['ic_w']);
            $imgH = intval($_POST['ic_h']);

            $imgr->resize($imgW,$imgH,$imgX,$imgY);    

            $imgr->save($image);

            echo '<img src="'.$_POST['cp_img_path'].'?t='.time().'" class="img-thumbnail"/>';
        }
    }
}