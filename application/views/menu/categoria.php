<br><br><br><div class="panel panel-default">
    <div class="panel-heading">
        Gerenciar Categorias
    </div>
    <div class="panel-body">
        <?php
        if(@$this->input->post('qtd'))
            $qtdAtual = $this->input->post('qtd');
        else if(@$this->session->userdata['qtd'])
            $qtdAtual = $this->session->userdata['qtd'];
        else
            $qtdAtual = 10;
        if(@$erro)
            echo $erro;
        if(@$mensagem)
            echo $mensagem;
        echo validation_errors(); ?>
        <a href="javascript:;" class="btn btn-default" onclick="novo_modal()">Nova Categoria</a><br><br>
        <table border="1" class="table table-striped table-bordered table-hover dataTable no-footer" width="100%">
            <tr><td align="center" width="15%"><b>Código</b></td><td align="center" width="55%"><b>Descrição</b></td>
            <td align="center" width="15%"><b>Editar</b></td><td align="center" width="15%"><b>Excluir</b></td></tr>
            <?php
            foreach($categorias as $c){
                echo '<tr><td align="center">'.$c->id_categoria.'</td>';
                echo '<td align="center">'.$c->descricao.'</td>';
                echo '<td align="center"><a class="btn btn-primary" href="javascript:func()" onclick="modal_editar_categoria(' . $c->id_categoria . ')"><i class="glyphicon glyphicon-list"></i></a></td>';
                echo '<td align="center"><a class="btn btn-danger" href="javascript:func()" onclick="apagar_categoria(' . $c->id_categoria . ')"><i class="glyphicon glyphicon-remove"></i></a></td></tr>';
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
            echo form_open('menu/categorias/filtro');
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
</div>

<div class="modal fade bs-example-modal-lg " id="novo_modal" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header corTextoModal">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title">Nova Categoria</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="novaLocalizacao" action="<?php echo base_url('menu/categorias/adcionar_categoria'); ?>" >
                    <?php 
                    echo '<b>Descrição:</b>';
                    $atributos = array(
                        'name'  =>  'descricao',
                        'class' =>  'form-control large',
                    );
                    echo form_input($atributos);
                    
//                    echo '<table>';
//                        echo '<tr><td width="32%"><b>Nível:</b></td>';
//                        $cont=0;
//                        foreach ($nivel as $n){
//                            if($cont>0)
//                                echo '<tr><td></td>';
//                            $atributos = array(
//                                'name' => 'nivel[]',
//                                'value' => $n->id,
//                                'id' => 'squaredThree'
//                            );
//                            echo '<td>'.form_checkbox($atributos).nbs().$n->descricao.'</td></tr>';
//                            $cont++;
//                        }
//                    echo '</table>';
                    
                    ?>
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

<div class="modal fade bs-example-modal-lg " id="modal_editar_categoria" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header corTextoModal">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title">Nova Categoria</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="novaLocalizacao" action="<?php echo base_url('menu/categorias/editar_categoria'); ?>" >
                    <?php 
                    echo '<b>Descrição:</b>';
                    $atributos = array(
                        'name'  =>  'descricao_editar',
                        'id'  =>  'descricao_editar',
                        'class' =>  'form-control large',
                    );
                    echo form_input($atributos);
                    ?>
                    <input class="form-control" type="hidden" id="id_editar" name="id_editar">
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