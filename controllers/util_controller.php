<?php 

$inf = json_decode(file_get_contents('php://input'));

if ($inf->go == 'LimparSessao') {
	@session_start();
	@session_destroy();
}