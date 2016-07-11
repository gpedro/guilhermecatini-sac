<?php

require_once '../_lib/classes/Usuario.class.php';

$inf = json_decode(file_get_contents('php://input'));



if ($inf->go == 'login') {

	$cls = new Usuario();

	$ax = $cls->getUserByLogin($inf->vm->usuario, $inf->vm->senha);

	if ($ax) {
		@session_start();
		$_SESSION['usuario']['cod_usuario'] = $ax['cod_usuario'];
		$_SESSION['usuario']['nome'] = $ax['nome'];
		echo json_encode($ax);
	} else {
		echo false;
	}

}