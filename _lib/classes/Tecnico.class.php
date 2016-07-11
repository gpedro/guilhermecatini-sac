<?php

class Tecnico {

	private $con;
	private $codigo;
	private $nome;

	public function __construct(\PDO $con) {
		$this->con = $con;
	}

	public function getAll() {
		$query = "SELECT * FROM tecnico ORDER BY codigo";
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function getTecnicoByCodigo($codigo) {
		$query = "SELECT * FROM tecnico WHERE codigo = :codigo";
		$stmt = $this->con->prepare($query);
		$stmt->bindValue(":codigo", $codigo);
		$stmt->execute();
		return $stmt;
	}


}