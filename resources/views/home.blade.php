@extends('layouts.app')

@section('content')
<div class="container" ng-controller="ProductController">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">Products</div>
                        <div class="col-md-8 text-right">
                            <button class="btn btn-primary btn-xs pull-right" ng-click="initAddProduct()">Add Product</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="table table-bordered table-striped" ng-if="products.length > 0">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Number of stocks</th>
                            <th></th>
                        </tr>
                        <tr ng-repeat="(index, product) in products">
                            <td>@{{ product.name }}</td>
                            <td>@{{ product.description }}</td>
                            <td>@{{ product.price }}</td>
                            <td>@{{ product.discount }}</td>
                            <td>@{{ product.number_of_stocks }}</td>
                            <td>
                                <button class="btn btn-success btn-xs" ng-click="initEditProduct(index)">Edit</button>
                                <button class="btn btn-danger btn-xs" ng-click="deleteProduct(index)" >Delete</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="add_new_product">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
     
                            <div class="alert alert-danger" ng-if="errors.length > 0">
                                <ul>
                                    <li ng-repeat="error in errors">@{{ error }}</li>
                                </ul>
                            </div>
     
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" ng-model="product.name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="5" class="form-control"
                                          ng-model="product.description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" class="form-control" ng-model="product.price">
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="discount" name="discount" class="form-control" ng-model="product.discount" min="1" max="100">
                            </div>
                            <div class="form-group">
                                <label for="number_of_stocks">Number of stocks</label>
                                <input type="number_of_stocks" name="number_of_stocks" class="form-control" ng-model="product.number_of_stocks"
                                    min="0" step="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" ng-click="addProduct()">Submit</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="edit_product">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
     
                            <div class="alert alert-danger" ng-if="errors.length > 0">
                                <ul>
                                    <li ng-repeat="error in errors">@{{ error }}</li>
                                </ul>
                            </div>
     
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" ng-model="edit_product.name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="5" class="form-control"
                                          ng-model="edit_product.description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" class="form-control" ng-model="edit_product.price">
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="text" name="discount" class="form-control" ng-model="edit_product.discount" min="1" max="100">
                            </div>
                            <div class="form-group">
                                <label for="number_of_stocks">Number of stocks</label>
                                <input type="text" name="number_of_stocks" class="form-control" ng-model="edit_product.number_of_stocks" 
                                    min="0" step="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" ng-click="updateProduct()">Submit</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
</div>
@endsection
