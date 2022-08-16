@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.currencies.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.settings.currencies.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.settings.currencies.index.header.before') !!}

                    {{ Breadcrumbs::render('settings.currencies') }}

                    {{ __('admin::app.currencies.title') }}

                    {!! view_render_event('admin.settings.currencies.index.header.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('admin.settings.currencies.create'))
                <template v-slot:table-action>
                    <button class="btn btn-md btn-primary" @click="openModal('addTagModal')">{{ __('admin::app.currencies.create-title') }}</button>
                </template>
            @endif
        <table-component>
    </div>

    <form action="{{ route('admin.settings.currencies.store') }}" method="POST" @submit.prevent="onSubmit">
        <modal id="addTagModal" :is-open="modalIds.addTagModal">
            <h3 slot="header-title">{{ __('admin::app.currencies.create-title') }}</h3>

            <div slot="header-actions">
                {!! view_render_event('admin.settings.currencies.create.form_buttons.before') !!}

                <button class="btn btn-sm btn-secondary-outline" @click="closeModal('addTagModal')">{{ __('admin::app.currencies.cancel') }}</button>

                <button type="submit" class="btn btn-sm btn-primary">{{ __('admin::app.currencies.save-btn-title') }}</button>

                {!! view_render_event('admin.settings.currencies.create.form_buttons.after') !!}
            </div>

            <div slot="body">
                {!! view_render_event('admin.settings.currencies.create.form_controls.before') !!}

                @csrf()

                <div class="form-group" :class="[errors.has('currency_name') ? 'has-error' : '']">
                    <label class="required">
                        {{ __('admin::app.currencies.currency-name') }}
                    </label>

                    <input
                        type="text"
                        name="currency_name"
                        class="control"
                        placeholder="{{ __('admin::app.currencies.currency-name') }}"
                        v-validate="'required'"
                        data-vv-as="{{ __('admin::app.currencies.currency-name') }}"
                    />

                    <span class="control-error" v-if="errors.has('currency_name')">
                        @{{ errors.first('currency_name') }}
                    </span>
                </div>

                <div class="form-group">
                    <label>{{ __('admin::app.currencies.fx-rate') }}</label>
                    <input
                        type="text"
                        name="fx_rate"
                        class="control"
                        placeholder="{{ __('admin::app.currencies.fx-rate') }}"
                        data-vv-as="{{ __('admin::app.currencies.fx-rate') }}"
                    />

                    <span class="control-error" v-if="errors.has('fx_rate')">
                        @{{ errors.first('fx_rate') }}
                    </span>
                </div>

                {!! view_render_event('admin.settings.tags.create.form_controls.after') !!}
            </div>
        </modal>
    </form>
@stop
