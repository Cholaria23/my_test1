<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Repositories\AdminCrudRepository;

class AdminController extends Controller
{
    protected $adminCrudRepository;

    public function __construct(AdminCrudRepository $adminCrudRepository)
    {
        $this->adminCrudRepository = $adminCrudRepository;
    }

    public function dashboard()
    {
        return view()->make('admin.layouts.app');
    }

}
