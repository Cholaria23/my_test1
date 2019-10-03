<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use App\Models\AttributeCategory;
use App\Models\Serial;

class ProductCategoryController extends AdminController
{
    protected $model = ProductCategory::class;

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
    public function store(StoreProductCategoryRequest $request)
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
    public function update(UpdateProductCategoryRequest $request)
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

    public function serialRelation()
    {
        return response()->json(['title' => 'title', 'entity' => 'serial', 'items' => Serial::all()]);
    }

    public function attributeCategoryRelation()
    {
        return response()->json(['title' => 'title', 'entity' => 'attributecategory', 'items' => AttributeCategory::all()]);
    }
}
