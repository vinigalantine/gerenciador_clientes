function tooltipItems(){
	$('.tooltipers').tooltip();
}

function clearForm(){
	$('.clearFormRadio').prop('checked', false);
	$('.clearForm').val("").change();
	$('.clearDiv').html("");
}

function requestAjax(method_request,uri,data_request = []){
  var result =  $.ajax({
                    method: method_request,
                    url: uri,
                    dataType: 'json',
                    data: data_request,
                    async: false
                }) ;

  if(result.status == 200
      || result.status == 201)
    return { code:result.status, data:result.responseJSON, status:true }
  else
    return { code:result.status, data:result.responseText, status:false }
}
