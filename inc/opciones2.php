
<?php 
$mod = isset($_GET['admin']) ? str_replace('.', '', $_GET['admin']) : '';


if($mod) {
	$dir = "admin/{$mod}.php";
	
	if($dir) {	
			include($dir);
		
	} else {
		echo('El modulo no existe');
	}
	
} else {
	echo 'Selecciona una opcion del menu.';
	echo '</div>';
} 
