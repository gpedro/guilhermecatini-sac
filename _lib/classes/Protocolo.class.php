<?php

class Protocolo {

	private $con;

	private $sequencia;
	private $descricao;
	private $status;
	private $tecnico;
	private $prioridade;

	public function __construct(\PDO $con) {
		$this->con = $con;
	}

	public function Update() {
		$query = "UPDATE protocolo SET descricao = :descricao, status = :status, tecnico = :tecnico, prioridade = :prioridade
		           WHERE sequencia = :sequencia";
		$stmt = $this->con->prepare($query);
		$stmt->bindValue(":descricao", $this->descricao);
		$stmt->bindValue(":status", $this->status);
		$stmt->bindValue(":tecnico", $this->tecnico);
		$stmt->bindValue(":prioridade", $this->prioridade);
		$stmt->bindValue(":sequencia", $this->sequencia);
		$stmt->execute();
		return $stmt;

	}

	public function getAll() {
		$query = "SELECT sequencia, descricao, status, tecnico, prioridade FROM protocolo ORDER BY sequencia";

		$stmt = $this->con->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function getProtocoloBySequencia($sequencia) {
		$query = "SELECT descricao, status, tecnico, prioridade FROM protocolo WHERE sequencia = :sequencia";

		$stmt = $this->con->prepare($query);
		$stmt->bindValue(":sequencia", $sequencia);
		$stmt->execute();

		return $stmt;
	}


	public function Insert() {
		$query = "
			INSERT INTO protocolo (sequencia, descricao, status, tecnico, prioridade)
  			  VALUES ((SELECT COALESCE(MAX(sequencia), 0) + 1 FROM protocolo), :descricao, :status, :tecnico, :prioridade)
		";

		$stmt = $this->con->prepare($query);
		$stmt->bindValue(":descricao", $this->descricao);
		$stmt->bindValue(":status", $this->status);
		$stmt->bindValue(":tecnico", $this->tecnico);
		$stmt->bindValue(":prioridade", $this->prioridade);

		$stmt->execute();

		return $stmt;

	}

	public function setSequencia($sequencia) {
		$this->sequencia = $sequencia;
	}

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	public function setTecnico($tecnico) {
		$this->tecnico = $tecnico;
	}

	public function setPrioridade($prioridade) {
		$this->prioridade = $prioridade;
	}


}