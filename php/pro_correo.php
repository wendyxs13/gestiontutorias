<?php
/**
* @abstract.- Envío de correo con enlace para responder la entrevista inicial
* @param.-    $alu_nom, $alu_ap $alu_correo, $alu_pass, $alu_id, datos de acceso del  alumno 
* @param.-    $opc.- opcion de contenido de correo
**/

function genera_codigo($alu_id){
    $t_id= $alu_id."";
    $tam = strlen($t_id); 
    $t=0;
    $con_id="";
    while($t < $tam){  ///se recorre el ID para generar una cadena que remplace los numeros por caracteres                   
        switch($t_id[$t]){  
            case '0': $etr="R";
            break;
            case '1': $etr="S";
            break;
            case '2': $etr="T";
            break;
            case '3': $etr="U";
            break;
            case '4': $etr="V";
            break;
            case '5': $etr="W";
            break;
            case '6': $etr="X";
            break;
            case '7': $etr="Y";
            break;
            case '8': $etr="Z";
            break;
            case '9': $etr="A";
            break;                  
        }
        $con_id= $con_id.$etr;
        $t++;
    }//fin while

    return $con_id;
}

function envia_enlace($alu_nom,$alu_correo, $alu_id, $codigo){
    $contenido="";  
    $header = "Content-type: text/html\r\n";          
    $subject = "Programa de Tutoría UAM-X"; 

    $liga="https://gestiontutorias.xoc.uam.mx/registro/activacion.php?r=".$codigo;
    $encabezado="";
    $contenido="Te informamos que tus datos de registro se han almacenado correctamente. Para responder el formulario de información inicial haz clic <b><a href='".$liga."'>aqu&iacute;</a></b>.<br />
        </p><br><br> 
        <p style='font-size: 11px; text-align: center;'>                                       
            El enlace para responder el formulario de información inicial es personal e intransferible, por favor no lo compartas con nadie.<br>
            Esta direcci&oacute;n de correo electr&oacute;nico no puede recibir respuestas
        </p>";

    $text="<html>
    <head>
        <title></title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans&display=swap' rel='stylesheet'>
        <style type='text/css'>
          .contenido{
             font-family: 'Open Sans', sans-serif;
             color: #5a5a5a;
          }         
        </style>
    </head>
    <body style='background-color: #FFF;'><br><br>
        <table  class='contenido' width='70%' border='0' align='center' cellpadding='2' cellspacing='0' style=' background:#FFF;'>
        <tr>           
            <td style='padding: 20px; font-size:16px; background-color:#232F41; color:#FFF;'>
              Programa de Tutoría
            </td>
        </tr>
          <tr>           
            <td style='padding-left: 30px; padding-right: 30px; font-size:16px;' >
                ".$encabezado."
                <p>Hola<b> ".$alu_nom."</b><br>
                ".$contenido."
                <br>                        
            </td>
        </tr>
     </table>
     <br><br>
    </body>
    </html>";
    include("phpMailer/envio_mail.php");
    return $envio;

   // return  mail($alu_correo,$subject,$text,$header);   
}

function envia_enlace_tutor($nombre,$correo, $id_tutor, $cod){

    $alu_correo = $correo;
    $alu_nom = $nombre;

    $contenido="";  
    $header = "Content-type: text/html\r\n";          
    $subject = "Programa de Tutoría UAM-X"; 

    $liga="https://gestiontutorias.xoc.uam.mx/tutoria/activacion.php?r=".$cod;
    $encabezado="";
    $contenido="Te informamos que tu registro ha sido exitoso. Para activar tu cuenta, por favor haz clic <b><a href='".$liga."'>AQU&Iacute;</a></b>. Una vez activada, podrás acceder al sistema y comenzar a capturar tu informe de tutoría.<br /></p><br><br><p style='font-size: 11px; text-align: center;'>El enlace para activar tu cuenta es personal e intransferible, por favor no lo compartas con nadie.<br>Esta direcci&oacute;n de correo electr&oacute;nico no puede recibir respuestas.</p>";
    $text="<html>
    <head>
        <title></title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans&display=swap' rel='stylesheet'>
        <style type='text/css'>
          .contenido{
             font-family: 'Open Sans', sans-serif;
             color: #5a5a5a;
          }         
        </style>
    </head>
    <body style='background-color: #FFF;'><br><br>
        <table  class='contenido' width='70%' border='0' align='center' cellpadding='2' cellspacing='0' style=' background:#FFF;'>
        <tr>           
            <td style='padding: 20px; font-size:16px; background-color:#232F41; color:#FFF;'>
              Programa de Tutoría
            </td>
        </tr>
          <tr>           
            <td style='padding-left: 30px; padding-right: 30px; font-size:16px;' >
                ".$encabezado."
                <p>Estimada/o: ".$nombre."</b><br> 
                ".$contenido."
                <br>                        
            </td>
        </tr>
     </table>
     <br><br>
    </body>
    </html>";
    include("phpMailer/envio_mail.php");
    return $envio; 
}

function notificacion_info_ind($num_tutor,$trimestre, $matricula,$cod_informe){

    $alu_correo = "ataa@correo.xoc.uam.mx";
    $alu_nom = "ATAA";

    $contenido="";  
    $header = "Content-type: text/html\r\n";          
    $subject = "Nuevo informe programa de Tutoría UAM-X"; 

    $liga="https://gestiontutorias.xoc.uam.mx/modulo/admin/informe_individual.php?r=".$cod_informe;
    $encabezado="";
    $contenido="Te informamos que el tutor con número economico ".$num_tutor." ha capturado un nuevo informe correspondiente a la matrícula ".$matricula.", del trimestre".$trimestre." Haz clic <b><a href='".$liga."'>aqu&iacute;</a></b> para consultarlo.<br /></p>";
    $text="<html>
    <head>
        <title></title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans&display=swap' rel='stylesheet'>
        <style type='text/css'>
          .contenido{
             font-family: 'Open Sans', sans-serif;
             color: #5a5a5a;
          }         
        </style>
    </head>
    <body style='background-color: #FFF;'><br><br>
        <table  class='contenido' width='70%' border='0' align='center' cellpadding='2' cellspacing='0' style=' background:#FFF;'>
        <tr>           
            <td style='padding: 20px; font-size:16px; background-color:#232F41; color:#FFF;'>
              Programa de Tutoría
            </td>
        </tr>
          <tr>           
            <td style='padding-left: 30px; padding-right: 30px; font-size:16px;' >
                ".$encabezado."
                <p>Estimada Mtra. Nancy<br> 
                ".$contenido."
                <br>                        
            </td>
        </tr>
     </table>
     <br><br>
    </body>
    </html>";
    include("phpMailer/envio_mail.php");
    return $envio; 
}

function notificacion_info_grupal($num_tutor,$trimestre){
    $alu_correo = "ataa@correo.xoc.uam.mx";
    $alu_nom = "ATAA";
    $num_eco = base64_encode($num_tutor);
    $trim = base64_encode($trimestre);

    $contenido="";  
    $header = "Content-type: text/html\r\n";          
    $subject = "Nuevo informe grupal del programa de Tutoría UAM-X"; 

    $liga="https://gestiontutorias.xoc.uam.mx/modulo/admin/informe_grupal.php?r=".$num_eco."&t=".$trim;
    $encabezado="";
    $contenido="Te informamos que el tutor con número economico ".$num_tutor." ha capturado un nuevo informe correspondiente trimestre ".$trimestre." . Haz clic <b><a href='".$liga."'>aqu&iacute;</a></b> para consultarlo.<br /></p>";
    $text="<html>
    <head>
        <title></title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans&display=swap' rel='stylesheet'>
        <style type='text/css'>
          .contenido{
             font-family: 'Open Sans', sans-serif;
             color: #5a5a5a;
          }         
        </style>
    </head>
    <body style='background-color: #FFF;'><br><br>
        <table  class='contenido' width='70%' border='0' align='center' cellpadding='2' cellspacing='0' style=' background:#FFF;'>
        <tr>           
            <td style='padding: 20px; font-size:16px; background-color:#232F41; color:#FFF;'>
              Programa de Tutoría
            </td>
        </tr>
          <tr>           
            <td style='padding-left: 30px; padding-right: 30px; font-size:16px;' >
                ".$encabezado."
                <p>Estimada Mtra. Nancy<br> 
                ".$contenido."
                <br>                        
            </td>
        </tr>
     </table>
     <br><br>
    </body>
    </html>";
    include("phpMailer/envio_mail.php");
    return $envio; 
}

?>