<br><br><br><div class="panel panel-default">
    <div class="panel-heading">
        Filtrar Contatos
    </div>
    <div class="panel-body">
        <?php
            echo form_open('alertas/contatos/filtro');?>
                <div class="row" >
                    <div class="col-sm-4 col-xs-12">
                        
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Empresa:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12"> <?php
                            $status = @$this->session->userdata['status'];
                            
                            $op[NULL] = '---';
                            $op['ab'] = 'Em aberto';
                            $op[1] = 'Visto';
                            echo form_dropdown('status', $op, $status, 'form-control');
                            ?>
                        </div>
                    </div>
                </div> <?php
                
                $atributos = array(
                    'name'  =>  'btnFiltrar',
                    'class' =>  'btn btn-success',
                    'value' =>  'Filtrar'
                );
                echo br().'<div align="center">';
                    echo anchor(base_url('alertas/contatos'), 'Limpar Filtro', 'class="btn btn-danger"').nbs(3);
                    echo form_submit($atributos);
                echo '</div>';
            echo form_close();
        ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Gerenciar Contatos
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

        <table border="1" id="datatable-responsive" class = "table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <td align="center" width="35%"><b>Nome</b></td>
                    <td align="center" width="15%" class="hidden-xs"><b>Telefone</b></td>
                    <td align="center" width="35%" class="hidden-xs"><b>E-Mail</b></td>
                    <td align="center" width="10%"><b>Status</b></td>
                    <td align="center" width="5%"><b>Visualizar</b></td>
                </tr>
            </thead>
            <?php
            foreach (@$contatos as $c){
                if($c->status==0){
                    $status = '<div class="alert-block alert-danger fade in">Em Aberto</div>';
                }
                else{
                    $status = '<div class="alert-block alert-success fade in">Visto</div>';
                }
                
                echo '<tr><td align="center">'.$c->nome.'</td>';
                echo '<td align="center" class="hidden-xs">'.$c->telefone.'</td>';
                echo '<td align="center" class="hidden-xs">'.$c->email.'</td>';
                echo '<td align="center">'.$status.'</td>';
                echo '<td align="center"><a class="btn btn-primary" href="javascript:func()" onclick="visualizar_mensagem(' . $c->id_contato . ')"><i class="glyphicon glyphicon-list"></i></a></td></tr>';
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
            echo form_open('alertas/contatos/filtro');
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
<div class="modal fade bs-example-modal-lg " id="modal_editar_empresa" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header corTextoModal">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title">Ler Contato</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="editarEmpresa" action="<?php echo base_url('alertas/contatos/ler_contato'); ?>" >
                    <?php 
                    echo '<b>Nome:</b>';
                    $atributos = array(
                        'name'  =>  'nome',
                        'id'  =>  'nome_baixa',
                        'class' =>  'form-control',
                        'disabled' => true
                    );
                    echo form_input($atributos).br(); 
                    
                    echo '<b>Telefone:</b>';
                    $atributos = array(
                        'name'  =>  'telefone',
                        'id'  =>  'telefone_baixa',
                        'class' =>  'form-control',
                        'disabled' => true
                    );
                    echo form_input($atributos).br(); 
                    
                    echo '<b>E-Mail:</b>';
                    $atributos = array(
                        'name'  =>  'email',
                        'id'  =>  'email_baixa',
                        'class' =>  'form-control',
                        'disabled' => true
                    );
                    echo form_input($atributos).br(); 
                    
                    echo '<b>Mensagem:</b>';
                    $atributos = array(
                        'name'  =>  'mensagem',
                        'id'  =>  'mensagem_baixa',
                        'class' =>  'form-control',
                        'disabled' => true
                    );
                    echo form_textarea($atributos).br(); 
                    
                    ?>
                <input class="form-control" type="hidden" id="id_baixa" name="id">
            </div>
            <div class="modal-footer">
                <p align="left">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload()">Fechar</button>
                    <!--<button type="button" class="btn btn-primary" onclick="$('#nova_localizacao').submit()">Finalizar</button>-->
                    <?php
                    $atributos = array(
                        'name' => 'btnProsseguir',
                        'value' => 'Ler',
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
