<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Request;
use App;
use Config;
use Session;
use Carbon\Carbon;

class LocaleMiddleware
{
    public static function getLocale()
    {
        $uri = request()->path();
        $segmentsURI = explode('/', $uri);
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], config()->get('app.locales'))) {
            if ($segmentsURI[0] !== config()->get('app.locale')) {
                return $segmentsURI[0];
            }
        }
        return null;
    }

    public function handle($request, Closure $next)
    {

        if (!request()->ajax()) {
            $locales = array_replace(Config::get('app.locales'),
                array_fill_keys(
                    array_keys(Config::get('app.locales'), 'ua'),
                    'uk'
                )
            );
            $preferredLanguage = Request::getPreferredLanguage($locales);
            $preferredLanguage = $preferredLanguage === 'uk' ? 'ua' : $preferredLanguage;
            $locale = self::getLocale($request);
            if ($preferredLanguage !== $locale && !Cookie::get('language')) {
                $subject = $request->url();
                $url = $subject;
                if ($locale === null && $preferredLanguage !== 'ru') {
                    $search = config("app.url");
                    $replace = config("app.url") . '/' . $preferredLanguage;
                    $url = str_replace($search, $replace, $subject);
                } else if ($preferredLanguage === 'ru') {
                    if ($locale) {
                        $search = config("app.url") . '/' . $locale;
                        $replace = config("app.url");
                        $url = str_replace($search, $replace, $subject);
                    }
                } else {
                    $search = config("app.url") . '/' . $locale;
                    $replace = config("app.url") . '/' . $preferredLanguage;
                    $url = str_replace($search, $replace, $subject);
                }
                if ($subject !== $url) {
                    Cookie::queue(Cookie::forever('language', $locale, null, null, false, false));
                    if (!$this->isBot($request)) {
                        return redirect($url);
                    }
                }
            }
            $locale = $locale ?: Config::get('app.locale');
            App::setLocale($locale);
            Cookie::queue(Cookie::forever('language', $locale, null, null, false, false));
        }
        return $next($request);
    }

    function isBot($request)
    {
        /* Эта функция будет проверять, является ли посетитель роботом поисковой системы */
        $bots = array(
            'rambler', 'googlebot', 'aport', 'yahoo', 'msnbot', 'turtle', 'mail.ru', 'omsktele',
            'yetibot', 'picsearch', 'sape.bot', 'sape_context', 'gigabot', 'snapbot', 'alexa.com',
            'megadownload.net', 'askpeter.info', 'igde.ru', 'ask.com', 'qwartabot', 'yanga.co.uk',
            'scoutjet', 'similarpages', 'oozbot', 'shrinktheweb.com', 'aboutusbot', 'followsite.com',
            'dataparksearch', 'google-sitemaps', 'appEngine-google', 'feedfetcher-google',
            'liveinternet.ru', 'xml-sitemaps.com', 'agama', 'metadatalabs.com', 'h1.hrn.ru',
            'googlealert.com', 'seo-rus.com', 'yaDirectBot', 'yandeG', 'yandex',
            'yandexSomething', 'Copyscape.com', 'AdsBot-Google', 'domaintools.com',
            'Nigma.ru', 'bing.com', 'dotnetdotcom'
        );
        foreach ($bots as $bot) {
            if (stripos($request->header('User-Agent'), $bot) !== false) {
                return true;
            }
        }
        return false;
    }
}
