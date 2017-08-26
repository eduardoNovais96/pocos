<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><div align="center">Entre com sua nova senha</div></strong>  
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('usuarios/gerenciar_usuarios/salvar_nova_senha'); ?>
                            <?php
                            if(@$mensagem)
                                echo $mensagem;
                            echo validation_errors(); ?>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                <input name="senha" type="password" class="form-control" placeholder="Nova Senha" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                <input name="repetir_senha" type="password" class="form-control"  placeholder="Repetir nova Senha" />
                            </div>
                            
                            <div align="center">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                            <hr />
                            <input class="form-control" type="hidden" value="<?php echo $link; ?>" id="link" name="link">
                            <!--Not register ? <a href="registeration.html" >click here </a>--> 
                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>