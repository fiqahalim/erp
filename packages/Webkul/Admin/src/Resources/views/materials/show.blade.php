@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.materials.view-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">

        {!! view_render_event('admin.materials.view.header.before', ['material' => $material]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('materials.view', $material) }}

            <div class="page-title">
                <h1>{{ __('admin::app.materials.view-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.materials.view.header.after', ['material' => $material]) !!}

        {!! view_render_event('admin.materials.view.informations.before', ['material' => $material]) !!}

        <div class="panel">

        </div>

    </div>
@stop
