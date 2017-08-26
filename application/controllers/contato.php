<?php if(!defined('BASEPATH')) exit('Sem direito de acesso direto ao script.');

class Contato extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $dados = array();
        if(@$this->session->userdata['msg']!=NULL){
            $dados['msg'] = $this->session->userdata['msg'];
            echo $dados['msg'];
            $this->session->set_userdata('msg', NULL);
        } 
        $this->load->view('../../template/contato.php', $dados);
    }
}