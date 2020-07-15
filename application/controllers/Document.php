<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // if(!$this->Login_session->check_login()) {
        //     $this->session->sess_destroy();
        //     redirect('member/login');
		// }
		
		// //check priv
        // if($this->Login_session->check_login()->login_type != 'coop_student') {
        //     redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
        //     die();
        // }
    }

    public function index() 
    {
        $html = $this->load->view('Document/IN-S001_view', array(), true);

        $this->load->library('mpdf60/mpdf');
        $mpdf = new mPdf('th', 'A4', '0', 'THSaraban');
        $mpdf->SetTitle('IN-S001.pdf');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }


    public function in_s002() 
    {
        $html = $this->load->view('Document/IN-S002_view', array(), true);

        $this->load->library('mpdf60/mpdf');
        $mpdf = new mPdf('th', 'A4', '0', 'THSaraban');
        $mpdf->SetTitle('IN-S002.pdf');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }

    public function IN_S003()
    {
        $html = $this->load->view('Document/IN-S003_view', array(), true);

        $this->load->library('mpdf60/mpdf');
        $mpdf = new mPdf('th', 'A4', '0', 'THSaraban');
        $mpdf->SetTitle('IN-S003.pdf');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }

    public function IN_S003_word()
    {
        $strWordFileName = "Portfolio.doc"; 
        header("Content-Type: application/vnd.ms-word; name=\"$strWordFileName\""); 
        header("Content-Disposition: inline; filename=\"$strWordFileName\""); 
        header("Pragma: no-cache"); 

        $html = $this->load->view('Document/IN-S003_view', array());

    }

    public function IN_S004()
    {
        $html = $this->load->view('Document/IN-S004_view', array(), true);

        $this->load->library('mpdf60/mpdf');
        $mpdf = new mPdf('th', 'A4', '0', 'THSaraban');
        $mpdf->SetTitle('IN-S004.pdf');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }

    public function IN_S005()
    {
        $html = $this->load->view('Document/IN-S005_view', array(), true);

        $this->load->library('mpdf60/mpdf');
        $mpdf = new mPdf('th', 'A4', '0', 'THSaraban');
        $mpdf->SetTitle('IN-S005.pdf');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }

    public function IN_S006()
    {
        $html = $this->load->view('Document/IN-S006_view', array(), true);

        $this->load->library('mpdf60/mpdf');
        $mpdf = new mPdf('th', 'A4', '0', 'THSaraban');
        $mpdf->SetTitle('IN-S006.pdf');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }
    public function IN_S007()
    {
        $html = $this->load->view('Document/IN-S007_view', array(), true);

        $this->load->library('mpdf60/mpdf');
        $mpdf = new mPdf('th', 'A4', '0', 'THSaraban');
        $mpdf->SetTitle('IN-S007.pdf');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }
    


}