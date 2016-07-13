'use strict';

angular.module('Login',[])


.controller('LoginController', LoginController);

function LoginController($http, $timeout) {

	var vm = this;

	vm.fazerLogin = fazerLogin;
	function fazerLogin() {
		vm.btnLogin = true;
		Loading(true);
		vm.btnLogin = false;

		$http.post('controllers/login_controller.php', {'go':'login', 'vm':vm })
		.success(function(ret) {
			Loading(false);

			if (ret != false) {
				toastr["success"]("Carregando...", "Acesso Concedido", {'timeOut':'2000'});
				$timeout(function(){
					window.location='#/menu';
				},2500);
			} else {
				toastr["warning"]("Usuário ou Senha Inválida.", "Atenção");
			}

		});



	}
}
