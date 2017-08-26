<br><br><br><div class="panel panel-default">
    <div class="panel-heading">
        Filtrar Usuários
    </div>
    <div class="panel-body">
        <?php echo form_open('usuarios/gerenciar_usuarios/filtro', array('class' => 'form-horizontal form-label-left'));?>
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome:</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <?php
                        $nome = @$this->session->userdata['nome'];
                        $usuario = @$this->session->userdata['usuario'];
                        $atributos = array(
                            'name'  =>  'nome',
                            'id'    =>  'nome',
                            'class' =>  'form-control col-xs-12',
                            'value' =>  $nome
                        );
                        echo form_input($atributos);
                        ?>
                      </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usuario">Usuário:</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <?php
                        $nome = @$this->session->userdata['nome'];
                        $usuario = @$this->session->userdata['usuario'];
                        $atributos = array(
                            'name'  =>  'usuario',
                            'id'    =>  'usuario',
                            'class' =>  'form-control col-xs-12',
                            'value' =>  $usuario
                        );
                        echo form_input($atributos);
                        ?>
                      </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-xs-12" style="text-align: center;">
                    <?php
                    echo anchor(base_url('usuarios/gerenciar_usuarios'), 'Limpar Filtro', 'class="btn btn-danger"').nbs(3);
                    
                    $atributos = array(
                        'name'  =>  'btnFiltrar',
                        'class' =>  'btn btn-success',
                        'value' =>  'Filtrar'
                    );
                    echo form_submit($atributos);
                    ?>
                </div>
            </div>
        <?php echo form_close();?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Gerenciar Usuários
    </div>
    <div class="panel-body">
        <?php
        if(@$this->input->post('qtd'))
            $qtdAtual = $this->input->post('qtd');
        else if(@$this->session->userdata['qtd'])
            $qtdAtual = $this->session->userdata['qtd'];
        else
            $qtdAtual = 10;
        
        if(@$erro){
            echo $erro;
        }
        if(@$mensagem)
            echo $mensagem;
        echo validation_errors(); ?>
        <a href="javascript:;" class="btn btn-primary" onclick="novo_modal()">Novo Usuário</a><br><br>
        <table border="1" id="datatable-responsive" class = "table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <td align="center"><b>Nome</b></td>
                    <td align="center" class="hidden-xs"><b>E-Mail</b></td>
                    <td align="center"><b>Usuário</b></td>
                    <td align="center"><b>Editar</b></td>
                </tr>
            </thead>
            <?php
            foreach (@$usuarios as $u){     
                echo '<tr><td align="center">'.$u->nome.'</td>';
                echo '<td align="center" class="hidden-xs">'.$u->email.'</td>';
                echo '<td align="center">'.$u->usuario.'</td>';
                echo '<td align="center"><a class="btn btn-primary" href="javascript:func()" onclick="editar_usuario(' . $u->id_usuario . ')"><i class="glyphicon glyphicon-list"></i></a></td></tr>';
            }
            ?>    
        </table>
            <?php 
            $opc = array();
            $opc[5] = 5;
            $opc[10] = 10;
            $opc[20] = 20;
            $opc['todos'] = 'Todos';
            
            $atributos = array(
                'name'  =>  'btnFiltrar',
                'value' => 'Atualizar',
                'method' => 'post',
                'class' => 'btn btn-primary'
            );
            echo form_label('Total de Registros: ').nbs(2).$total.br(2);
            echo form_open('usuarios/gerenciar_usuarios/filtro');
                echo '<div class="form-group row">';
                    echo '<div class="col-md-6">';
                        echo '<table width="90%">';
                        echo '<tr><td>'.form_label('Total de Registros por Página:').'</td>';
                        echo '<td>'.form_dropdown('qtd',$opc,$qtdAtual,'class="form-control small inline"').'</td>';
                        echo '<td>'.form_submit($atributos).'</td></tr>';
                        echo '</table>';
                    echo '</div>';
                echo '</div>';
            echo form_close();
            
            echo @$paginacao; ?>
    </div>
</div><br>

<div class="modal fade bs-example-modal-lg " id="novo_modal" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header corTextoModal">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title">Novo Usuário</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="novaLocalizacao" action="<?php echo base_url('usuarios/gerenciar_usuarios/adcionar_usuario'); ?>" >
                    <?php 
                    
                    echo '<b>Nome:</b>';
                    $atributos = array(
                        'name'  =>  'nome',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>E-Mail:</b>';
                    $atributos = array(
                        'name'  =>  'email',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    $op = array();

                    echo '<table>';
                    echo '<tr><td width="40%"><b>Nível:</b></td>';
                    $cont=0;
                    foreach ($nivel as $n){
                        if($cont>0)
                            echo '<tr><td></td>';
                        $atributos = array(
                            'name' => 'nivel[]',
                            'value' => $n->id_nivel,
                        );
                        echo '<td>'.form_checkbox($atributos).nbs().$n->descricao.'</td></tr>';
                        $cont++;
                    }
                    echo '</table><br>';
                    echo '<b>Usuário:</b>';
                    $atributos = array(
                        'name'  =>  'usuario',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();

                    echo '<b>Senha:</b><br>';
                    $atributos = array(
                        'name'  =>  'senha',
                        'id'    =>  'nova_senha_usuario',
                        'class' =>  'form-control',
                        'type'  =>  'password',
                        'value' =>  ''
                    );
//                    echo '<div class="col-md-9 col-sm-12 col-xs-12">';
                    echo '<table width="100%" >';
                        echo '<tr><td width="80%">'.form_input($atributos).'</td>';
//                    echo '</div>';
//                    echo '<div class="col-md-3 col-sm-12 col-xs-6">';
                        echo '<td width="15%" align="right"><a href="javascript:;" class="btn btn-danger" onclick="gerar_nova_senha()">Gerar</a></td></tr>';
//                    echo '</div>';
                    echo '</table>';
              ?>
            </div>
            <div class="modal-footer">
                <p align="left">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="window.location.reload()">Fechar</button>
                    <!--<button type="button" class="btn btn-primary" onclick="$('#nova_localizacao').submit()">Finalizar</button>-->
                    <?php
                    $atributos = array(
                        'name' => 'btnProsseguir',
                        'value' => 'Salvar',
                        'method' => 'post',
                        'class' => 'btn btn-primary'
                    );
                    echo form_submit($atributos);
                    ?>
                </p>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-lg " id="modal_editar_usuario" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header corTextoModal">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title">Editar Usuário</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="editarUsuario" action="<?php echo base_url('usuarios/gerenciar_usuarios/salvar'); ?>" >
                    <?php 
                    
                    echo '<b>Nome:</b>';
                    $atributos = array(
                        'name'  =>  'nome',
                        'id'  =>  'nome_edt',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>E-Mail:</b>';
                    $atributos = array(
                        'name'  =>  'email',
                        'id'  =>  'email_edt',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    $op = array();

                    echo '<table>';
                    echo '<tr><td width="40%"><b>Nível:</b></td>';
                    $cont=0;
                    foreach ($nivel as $n){
                        if($cont>0)
                            echo '<tr><td></td>';
                        $atributos = array(
                            'name' => 'nivel[]',
                            'id' => 'nivel'.$n->id_nivel,
                            'value' => $n->id_nivel,
                        );
                        echo '<td>'.form_checkbox($atributos).nbs().$n->descricao.'</td></tr>';
                        $cont++;
                    }
                    echo '</table><br>';
                    echo '<b>Usuário:</b>';
                    $atributos = array(
                        'name'  =>  'usuario',
                        'id'  =>  'usuario_edt',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>Senha:</b><br>';
                    $atributos = array(
                        'name'  =>  'senha',
                        'id'    =>  'nova_senha_usuario',
                        'class' =>  'form-control',
                        'type'  =>  'password',
                        'value' =>  ''
                    );
                    echo form_input($atributos);
              ?>
                <input class="form-control" type="hidden" id="id" name="id">
                <input class="form-control" type="hidden" id="gerenciar" name="gerenciar" value="1">
            </div>
            <div class="modal-footer">
                <p align="left">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload()">Fechar</button>
                    <!--<button type="button" class="btn btn-primary" onclick="$('#nova_localizacao').submit()">Finalizar</button>-->
                    <?php
                    $atributos = array(
                        'name' => 'btnProsseguir',
                        'value' => 'Salvar',
                        'method' => 'post',
                        'class' => 'btn btn-primary'
                    );
                    echo form_submit($atributos);
                    ?>
                </p>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
