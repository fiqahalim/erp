@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.purchases_order.view-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">

        {!! view_render_event('admin.purchases-orders.view.header.before', ['purchase' => $purchase]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('purchases-orders.view', $purchase) }}

            <div class="page-title">
                <h1>{{ __('admin::app.purchases_order.view-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.purchases-orders.view.header.after', ['purchase' => $purchase]) !!}

        {!! view_render_event('admin.purchases-orders.view.informations.before', ['purchase' => $purchase]) !!}

        <div class="page-content">
            <div class="form-container">
                <div class="panel">
                    <div class="panel-header">
                        {!! view_render_event('admin.purchases-orders.edit.form_buttons.before', ['purchase' => $purchase]) !!}

                        <a href="{{ route('admin.purchases-orders.print', ['id' => $purchase]) }}">
                            <button type="submit" class="btn btn-md btn-primary">
                            {{ __('admin::app.acl.print') }}
                            </button>
                        </a>

                        <a href="{{ route('admin.purchases-orders.index') }}">{{ __('admin::app.purchases_order.back') }}</a>

                        {!! view_render_event('admin.purchases-orders.view.form_buttons.after', ['purchase' => $purchase]) !!}
                    </div>

                    {!! view_render_event('admin.purchases-orders.view.form_controls.before') !!}

                    <tabs>
                        <tab name="{{ __('admin::app.purchases_order.title') }}">
                            @include('admin::purchase-orders.common.view.purchases')
                        </tab>

                        {!! view_render_event('admin.purchases-orders.view.form_controls.details.after') !!}

                        {!! view_render_event('admin.purchases-orders.view.form_controls.before') !!}

                        <tab name="{{ __('admin::app.products.title') }}">
                            @include('admin::purchase-orders.common.view.products')

                            <product-list :data='@json(old('products'))'></product-list>
                        </tab>

                        {!! view_render_event('admin.purchases-orders.edit.form_controls.products.after') !!}

                    </tabs>
                </div>
            </div>
        </div>
    </div>
@stop
