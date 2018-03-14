var app = angular.module('app', []);

app.controller('formCtrl', function ($scope, $http) 
{
    
    $scope.formData = {};
    
        $scope.processForm = function () 
    {

		$http(
		{
			method: 	'POST',
			url:		'process_nb.php',
			data:		$.param($scope.formData),
			headers:	{ "Content-Type" : "application/x-www-form-urlencoded; charset=UTF-8" }
		})
		.success(function(data)
		{
            if (!data.success) 
            {
            	// if not successful, bind errors to error variables
                $scope.errorNaam = data.errors.naam;
                $scope.errorEmailadres = data.errors.emailadres;
            } else 
            {
            	// if successful, bind success message to message
                $scope.message = data.message;
                $scope.errorNaam = '';
                $scope.errorEmailadres = '';
                delete $scope.formData.naam;
                delete $scope.formData.emailadres;
            }
		});
    }
});

app.controller('contactCtrl', function ($scope, $http) 
{
    
    $scope.formData = {};
    
        $scope.processForm = function () 
    {

		$http(
		{
			method: 	'POST',
			url:		'contact_me.php',
			data:		$.param($scope.formData),
			headers:	{ "Content-Type" : "application/x-www-form-urlencoded; charset=UTF-8" }
		})
		.success(function(data)
		{
            if (!data.success) 
            {
                delete $scope.message;
                $scope.message2 = data.message2;
            	// if not successful, bind errors to error variables
/*
                $scope.errorNaam = data.errors.naam;
                $scope.errorEmailadres = data.errors.emailadres;
*/
            } else 
            {
            	// if successful, bind success message to message
                $scope.message = data.message;
                delete $scope.message2;
                delete $scope.formData.naam;
                delete $scope.formData.emailadres;
                delete $scope.formData.telnr;
                delete $scope.formData.tekst;
            }
		});
    }
});
    
app.controller('aanvraagCtrl', function ($scope, $http) 
{
    
    $scope.formData = {};
    
        $scope.processForm = function () 
    {
	    alert($scope.formData.naam);

		$http(
		{
			method: 	'POST',
			url:		'process_aanv.php',
			data:		$.param($scope.formData),
			headers:	{ "Content-Type" : "application/x-www-form-urlencoded; charset=UTF-8" }
		})
		.success(function(data)
		{
            if (!data.success) 
            {
                $scope.message = "Er waren fouten! Je aanvraag is NIET verzonden.";
            	// if not successful, bind errors to error variables
            	
                $scope.errorNaam = data.errors.naam;
                $scope.errorEmailadres = data.errors.emailadres;
                $scope.errorAdres = data.errors.adres;
                $scope.errorPostcode = data.errors.postcode;
                $scope.errorWnplts = data.errors.woonplaats;
                $scope.errorTelnr = data.errors.telnr;
                $scope.errorBericht = data.errors.tekst;
            } else 
            {
            	// if successful, bind success message to message
                $scope.message = "Je aanvraag is verzonden.";
                
                $scope.message += $scope.formData.file1;
                
                delete $scope.formData.naam;
                delete $scope.formData.adres;
                delete $scope.formData.postcode;
                delete $scope.formData.woonplaats;
                delete $scope.formData.emailadres;
                delete $scope.formData.telnr;
                delete $scope.formData.tekst;
                delete $scope.formData.file1;
                delete $scope.formData.file2;
                delete $scope.formData.file3;
                delete $scope.errorNaam;
                delete $scope.errorEmailadres;
                delete $scope.errorAdres;
                delete $scope.errorPostcode;
                delete $scope.errorWnplts;
                delete $scope.errorTelnr; 
                delete $scope.errorTekst; 
            }
		});
    }
});
    
