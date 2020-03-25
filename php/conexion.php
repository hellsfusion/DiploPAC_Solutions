<?php
	$mysqli=new mysqli("190.8.176.37","diplopac","!h_Y2m_y8_X5gX2W","diplopac_carnets"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos	
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
	
?>