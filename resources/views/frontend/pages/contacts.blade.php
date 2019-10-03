@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('body_class', 'page-contacts')

@section('content')
    <section class="page page--topForHeader pContacts">
        <contacts-map :locale="'{{ app()->getLocale() }}'"></contacts-map>
    </section>
@endsection