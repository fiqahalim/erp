@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.quotes.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.sales.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.sales.index.header.before') !!}

                    {{ Breadcrumbs::render('sales') }}

                    {{ __('admin::app.sales.title') }}

                    {!! view_render_event('admin.sales.index.header.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('sales.create'))
                <template v-slot:table-action>
                    <a href="{{ route('admin.sales.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.sales.create-title') }}</a>
                </template>
            @endif
        <table-component>
    </div>
@stop
