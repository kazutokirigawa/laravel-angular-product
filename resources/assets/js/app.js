
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('angular');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

/*const app = new Vue({
    el: '#app'
});*/

var app = angular.module('ProductsCRUD', [], ['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
}]);
 
app.controller('ProductController', ['$scope', '$http', function ($scope, $http) {
	$scope.products = [];
    $scope.product = {
        name: '',
        description: '',
        price: null,
        discount: null,
        number_of_stocks: null,
    };
	$scope.edit_product = {};
	$scope.errors = [];

	$scope.loadProducts = function () {
		$http.get('/products')
		.then(function success(e) {
			$scope.products = e.data;
		});
	};

    $scope.initAddProduct = function () {
        $scope.resetForm();
        $("#add_new_product").modal('show');
    };

    $scope.addProduct = function () {
        $http.post('/products', {
            name: $scope.product.name,
            description: $scope.product.description,
            price: $scope.product.price,
            discount: $scope.product.discount,
            number_of_stocks: $scope.product.number_of_stocks
        }).then(function success(e) {
            $scope.resetForm();
            $scope.products.push(e.data);
            $("#add_new_product").modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };
 
    $scope.recordErrors = function (error) {
        $scope.errors = [];
        for (var err in error.data.errors) {
        	console.log(error.data.errors[err]);
        	$scope.errors.push(error.data.errors[err][0]);
        }
    };
 
    $scope.resetForm = function () {
        $scope.product.name = '';
        $scope.product.description = '';
        $scope.product.price = null;
        $scope.product.discount = null;
        $scope.product.number_of_stocks = null;
        $scope.errors = [];
    };

    $scope.initEditProduct = function (index) {
        $scope.errors = [];
        $scope.edit_product = $scope.products[index];
        $("#edit_product").modal('show');
    };
 
    $scope.updateProduct = function () {
        $http.patch('/products/' + $scope.edit_product.id, {
            name: $scope.edit_product.name,
            description: $scope.edit_product.description,
            price: $scope.edit_product.price,
            discount: $scope.edit_product.discount,
            number_of_stocks: $scope.edit_product.number_of_stocks
        }).then(function success(e) {
            $scope.errors = [];
            $("#edit_product").modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    $scope.deleteProduct = function (index) {
        var conf = confirm("Do you want to proceed in deleting this product?");
        if (conf === true) {
            $http.delete('/products/' + $scope.products[index].id)
            .then(function success(e) {
                $scope.products.splice(index, 1);
            });
        }
    };

	$scope.loadProducts();
}]);

app.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);
