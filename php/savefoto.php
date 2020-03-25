<?php
if (isset($_POST['imagen'])) {
	$variable=$_GET['codigo'];

   // funcion para gusrfdar la imagen base64 en el servidor
   // el nombre debe tener la extension
   function uploadImgBase64 ($base64, $name){
       // decodificamos el base64
       $datosBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
       // definimos la ruta donde se guardara en el server
       $path= $_SERVER['DOCUMENT_ROOT'].'/ejemplo/camara/'.$name;
       // guardamos la imagen en el server
       if(!file_put_contents($path, $datosBase64)){
           // retorno si falla
           return false;
       }
       else{
           // retorno si todo fue bien
           return true;
       }
   }

   // llamamos a la funcion uploadImgBase64( img_base64, nombre_fina.png) 
   uploadImgBase64($_POST['imagen'], 'codigo'.date('d_m_Y_H_i_s').'.png' );
}
?>

				<script type="text/javascript">
                         /* Enviar el trazado */
                       function GuardarTrazado(){
                         imagen.value=document.getElementById('canvas').toDataURL('image/png');
                         document.forms['formCanvas'].submit();
                       }
                  </script>