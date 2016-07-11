<?php

require_once 'Conexao.class.php';

Class Usuario extends Conexao {

	private $con;

	public function __construct() {
		$this->con = $this->getCon();
	}

	public function getUserByLogin($login, $senha) {
		$query = "SELECT * FROM usuario WHERE login = :login AND senha = :senha";
		$stmt = $this->con->prepare($query);
		$stmt->bindValue(":login",$login);
		$stmt->bindValue(":senha",md5($senha));
		$stmt->execute();
		$res = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $res;
	}




}