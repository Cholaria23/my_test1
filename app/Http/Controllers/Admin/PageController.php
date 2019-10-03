<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\PageField;
use App\Models\Page;

class PageController extends AdminController
{
    protected $model = Page::class;
    protected $fieldModel = PageField::class;

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
    public function store(StorePageRequest $request)
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
    public function update(UpdatePageRequest $request)
    {
        return $this->adminCrudRepository->update($request, $this->model, $this->fieldModel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        return $this->adminCrudRepository->destroy($id, $this->model);
//    }
//
//    public function destroyList(Request $request)
//    {
//        return $this->adminCrudRepository->destroyList($request, $this->model);
//    }

    public function pageFieldRelation()
    {
        return response()->json(['title' => 'title', 'entity' => 'field', 'items' => PageField::all()]);
    }
}
