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

        <div class="page-content">
            <div class="form-container">
                <div class="panel">
                    <div class="panel-header">
                        {!! view_render_event('admin.materials.edit.form_buttons.before', ['material' => $material]) !!}

                        <a href="{{ route('admin.materials.print', ['id' => $material]) }}">
                            <button type="submit" class="btn btn-md btn-primary">
                            {{ __('admin::app.acl.print') }}
                            </button>
                        </a>

                        <a href="{{ route('admin.materials.index') }}">{{ __('admin::app.materials.back') }}</a>

                        {!! view_render_event('admin.materials.view.form_buttons.after', ['material' => $material]) !!}
                    </div>

                    {!! view_render_event('admin.materials.view.form_controls.before') !!}

                    <tabs>
                        <tab name="{{ __('admin::app.materials.title') }}">
                            @include('admin::materials.common.view.materials')
                        </tab>

                        {!! view_render_event('admin.materials.view.form_controls.details.after') !!}

                        {!! view_render_event('admin.materials.view.form_controls.before') !!}

                        <tab name="{{ __('admin::app.products.title') }}">
                            @include('admin::materials.common.view.products')

                            <product-list :data='@json(old('products'))'></product-list>
                        </tab>

                        {!! view_render_event('admin.materials.edit.form_controls.products.after') !!}

                    </tabs>
                </div>
            </div>
        </div>
    </div>
@stop
