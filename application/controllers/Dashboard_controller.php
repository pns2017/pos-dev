<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {

   public function index()
   {						

   	// echo "<pre>";
    //   print_r($this->session->all_userdata());
    //   echo "</pre>";

   							/** Note: ayaw ilisi ang sequence sa page load sa page **/
      $data['title'] = 'Dashboard';	
      $this->load->view('template/dashboard_header',$data);
      $this->load->view('template/dashboard_body');		// mao lang ni ang replaceable
      $this->load->view('template/dashboard_navigation');
      $this->load->view('template/dashboard_footer');

   }


}
