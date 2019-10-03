<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FileRepository;

class ImagesController extends Controller
{
    protected $file;

    public function __construct(FileRepository $fileRepository)
    {
        $this->file = $fileRepository;
    }

    public function upload(Request $request)
    {
        $file = $request->image;
        $fileUrl = $this->file->uploadFile($file, 'editor');
        return response()->json(compact('fileUrl'));
    }
}
