'use strict';

angular.module('Protocolo', [])

.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
	$locationProvider.html5Mode(false);
	$routeProvider
	.when('/menu/protocolo/listar', {
		templateUrl: 'views/protocolo/protocolo_listar.html'
		,controller: 'ProtocoloController'
		,controllerAs: 'P'
	})
	.when('/menu/protocolo/alterar/:sequencia', {
		templateUrl: 'views/protocolo/protocolo_update.html'
		,controller: 'ProtocoloController'
		,controllerAs: 'P'
	})
	.otherwise({redirectTo: '/'});
}])
.controller('ProtocoloController', ProtocoloController);


function ProtocoloController($http, $routeParams) {
	
	let vm = this;

	vm.routeParams = $routeParams;

	vm.dados = new Object();
	vm.dados.tecnico = 2;
	vm.dados.situacao = 'A';
	vm.dados.prioridade = 1;

	vm.getTecnico = getTecnico;
	function getTecnico() {
		Loading(true);
		$http.post('controllers/protocolo_controller.php', {'go':'getTecnicos'})
		.success(function(ret){
			vm.Tecnico = ret;
			Loading(false);
		});
	}

	vm.Insert = Insert;
	function Insert(data) {
		Loading(true);
		$http.post('controllers/protocolo_controller.php', {'go':'Insert', 'data':data})
		.success(function(ret){
			if (Boolean(ret) == true) {
				toastr["success"]("Protocolo Cadastrado com Sucesso", "Info:");
				location.reload();
			} else {

			}
			Loading(false);
		});
	}

	vm.Update = Update;
	function Update(data) {
		Loading(true);
		$http.post('controllers/protocolo_controller.php', {'go':'Update', 'data':data})
		.success(function(ret){
			if (Boolean(ret) == true) {
				toastr["success"]("Protocolo Atualizado com Sucesso", "Info:");
			} else {

			}
			Loading(false);
		});
	}

	vm.getAll = getAll;
	function getAll() {
		getTecnico();
		Loading(true);
		$http.post('controllers/protocolo_controller.php', {'go':'getAll'})
		.success(function(ret){

			console.log(ret);

			vm.ax_rel = ret;

			// for (var i=0;i<vm.ax_rel.length;i++) {
			// 	switch (vm.ax_rel[i].status) {
			// 		case 'A':
			// 			vm.ax_rel[i].status = 'Aberto';
			// 			break;
			// 		case 'B':
			// 			vm.ax_rel[i].status = 'Baixado';
			// 			break;
			// 		case 'C':
			// 			vm.ax_rel[i].status = 'Cancelado';
			// 			break;
			// 	}
			// }

			// for (var i=0;i<vm.ax_rel.length;i++) {
			// 	switch (vm.ax_rel[i].prioridade.toString()) {
			// 		case '3':
			// 			vm.ax_rel[i].prioridade = 'Baixa';
			// 			break;
			// 		case '2':
			// 			vm.ax_rel[i].prioridade = 'Média';
			// 			break;
			// 		case '1':
			// 			vm.ax_rel[i].prioridade = 'Alta';
			// 			break;
			// 	}
			// }

			Loading(false);
		});
	}

	vm.getProtocolo = getProtocolo;
	function getProtocolo() {
		getTecnico();
		Loading(true);
		$http.post('controllers/protocolo_controller.php', {'go':'getProtocoloBySequencia', 'protocolo':vm.routeParams.sequencia})
		.success(function(ret){
			if (Boolean(ret)) {
				vm.alterar = true;
				vm.dados.descricao = ret.descricao;
				vm.dados.tecnico = ret.tecnico;
				vm.dados.situacao = ret.status;
				vm.dados.prioridade = ret.prioridade.toString();
				vm.dados.sequencia = vm.routeParams.sequencia;
			} else {
				toastr["error"]("Protocolo Não Encontrado", "ERRO:");
			}
			
			Loading(false);
		});
	}
}