<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CountryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function getCountries($locale, Request $request)
    {
        $countries = DB::table('countries')->join('country_translations' . ' as t', function ($join) use ($locale) {
            $join->on('countries.id', '=', 't.country_id')
                ->where('t.locale', '=', $locale);
        })
            ->where('latitude', '<>', '', 'and')
            ->where('longitude', '<>', '', 'and')
            ->select(['countries.id', 'countries.country_category_id', 'countries.latitude', 'countries.longitude', 't.title'])
            ->orderBy('title')->get();
        $country_category = CountryCategory::all();
        $country_id = Cookie::get('country_id');
        return response()->json(compact('countries', 'country_category', 'country_id', 'locale'));
    }
}
