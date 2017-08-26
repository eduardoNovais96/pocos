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
    $.post(base_url + 'menu/categorias/dados_categoria', {
        id: id
    }, function (data) {
        $('#descricao_editar').val(data.descricao);
        $('#id_editar').val(data.id);
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
        $('#usuario_edt').val(data.ususario);
        $('#id').val(data.id_usuario);
        
        $.each(data.td_nivel, function( index, value ) {
            document.getElementById('nivel'+value).checked = false;
        });
        
        $.each(data.nivel, function( index, value ) {
            document.getElementById('nivel'+value).checked = true;
        });
        
    }, 'json');
    $('#modal_editar_usuario').modal('show');
}

/*
 * SCRIPTS Empresas
 */
function editar_empresa(id) {
    $.post(base_url + 'empresas/gerenciar_empresas/dados_empresa/'+id, {
        id: id
    }, function (data) {
        $('#codigo_edt').val(data.codigo);
        $('#nome_edt').val(data.nome);
        $('#im_edt').val(data.im);
        $('#cnpj_edt').val(data.cnpj);
        $('#endereco_edt').val(data.endereco);
        $('#data_inscricaoval_edt').val(data.data_inscricao);
        $('#id_empresa_edt').val(id);
        
        document.getElementById("tipo_edt"+data.tipo).checked = true;
        
    }, 'json');
    $('#modal_editar_empresa').modal('show');
}