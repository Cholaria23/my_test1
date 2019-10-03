<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequestRequest;
use App\Models\FormRequest;
use Config;

class FormRequestController extends AdminController
{
    protected $model = FormRequest::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$routeName = array_reverse(explode('/', $request->route()->getPrefix()));
        //$routeName = $routeName[0];
        //$subject = Config::get('mail.' . $routeName . '_subject');
        //$whereArr = ['subject' => $subject];
        return $this->adminCrudRepository->index($request, $this->model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormRequest $request)
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
    public function update(UpdateFormRequestRequest $request, $id)
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
}
