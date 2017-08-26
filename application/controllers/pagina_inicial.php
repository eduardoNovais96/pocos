<?php
if(!defined("BASEPATH"))exit("Sem direito de acesso direto ao script");
class Pagina_inicial extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $data['pagina'] = 'pagina_inicial';
        $this->load->view('template',$data);
    }
}