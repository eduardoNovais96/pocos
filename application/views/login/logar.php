<?php echo form_open('login/logar'); ?>
<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form>
                        <h1><img src="<?php echo base_url('assets/img/Logo.png');?>" width="40%"></h1>
                        <?php echo validation_errors(); ?>
                        <div>
                            <input type="text" class="form-control" placeholder="Usuário" required="" name="usuario" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Senha" required="" name="senha"/>
                        </div>
                        <br>
                        <div class="col-sm-6">
                            <span class="pull-left">
                                <input type="submit" class="btn btndefault submit" value="Logar">
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <span class="pull-right" style="padding-top: 7px;">
                                <a href="javascript:func()" onclick="novo_modal()">Esqueceu sua senha? </a>
                            </span>
                        </div>
                        <div class="clearfix"></div>

                        <div class="separator">

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1>Poços de Caldas 100% Conectado</h1>
                                <!--<p>IF Sul de Minas Campus Muzambinho</p>-->
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

<?php echo form_close(); ?>

<div class="modal fade bs-example-modal-lg " id="novo_modal" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header corTextoModal">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title">Nova senha</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="novaLocalizacao" action="<?php echo base_url('login/logar/nova_senha'); ?>" >
                    <?php 
//                    echo '<b>Usuário:</b>';
//                    $atributos = array(
//                        'name'  =>  'usuario',
//                        'class' =>  'form-control large',
//                    );
//                    echo form_input($atributos).br();
                    
                    echo '<b>E-Mail:</b>';
                    $atributos = array(
                        'name'  =>  'email',
                        'class' =>  'form-control large',
                    );
                    echo form_input($atributos);
                    
                    ?>
            </div>
            <div class="modal-footer">
                <p align="left">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.reload()">Fechar</button>
                    <!--<button type="button" class="btn btn-primary" onclick="$('#nova_localizacao').submit()">Finalizar</button>-->
                    <?php
                    $atributos = array(
                        'name' => 'btnProsseguir',
                        'value' => 'Prosseguir',
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