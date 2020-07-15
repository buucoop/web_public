<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_cooperative extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        if($this->Login_session->check_login()->login_type != 'officer') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
    }

    public function index()
    {
        $data['company_name'] = $this->Company->gets_company();
        $data['department_name'] = $this->Student->gets_department();
        //    get all
        $data['reports'] = $this->get_stat_all();
        $data['current_department'] = array();

        $this->template->view('Officer/Report_cooperative_view', $data);
    }

    public function search()
    {
        $company_id = $this->input->post('company_id');
        $department_id = $this->input->post('department_id');
        if($company_id == "0") {
            $data['reports'] = $this->get_stat_all();
        } else {
            $data['reports'] = $this->get_stat($company_id, $department_id);
        }
        $data['current_company'] = $company_id;
        $data['current_department'] = $department_id;
        
        $data['company_name'] = $this->Company->gets_company();        
        $data['department_name'] = $this->Student->gets_department();

        $this->template->view('Officer/Report_cooperative_view', $data);
    }

    private function get_stat_all()
    {
        
        //cache
        $cache = array();
        $cache['company'] = $this->Company->gets_company();
        //cache
        $data = array();
        $data['department'] = array();

        foreach($this->Student->gets_department() as $department) {
            $tmp = array();
            $tmp['department_name'] = $department['department_name'];
            $tmp['company'] = array();
            //get company
            foreach($cache['company'] as $company) {
                $tmpc = array();
                $tmpc['company_name'] = $company['company_name_th'];
                $tmpc['total_student'] = count($this->Coop_Student->gets_coop_student_by_department_company($department['department_id'], $company['company_id']));
                // for($i=0;$i<15;$i++) {
                array_push($tmp['company'], $tmpc);
                // }
            }
            array_push($data['department'], $tmp);
        }

        
        return $data['department'];
    }


    private function get_stat($company_id, $department_id)
    {
        //cache
        $cache = array();
        $cache['company'] = $this->Company->get_company($company_id);
        //cache
        $data = array();
        $data['department'] = array();

        foreach($this->Student->gets_department() as $department) {
            if($department_id) {
                if(!in_array($department['department_id'], $department_id)) {
                    continue;
                }  
            }
            
            $tmp = array();
            $tmp['department_name'] = $department['department_name'];
            $tmp['company'] = array();
            //get company
            foreach($cache['company'] as $company) {
                $tmpc = array();
                $tmpc['company_name'] = $company['company_name_th'];
                $tmpc['total_student'] = count($this->Coop_Student->gets_coop_student_by_department_company($department['department_id'], $company['company_id']));
                array_push($tmp['company'], $tmpc);
            }
            array_push($data['department'], $tmp);
        }


        return $data['department'];
    }

    public function to_excel()
    {
        //cache
        $cache = array();
        $cache['company'] = $this->Company->gets_company();
        $cache['department'] = $this->Student->gets_department();

        $term = $this->Term->get_current_term()[0];

        // to excel
        require(FCPATH.'/application/libraries/XLSXWriter/xlsxwriter.class.php');
        require(FCPATH.'/application/libraries/XLSXWriter/xlsxwriterplus.class.php');
        

        $filename = "report-cooperative-".time().".xlsx";
        header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $writer = new XLSWriterPlus();
        //get student
        $header = array(
            '' => 'string',
            '' => 'string',
            '' => 'string',
            '' => 'string',
        );
        
        $rows[] = array(
            'รายงานการไปสหกิจศึกษาในภาคเรียนที่ '.$term['term_name'], '', '', ''
        );

        $header_row = array();

        $header_row[] = 'รายชื่อบริษัท';
        foreach($cache['department'] as $department) {
            $header_row[] = $department['department_name'];
        }

        $rows[] = $header_row;

        //cache
        $data = array();

        foreach($this->Company->gets_company() as $company) {
            $tmp = array();
            $tmp[] = $company['company_name_th'];
            // $tmp['department'] = array();
            //get company
            foreach($cache['department'] as $department) {
                // $tmpc['department_name'] = $department['department_name'];
                $tmp[] = count($this->Coop_Student->gets_coop_student_by_department_company($department['department_id'], $company['company_id']));
            }

            $rows[] = $tmp;

        }


        
        $format = array(
            'font'=>'THSarabunPSK',
            'font-size'=>16, 
            'wrap_text'=>true
        );

        $writer = new XLSXWriter();
        $writer->setAuthor('from Cooperative System, BUU');
        foreach($rows as $row) {
            $writer->writeSheetRow('Sheet1', $row, $format);            
        }
        $writer->markMergedCell('Sheet1', $start_row=0, $start_col=0, $end_row=0, $end_col=(count($header_row)-1));
            
        $writer->writeToStdOut();

    }

   
}