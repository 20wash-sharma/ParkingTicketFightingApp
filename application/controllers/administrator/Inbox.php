<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render('administrator/inbox_view');
    }
}