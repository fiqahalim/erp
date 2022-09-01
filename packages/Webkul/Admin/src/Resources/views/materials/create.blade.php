@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.materials.create-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('admin.materials.create.header.before') !!}

        <div class="page-header">

            {{ Breadcrumbs::render('materials.create') }}

            <div class="page-title" style="padding-top:25px;">
                <h1>{{ __('admin::app.materials.create-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.materials.create.header.after') !!}

        <form method="POST" action="{{ route('admin.materials.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-content">
                <div class="form-container">
                    <div class="panel">
                        {!! view_render_event('admin.materials.create.form_controls.before') !!}

                        @csrf()

                        <tabs>
                            <tab name="{{ __('admin::app.materials.title') }}">
                                @include('admin::materials.common.materials')
                            </tab>

                            {!! view_render_event('admin.materials.create.form_controls.details.after') !!}

                            {!! view_render_event('admin.materials.create.form_controls.before') !!}

                            <tab name="{{ __('admin::app.products.title') }}">
                                @include('admin::materials.common.products')

                                <product-list :data='@json(old('products'))'></product-list>
                            </tab>

                            {!! view_render_event('admin.materials.create.form_controls.products.after') !!}

                        </tabs>

                        <div class="panel-header">
                            {!! view_render_event('admin.materials.create.form_buttons.before') !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.materials.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.materials.index') }}">{{ __('admin::app.materials.back') }}</a>

                            {!! view_render_event('admin.materials.create.form_buttons.after') !!}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
