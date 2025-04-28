<?php

  function verificaInput($valorInput){
      $nInput="";
      $nInput = trim($valorInput);
      $nInput = stripslashes($nInput);
      $nInput = htmlspecialchars($nInput);
      $nInput = str_replace(array('\\','/',':','*','?','"','<','>','|','“',"”","%","&"),'',$nInput);
      //$nInput = ucwords(strtolower($nInput));
      return $nInput;
  }

  function verifica($valorInput){
    if (is_array($valorInput)) {
      foreach ($valorInput as &$value) {
        $value = verifica($value); // Llamada recursiva para sanear cada elemento del array
      }
      unset($value); // Liberar la referencia al último elemento del array
    } else {
      $valorInput = trim($valorInput); // Eliminar espacios en blanco al inicio y al final
      $valorInput = stripslashes($valorInput); // Eliminar barras invertidas
      $valorInput = htmlspecialchars($valorInput); // Convertir caracteres especiales en entidades HTML
    }
    return $valorInput;
  }




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

  // htmlspecialchars_decode($str, ENT_QUOTES);

/*
  function verifica($valorInput){
      $nInput="";
      //$nInput = trim($valorInput);
      //$nInput = stripslashes($nInput);
      //$nInput = htmlspecialchars($nInput);
      //$nInput = ucwords(strtolower($nInput));

      if (is_array($valorInput)) {
        foreach ($valorInput as &$value) {
          $value = verifica($value); // Llamada recursiva para sanear cada elemento del array
        }
        unset($value); // Liberar la referencia al último elemento del array
      } else {
        $valorInput = trim($valorInput); // Eliminar espacios en blanco al inicio y al final
        $valorInput = stripslashes($valorInput); // Eliminar barras invertidas
        $valorInput = htmlspecialchars($valorInput); // Convertir caracteres especiales en entidades HTML
      }

      return $valorInput;
  }
  */




?>