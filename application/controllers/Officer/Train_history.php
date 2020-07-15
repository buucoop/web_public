<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Train_history extends CI_Controller {

    public function index()
    {
         $this->template->view('Officer/Train_history_view');
    }
  }
