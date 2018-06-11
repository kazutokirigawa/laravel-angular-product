<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\PatchRequest;
use App\Http\Requests\Product\PostRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lists all products
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $products = $user->products()->get();
        return response()->json($products, 200);
    }

    /**
     * Shows info about a specific product
     * @param Request $request
     * @return mixed
     */
    public function show(Product $product, Request $request)
    {
        $user = Auth::user();
        $product = $user->products()->findOrFail($product->id);
        return response()->json($product, 200);
    }

    /**
     * Create a new product.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(PostRequest $request)
    {
        $user = Auth::user();
        $product = new Product;
        $product->user_id = $user->id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->number_of_stocks = $request->number_of_stocks;
        $product->save();

        return response()->json($product, 200);
    }

    /**
     * Update a product.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return mixed
     */
    public function update(PatchRequest $request, Product $product)
    {
        $user = Auth::user();
        $product = $user->products()->findOrFail($product->id);
        $product->name = $request->get('name') ?? $product->name;
        $product->description = $request->get('description') ?? $product->description;
        $product->price = $request->get('price') ?? $product->price;
        $product->discount = $request->get('discount') ?? $product->discount;
        $product->number_of_stocks = $request->get('number_of_stocks') ?? $product->number_of_stocks;
        $product->save();
        
        return response()->json($product, 200);
    }

    /**
     * Delete a product.
     *
     * @param 
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function destroy(Product $product, Request $request)
    {
        $user = Auth::user();
        $product = $user->products()->findOrFail($product->id);
        $product->delete();

        return response()->json([], 204);
    }
}
