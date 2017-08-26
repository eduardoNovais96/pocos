<br><br><br><div class="panel panel-default">
    <div class="panel-heading">
        Filtrar Empresas
    </div>
    <div class="panel-body">
        <?php
            echo form_open('empresas/gerenciar_empresas/filtro');?>
                <div class="row">
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Inscrição Estadual:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12"> <?php
                            $im = @$this->session->userdata['im'];
                            $cnpj = @$this->session->userdata['cnpj'];
                            $tipo = @$this->session->userdata['tipo'];

                            $atributos = array(
                                'name'  =>  'im',
                                'id'    =>  'im',
                                'class' =>  'form-control',
                                'value' =>  $im
                            );
    //                        echo '<tr><td width="15%" align="right">'.form_label('Inscrição Estadual: ').nbs(2).'</td>';
                            echo form_input($atributos); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">CNPJ:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12"> <?php
                            $atributos = array(
                                'name'  =>  'cnpj',
                                'id'    =>  'cnpj',
                                'class' =>  'form-control',
                                'value' =>  $cnpj
                            );
    //                        echo '<td width="10%" align="right">'.form_label('CNPJ: ').nbs(2).'</td>';
                            echo form_input($atributos); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Tipo Empresa:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12"> <?php
                            $op[NULL] = '---';
                            $op['COMERCIO'] = 'COMERCIO';
                            $op['SERVICO'] = 'SERVICO';
    //                        echo '<td width="10%" align="right">'.form_label('Tipo Empresa: ').nbs(2).'</td>';
                            echo form_dropdown('tipo', $op, $tipo, 'class="form-control"'); ?>
                        </div>
                    </div> 
                </div> <?php
                
                $atributos = array(
                    'name'  =>  'btnFiltrar',
                    'class' =>  'btn btn-success',
                    'value' =>  'Filtrar'
                );
                echo br().'<div align="center">';
                    echo anchor(base_url('empresas/gerenciar_empresas'), 'Limpar Filtro', 'class="btn btn-danger"').nbs(3);
                    echo form_submit($atributos);
                echo '</div>';
            echo form_close();
        ?>
    </div>
</div>

<div class="panel panel-default">
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
        <a href="javascript:;" class="btn btn-primary" onclick="novo_modal()">Nova Empresa</a><br><br>
        <table border="1" id="datatable-responsive" class = "table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <td align="center" width="10%" class="hidden-xs"><b>Tipo da Empresa</b></td>
                    <td align="center" width="20%"><b>Nome Fantasia</b></td>
                    <td align="center" width="15%" class="hidden-xs"><b>Inscrição Municipal</b></td>
                    <td align="center" width="15%"><b>CNPJ</b></td>
                    <td align="center" width="20%" class="hidden-xs"><b>Endereço</b></td>
                    <td align="center" width="10%" class="hidden-xs"><b>Data Inscrição</b></td>
                    <td align="center" width="10%"><b>Editar</b></td>
                </tr>
            </thead>
            <?php
            foreach (@$empresas as $e){
                $dt = explode('-', $e->datainscricao);
                
                echo '<tr><td align="center" class="hidden-xs">'.$e->tipo.'</td>';
                echo '<td align="center">'.$e->nome.'</td>';
                echo '<td align="center" class="hidden-xs">'.$e->inscricao_municipal.'</td>';
                echo '<td align="center">'.$e->documento.'</td>';
                echo '<td align="center" class="hidden-xs">'.utf8_decode($e->endereco).'</td>';
                echo '<td align="center" class="hidden-xs">'.$dt[2].'/'.$dt[1].'/'.$dt[0].'</td>';
                echo '<td align="center"><a class="btn btn-primary" href="javascript:func()" onclick="editar_empresa(' . $e->id . ')"><i class="glyphicon glyphicon-list"></i></a></td></tr>';
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
            echo form_open('empresas/gerenciar_empresas/filtro');
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
