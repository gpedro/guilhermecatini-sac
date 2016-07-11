<?php

require_once '../_lib/classes/Conexao.class.php';
require_once '../_lib/classes/Tecnico.class.php';
require_once '../_lib/classes/Protocolo.class.php';

$c = new Conexao();

$dt = json_decode(file_get_contents('php://input'));

if ($dt->go == 'getTecnicos') {
	$Tecnico = new Tecnico($c->getCon());
	$stmt = $Tecnico->getAll();
	echo json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));
} 

if ($dt->go == 'Insert') {
	$Protocolo = new Protocolo($c->getCon());
	$Protocolo->setDescricao($dt->data->descricao);
	$Protocolo->setTecnico($dt->data->tecnico);
	$Protocolo->setPrioridade($dt->data->prioridade);
	$Protocolo->setStatus($dt->data->situacao);
	$stmt = $Protocolo->Insert();
	if ($stmt) {
		echo true;
	} else {
		echo false;
	}
}

if ($dt->go == 'Update') {
	$Protocolo = new Protocolo($c->getCon());
	$Protocolo->setDescricao($dt->data->descricao);
	$Protocolo->setTecnico($dt->data->tecnico);
	$Protocolo->setPrioridade($dt->data->prioridade);
	$Protocolo->setStatus($dt->data->situacao);
	$Protocolo->setSequencia($dt->data->sequencia);
	$stmt = $Protocolo->Update();
	if ($stmt) {
		echo true;
	} else {
		echo false;
	}
}

if ($dt->go == 'getProtocoloBySequencia') {
	$p = new Protocolo($c->getCon());
	$stmt = $p->getProtocoloBySequencia($dt->protocolo);
	if ($stmt->rowCount() == 1) {
		echo json_encode($stmt->fetch(\PDO::FETCH_ASSOC));
	} else {
		echo false;
	}
}

if ($dt->go == 'getAll') {

	$query = "
		SELECT protocolo.sequencia,
		       lpad(protocolo.sequencia::text, 8, '0') as sequencia_string,
		       protocolo.descricao,
		       CASE WHEN status = 'A' THEN 'Aberto'
		       WHEN status = 'B' THEN 'Baixado'
		       WHEN status = 'C' THEN 'Cancelado'
		       ELSE 'Status Desconhecido' END AS status,
		       protocolo.descricao,
		       protocolo.tecnico,
		       tecnico.nome as tecnico_nome,
		       CASE WHEN prioridade = 1 THEN 'Alta'
		       WHEN prioridade = 2 THEN 'Média'
		       WHEN prioridade = 3 THEN 'Baixa' END AS prioridade
		  FROM protocolo

		  JOIN tecnico
		    ON tecnico.codigo = protocolo.tecnico

	  ORDER BY protocolo.sequencia
	";

	$con = $c->getCon();
	$stmt = $con->prepare($query);
	$stmt->execute();

	echo json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));

	// $p = new Protocolo($c->getCon());
	// $t = new Tecnico($c->getCon());
	// $stmt = $p->getAll();
	// $aux = $stmt->fetchAll(\PDO::FETCH_ASSOC);
	
	// for ($i=0;$i<count($aux);$i++) {
	// 	$tec = $t->getTecnicoByCodigo($aux[$i]['tecnico']);
	// 	$ax = $tec->fetch(\PDO::FETCH_ASSOC);
	// 	$aux[$i]['tecnico_nome'] = $ax['nome'];
	// }
	// echo json_encode($aux);
}