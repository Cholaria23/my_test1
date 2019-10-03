<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;
use App;

class LanguageController extends Controller
{
    public function findLang($language_id)
    {
        $languages = App::make('languages');
        $lang = App::getLocale();
        foreach ($languages as $language) {
            if ($language->id === (int) $language_id) {
                $lang = $language->code;
            }
        }
        return $lang;
    }

    public function setLocale($language_id)
    {
        $lang = $this->findLang($language_id);
        Cookie::forget('language_id');
        Cookie::forget('language');
        Cookie::queue(Cookie::forever('language_id', $language_id, null, null, false, false));
        Cookie::queue(Cookie::forever('language', $lang, null, null, false, false));

        $referer = Redirect::back()->getTargetUrl();
        $parse_url = parse_url($referer, PHP_URL_PATH);

        $segments = explode('/', $parse_url);

        if (in_array($segments[1], Config::get('app.locales'))) {
            unset($segments[1]);
        }
        if ($lang != Config::get('app.locale')) {
            array_splice($segments, 1, 0, $lang);
        }

        $url = Request::root() . implode("/", $segments);

        if (parse_url($referer, PHP_URL_QUERY)) {
            $url = $url . '?' . parse_url($referer, PHP_URL_QUERY);
        }

        if (Request::ajax()) {
            return $url;
        }

        return redirect($url);
    }

    public function selectCountryAndLanguage(HttpRequest $request)
    {
        $url = null;
        if ($request->has('country_id')) {
            $country_id = $request->get('country_id');
            Cookie::forget('country_id');
            Cookie::queue(Cookie::forever('country_id', $country_id, null, null, false, false));
        }
        if ($request->has('language_id')) {
            $language_id = (int) $request->get('language_id');
            $url = $this->setLocale($language_id);
        }
        $answer = true;
        return response()->json(compact('answer', 'url'));
    }

    public function getLanguages()
    {
        $locales = Config::get('app.locales');
        return response()->json(compact('locales'));
    }

    public function getLocales()
    {
        $lang = App::getLocale();

        $strings = \Cache::rememberForever("lang-{$lang}", function () use ($lang) {
            $files   = glob(resource_path('lang/' . $lang . '/*.php'));
            $strings = [];

            foreach ($files as $file) {
                $name           = basename($file, '.php');
                $strings[$name] = require $file;
            }
            return $strings;
        });

        header('Content-Type: text/javascript');
        echo ('window.langObj = ' . json_encode($strings) . ';');
        exit;
    }
}
