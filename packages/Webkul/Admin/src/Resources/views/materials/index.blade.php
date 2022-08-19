@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.materials.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.materials.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.materials.index.header.before') !!}

                    {{ Breadcrumbs::render('materials') }}

                    {{ __('admin::app.materials.title') }}

                    {!! view_render_event('admin.materials.index.header.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('materials.create'))
                <template v-slot:table-action>
                    <a href="{{ route('admin.materials.create') }}" class="btn btn-md btn-primary">{{ __('admin::app.materials.create-title') }}</a>
                </template>
            @endif
        <table-component>
    </div>
@stop
