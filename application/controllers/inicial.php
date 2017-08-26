<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicial extends CI_Controller {
    
	public function index(){
            
            if(@$this->nativesession->get('id_usuario'))
                    redirect(base_url ('pagina_inicial'));
            else{
                    //$data['pagina'] = 'login/logar';
                    //$this->load->view('template',$data);
                redirect('site/index');
            }
	}
        public function erro_404(){
            $data['pagina'] = 'erro_404';
            $this->load->view('template',$data);
        }
        public function sair(){
            $this->session->sess_destroy();
            $this->nativesession->delete_all();
            redirect('inicial');
        }
}
