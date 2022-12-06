@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.incoming_stocks.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.incoming-stocks.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.incoming-stocks.index.header.before') !!}

                    {{ Breadcrumbs::render('incoming-stocks') }}

                    {{ __('admin::app.incoming_stocks.title') }}

                    {!! view_render_event('admin.incoming-stocks.index.header.after') !!}
                </h1>
            </template>
        <table-component>
    </div>
@stop
