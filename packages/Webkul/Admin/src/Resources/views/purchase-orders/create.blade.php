@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.purchases_order.create-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('admin.purchases-orders.create.header.before') !!}

        <div class="page-header">

            {{ Breadcrumbs::render('purchases-orders.create') }}

            <div class="page-title">
                <h1>{{ __('admin::app.purchases_order.create-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.purchases-orders.create.header.after') !!}

        <form method="POST" action="{{ route('admin.purchases-orders.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-content">
                <div class="form-container">
                    <div class="panel">
                        <div class="panel-header">
                            {!! view_render_event('admin.purchases-orders.create.form_buttons.before') !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.purchases_order.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.purchases-orders.index') }}">{{ __('admin::app.purchases_order.back') }}</a>

                            {!! view_render_event('admin.purchases-orders.create.form_buttons.after') !!}
                        </div>

                        @csrf()

                        <tabs>
                            <tab name="{{ __('admin::app.purchases_order.title') }}">
                                @include('admin::purchase-orders.common.purchases')
                            </tab>

                            {!! view_render_event('admin.purchases-orders.create.form_controls.details.after') !!}

                            {!! view_render_event('admin.purchases-orders.create.form_controls.before') !!}

                            <tab name="{{ __('admin::app.products.title') }}">
                                @include('admin::purchase-orders.common.products')

                                <product-list :data='@json(old('products'))'></product-list>
                            </tab>

                            {!! view_render_event('admin.purchases-orders.create.form_controls.products.after') !!}

                        </tabs>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
