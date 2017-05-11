function validar(){
	var usuario,clave;
	usuario=document.getElementById("usuario").value;
	clave=document.getElementById("clave").value;

	expresion = /\w+@\w+\.+[a-z]/;

	if(usuario===""){
		alert("El campo usuario esta vacio");
		return false;
	}

	if(!expresion.test(usuario)){
		alert("Correo invalido")
		return false;
	}

	if(clave===""){
		alert("El campo contraseña esta vacio");
		return false;
	}
}