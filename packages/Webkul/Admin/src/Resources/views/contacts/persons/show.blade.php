@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.contacts.persons.view-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">

        {!! view_render_event('admin.contacts.persons.view.header.before', ['person' => $person]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('contacts.persons.view', $person) }}

            <div class="page-title">
                <h1>View Supplier</h1>
            </div>
        </div>

        {!! view_render_event('admin.contacts.persons.view.header.after', ['person' => $person]) !!}

    </div>
@stop
