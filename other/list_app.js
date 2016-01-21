(function(){

var app = angular.module('listApp', []);

app.controller('listCtrl', function($scope, $http) {
    
    $scope.names = A_Names;
    
    $scope.updateNames = function(list_name){
    	console.log(list_name);
    	if(list_name == 'E_Names'){
    		$scope.names = E_Names;
    	}
    	if(list_name == 'A_Names'){
    		$scope.names = A_Names;
    	}
    };

});

	var A_Names = [
		{	
			"present":false,
			"first_name":"Amanda",
			"last_name":"Anderson",
			"rank":"PO2"
		},
		{	
			"present":false,
			"first_name":"Keven",
			"last_name":"Anderson",
			"rank":"PO1"
		},
		{	
			"present":false,
			"first_name":"Stevie",
			"last_name":"Awkwardman",
			"rank":"PO3"
		},
		{	
			"present":true,
			"first_name":"Richard",
			"last_name":"Baby",
			"rank":"CPO"
		},
	]

	var E_Names = [
		{	
			"present":false,
			"first_name":"Stacey",
			"last_name":"Emery",
			"rank":"PO2"
		},
		{	
			"present":true,
			"first_name":"Lloyd",
			"last_name":"Emmerson",
			"rank":"PO1"
		},
		{	
			"present":true,
			"first_name":"Calvin",
			"last_name":"Frankenstien",
			"rank":"PO3"
		},
		{	
			"present":false,
			"first_name":"Sammy",
			"last_name":"Groverson",
			"rank":"CPO"
		},
	]

})();