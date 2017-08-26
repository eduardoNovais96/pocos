<div class="panel panel-danger">
    <div class="panel-heading">
        Gerenciar Usuários
    </div>
    <div class="panel-body">
        <?php echo validation_errors();
        if(@$mensagem)
            echo $mensagem;
        
        echo form_open('usuarios/gerenciar_usuarios/salvar');
                    
            echo '<b>Nome:</b>';
            $atributos = array(
                'name'  =>  'nome',
                'value' =>  $usuario[0]->nome,
                'class' =>  'form-control',
            );
            echo form_input($atributos).br();

            echo '<b>E-Mail:</b>';
            $atributos = array(
                'name'  =>  'email',
                'value' =>  $usuario[0]->email,
                'class' =>  'form-control',
            );
            echo form_input($atributos).br();

            $op = array();

            echo '<b>Usuário:</b>';
            $atributos = array(
                'name'  =>  'usuario',
                'value' =>  $usuario[0]->usuario,
                'class' =>  'form-control',
            );
            echo form_input($atributos).br();

            echo '<b>Senha antiga:</b>';
            $atributos = array(
                'name'  =>  'senha_antiga',
                'class' =>  'form-control',
                'type'  =>  'password',
                'value' =>  ''
            );
            echo form_input($atributos).br(2);
            
            echo '<b>Nova senha:</b>';
            $atributos = array(
                'name'  =>  'senha',
                'class' =>  'form-control',
                'type'  =>  'password',
                'value' =>  ''
            );
            echo form_input($atributos).br(2);
            
            echo '<b>Repita a nova senha:</b>';
            $atributos = array(
                'name'  =>  'senha_repeticao',
                'class' =>  'form-control',
                'type'  =>  'password',
                'value' =>  ''
            );
            echo form_input($atributos).br(2);

            $atributos = array(
                'name' => 'btnProsseguir',
                'value' => 'Salvar',
                'method' => 'post',
                'class' => 'btn btn-primary'
            );
            echo form_submit($atributos);

            echo '<input class="form-control" type="hidden" value="'.$usuario[0]->id_usuario.'" name="id">';
        echo form_close(); ?>
    </div>
</div>