@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.locations.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('admin.settings.locations.edit.header.before', ['location' => $location]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('settings.locations.edit', $location) }}

            <div class="page-title" style="padding-top:25px;">
                <h1>{{ __('admin::app.locations.edit-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.settings.locations.edit.header.after', ['location' => $location]) !!}

        <form method="POST" action="{{ route('admin.settings.locations.update', $location->id) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-content">
                <div class="form-container">
                    <div class="panel">
                        <div class="panel-body">
                            {!! view_render_event('admin.settings.locations.edit.form_controls.before', ['location' => $location]) !!}

                            @csrf()
                            <input name="_method" type="hidden" value="PUT">

                            <div class="form-group" :class="[errors.has('location_code') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.locations.location_code') }}
                                </label>

                                <input
                                    type="text"
                                    name="location_code"
                                    class="control"
                                    value="{{ old('location_code') ?? $location->location_code }}"
                                    placeholder="{{ __('admin::app.locations.location_code') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.locations.location_code') }}"
                                    disabled
                                />

                                <span class="control-error" v-if="errors.has('location_code')">
                                    @{{ errors.first('location_code') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('location_name') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.locations.location_name') }}
                                </label>

                                <textarea
                                    class="control"
                                    name="location_name"
                                    placeholder="{{ __('admin::app.locations.location_name') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.locations.location_name') }}"
                                >{{ old('location_name') ?? $location->location_name }}</textarea>

                                <span class="control-error" v-if="errors.has('location_name')">
                                    @{{ errors.first('location_name') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('type') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.locations.type') }}
                                </label>

                                <input
                                    type="text"
                                    name="type"
                                    class="control"
                                    value="{{ old('type') ?? $location->type }}"
                                    placeholder="{{ __('admin::app.locations.type') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.locations.type') }}"
                                />

                                <span class="control-error" v-if="errors.has('type')">
                                    @{{ errors.first('type') }}
                                </span>
                            </div>
                        </div>

                        <div class="panel-header">
                            {!! view_render_event('admin.settings.locations.edit.form_buttons.before', ['location' => $location]) !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.locations.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.settings.locations.index') }}">
                                {{ __('admin::app.layouts.back') }}
                            </a>

                            {!! view_render_event('admin.settings.locations.edit.form_buttons.after', ['location' => $location]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
