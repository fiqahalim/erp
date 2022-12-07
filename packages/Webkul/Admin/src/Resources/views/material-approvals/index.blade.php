@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.materials_approval.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.materials-approval.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.materials-approval.index.header.before') !!}

                    {{ Breadcrumbs::render('material-approval') }}

                    {{ __('admin::app.materials_approval.title') }}

                    {!! view_render_event('admin.materials-approval.index.header.after') !!}
                </h1>
            </template>
        <table-component>
    </div>
@stop
