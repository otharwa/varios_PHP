<?php
include('arrays.php');

function menu($seccionId){
	global $menu;
	
	if($seccionId==false) {$seccionId=$menu[0]['id'];}
	
	foreach($menu as $menuArray){
		echo "<li><a href=\"index.php?seccion=$menuArray[id]\"";
		
		if($seccionId==$menuArray['id']){echo ' class="aqui"';}
		
		echo ">$menuArray[mostrar]</a></li>";
	}
}

function contenido($seccionId){
	global $menu;
	
	if($seccionId==false) { $seccionId=$menu[0]['id']; }
	
	foreach($menu as $menuArray){
		if($seccionId==$menuArray['id']){
			include($carpeta.$menuArray['archivo'].'.php'); 
		}
	}
	
	if($seccionId=='enviar') { echo'<h1>Enviar</h1>'; include($carpeta.'enviar.php'); }
}

function redes_sociales(){
	global $social;
	
	foreach($social as $socialArray){
		echo "<li><a href=\"$socialArray[url]\" ><img src=\"img/$socialArray[img]\" alt=\"$socialArray[alt]\" /></a></li>";
	}
}

function menu_galeria($seccionId,$porfolioId){
	global $materias;
	
	foreach($materias as $materiasArray => $atributo){
		echo "<li><a href=\"index.php?seccion=$seccionId&porfolio=$atributo[id]\"";
		
		if($porfolioId==$atributo['id']){echo ' class="aqui"';}
		
		echo ">$atributo[nombre]</a></li>";	
	}
}

function muestras($seccionId,$porfolioId,$ampliar){
	global $trabajos;
	
	foreach($trabajos as $trabajosArray => $atributo){	
		if(!$porfolioId || $porfolioId == null) { $porfolioId=$materias[0]['id'];}
			
		if($porfolioId==$atributo['categMateria']){
		
			if($ampliar==$atributo['archivo']){echo "<div class=\"muestras ampliar\"><div>"; }
			else {echo "<div class=\"muestras\"><div>";}
			echo "<a href=\"index.php?seccion=$seccionId&porfolio=".$porfolioId;
			
			if($ampliar==false){echo "&ampli=$atributo[archivo]";}
			else {echo "&ampli=false";}

			echo "\"><img src=\"art/$atributo[archivo]\" alt=\"$atributo[alt]\"/></a>";
			echo "</div>";
			if($ampliar==$atributo['archivo']){echo "<div><p>$atributo[descripcion]</p></div>";}
			else {echo "";}
			
			echo "</div>";
		}
	}
}

function form_contacto() {
	
	if(isset($_POST['nombre'])){$n = $_POST['nombre'];}
	if(isset($_POST['apellido'])){$a = $_POST['apellido'];}
	if(isset($_POST['correo'])){$correo = $_POST['correo'];}
	if(isset($_POST['mensaje'])){$m = $_POST['mensaje'];}
	
	if(isset($_POST['sistema'])){$sistema = implode(', ',$_POST['sistema']);}
	if(isset($_POST['como_llego'])){$cmllg = $_POST['como_llego'];}
	
	if(isset($_POST['status'])){$status = $_POST['status'];}
	
	if($n!=null && $a!=null && $correo!=null) {
					include_once($carpeta.'enviar.php');
		}
}

function validarGet($datoArray) {
	global $listaArrays;
	
	if(!isset($datoArray) || $datoArray==null){return false;} 
	
	$valido=false;
	foreach($listaArrays as $nombreArray){
		foreach($nombreArray as $array2 => $array3){
			foreach($array3 as $array4 => $valor){
				if($datoArray==$valor){$valido=true;}
			} 
		}	 
	}
	switch($valido) {
		case false:return false; break;
		case true: return $datoArray; break;
	}
}
function administracion(){
	
}
 ?>
