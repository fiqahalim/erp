@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.purchases.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.purchases.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.purchases.index.header.before') !!}

                    {{ Breadcrumbs::render('purchases') }}

                    {{ __('admin::app.purchases.title') }}

                    {!! view_render_event('admin.purchases.index.header.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('purchases.create'))
                <template v-slot:table-action>
                    <a href="{{ route('admin.purchases.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.purchases.create-title') }}</a>
                </template>
            @endif
        <table-component>
    </div>
@stop
