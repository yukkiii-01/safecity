$(document).on("ready",inicio);

function inicio(){
	$("span.help-block").hide();
	$("#nombre").keyup(nombres);
	$("#dni").keyup(dni);
	$("#telefono").keyup(telefono);
	$("#clave").keyup(clave);
	$("#correo").keyup(correo);

}

function correo(){
	var valor = document.getElementById("correo").value;

	expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(valor) ){
    	$("#iconotexto").remove();
		$("#correo").parent().parent().attr("class","form-group col-md-4 has-error");
		$("#correo").parent().append("<span id='iconotexto' class='glyphicon glyphicon-remove form-control-feedback'></span>");
		return false;
    }else{
    	$("#iconotexto").remove();
		$("#correo").parent().parent().attr("class","form-group col-md-4 has-success");
		$("#correo").parent().append("<span id='iconotexto' class='glyphicon glyphicon-ok form-control-feedback'></span>");
		return true;
    }
}

function nombres(){
	var valor = document.getElementById("nombre").value;

	if(valor == null || valor.length == 0  || /^\s+$/.test(valor)){
		$("#iconotexto").remove();
		$("#nombre").parent().parent().attr("class","form-group col-md-4 has-error");
		$("#nombre").parent().append("<span id='iconotexto' class='glyphicon glyphicon-remove form-control-feedback'></span>");
		return false;
	}else{
		$("#iconotexto").remove();
		$("#nombre").parent().parent().attr("class","form-group col-md-4 has-success");
		$("#nombre").parent().append("<span id='iconotexto' class='glyphicon glyphicon-ok form-control-feedback'></span>");
		return true;
	}
}

function clave(){
	var valor = document.getElementById("clave").value;

	if(valor == null || valor.length == 0  || /^\s+$/.test(valor)){
		$("#iconotexto").remove();
		$("#clave").parent().parent().attr("class","form-group col-md-4 has-error");
		$("#clave").parent().append("<span id='iconotexto' class='glyphicon glyphicon-remove form-control-feedback'></span>");
		return false;
	}else{
		$("#iconotexto").remove();
		$("#clave").parent().parent().attr("class","form-group col-md-4 has-success");
		$("#clave").parent().append("<span id='iconotexto' class='glyphicon glyphicon-ok form-control-feedback'></span>");
		return true;
	}
}

function dni(){
	var valor = document.getElementById("dni").value;

	if(valor == null || valor.length == 0 || /^\s+$/.test(valor)){
		$("#iconotexto").remove();
		$("#dni").parent().parent().attr("class","form-group col-md-4 has-error");
		$("#dni").parent().append("<span id='iconotexto' class='glyphicon glyphicon-remove form-control-feedback'></span>");
		return false;
	}else{
		if( isNaN(valor) ){
			$("#iconotexto").remove();
			$("#dni").parent().parent().attr("class","form-group col-md-4 has-error");
			$("#dni").parent().append("<span id='iconotexto' class='glyphicon glyphicon-remove form-control-feedback'></span>");
			return false;
		}if(valor.length<8){
			$("#iconotexto").remove();
			$("#dni").parent().parent().attr("class","form-group col-md-4 has-error");
			$("#dni").parent().append("<span id='iconotexto' class='glyphicon glyphicon-remove form-control-feedback'></span>");
			return false;
		}else{
			$("#iconotexto").remove();
			$("#dni").parent().parent().attr("class","form-group col-md-4 has-success");
			$("#dni").parent().append("<span id='iconotexto' class='glyphicon glyphicon-ok form-control-feedback'></span>");
			return true;
		}
	}


}

function telefono(){
	var valor = document.getElementById("telefono").value;

	if(valor == null || valor.length == 0 || /^\s+$/.test(valor)){
		$("#iconotexto").remove();
		$("#telefono").parent().parent().attr("class","form-group col-md-4 has-error");
		$("#telefono").parent().append("<span id='iconotexto' class='glyphicon glyphicon-remove form-control-feedback'></span>");
		return false;
	}else{
		if( isNaN(valor) ){
			$("#iconotexto").remove();
			$("#telefono").parent().parent().attr("class","form-group col-md-4 has-error");
			$("#telefono").parent().append("<span id='iconotexto' class='glyphicon glyphicon-remove form-control-feedback'></span>");
			return false;
		}if(valor.length<9){
			$("#iconotexto").remove();
			$("#telefono").parent().parent().attr("class","form-group col-md-4 has-error");
			$("#telefono").parent().append("<span id='iconotexto' class='glyphicon glyphicon-remove form-control-feedback'></span>");
			return false;
		}else{
			$("#iconotexto").remove();
			$("#telefono").parent().parent().attr("class","form-group col-md-4 has-success");
			$("#telefono").parent().append("<span id='iconotexto' class='glyphicon glyphicon-ok form-control-feedback'></span>");
			return true;
		}
	}
}