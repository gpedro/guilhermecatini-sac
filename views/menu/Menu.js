'use strict';

angular.module('Menu',[])

.controller('MenuController',MenuController);

function MenuController($http) {
	let vm = this;

	vm.sys = new Object();

	$http.post('controllers/menu_controller.php', {'go':'sys'}) 
	.success(function(ret){
		// if (ret != false) {
		// 	vm.sys.nome = ret.usuario.nome;
		// } else {
		// 	window.location='#/';
		// }
	});


	vm.Logout = Logout;
	function Logout() {
		$http.post('controllers/util_controller.php', {'go':'LimparSessao'});
		window.location="#/";
	}


}