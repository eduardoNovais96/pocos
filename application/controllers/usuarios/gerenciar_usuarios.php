<?php if(!defined("BASEPATH")) exit("Sem direito de acesso direto ao script");

class Gerenciar_usuarios extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model','um');
    }
    public function index(){
            if(@$this->session->userdata['msg'] != NUll){   
                $data['mensagem'] = $this->session->userdata['msg'];
                $this->session->set_userdata('msg', NULL);
            }
            $sess['usuario'] = NULL;
            $sess['nome'] = NULL;
            $sess['qtd'] = 10;
            $maximo = 10;
            $this->session->set_userdata($sess);

            $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");

            if(@$this->input->post('qtd'))
                $maximo = $this->input->post('qtd');
            else
                $maximo = 10;

            $config['base_url'] = '/pocos/usuarios/gerenciar_usuarios/filtro';
            $config['total_rows'] = $this->um->count_all();
            $config['per_page'] = $maximo;
            $config["uri_segment"] = 4;
            $config['first_link'] = 'Primeiro';
            $config['last_link'] = 'Último';
            $config['next_link'] = 'Próximo';
            $config['prev_link'] = 'Anterior';

            $config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
            $config['full_tag_close'] = '</ul></div><!--pagination-->';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Próximo &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Anterior';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);

            $data['paginacao'] = $this->pagination->create_links();
            $data['usuarios'] = $this->um->get_all($maximo, $inicio);
            $data['total'] = $config['total_rows'];
            $data['nivel'] = $this->um->get_nivel();

            $data['pagina']   = 'usuarios/gerenciar_usuarios';
            $this->load->view('template',$data);
//        }
    }
    public function filtro(){
        if(@$this->input->post('nome')){
            $sess['nome'] = $this->input->post('nome');
            $nome = $this->input->post('nome');
        }
        else if($this->session->userdata['nome']){
            $sess['nome'] = $this->session->userdata['nome'];
            $nome = $this->session->userdata['nome'];
        }
        else{
            $sess['nome'] = NULL;
            $nome = NULL;
        }

        if(@$this->input->post('usuario')){
            $sess['usuario'] = $this->input->post('usuario');
            $usuario = $this->input->post('usuario');
        }
        else if($this->session->userdata['usuario']){
            $sess['usuario'] = $this->session->userdata['usuario'];
            $usuario = $this->session->userdata['usuario'];
        }
        else{
            $sess['usuario'] = NULL;
            $usuario = NULL;
        }        

        if(@$this->input->post('qtd')){
            $sess['qtd'] = $this->input->post('qtd');
            $maximo = $this->input->post('qtd');
        }
        else if($this->session->userdata['qtd']){
            $sess['qtd'] = $this->session->userdata['qtd'];
            $maximo = $this->session->userdata['qtd'];
        }
        else{
            $sess['qtd'] = 10;
            $maximo = 10;
        }

        $this->session->set_userdata($sess);

        $config['base_url'] = '/pocos/usuarios/gerenciar_usuarios/filtro';
        $config['total_rows'] = $this->um->count_all($nome, $usuario);
        if($maximo == 'todos'){
            $maximo = $this->um->count_all();
            $inicio = 0;
        }
        else
            $inicio = (!$this->uri->segment("4")) ? 0 : $this->uri->segment("4");
        $config['per_page'] = $maximo;
        $config["uri_segment"] = 4;
        $config['first_link'] = 'Primeiro';
        $config['last_link'] = 'Último';
        $config['next_link'] = 'Próximo';
        $config['prev_link'] = 'Anterior';

        $config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; Primeiro';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Último &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Próximo &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Anterior';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['paginacao'] = $this->pagination->create_links();
        $data['usuarios'] = $this->um->get_all($maximo, $inicio, $nome, $usuario);
        $data['total'] = $config['total_rows'];
        $data['nivel'] = $this->um->get_nivel();

        $data['pagina']   = 'usuarios/gerenciar_usuarios';
        $this->load->view('template',$data);
    }
    public function adcionar_usuario(){
        $this->form_validation->set_rules('nome','Nome','required');
        $this->form_validation->set_rules('email','E-Mail','required');
        $this->form_validation->set_rules('usuario','Usuário','required');
        $this->form_validation->set_rules('senha','Senha','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        
        if($this->form_validation->run()==FALSE){
            $this->index();
        }
        else{
            $data['nome']            =   $this->input->post('nome');
            $data['email']           =   $this->input->post('email');
            $data['usuario']         =   $this->input->post('usuario');
            $data['senha']           =   md5($this->input->post('senha'));
            
            $existente = $this->um->usuario_existente($data['usuario']);
            
            if(@$existente[0]->id_usuario){
                $data['erro'] = '<div class="alert alert-block alert-danger fade in">Usuário já exsitente. </div>';
                $this->index($data['erro']);
            }
            else{
                $dados['id_usuario'] = $this->um->novo_usuario($data);

                foreach ($this->input->post('nivel') as $n){
                    $dados['id_nivel'] = $n;
                    $this->um->novo_usuario_nivel($dados);
                }

                $data['mensagem'] = '<div class="alert alert-success">Usuário cadastrado com sucesso. </div>';
                $this->index($data['mensagem']);
            }
        }
        
    }
    
    public function editar($mensagem = NULL){        
        if($mensagem!=NULL)
            $dados['mensagem'] = $mensagem;
        $dados['usuario'] = $this->um->usuario_existente(NULL, $this->session->userdata['id_usuario']);
        $dados['pagina'] = 'usuarios/editar';
        
        $this->load->view('template',$dados);
    }
    
    public function salvar(){
        $id = $this->input->post('id');
        
        $this->form_validation->set_rules('nome','Nome','required');
        $this->form_validation->set_rules('email','E-Mail','required');
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_rules('usuario','Usuário','required');
        
        if(@$this->input->post('senha_antiga') || @$this->input->post('senha_antiga') || @$this->input->post('senha_antiga')){
            $this->form_validation->set_rules('senha_antiga','Senha Antiga','required');
            $this->form_validation->set_rules('senha','Nova Senha','required');
            $this->form_validation->set_rules('senha_repeticao','Repetir Nova Senha','required');
        }
        if(@$this->input->post('gerenciar'))
            $this->form_validation->set_rules('nivel','Nivel','required');
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        
        if($this->form_validation->run()==FALSE)
            if(@$this->input->post('gerenciar'))
                $this->index();
            else
                $this->editar();
        else{
            if(@$this->input->post('senha_antiga') || @$this->input->post('senha_antiga') || @$this->input->post('senha_antiga')){
                $senha_antiga = md5($this->input->post('senha_antiga'));

                $usuario = $this->um->usuario_existente(NULL, $id, $senha_antiga);

                if(@$usuario[0]->id_usuario){
                    $dt = explode('/', $this->input->post('nasc'));

                    $data['nome']            =   $this->input->post('nome');
                    $data['email']           =   $this->input->post('email');
                    $data['status']           =   $this->input->post('status');
                    $data['usuario']         =   $this->input->post('usuario');
                    $data['senha']           =   md5($this->input->post('senha'));

                    $nova_senha = md5($this->input->post('senha_repeticao'));

                    if($data['senha'] == $nova_senha){
                        $existente = $this->um->get_usuario_existente($data['usuario'], $id);

                        if(@$existente[0]->id_usuario){
                            $mensagem = '<div class="alert alert-block alert-danger fade in">Novo nome de usuário já existente.</div>'; ;
                            $this->session->set_userdata('msg', $mensagem);
                            redirect(base_url('usuarios/gerenciar_usuarios/editar'));
                            $this->session->set_userdata('msg', $mensagem);
                            redirect(base_url('usuarios/gerenciar_usuarios/editar'));
                        }
                        else{
                            $this->um->editar_usuario($data, $id);
                            $mensagem = '<div class="alert alert-block alert-success fade in">Conta editada com sucesso.</div>'; ;
                            $this->session->set_userdata('msg', $mensagem);
                            redirect(base_url('usuarios/gerenciar_usuarios/editar'));
                        }
                    }
                    else{
                        $mensagem = '<div class="alert alert-block alert-danger fade in">Os campos Nova Senha e Repetir '
                                . 'Nova Senha estão diferentes.</div>'; ;
                        $this->session->set_userdata('msg', $mensagem);
                            redirect(base_url('usuarios/gerenciar_usuarios/editar'));
                    }
                }
                else{
                    $mensagem = '<div class="alert alert-block alert-danger fade in">O campo Senha Antiga não confere.</div>'; ;
                    $this->session->set_userdata('msg', $mensagem);
                    redirect(base_url('usuarios/gerenciar_usuarios/editar'));
                }
            }
            else{
                //$dt = explode('/', $this->input->post('nasc'));

                $data['nome']            =   $this->input->post('nome');
                $data['email']            =   $this->input->post('email');
                $data['status']           =   $this->input->post('status');
                $data['usuario']         =   $this->input->post('usuario');

                $existente = $this->um->get_usuario_existente($data['usuario'], $id);

                if(@$existente[0]->id_usuario){
                    $mensagem = '<div class="alert alert-block alert-danger fade in">Novo nome de usuário já existente.</div>'; ;
                    $this->session->set_userdata('msg', $mensagem);
                    redirect(base_url('usuarios/gerenciar_usuarios/editar'));
                }
                else{
                    if(@$this->input->post('senha'))
                        $data['senha'] = md5($this->input->post('senha'));
                    $this->um->editar_usuario($data, $id);
                    $mensagem = '<div class="alert alert-block alert-success fade in">Conta editada com sucesso.</div>'; ;
                    if(@$this->input->post('gerenciar')){
                        $this->um->excluir_nivel($id);
                        $un['id_usuario'] = $id;
                        $nivel = $this->input->post('nivel');
                        foreach($nivel as $n){
                            $un['id_nivel'] = $n;
                            $this->um->novo_usuario_nivel($un);
                        }
                        $this->session->set_userdata('msg', $mensagem);
                        redirect(base_url('usuarios/gerenciar_usuarios'));
                    }
                    else
                        $this->session->set_userdata('msg', $mensagem);
                        redirect(base_url('usuarios/gerenciar_usuarios/editar'));
                }
            }
        }
    }
    
    public function recuperar($link = NULL){
        if($link != NULL){
            $linkCons = $this->um->get_link($link, 1);
            
            if(@$linkCons[0]->link){
                $dados['link'] = $link;
                $dados['pagina'] = 'login/recuperar';
                $this->load->view('template', $dados);
            }
            else{
                $data['mensagem'] = '<div class="alert alert-block alert-danger fade in">Link inválido (cada link poderá '
                        . 'ser usado apenas uma vez).</div>';
                $data['pagina'] = 'login/logar';

                $this->load->view('template',$data);
            }
        }
        else
            redirect(base_url('inicial'));
    }
    public function salvar_nova_senha(){
        $this->form_validation->set_rules('senha','Nova senha','required');
        $this->form_validation->set_rules('repetir_senha','Repetir nova senha','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">','</div>');
        
        if($this->form_validation->run()==FALSE){
            $data['pagina'] = 'pagina_inicial';
            $this->load->view('template',$data);
        }
        else{
            $senha = $this->input->post('senha');
            $repetirSenha = $this->input->post('repetir_senha');
            
            if($senha != $repetirSenha){
                $data['mensagem'] = '<div class="alert alert-block alert-danger fade in">As senhas digitadas são diferentes.</div>';
                $data['pagina'] = 'login/logar';

                $this->load->view('template',$data);
            }
            else{
                $link = $this->input->post('link');
                if(@$link==NULL){
                    $data['mensagem'] = '<div class="alert alert-block alert-danger fade in">Link inválido.</div>';
                    $data['pagina'] = 'login/logar';

                    $this->load->view('template',$data);
                }
                else{
                    $linkPsq = $this->um->get_link($link, 1);
                    if(@$linkPsq[0]->id_usuario){
                        $dados['senha'] = md5($senha);
                        
                        $this->um->editar_usuario($dados, $linkPsq[0]->id_usuario);
                        $at['ativo'] = 0;
                        $this->um->editar_link($at, $link);
                        
                        $data['mensagem'] = '<div class="alert alert-success">Senha alterada com sucesso.</div>';
                        $data['pagina'] = 'login/logar';

                        $this->load->view('template',$data);
                    }
                    else{
                        $data['mensagem'] = '<div class="alert alert-block alert-danger fade in">Link inválido.</div>';
                        $data['pagina'] = 'login/logar';

                        $this->load->view('template',$data);
                    }
                }
            }
        }
    }
    
    public function gerar_senha(){
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $senha['senha'] = NULL;

        $max = strlen($chars) - 1;
        
        for($i=0;$i < 8; $i++){
            $senha['senha'] .= $chars{mt_rand(0,$max)};
        }
        
        echo json_encode($senha);
    }
    
    public function dados_usuario(){
        $id = $this->input->post('id');
        $usuario = $this->um->usuario_existente(NULL, $id);
        $nivel = $this->um->get_ususario_nivel($id);
        $todos_nv = $this->um->get_nivel();
        
        $dados = array();
        foreach($usuario as $u){
            $dados['id_usuario'] = $u->id_usuario;
            $dados['email'] = $u->email;
            $dados['nome'] = $u->nome;
            $dados['ususario'] = $u->usuario;
            $dados['status'] = $u->status;

            foreach($nivel as $n){
                $dados['nivel'][$n->id_nivel] = $n->id_nivel;
            }
            foreach($todos_nv as $tn)
                $dados['td_nivel'][$tn->id_nivel] = $tn->id_nivel;
        }
        
        echo json_encode($dados);
    }
}