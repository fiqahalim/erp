@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.locations.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.settings.locations.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.settings.locations.index.header.before') !!}

                    {{ Breadcrumbs::render('settings.locations') }}

                    {{ __('admin::app.locations.title') }}

                    {!! view_render_event('admin.settings.locations.index.header.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('admin.settings.locations.create'))
                <template v-slot:table-action>
                    <button class="btn btn-md btn-primary" @click="openModal('addTagModal')">{{ __('admin::app.locations.create-title') }}</button>
                </template>
            @endif
        <table-component>
    </div>

    <form action="{{ route('admin.settings.locations.store') }}" method="POST" @submit.prevent="onSubmit">
        <modal id="addTagModal" :is-open="modalIds.addTagModal">
            <h3 slot="header-title">{{ __('admin::app.locations.create-title') }}</h3>

            <div slot="header-actions">
                {!! view_render_event('admin.settings.locations.create.form_buttons.before') !!}

                <button class="btn btn-sm btn-secondary-outline" @click="closeModal('addTagModal')">{{ __('admin::app.locations.cancel') }}</button>

                <button type="submit" class="btn btn-sm btn-primary">{{ __('admin::app.locations.save-btn-title') }}</button>

                {!! view_render_event('admin.settings.locations.create.form_buttons.after') !!}
            </div>

            <div slot="body">
                {!! view_render_event('admin.settings.locations.create.form_controls.before') !!}

                @csrf()

                <div class="form-group" :class="[errors.has('location_code') ? 'has-error' : '']">
                    <label class="required">
                        {{ __('admin::app.locations.location_code') }}
                    </label>

                    <input
                        type="text"
                        name="location_code"
                        class="control"
                        placeholder="{{ __('admin::app.locations.location_code') }}"
                        v-validate="'required'"
                        data-vv-as="{{ __('admin::app.locations.location_code') }}"
                    />

                    <span class="control-error" v-if="errors.has('location_code')">
                        @{{ errors.first('location_code') }}
                    </span>
                </div>

                <div class="form-group">
                    <label>{{ __('admin::app.locations.location_name') }}</label>
                    <input
                        type="text"
                        name="location_name"
                        class="control"
                        placeholder="{{ __('admin::app.locations.location_name') }}"
                        data-vv-as="{{ __('admin::app.locations.location_name') }}"
                    />

                    <span class="control-error" v-if="errors.has('location_name')">
                        @{{ errors.first('location_name') }}
                    </span>
                </div>

                <div class="form-group">
                    <label>{{ __('admin::app.locations.type') }}</label>
                    <input
                        type="text"
                        name="type"
                        class="control"
                        placeholder="{{ __('admin::app.locations.type') }}"
                        data-vv-as="{{ __('admin::app.locations.type') }}"
                    />

                    <span class="control-error" v-if="errors.has('type')">
                        @{{ errors.first('type') }}
                    </span>
                </div>

                {!! view_render_event('admin.settings.tags.create.form_controls.after') !!}
            </div>
        </modal>
    </form>
@stop
