<br><br><br><div class="panel panel-default">
    <div class="panel-heading">
        Filtrar Feedbacks
    </div>
    <div class="panel-body">
        <?php
            echo form_open('alertas/info_face/filtro');?>
                <div class="row" >
                    <div class="col-sm-4 col-xs-12">
                        
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Empresa:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12"> <?php
                            $nome = @$this->session->userdata['nome'];

                            $atributos = array(
                                'name'  =>  'nome',
                                'id'    =>  'nome',
                                'class' =>  'form-control',
                                'value' =>  $nome
                            );
    //                        echo '<tr><td width="15%" align="right">'.form_label('Inscrição Estadual: ').nbs(2).'</td>';
                            echo form_input($atributos); ?>
                        </div>
                    </div>
                </div> <?php
                
                $atributos = array(
                    'name'  =>  'btnFiltrar',
                    'class' =>  'btn btn-success',
                    'value' =>  'Filtrar'
                );
                echo br().'<div align="center">';
                    echo anchor(base_url('alertas/info_face'), 'Limpar Filtro', 'class="btn btn-danger"').nbs(3);
                    echo form_submit($atributos);
                echo '</div>';
            echo form_close();
        ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Gerenciar Feedbacks
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
                    <td align="center" width="45%"><b>Empresa</b></td>
                    <td align="center" width="15%"><b>Quantidade de Reclamações</b></td>
                    <td align="center" width="15%" class="hidden-xs"><b>Data Primeira Reclamação</b></td>
                    <td align="center" width="15%" class="hidden-xs"><b>Data Última Reclamação</b></td>
                    <td align="center" width="10%"><b>Alterar ID do Facebook</b></td>
                </tr>
            </thead>
            <?php
            foreach (@$alertas as $a){
                $dtMin = explode('-', $a->data_minima);
                $dtMax = explode('-', $a->data_maxima);
                $diaMin = explode(':', $dtMin[2]);
                $diaMax = explode(':', $dtMax[2]);
                $diaMinFinal = explode(' ', $diaMin[0]);
                $diaMaxFinal = explode(' ', $diaMax[0]);
                
                echo '<tr><td align="center">'.$a->nome.'</td>';
                echo '<td align="center" >'.$a->qtd.'</td>';
                echo '<td align="center" class="hidden-xs">'.$diaMinFinal[0].'/'.$dtMin[1].'/'.$dtMin[0].'</td>';
                echo '<td align="center" class="hidden-xs">'.$diaMaxFinal[0].'/'.$dtMax[1].'/'.$dtMax[0].'</td>';
                echo '<td align="center"><a class="btn btn-primary" href="javascript:func()" onclick="editar_empresa(' . $a->id_empresa . ')"><i class="glyphicon glyphicon-list"></i></a></td></tr>';
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
            echo form_open('alertas/info_face/filtro');
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
                <h4 class="modal-title">Editar ID Facbook</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="editarEmpresa" action="<?php echo base_url('alertas/info_face/alterar_id'); ?>" >
                    <?php 
                    echo '<b>ID Facebook:</b>';
                    $atributos = array(
                        'name'  =>  'id_facebook',
                        'id'  =>  'id_facebook_edt',
                        'class' =>  'form-control',
                    );
                    echo form_input($atributos); ?>
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
