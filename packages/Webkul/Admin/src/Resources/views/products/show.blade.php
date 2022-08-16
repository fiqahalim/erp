@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.products.view-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">

        {!! view_render_event('admin.products.view.header.before', ['product' => $product]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('products.view', $product) }}

            <div class="page-title">
                <h1>{{ __('admin::app.products.view-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.products.view.header.after', ['product' => $product]) !!}

        {!! view_render_event('admin.leads.view.informations.before', ['product' => $product]) !!}

        <div class="panel">

        </div>

    </div>
@stop
