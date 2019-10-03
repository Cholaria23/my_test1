<?php

namespace App\Http\Controllers;

use Cookie;

class CookieController extends Controller
{
    public function index()
    {
        return response()->json(true, 200)->withCookie(cookie()->forever('first_visit_was', true));
    }
}
