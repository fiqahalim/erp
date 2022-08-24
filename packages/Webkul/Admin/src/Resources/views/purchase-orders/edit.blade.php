@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.purchases_order.edit-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('admin.purchases-orders.edit.header.before', ['purchase' => $purchase]) !!}

        <div class="page-header">

             {{ Breadcrumbs::render('purchases-orders.edit', $purchase) }}

            <div class="page-title">
                <h1>{{ __('admin::app.purchases_order.edit-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.purchases-orders.edit.header.after', ['purchase' => $purchase]) !!}

        <form method="POST" action="{{ route('admin.purchases-orders.update', $purchase->id) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-content">
                <div class="form-container">
                    <div class="panel">
                        <div class="panel-header">
                            {!! view_render_event('admin.purchases-orders.edit.form_buttons.before', ['purchase' => $purchase]) !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.purchases_order.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.purchases-orders.index') }}">{{ __('admin::app.purchases_order.back') }}</a>

                            {!! view_render_event('admin.purchases-orders.edit.form_buttons.after', ['purchase' => $purchase]) !!}
                        </div>

                        {!! view_render_event('admin.purchases-orders.edit.form_controls.before') !!}

                        @csrf()

                        <input name="_method" type="hidden" value="PUT">

                        <tabs>
                            <tab name="{{ __('admin::app.purchases_order.title') }}">
                                @include('admin::purchase-orders.common.edit.purchases')
                            </tab>

                            {!! view_render_event('admin.purchases-orders.edit.form_controls.details.after') !!}

                            {!! view_render_event('admin.purchases-orders.edit.form_controls.before') !!}

                            <tab name="{{ __('admin::app.products.title') }}">
                                @include('admin::purchase-orders.common.edit.products')

                                <product-list :data='@json(old('products'))'></product-list>
                            </tab>

                            {!! view_render_event('admin.purchases-orders.edit.form_controls.products.after') !!}

                        </tabs>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
