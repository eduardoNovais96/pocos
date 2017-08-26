<br><div class="panel panel-default">
    <div class="panel-heading">
        Gerenciar Empresas
    </div>
    <div class="panel-body">
        <?php
        if(@$this->input->post('qtd'))
            $qtdAtual = $this->input->post('qtd');
        else if(@$this->session->userdata['qtd'])
            $qtdAtual = $this->session->userdata['qtd'];
        else
            $qtdAtual = 10;

        if(@$mensagem)
            echo $mensagem;
        echo validation_errors(); ?>
        <a href="javascript:;" class="btn btn-primary" onclick="novo_modal()">Nova Categoria</a>
        <table border="1" id="datatable-responsive" class = "table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <td align="center" width="10%" class="hidden-xs"><b>Categoria</b></td>
                    <td align="center" width="10%"><b>Editar</b></td>
                </tr>
            </thead>
            <?php
            foreach (@$categorias as $c){
                echo '<tr><td align="center" class="hidden-xs">'.$c->categoria.'</td>';
                echo '<td align="center"><a class="btn btn-primary" href="javascript:func()" onclick="editar_empresa(' . $c->id_categoria . ')"><i class="glyphicon glyphicon-list"></i></a></td></tr>';
            }
            ?>    
        </table>
            
            echo form_close();
            
            echo @$paginacao; ?>
    </div>
</div><br>

<div class="modal fade bs-example-modal-lg " id="novo_modal" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header corTextoModal">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title">Nova Empresa</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="novaLocalizacao" action="<?php echo base_url('empresas/gerenciar_empresas/nova_empresa'); ?>" >
                    <?php 
                    echo '<b>Código:</b>';
                    $atributos = array(
                        'name'  =>  'codigo',
                        'class' =>  'form-control',
                        'type'  =>  'number'
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>Nome:</b>';
                    $atributos = array(
                        'name'  =>  'nome',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    $op = array();
                    $op[NULL] = '---';
                    
                    echo '<table>';
                        echo '<tr><td width="40%"><b>Tipo:</b></td>';
                        
                        $atributos = array(
                            'name' => 'tipo',
                            'value' => 'COMERCIO',
                        );
                        echo '<td>'.form_radio($atributos).nbs().'COMERCIO</td></tr>';

                        echo '<tr><td></td>';
                        $atributos = array(
                            'name' => 'tipo',
                            'value' => 'SERVICO',
                        );
                        echo '<td>'.form_radio($atributos).nbs().'SERVICO</td></tr>';
                    echo '</table><br>';

                    echo '<b>ID Facebook:</b>';
                    $atributos = array(
                        'name'  =>  'id_facebook',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>Inscrição Municipal:</b>';
                    $atributos = array(
                        'name'  =>  'im',
                        'class' =>  'form-control',
                        'type'  =>  'number'
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>CNPJ:</b>';
                    $atributos = array(
                        'name'  =>  'cnpj',
                        'class' =>  'form-control cnpj',
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>Endereço:</b>';
                    $atributos = array(
                        'name'  =>  'endereco',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>Data de Inscrição:</b>';
                    $atributos = array(
                        'name'  =>  'data_inscricao',
                        'class' =>  'form-control data',
                    );
                    echo form_input($atributos).br();
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

<div class="modal fade bs-example-modal-lg " id="modal_editar_empresa" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header corTextoModal">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title">Editar Empresa</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="editarEmpresa" action="<?php echo base_url('empresas/gerenciar_empresas/salvar'); ?>" >
                    <?php 
                    echo '<b>Código:</b>';
                    $atributos = array(
                        'name'  =>  'codigo',
                        'id'    =>  'codigo_edt',
                        'class' =>  'form-control',
                        'type'  =>  'number'
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>Nome:</b>';
                    $atributos = array(
                        'name'  =>  'nome',
                        'id'  =>  'nome_edt',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    $op = array();
                    $op[NULL] = '---';
                    
                    echo '<table>';
                        echo '<tr><td width="40%"><b>Tipo:</b></td>';
                        
                        $atributos = array(
                            'name' => 'tipo',
                            'id' => 'tipo_edtCOMERCIO',
                            'value' => 'COMERCIO',
                        );
                        echo '<td>'.form_radio($atributos).nbs().'COMERCIO</td></tr>';

                        echo '<tr><td></td>';
                        $atributos = array(
                            'name' => 'tipo',
                            'id' => 'tipo_edtSERVICO',
                            'value' => 'SERVICO',
                        );
                        echo '<td>'.form_radio($atributos).nbs().'SERVICO</td></tr>';
                    echo '</table><br>';

                    echo '<b>ID Facebook:</b>';
                    $atributos = array(
                        'name'  =>  'id_facebook',
                        'id'  =>  'id_facebook_edt',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>Inscrição Municipal:</b>';
                    $atributos = array(
                        'name'  =>  'im',
                        'id'  =>  'im_edt',
                        'class' =>  'form-control',
                        'type'  =>  'number'
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>CNPJ:</b>';
                    $atributos = array(
                        'name'  =>  'cnpj',
                        'id'  =>  'cnpj_edt',
                        'class' =>  'form-control cnpj',
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>Endereço:</b>';
                    $atributos = array(
                        'name'  =>  'endereco',
                        'id'  =>  'endereco_edt',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos).br();
                    
                    echo '<b>Data de Inscrição:</b>';
                    $atributos = array(
                        'name'  =>  'data_inscricao',
                        'id'  =>  'data_inscricao_edt',
                        'class' =>  'form-control data',
                    );
                    echo form_input($atributos).br(); ?>
                <input class="form-control" type="hidden" id="id_empresa_edt" name="id_empresa">
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
<div class="modal fade bs-example-modal-lg " id="modalAtualizarEmpresasComReceita" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header corTextoModal">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title">Atualizando empresas com a receita</h4>
            </div>
            <div class="modal-body" style="text-align: center;">
                <label>De</label><input type="text" id="de">
                <label>Ate</label><input type="text" id="ate">
                <button id="atualizarEmpresas" type="button" onclick="atualizarComAReceitaAsEmpresas()">Atualizar empresas no intervalo</button>
                <div id="mensagem" style="margin-top: 25px;margin-bottom: 25px;"></div>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
