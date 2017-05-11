<?php
    function getPost($var){
   	  $v = isset($_POST[$var]) ? $_POST[$var] : "NO";
   	  return $v;
   }
   $Ws = getPost("Ws");
  switch ($Ws) {
    case 'getColaborador':
      $empresa = getPost("Empresa");
      if($empresa == "NO" || $empresa == "")
        echo "Falta parametro empresa";
      $BusquedaVisitante1=$dbconection->query("select 
                       id_colaborador,
                       nombre 
                  from 
                       Colaborador 
                  where 
                       id_empresa in (
                       select
                          id_empresa
                         from
                          Empresa
                         where
                          nombre= '$empresa' 
                          )");
      echo $BusquedaVisitante1 ['id_colaborador'];
      break;
  }

      

?>