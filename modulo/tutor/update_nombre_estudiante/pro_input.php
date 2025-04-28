<?php

function verificaInput($valorInput){
      $nInput="";
      $nInput = trim($valorInput);
      $nInput = stripslashes($nInput);
      //$nInput = htmlspecialchars($nInput);
      $nInput = ucwords(strtolower($nInput));
      return $nInput;
  }

 // htmlspecialchars_decode($str, ENT_QUOTES);

  function verificaInputVal($valorInput2){
      $nInput2="";
      $nInput2 = trim($valorInput2);
      $nInput2 = stripslashes($nInput2);
      $nInput2 = htmlspecialchars($nInput2);
      //$nInput2 = htmlspecialchars($nInput2, ENT_COMPAT);
      //$nInput = html_entity_decode($nInput);
      $nInput2 = str_replace(array('\\','/',':','*','?','"','<','>','|','“',"”"),'',$nInput2);
      return $nInput2;
  }


?>