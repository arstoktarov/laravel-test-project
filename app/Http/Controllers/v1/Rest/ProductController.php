<?php

namespace App\Http\Controllers\v1\Rest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollectionResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, Request $request)
    {
        $paginated = $category->products()->with('category')->paginate(20);

        $products = $this->paginatedToResourceCollection($paginated, ProductCollectionResource::class);

        return self::successJsonResponse($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Category $category
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category, CreateProductRequest $request)
    {
        $product = new Product($request->validated());

        $category->products()->save($product);

        $product->refresh();

        return self::successJsonResponse(ProductResource::make($product));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('category');
        return self::successJsonResponse(ProductResource::make($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->fill($request->validated());
        $product->save();
        $product->refresh();

        return self::successJsonResponse(ProductResource::make($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return self::successJsonResponse(ProductResource::make($product));
    }
}
