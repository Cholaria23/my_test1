<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\SchoolCategory;
use App\Models\Page;

class SchoolController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $school = School::where('slug', $slug)->firstOrFail();
        if (!$school->publish) {
            return redirect(route('education'));
        }
        return view()->make('frontend.pages.schools.show', compact('school'));
    }


}
