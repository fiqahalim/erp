@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.transaction_types.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('admin.settings.transaction-types.edit.header.before', ['transactionType' => $transactionType]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('settings.locations.edit', $transactionType) }}

            <div class="page-title">
                <h1>{{ __('admin::app.transaction_types.edit-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.settings.transaction-types.edit.header.after', ['transactionType' => $transactionType]) !!}

        <form method="POST" action="{{ route('admin.settings.transaction-types.update', $transactionType->id) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-content">
                <div class="form-container">
                    <div class="panel">
                        <div class="panel-header">
                            {!! view_render_event('admin.settings.transaction-types.edit.form_buttons.before', ['transactionType' => $transactionType]) !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.transaction_types.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.settings.transaction-types.index') }}">
                                {{ __('admin::app.layouts.back') }}
                            </a>

                            {!! view_render_event('admin.settings.transaction-types.edit.form_buttons.after', ['transactionType' => $transactionType]) !!}
                        </div>

                        <div class="panel-body">
                            {!! view_render_event('admin.settings.transaction-types.edit.form_controls.before', ['transactionType' => $transactionType]) !!}

                            @csrf()
                            <input name="_method" type="hidden" value="PUT">

                            <div class="form-group" :class="[errors.has('transaction_code') ? 'has-error' : '']">
                                <label>
                                    {{ __('admin::app.transaction_types.transaction_code') }}
                                </label>

                                <input
                                    type="text"
                                    name="transaction_code"
                                    class="control"
                                    value="{{ old('transaction_code') ?? $transactionType->transaction_code }}"
                                    placeholder="{{ __('admin::app.transaction_types.transaction_code') }}"
                                    data-vv-as="{{ __('admin::app.transaction_types.transaction_code') }}"
                                    disabled
                                />

                                <span class="control-error" v-if="errors.has('transaction_code')">
                                    @{{ errors.first('transaction_code') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('transaction_name') ? 'has-error' : '']">
                                <label>
                                    {{ __('admin::app.transaction_types.transaction_name') }}
                                </label>

                                <input
                                    class="control"
                                    name="transaction_name"
                                    value="{{ old('transaction_name') ?? $transactionType->transaction_name }}"
                                    placeholder="{{ __('admin::app.transaction_types.transaction_name') }}"
                                    data-vv-as="{{ __('admin::app.transaction_types.transaction_name') }}"
                                />

                                <span class="control-error" v-if="errors.has('transaction_name')">
                                    @{{ errors.first('transaction_name') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('amount') ? 'has-error' : '']">
                                <label>
                                    {{ __('admin::app.transaction_types.amount') }}
                                </label>

                                <input
                                    type="text"
                                    name="amount"
                                    class="control"
                                    value="{{ old('amount') ?? $transactionType->amount }}"
                                    placeholder="{{ __('admin::app.transaction_types.amount') }}"
                                    data-vv-as="{{ __('admin::app.transaction_types.amount') }}"
                                />

                                <span class="control-error" v-if="errors.has('amount')">
                                    @{{ errors.first('amount') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
