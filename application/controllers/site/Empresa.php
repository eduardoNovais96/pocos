<?php if(!defined('BASEPATH')) exit ('Sem direito de acesso direto ao script.');

class Empresa extends CI_Controller{
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('empresa_model');
        
    }
    
    public function index(){
        
        $this->load->view('../../template/index.php');
    }
    
    public function detalhes($empresaId) {
        
        $dados = array(
            'empresa' => $this->empresa_model->BuscarPorId($empresaId)            
        );
        
        $dados['nomeEmpresa'] = $this->formataNomeEmpresa($dados['empresa']->nome);
        
        $this->load->view('../../template/single.php', $dados);
    }
    
    private function formataNomeEmpresa($nome) {
        
        $nome = str_replace(' LTDA', '', strtoupper($nome));
        $nome = str_replace('LTDA', '', strtoupper($nome));
        $nome = str_replace(' LTDA.', '', strtoupper($nome));
        $nome = str_replace('LTDA.', '', strtoupper($nome));
        $nome = str_replace(' - MEI', '', strtoupper($nome));
        $nome = str_replace(' - ME', '', strtoupper($nome));
        $nome = str_replace('- MEI', '', strtoupper($nome));
        $nome = str_replace('- ME', '', strtoupper($nome));
        $nome = str_replace('-MEI', '', strtoupper($nome));
        $nome = str_replace('-ME', '', strtoupper($nome));
         $nome = str_replace(' - EPP', '', strtoupper($nome));
         $nome = str_replace('- EPP', '', strtoupper($nome));
         $nome = str_replace('-EPP', '', strtoupper($nome));
        $nome = preg_replace('/[0-9]+/', '', $nome); 
        $nome = str_replace(' ', ',', $nome);
        
        return $nome;
    }
    
    public function palavrasMaisUtilizadas() {
        
        echo '<pre>';
        print_r($this->input->post());
    }
}