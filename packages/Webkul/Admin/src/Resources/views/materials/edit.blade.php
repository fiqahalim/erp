@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.materials.edit-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('admin.materials.edit.header.before', ['material' => $material]) !!}

        <div class="page-header">

             {{ Breadcrumbs::render('materials.edit', $material) }}

            <div class="page-title">
                <h1>{{ __('admin::app.materials.edit-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.materials.edit.header.after', ['material' => $material]) !!}

        <form method="POST" action="{{ route('admin.materials.update', $material->id) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-content">
                <div class="form-container">
                    <div class="panel">
                        <div class="panel-header">
                            {!! view_render_event('admin.materials.edit.form_buttons.before', ['material' => $material]) !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.materials.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.materials.index') }}">{{ __('admin::app.materials.back') }}</a>

                            {!! view_render_event('admin.materials.edit.form_buttons.after', ['material' => $material]) !!}
                        </div>

                        {!! view_render_event('admin.materials.edit.form_controls.before') !!}

                        @csrf()

                        <input name="_method" type="hidden" value="PUT">

                        <tabs>
                            <tab name="{{ __('admin::app.materials.title') }}">
                                @include('admin::materials.common.edit.materials')
                            </tab>

                            {!! view_render_event('admin.materials.edit.form_controls.details.after') !!}

                            {!! view_render_event('admin.materials.edit.form_controls.before') !!}

                            <tab name="{{ __('admin::app.products.title') }}">
                                @include('admin::materials.common.edit.products')

                                <product-list :data='@json(old('products'))'></product-list>
                            </tab>

                            {!! view_render_event('admin.materials.edit.form_controls.products.after') !!}

                        </tabs>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
