<?php
@session_start();

$inf = json_decode(file_get_contents('php://input'));

if ($inf->go == 'sys') {
	if (isset($_SESSION['usuario']['nome'])) {
		echo json_encode($_SESSION);
	} else {
		echo false;
	}
}