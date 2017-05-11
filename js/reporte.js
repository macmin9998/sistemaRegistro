    function activar1(){
         var cana1=document.getElementById("text1").disabled=false;
         var cana2=document.getElementById("datepicker").disabled=true;
         var cana3=document.getElementById("datepicker1").disabled=true;

    if (document.form.datepicker.disabled==true){
        document.form.datepicker.value = "";
        }

    if (document.form.datepicker1.disabled==true){
        document.form.datepicker1.value = "";
        }
    }

    function activar2(){
         var cana1=document.getElementById("text1").disabled=true;
         var cana2=document.getElementById("datepicker").disabled=false;
         var cana3=document.getElementById("datepicker1").disabled=false;

        
    if (document.form.text1.disabled==true){
        document.form.text1.value = "";
        }

    }

    function activar3(){
         var cana1=document.getElementById("text1").disabled=false;  
         var cana2=document.getElementById("datepicker").disabled=false;
         var cana3=document.getElementById("datepicker1").disabled=false;
    }

    function validar()
    {
        var nombre, fechainicio, fechafinal ;
        var expresion = /\w+@\w+\.+[a-z]/;

        nombre=document.getElementById("text1").value;
        fechainicio=document.getElementById('datepicker').value;
        fechafinal= document.getElementById('datepicker1').value;

        if (document.form.text1.disabled==false) 
            {
                if(nombre==="")
                {
                    alert("El campo nombre esta vacio");
                    return false;
                }
                if(!expresion.test(nombre))
                {
                    alert("Correo invalido")
                    return false;
                }
            }

        if (document.form.datepicker.disabled==false) 
            {
                if(fechainicio==="")
                {
                    alert("La fecha de inicio esta vacia");
                    return false;
                }

                var checador =fechainicio.split("/");
                var aux_mes=parseInt(checador[0]);
                var aux_dia=parseInt(checador[1]);
                var aux_a = parseInt(checador[2]);
                if (aux_mes>12 || aux_dia>31 || 1990>aux_a || aux_a>2100)  
                {
                   alert("La fecha de inicio no es valida"); 
                }
            }
                 
        if (document.form.datepicker1.disabled==false) 
            {
                if(fechafinal==="")
                {   
                    alert("La fecha del final esta vacia");
                    return false;
                }
                var checador_final =fechafinal.split("/");
                var aux_mes_final=parseInt(checador_final[0]);
                var aux_dia_final=parseInt(checador_finla[1]);
                var aux_a_final = parseInt(checador_final[2]);
                if (aux_mes_final>12 || aux_dia_final>31 || 1990>aux_a_final || aux_a_final>2100)  
                {
                   alert("La fecha del final no es valida"); 
                }
            }
        
    }
    

