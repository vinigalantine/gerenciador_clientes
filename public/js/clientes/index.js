$(function() {
	tooltipItems();
});

function openNovo(){
	clearForm();
	$('#form-cliente').show();
	$('#div-btn-new-cliente').hide();
	$('#div-btn-close-cliente').show();
	$('.div-edit').hide();
}

function closeNovo(){
	clearForm();
	$('#form-cliente').hide();
	$('#div-btn-new-cliente').show();
	$('#div-btn-close-cliente').hide();
	$('.div-edit').hide();
}

function chooseAction(){
	$('#form-cliente').hide();
	$('#div-btn-new-cliente').show();
	$('#div-btn-close-cliente').hide();
	$('.div-edit').hide();

	if($('#id').val())
		update_cliente();
	else
		create_cliente();
}

function create_cliente(){
  var result = requestAjax('POST', 'clientes/store', $('#form-cliente').serialize());
  if(result.status){
  	location.reload();
  }else{
  	alert("Error!");
  }
}

function info_cliente(id){
	var result = requestAjax('GET', 'clientes/info/'+id, {"_token":$("[name=_token]").val()});
	if(result.status){
		clearForm();
		$('#form-cliente').show();
		$('#div-btn-new-cliente').hide();
		$('#div-btn-close-cliente').show();
		$('.div-edit').show();
    	data = result.data;

		$('#id').val(data.id);

		if (data.tipo_pessoa == 0)
			$('#cpf').prop('checked', true);
		else
			$('#cnpj').prop('checked', true);

		$('#cadastro_nacional').val(data.cadastro_nacional);
		$('#nome').val(data.nome);

		$('#nascimento').val(data.nascimento);
		$('#cliente_desde').val(data.cliente_desde);
		$('#descricao').val(data.descricao);

		$('#created_at').html(data.created_at);
		$('#updated_at').html(data.updated_at);
		$('#user_atualizou').html(data.user_atualizou);
		$('#user_criou').html(data.user_criou);

		console.log(data);
	}else{
		alert("Error!");
	}
}

function update_cliente(){
	var result = requestAjax('PUT', 'clientes/update', $('#form-cliente').serialize());
	if(result.status){
		location.reload();
	}else{
		alert("Error!");
	}
}

function askDelete(id){
	$('#delete-cliente-id').val(id);
	$('#delete_modal').modal('toggle');
}

function delete_cliente(){
	var result = requestAjax('DELETE', 'clientes/delete/'+$('#delete-cliente-id').val(), {"_token":$("[name=_token]").val()});
	if(result.status){
		location.reload();
		$('#delete-cliente-id').val("");
		$('#delete_modal').modal('toggle');
	}else{
		alert("Error!");
	}
}