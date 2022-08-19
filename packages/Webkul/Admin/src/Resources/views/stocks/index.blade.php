@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.stocks.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.stocks.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.stocks.index.header.before') !!}

                    {{ Breadcrumbs::render('stocks') }}

                    {{ __('admin::app.stocks.title') }}

                    {!! view_render_event('admin.stocks.index.header.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('stocks.create'))
                <template v-slot:table-action>
                    <a href="{{ route('admin.stocks.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.stocks.create-title') }}</a>
                </template>
            @endif
        <table-component>
    </div>
@stop
