<?php

class Conexion
{
	public $conexion;
	public function __construct()
	{
		try
		{
			$this->conexion=new PDO("mysql:host=localhost;dbname=diplopac_carnets","root","");
		}
		catch(PDOexception $c){
			$this->conexion=new PDO("mysql:host=190.8.176.37;dbname=diplopac_carnets","diplopac","!h_Y2m_y8_X5gX2W");
			// echo "error de conexion";
		}
	}
	public function __destruct()
	{
		$this->conexion = null;
	}
}
/**
 * 
 */
class Usuarios extends Conexion{
	
	public function consultar_colegios()
	{
		$orden=$this->conexion->prepare("
			SELECT * FROM
			colegios
			");
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegio($codigo,$grado,$curso){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			WHERE 
			SUBSTR(es.cod_col,1,2) = :codigo and es.grado = :grado and es.curso = :curso
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->bindParam(":grado",$grado);
		$orden->bindParam(":curso",$curso);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegio2v($codigo,$grado){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			WHERE 
			es.cod_col = :codigo and es.grado = :grado
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->bindParam(":grado",$grado);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegio1v($codigo){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			WHERE 
			substr(es.cod_col,1,2) = :codigo
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegios($codigo,$grado,$curso){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			WHERE 
			es.cod_col = :codigo and es.grado = :grado and es.curso = :curso
			AND nofoto <> ''
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->bindParam(":grado",$grado);
		$orden->bindParam(":curso",$curso);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegio2vs($codigo,$grado){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			WHERE 
			SUBSTR(es.cod_col,1,2) = :codigo and es.grado = :grado
			AND nofoto <> ''
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->bindParam(":grado",$grado);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegio1vs($codigo){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			WHERE 
			substr(es.cod_col,1,2) = :codigo
			AND nofoto <> ''
			ORDER BY
			grado, curso, lista ASC
			");
		$orden->bindParam(":codigo",$codigo);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegioCompleto($codigo){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista,substr(cod_est,3,1)as modo,substr(cod_est,4,1) as sede, substr(cod_est,5,1) as jornada
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			WHERE 
			substr(es.cod_col,1,2) = :codigo
			ORDER BY
			grado, curso, lista ASC
			");
		$orden->bindParam(":codigo",$codigo);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegion($codigo,$grado,$curso){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			WHERE 
			es.cod_col = :codigo and es.grado = :grado and es.curso = :curso
			AND nofoto = ''
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->bindParam(":grado",$grado);
		$orden->bindParam(":curso",$curso);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegio2vn($codigo,$grado){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			WHERE 
			es.cod_col = :codigo and es.grado = :grado
			AND nofoto = ''
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->bindParam(":grado",$grado);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegio1vn($codigo){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			WHERE 
			es.cod_col = :codigo
			AND nofoto = ''
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function SubirFoto($cod_est,$usuario){
		$orden=$this->conexion->prepare("
			UPDATE estudiantes SET
			nofoto = :cod_est,
			fecha_m = CURRENT_DATE,
			usuario = :usuario
			WHERE cod_est = :cod_est
			");
		$orden->bindParam(":cod_est",$cod_est);
		$orden->bindParam(":usuario",$usuario);
		$orden->execute();
	}

	public function ConsultaDatosEstudiante($cod_est){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,col.jornada,jor.nom_jor
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			join jornadas jor on col.jornada = jor.cod_jor
			WHERE 
			es.cod_est= :cod_est
			");
		$orden->bindParam(":cod_est",$cod_est);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function SubirFotoNueva($cod_est,$cod_col,$grado,$curso,$lista,$apellidos,$nombres,$tipdoc,$documento,$usuario){
		$orden=$this->conexion->prepare("
			INSERT INTO `estudiantes`
			(`cod_est`, `cod_col`, `grado`, `curso`, `lista`, `apellidos`, `nombres`, `tipdoc`, `documento`, `direccion`,
			`telefono`, `rh`, `eps`, `consecutivo`, `nummatricula`, `nofoto`, `sexo`, `fecha_ncto`, `lugncto`, `estado`,
			`fecretiro`, `madre`, `padre`, `acudiente`, `barrio`, `localidad`, `estrato`, `rutafoto`, `impresion`,
			`remiendo`, `cargo`, `camara`, `imp_respaldos`, `carpeta`, `fecha_c`, `fecha_m`, `usuario`)
			VALUES 
			(:cod_est,:cod_col,:grado,:curso,:lista,:apellidos,:nombres,:tipdoc,:documento,'',
			'','','','','',:cod_est,'','','','',
			'','','','','','','','','','',
			'','','','',CURRENT_DATE,CURRENT_DATE,:usuario)
			");
		$orden->bindParam(":cod_est",$cod_est);
		$orden->bindParam(":cod_col",$cod_col);
		$orden->bindParam(":grado",$grado);
		$orden->bindParam(":curso",$curso);
		$orden->bindParam(":lista",$lista);
		$orden->bindParam(":apellidos",$apellidos);
		$orden->bindParam(":nombres",$nombres);
		$orden->bindParam(":tipdoc",$tipdoc);
		$orden->bindParam(":documento",$documento);
		$orden->bindParam(":usuario",$usuario);
		$orden->execute();
	}
}
/**
 * 
 */
class Consultas extends Conexion{
	
	public function ConsultaGrados($cod_col){
		$orden=$this->conexion->prepare("
			SELECT DISTINCT(grado) FROM estudiantes e
			WHERE Substr(e.cod_col,1,2) = :cod_col
			ORDER BY grado ASC
			");
		$orden->bindParam(":cod_col",$cod_col);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaGradosListado($cod_col){
		$orden=$this->conexion->prepare("
			SELECT DISTINCT(cod_grado) FROM grados g 
			inner JOIN estudiantes e on g.cod_grado = e.grado
			WHERE substr(e.cod_col,1,2) = :cod_col
			ORDER BY cod_grado ASC
			");
		$orden->bindParam(":cod_col",$cod_col);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaColegiosR(){
		$orden=$this->conexion->prepare("
			SELECT distinct(cod_col_gral), nom_col, sede, jornada, seccion, estado, tipocol, impreso, direccion ,jor.nom_jor
			FROM colegios co inner join jornadas jor ON co.jornada=jor.cod_jor
			ORDER BY cod_col ASC
			");
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaColegios(){
		$orden=$this->conexion->prepare("
			SELECT cod_col, cod_col_gral, nom_col, sede, jornada, seccion, estado, tipocol, impreso, direccion ,jor.nom_jor
			FROM colegios co inner join jornadas jor ON co.jornada=jor.cod_jor
			ORDER BY cod_col ASC
			");
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaCodigoColegios(){
		$orden=$this->conexion->prepare("
			SELECT DISTINCT(cod_col_gral), nom_col
			FROM colegios
			ORDER BY cod_col_gral ASC
			");
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}



	public function ConsultaColegiosId($cod_col_gral){
		$orden=$this->conexion->prepare("
			SELECT cod_col, cod_col_gral, nom_col, sede, jornada, seccion, estado, tipocol, impreso, direccion ,
			jor.nom_jor,substr(cod_col,3,1) as sec
			FROM colegios co inner join jornadas jor ON co.jornada=jor.cod_jor
			WHERE cod_col_gral = :cod_col_gral
			ORDER BY cod_col, sede, jornada ASC
			");
		$orden->bindParam(":cod_col_gral",$cod_col_gral);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaColegiosIdCompleto($cod_col){
		$orden=$this->conexion->prepare("
			SELECT cod_col_gral, nom_col
			FROM colegios
			WHERE substr(cod_col,1,2) = :cod_col
            limit 1
			");
		$orden->bindParam(":cod_col",$cod_col);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaJornadas(){
		$orden=$this->conexion->prepare("
			SELECT cod_jor, nom_jor FROM jornadas
			");
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}
	public function ConsultaJornadasCamara($cod_col){
		$orden=$this->conexion->prepare("
			select DISTINCT(cod_col) from estudiantes WHERE substr(cod_col,1,2)=:cod_col
			");
		$orden->bindParam(":cod_col",$cod_col);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaCursos($cod_col){
		$orden=$this->conexion->prepare("
			SELECT DISTINCT(curso) FROM estudiantes e
			where Substr(e.cod_col,1,2) = :cod_col
			ORDER BY curso ASC
			");
		$orden->bindParam(":cod_col",$cod_col);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaCursosListado($cod_col){
		$orden=$this->conexion->prepare("
			SELECT DISTINCT(codigo) from cursos c 
			LEFT JOIN estudiantes e on c.codigo = e.curso
			WHERE substr(cod_col,1,2) = :cod_col
			ORDER BY codigo ASC
			");
		$orden->bindParam(":cod_col",$cod_col);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaColegioFechaReporte($cod_col,$fecha){
		$orden=$this->conexion->prepare("
			SELECT `cod_est`, `cod_col`, `grado`, `curso`, `lista`, `apellidos`, `nombres`, `tipdoc`, `documento`, `direccion`, `telefono`, `rh`, `eps`, `consecutivo`, `nummatricula`, `nofoto`, `sexo`, `fecha_ncto`, `lugncto`, `estado`, `fecretiro`, `madre`, `padre`, `acudiente`, `barrio`, `localidad`, `estrato`, `rutafoto`, `impresion`, `remiendo`, `cargo`, `camara`, `imp_respaldos`, `carpeta`, `fecha_c`, `fecha_m`, `usuario` FROM `estudiantes` WHERE substr(cod_col,1,2) = :cod_col AND fecha_m = :fecha or substr(cod_col,1,2) = :cod_col AND fecha_c = :fecha
			");
		$orden->bindParam(":cod_col",$cod_col);
		$orden->bindParam(":fecha",$fecha);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaColegioReporte($cod_col){
		$orden=$this->conexion->prepare("
			SELECT `cod_est`, `cod_col`, `grado`, `curso`, `lista`, `apellidos`, `nombres`, `tipdoc`, `documento`, `direccion`, `telefono`, `rh`, `eps`, `consecutivo`, `nummatricula`, `nofoto`, `sexo`, `fecha_ncto`, `lugncto`, `estado`, `fecretiro`, `madre`, `padre`, `acudiente`, `barrio`, `localidad`, `estrato`, `rutafoto`, `impresion`, `remiendo`, `cargo`, `camara`, `imp_respaldos`, `carpeta`, `fecha_c`, `fecha_m`, `usuario` FROM `estudiantes` WHERE substr(cod_col,1,2) = :cod_col
			");
		$orden->bindParam(":cod_col",$cod_col);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaColegioGeneral(){
		$orden=$this->conexion->prepare("
			SELECT `cod_est`, `cod_col`, `grado`, `curso`, `lista`, `apellidos`, `nombres`, `tipdoc`, `documento`, `direccion`, `telefono`, `rh`, `eps`, `consecutivo`, `nummatricula`, `nofoto`, `sexo`, `fecha_ncto`, `lugncto`, `estado`, `fecretiro`, `madre`, `padre`, `acudiente`, `barrio`, `localidad`, `estrato`, `rutafoto`, `impresion`, `remiendo`, `cargo`, `camara`, `imp_respaldos`, `carpeta`, `fecha_c`, `fecha_m`, `usuario` FROM `estudiantes`
			");
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	// consultas para vista carnets
	public function ConsultarPorColegiofotos($codigo,$grado,$curso){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista,col.sede,jor.nom_jor
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			inner JOIN jornadas jor on col.jornada = jor.cod_jor
			WHERE 
			es.cod_col = :codigo and es.grado = :grado and es.curso = :curso AND nofoto <> ''
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->bindParam(":grado",$grado);
		$orden->bindParam(":curso",$curso);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegio2vfotos($codigo,$grado){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista,col.sede,jor.nom_jor
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			inner JOIN jornadas jor on col.jornada = jor.cod_jor
			WHERE 
			es.cod_col = :codigo and es.grado = :grado AND nofoto <> ''
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->bindParam(":grado",$grado);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultarPorColegio1vfotos($codigo){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista,col.sede,jor.nom_jor
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			inner JOIN jornadas jor on col.jornada = jor.cod_jor
			WHERE 
			es.cod_col = :codigo AND nofoto <> ''
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaCamara($codigo,$grado,$curso,$jornada){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,nofoto,consecutivo,lista
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			WHERE 
			substr(es.cod_col,1,2) = :codigo :grado :curso :jornada
			ORDER BY
			grado, curso, lista ASC

			");
		$orden->bindParam(":codigo",$codigo);
		$orden->bindParam(":grado",$grado);
		$orden->bindParam(":curso",$curso);
		$orden->bindParam(":jornada",$jornada);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function UltimoDeLista($cod_col,$grado,$curso){
		$orden=$this->conexion->prepare("
			select max(lista) as lista FROM estudiantes WHERE cod_col=:cod_col AND grado=:grado AND curso=:curso
			");
		$orden->bindParam(":cod_col",$cod_col);
		$orden->bindParam(":grado",$grado);
		$orden->bindParam(":curso",$curso);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaTipdoc(){
		$orden=$this->conexion->prepare("
			SELECT tip_doc, nom_doc from tipo_doc
			");
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaConsolidados($cod_col_gral,$fecha){
		$orden=$this->conexion->prepare("
			SELECT es.cod_col,col.nom_col, es.grado, es.curso, COUNT(cod_est) as Fotos_tomadas,
			(SELECT COUNT(cod_est) FROM estudiantes	WHERE substr(cod_col,1,2)=:cod_col_gral AND nofoto = '' and 
			es.grado=grado and es.curso=curso) AS Fotos_faltantes
			FROM estudiantes es INNER JOIN colegios col on es.cod_col = col.cod_col
			WHERE substr(ES.cod_col,1,2)=:cod_col_gral AND nofoto <> '' AND fecha_m = :fecha
			OR substr(ES.cod_col,1,2)= :cod_col_gral AND nofoto <> '' AND fecha_c = :fecha
			GROUP by grado, curso
			");
		$orden->bindParam(":cod_col_gral",$cod_col_gral);
		$orden->bindParam(":fecha",$fecha);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaImprimirCarnets($codigo){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista,col.sede,jor.nom_jor
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			inner JOIN jornadas jor on col.jornada = jor.cod_jor
			WHERE 
			substr(es.cod_col,1,2) = :codigo AND nofoto <> ''
			ORDER BY
			grado, curso, lista ASC
			");
		$orden->bindParam(":codigo",$codigo);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsultaImprimirCarnets2($codigo,$remiendo){
		$orden=$this->conexion->prepare("
			SELECT 
			cod_est,es.cod_col,grado,curso,lista,apellidos,nombres,tp.nom_doc,documento,col.nom_col,nofoto,consecutivo,lista,col.sede,jor.nom_jor
			FROM 
			estudiantes es 
			inner JOIN tipo_doc tp on tp.tip_doc = es.tipdoc
			inner JOIN colegios col on col.cod_col = es.cod_col
			inner JOIN jornadas jor on col.jornada = jor.cod_jor
			WHERE 
			substr(es.cod_col,1,2) = :codigo AND nofoto <> '' and remiendo = :remiendo
			ORDER BY
			grado, curso, lista ASC
			");
		$orden->bindParam(":codigo",$codigo);
		$orden->bindParam(":remiendo",$remiendo);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsolidadoDatos($codigo){
		$orden=$this->conexion->prepare("
			select cod_col,grado, curso, count(cod_est) as cantidad from estudiantes
			WHERE substr(cod_col,1,2)=:codigo AND nofoto <> ''
			group by cod_col,grado, curso  
			ORDER BY cod_col,grado,curso asc
			");
		$orden->bindParam(":codigo",$codigo);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

	public function ConsolidadoJornadas($codigo){
		$orden=$this->conexion->prepare("
			select DISTINCT(es.cod_col), co.cod_col_gral, co.nom_col, co.sede, co.jornada, co.seccion, co.estado, co.tipocol,jor.nom_jor,substr(es.cod_col,3,1) as sec
			FROM estudiantes es inner join colegios co on es.cod_col=co.cod_col 
			inner join jornadas jor ON co.jornada=jor.cod_jor
			WHERE substr(es.cod_col,1,2)=:codigo AND es.nofoto <> ''
			group by es.cod_col,es.grado, es.curso  
			ORDER BY es.cod_col,es.grado,es.curso asc
			");
		$orden->bindParam(":codigo",$codigo);
		$orden->execute();
		return($orden->fetchAll(PDO::FETCH_OBJ));
	}

}

?>