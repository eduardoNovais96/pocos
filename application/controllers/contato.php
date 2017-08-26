<?php if(!defined('BASEPATH')) exit('Sem direito de acesso direto ao script.');

class Contato extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('../../template/contato.php');
    }
}