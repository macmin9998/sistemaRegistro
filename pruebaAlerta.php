

<html>		
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script type="text/javascript">
function mostrar(){
document.getElementById('oculto').style.display = 'block';}

$(document).ready(function () {
 
            (function ($) {
 
                $('#filtrar').keyup(function () {
 
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
 
                })
 
            }(jQuery));
 
        });




</script>





</head>


<body>
	

	

<div class="alert alert-info" role="alert" id='oculto' style='display:none;' >Esta es una alerta</div>




<input type="button" value="Mostrar" onclick="mostrar()"> 
</body>


</html>