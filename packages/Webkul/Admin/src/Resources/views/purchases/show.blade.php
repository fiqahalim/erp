@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.purchases.view-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">

        {!! view_render_event('admin.purchases.view.header.before', ['purchase' => $purchase]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('purchases.view', $purchase) }}

            <div class="page-title">
                <h1>{{ __('admin::app.purchases.view-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.purchases.view.header.after', ['purchase' => $purchase]) !!}

        {!! view_render_event('admin.purchases.view.informations.before', ['purchase' => $purchase]) !!}

        <div class="page-content">
            <div class="form-container">
                <div class="panel">
                    <div class="panel-header">
                        {!! view_render_event('admin.purchases.edit.form_buttons.before', ['purchase' => $purchase]) !!}

                        <a href="{{ route('admin.purchases.print', ['id' => $purchase]) }}">
                            <button type="submit" class="btn btn-md btn-primary">
                            {{ __('admin::app.acl.print') }}
                            </button>
                        </a>

                        <a href="{{ route('admin.purchases.index') }}">{{ __('admin::app.purchases.back') }}</a>

                        {!! view_render_event('admin.purchases.view.form_buttons.after', ['purchase' => $purchase]) !!}
                    </div>

                    {!! view_render_event('admin.purchases.view.form_controls.before') !!}

                    <tabs>
                        <tab name="{{ __('admin::app.purchases.title') }}">
                            @include('admin::purchases.common.view.purchases')
                        </tab>

                        {!! view_render_event('admin.purchases.view.form_controls.details.after') !!}

                        {!! view_render_event('admin.purchases.view.form_controls.before') !!}

                        <tab name="{{ __('admin::app.products.title') }}">
                            @include('admin::purchases.common.view.products')

                            <product-list :data='@json(old('products'))'></product-list>
                        </tab>

                        {!! view_render_event('admin.purchases.edit.form_controls.products.after') !!}

                    </tabs>
                </div>
            </div>
        </div>
    </div>
@stop
