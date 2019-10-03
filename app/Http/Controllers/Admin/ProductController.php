<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductAppointment;
use App\Models\Country;
use App\Models\Article;
use App\Models\Picture;
use App\Models\Attribute;

class ProductController extends AdminController
{
    protected $model = Product::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->adminCrudRepository->index($request, $this->model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        return $this->adminCrudRepository->store($request, $this->model);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->adminCrudRepository->show($id, $this->model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request)
    {
        return $this->adminCrudRepository->update($request, $this->model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->adminCrudRepository->destroy($id, $this->model);
    }

    public function destroyList(Request $request)
    {
        return $this->adminCrudRepository->destroyList($request, $this->model);
    }

    public function productCategoryRelation()
    {
        return response()->json(['title' => 'title', 'entity' => 'category',  'items' => ProductCategory::all()]);
    }

    public function appointmentRelation()
    {
        return response()->json(['title' => 'title', 'entity' => 'appointment', 'items' => ProductAppointment::all()]);
    }

    public function countryRelation()
    {
        return response()->json(['title' => 'title', 'entity' => 'country', 'items' => Country::all()]);
    }

    public function articleRelation()
    {
        return response()->json(['title' => 'title', 'entity' => 'article', 'items' => Article::all()]);
    }

    public function productRelation()
    {
        return response()->json(['title' => 'title', 'entity' => 'product', 'items' => Product::all()]);
    }

    public function attributeRelation($id)
    {
        $product = Product::find($id);
        $attributes = [];
        foreach ($product->category->attributecategories as $attributecategory) {
            $cat_attributes = Attribute::where('attribute_category_id', $attributecategory->id)->get();
            $attributes['attribute_category-' . $attributecategory->translate('en')->title] = $cat_attributes;
        }

        return response()->json(['title' => 'title', 'entity' => 'attribute', 'items' => $attributes]);
    }
}
