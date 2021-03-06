<?php

if (!defined('BASEPATH'))
    exit("Sem direito de acesso direto ao script");

class Logar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model', 'um');
    }

    public function index() {
        if (@$this->nativesession->get('id_usuario')) {
            redirect(base_url('pagina_inicial'));
        } else {
            $this->form_validation->set_rules('usuario', 'Usuário', 'required');
            $this->form_validation->set_rules('senha', 'Senha', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger fade in">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                $data['pagina'] = 'login/logar';
                $this->load->view('template', $data);
            } else {
                $data['usuario'] = $this->input->post('usuario');
                $data['senha'] = md5($this->input->post('senha'));

                $log = $this->um->logar($data);
                if (@$log[0]->id_usuario) {
                    $cont = 0;
                    $nivel = array();
                    $cod_nivel = array();
                    $desc_nivel = array();
                    foreach ($log as $l) {
                        $nivel[$cont] = $l->nivel;
                        $cod_nivel[$cont] = $l->cod_nivel;

                        $cont++;
                    }
                    $this->nativesession->set('id_usuario', $log[0]->id_usuario);
                    $this->nativesession->set('nome_usuario', $log[0]->nome);
                    $this->nativesession->set('usuario', $data['usuario']);
                    $this->nativesession->set('nivel', $nivel);
                    $this->nativesession->set('cod_nivel', $cod_nivel);
                    //$where = "name='Joe' AND status='boss' OR status='active'";
                    $cont = 0;
                    $where = "";
                    foreach ($cod_nivel as $cn) {
                        if ($cont == 0)
                            $where = "fn.id_nivel = $cn";
                        else
                            $where .= " or fn.id_nivel = $cn";
                        $cont++;
                    }
                    $funcionalidades = $this->um->get_funcionalidades($where);
                    $this->nativesession->set('funcionalidades', $funcionalidades);
//echo '<pre>';
                    $menus_sel = $this->um->get_cat_dif($where);

                    $cont = 0;
//                    echo '<pre>'; print_r($menus_sel);die;
                    foreach ($menus_sel as $ms) {
                        $menuAux = $this->um->get_categorias($ms->id_categoria);
                        $menu[$cont]['id'] = $menuAux[0]->id_categoria;
                        $menu[$cont]['nome'] = $menuAux[0]->descricao;
                        $menu[$cont]['miniatura'] = $menuAux[0]->miniatura;
                        
                        $cont++;
                    }
                    $this->nativesession->set('menu', $menu);
//                    print_r($this->session->userdata['menu']);die;
//                    echo '<pre>'; print_r($this->session->userdata);die; 
                    $data['pagina'] = 'pagina_inicial';
                    $this->load->view('template', $data);
//                    redirect(base_url());
                } else {
                    $data['mensagem'] = '<div class="alert alert-block alert-danger fade in">Login ou senha inválido </div>';
                    $data['pagina'] = 'login/logar';

                    $this->load->view('template', $data);
                }
            }
        }
    }

    public function nova_senha() {
        if (@$this->input->post('usuario') == NULL && $this->input->post('email') == NULL) {
            $data['mensagem'] = '<div class="alert alert-block alert-danger fade in">Você precisa digitar pelo menos um dos campos para prosseguir.</div>';
            $data['pagina'] = 'login/logar';

            $this->load->view('template', $data);
        } else {
            if (@$this->input->post('usuario') != NULL)
                $usuario = $this->input->post('usuario');
            else
                $usuario = NULL;

            if (@$this->input->post('email') != NULL)
                $email = $this->input->post('email');
            else
                $email = NULL;

            $rec = $this->um->recuperar($usuario, $email);

            if (@$rec[0]->nome) {
                $existente = $this->um->get_link(NULL, 1, $rec[0]->id_usuario);

                if (@$existente[0]->id_usuario) {
                    $data['mensagem'] = '<div class="alert alert-block alert-danger fade in">Há um link em aberto com seu usuário, verifique o '
                            . 'e-mail: ' . $rec[0]->email . ' </div>';
                    $this->load->view('template', $data);
                } else {
                    $str = "AaBbCcDdEeFf1234567890gGhHiIjJKklLmMnNoOPPqqRRSstTUuvvWwxXYyZz";
                    $codigo = str_shuffle($str);

                    $linkEx = $this->um->get_link($codigo);

                    while (@$linkEx[0]->link) {
                        $str = "afspkasflaskfklasfksalsafASKFLASKFlasfAKSfla2312312325025asd";
                        $codigo = str_shuffle($str);
                        $linkEx = $this->um->get_link($codigo);
                    }

                    $dados['id_usuario'] = $rec[0]->id_usuario;
                    $dados['link'] = $codigo;

                    $this->um->set_link($dados);

                    $this->load->view('template', $data);
                }
            } else {
                $data['mensagem'] = '<div class="alert alert-block alert-danger fade in">Cadastro não localizado, tente novamente ou entre em contato.</div>';
                $data['pagina'] = 'login/logar';

                $this->load->view('template', $data);
            }
        }
    }

}
