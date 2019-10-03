<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\File;
use App\Models\FileCategory;
use Illuminate\Support\Facades\Cookie;

class FileController extends Controller
{
    public function getFiles($cats = null, Request $request)
    {
        if ($request->cookie('staleks-auth')) {
            if ($cats) {
                $cats = explode('_', $cats);
                $files = File::whereIn('files.file_category_id', $cats)->where('publish', true)->get();
            } else {
                $files = File::where('publish', true)->get();
            }
        } else {
            if ($cats) {
                $cats = explode('_', $cats);
                $files = File::join('file_translations as t', function ($join) {
                    $join->on('files.id', '=', 't.file_id')
                        ->where('t.locale', '=', \App::getLocale());
                })
                    ->whereIn('files.file_category_id', $cats)
                    ->where('publish', true)
                    ->select('files.id', 'icon', 'title', 'image', 'file_category_id', 'files.created_at')
                    ->get();
            } else {
                $files = File::join('file_translations as t', function ($join) {
                    $join->on('files.id', '=', 't.file_id')
                        ->where('t.locale', '=', \App::getLocale());
                })
                    ->where('publish', true)
                    ->select('files.id', 'icon', 'title', 'image', 'file_category_id', 'files.created_at')
                    ->get();
            }
        }
        $chunk_files = $files->chunk(6)->toArray();
        $categories = FileCategory::all();
        return response()->json(compact('chunk_files', 'categories'));
    }

    public function checkPassword(Request $request, Response $response)
    {
        $answer = false;
        if ($request->get('password') === config('app.access_to_file_password')) {
            $answer = true;
            Cookie::queue(Cookie::make('staleks-auth', 'true', 1140));
            return response()->json(compact('answer'));
        }
        return response()->json(compact('answer'));
    }
}
