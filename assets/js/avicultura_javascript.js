var ate            = 0;
var de             = 0;
var sucessoReceita = 0;
var errosReceita   = 0;
var informacoes    = [];

//Mascaras de Entrada
jQuery(function($){
    $(".data").mask("99/99/9999");
    $(".competencia").mask("99/9999");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".cep").mask("99999-999");
    $(".telefone").mask("(99)9999-9999");
    $(".celular").focusout(function(){
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if(phone.length > 10) {
            element.mask("(99) ?9 9999-9999");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');
});

function novo_modal() {
    $('#novo_modal').modal('show');
}

/*
 * Scripts para o menu.
 */
function modal_editar_categoria(id) {
    $.post(base_url + 'empresas/categorias/dados_categoria', {
        id: id
    }, function (data) {
        $('#descricao_editar').val(data.descricao);
        $('#id_editar').val(id);
    }, 'json');
    $('#modal_editar_categoria').modal('show');
}

function apagar_categoria(id) {
    var resposta = confirm("Deseja remover essa categoria?");

    if (resposta == true) {
        window.location.href = base_url + "menu/categorias/excluir/" + id;
    }
}

/*
 * Scripts para o funcionalidades.
 */
function modal_editar_funcionalidade(id) {
    $.post(base_url + 'menu/funcionalidades/dados_funcionalidade', {
        id: id
    }, function (data) {
        $('#descricao_editar').val(data.nome);
        $('#caminho_editar').val(data.url);
        $('#categoria_editar').val(data.id_categoria);//
        $('#nivel_editar').val(data.nivel);
        $('#id_editar').val(data.id);
        
        $.each(data.nivel, function( index, value ) {
            document.getElementById('nivel_editar'+value).checked = true;
        });
        
    }, 'json');
    $('#modal_editar_funcionalidade').modal('show');
} 

function apagar_funcionalidade(id) {
    var resposta = confirm("Deseja remover essa funcionalidade?");

    if (resposta == true) {
        window.location.href = base_url + "menu/funcionalidades/excluir/" + id;
    }
}

/*
 * SCRIPTS Usuários
 */
function editar_usuario(id) {
    $.post(base_url + 'usuarios/gerenciar_usuarios/dados_usuario', {
        id: id
    }, function (data) {
        $('#nome_edt').val(data.nome);
        $('#email_edt').val(data.email);
        $('#usuario_edt').val(data.ususario);
        $('#id').val(data.id_usuario);
        
        $.each(data.td_nivel, function( index, value ) {
            document.getElementById('nivel'+value).checked = false;
        });
        
        $.each(data.nivel, function( index, value ) {
            document.getElementById('nivel'+value).checked = true;
        });
        
        document.getElementById("status"+data.status).checked = true;
        
    }, 'json');
    $('#modal_editar_usuario').modal('show');
}

function gerar_nova_senha(){
    $.post(base_url + 'usuarios/gerenciar_usuarios/gerar_senha', {
    }, function (data) {
        $('#nova_senha_usuario').val(data.senha);
    }, 'json');
    $('#modal_novo_sindicalizado').modal('show');
}

/*
 * SCRIPTS Empresas
 */
function editar_empresa(id) {
    $('#codigo_edt').val(null);
    $('#nome_edt').val(null);
    $('#im_edt').val(null);
    $('#id_facebook_edt').val(null);
    $('#cnpj_edt').val(null);
    $('#endereco_edt').val(null);
    $('#data_inscricao_edt').val(null);
    $('#id_empresa_edt').val(null);
    $.post(base_url + 'empresas/gerenciar_empresas/dados_empresa/'+id, {
        id: id
    }, function (data) {
        $('#codigo_edt').val(data.codigo);
        $('#nome_edt').val(data.nome);
        $('#id_facebook_edt').val(data.id_facebook);
        $('#im_edt').val(data.im);
        $('#cnpj_edt').val(data.cnpj);
        $('#endereco_edt').val(data.endereco);
        $('#data_inscricao_edt').val(data.data_inscricao);
        $('#id_empresa_edt').val(id);
        
        document.getElementById("tipo_edt"+data.tipo).checked = true;
        
    }, 'json');
    $('#modal_editar_empresa').modal('show');
}

function exibirModalAtualizarComReceita() {
    
    $('#modalAtualizarEmpresasComReceita #mensagem').hide();
    $('#modalAtualizarEmpresasComReceita').modal('show');
}

function atualizarComAReceitaAsEmpresas() {
        
    $('#modalAtualizarEmpresasComReceita #mensagem').html('CARREGANDO...');
    
    sucessoReceita = 0;
    errosReceita   = 0;
    informacoes    = [];
    de             = Number($('#de').val());
    ate            = Number($('#ate').val());

    mostrarInformacoesBuscasReceita();
    $('#modalAtualizarEmpresasComReceita #mensagem').show();
    $('#atualizarEmpresas').attr('disabled', 'disabled');
    buscarEAtualizarEmpresa();
}

function buscarEAtualizarEmpresa(){
    
    $.ajax({
        url: $('#baseUrl').val() + 'empresas/gerenciar_empresas/buscarEAtualizarComReceita/' + de,
        type: 'GET',
        dataType: 'json',
        success: function(dados) {
            
            if(dados.atualizada) {
                
                sucessoReceita++;
                informacoes[informacoes.length] = "<span style='color: green;'>" + de + " - " + dados.empresa + ", ATUALIZADA</span>";
            }
            else {
                
                errosReceita++;
                informacoes[informacoes.length] = "<span style='color: red;'>" + de + " - " + dados.empresa + ", NÃO ATUALIZADA</span>";
            }
            
            mostrarInformacoesBuscasReceita();
            
            if(de < ate) {
                
                de++;                
                buscarEAtualizarEmpresa();
            }
            else {
                
                $('#modalAtualizarEmpresasComReceita #mensagem').append('<br><br><span style="color: green;">OPERAÇÃO FINALIZADA</span><br><span> - Sucessos: ' + sucessoReceita + ' </span><span> - Erros: ' + errosReceita + '</span>');
                $('#atualizarEmpresas').removeAttr('disabled');
            }
        },
        error: function() {
            
            errosReceita++;
            informacoes[informacoes.length] = "<span style='color:red;'>" + de + " - OCORREU UM ERRO</span>";
            
            if(de < ate) {
             
                de++;
                mostrarInformacoesBuscasReceita();
                buscarEAtualizarEmpresa();
            }
            else {
                
                $('#modalAtualizarEmpresasComReceita #mensagem').append('<br><br><span style="color: green;">OPERAÇÃO FINALIZADA</span><br><span> - Sucessos: ' + sucessoReceita + ' </span><span> - Erros: ' + errosReceita + '</span>');
                $('#atualizarEmpresas').removeAttr('disabled');
            }
        }
    });
};

function mostrarInformacoesBuscasReceita() {
    
    var informação = "Atualizando " + de + " de " + ate;
    
    for(var i=informacoes.length-1;i>informacoes.length-8 && i>=0;i--) {
        
        informação += "<br>" + informacoes[i];
    }
    
    $('#modalAtualizarEmpresasComReceita #mensagem').html(informação);
}

/*
 * SCRIPTS PARA CONTATOS
 */

function visualizar_mensagem(id) {
    $.post(base_url + 'alertas/contatos/dados_contato/'+id, {
        id: id
    }, function (data) {
        $('#nome_baixa').val(data.nome);
        $('#telefone_baixa').val(data.telefone);
        $('#email_baixa').val(data.email);
        $('#mensagem_baixa').val(data.mensagem);
        $('#id_baixa').val(id);
        
    }, 'json');
    $('#modal_editar_empresa').modal('show');
}