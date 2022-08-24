@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.purchases_order.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.purchases-orders.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.purchases-orders.index.header.before') !!}

                    {{ Breadcrumbs::render('purchases-orders') }}

                    {{ __('admin::app.purchases_order.title') }}

                    {!! view_render_event('admin.purchases-orders.index.header.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('purchases-orders.create'))
                <template v-slot:table-action>
                    <a href="{{ route('admin.purchases-orders.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.purchases_order.create-title') }}</a>
                </template>
            @endif
        <table-component>
    </div>
@stop
