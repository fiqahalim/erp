@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.transaction_types.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <table-component data-src="{{ route('admin.settings.transaction-types.index') }}">
            <template v-slot:table-header>
                <h1>
                    {!! view_render_event('admin.settings.transaction-types.index.header.before') !!}

                    {{ Breadcrumbs::render('settings.transaction-types') }}

                    {{ __('admin::app.transaction_types.title') }}

                    {!! view_render_event('admin.settings.transaction-types.index.header.after') !!}
                </h1>
            </template>

            @if (bouncer()->hasPermission('admin.settings.transaction-types.create'))
                <template v-slot:table-action>
                    <button class="btn btn-md btn-primary" @click="openModal('addTagModal')">{{ __('admin::app.transaction_types.create-title') }}</button>
                </template>
            @endif
        <table-component>
    </div>

    <form action="{{ route('admin.settings.transaction-types.store') }}" method="POST" @submit.prevent="onSubmit">
        <modal id="addTagModal" :is-open="modalIds.addTagModal">
            <h3 slot="header-title">{{ __('admin::app.transaction_types.create-title') }}</h3>

            <div slot="header-actions">
                {!! view_render_event('admin.settings.transaction-types.create.form_buttons.before') !!}

                <button class="btn btn-sm btn-secondary-outline" @click="closeModal('addTagModal')">{{ __('admin::app.transaction_types.cancel') }}</button>

                <button type="submit" class="btn btn-sm btn-primary">{{ __('admin::app.transaction_types.save-btn-title') }}</button>

                {!! view_render_event('admin.settings.transaction-types.create.form_buttons.after') !!}
            </div>

            <div slot="body">
                {!! view_render_event('admin.settings.transaction-types.create.form_controls.before') !!}

                @csrf()

                <div class="form-group" :class="[errors.has('transaction_code') ? 'has-error' : '']">
                    <label class="required">
                        {{ __('admin::app.transaction_types.transaction_code') }}
                    </label>

                    <input
                        type="text"
                        name="transaction_code"
                        class="control"
                        placeholder="{{ __('admin::app.transaction_types.transaction_code') }}"
                        v-validate="'required'"
                        data-vv-as="{{ __('admin::app.transaction_types.transaction_code') }}"
                    />

                    <span class="control-error" v-if="errors.has('transaction_code')">
                        @{{ errors.first('transaction_code') }}
                    </span>
                </div>

                <div class="form-group">
                    <label>{{ __('admin::app.transaction_types.transaction_name') }}</label>
                    <input
                        type="text"
                        name="transaction_name"
                        class="control"
                        placeholder="{{ __('admin::app.transaction_types.transaction_name') }}"
                        data-vv-as="{{ __('admin::app.transaction_types.transaction_name') }}"
                    />

                    <span class="control-error" v-if="errors.has('transaction_name')">
                        @{{ errors.first('transaction_name') }}
                    </span>
                </div>

                <div class="form-group">
                    <label>{{ __('admin::app.transaction_types.amount') }}</label>
                    <input
                        type="text"
                        name="amount"
                        class="control"
                        placeholder="{{ __('admin::app.transaction_types.amount') }}"
                        data-vv-as="{{ __('admin::app.transaction_types.amount') }}"
                    />

                    <span class="control-error" v-if="errors.has('amount')">
                        @{{ errors.first('amount') }}
                    </span>
                </div>

                {!! view_render_event('admin.settings.transaction-types.create.form_controls.after') !!}
            </div>
        </modal>
    </form>
@stop
