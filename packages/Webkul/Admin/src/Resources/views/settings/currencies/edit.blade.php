@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.currencies.title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('admin.settings.currencies.edit.header.before', ['currency' => $currency]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('settings.currencies.edit', $currency) }}

            <div class="page-title" style="padding-top:25px;">
                <h1>{{ __('admin::app.currencies.edit-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.settings.currencies.edit.header.after', ['currency' => $currency]) !!}

        <form method="POST" action="{{ route('admin.settings.currencies.update', $currency->id) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-content">
                <div class="form-container">
                    <div class="panel">
                        <div class="panel-body">
                            {!! view_render_event('admin.settings.currencies.edit.form_controls.before', ['currency' => $currency]) !!}

                            @csrf()
                            <input name="_method" type="hidden" value="PUT">

                            <div class="form-group" :class="[errors.has('currency_name') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.currencies.currency_name') }}
                                </label>

                                <input
                                    type="text"
                                    name="currency_name"
                                    class="control"
                                    value="{{ old('currency_name') ?? $currency->currency_name }}"
                                    placeholder="{{ __('admin::app.currencies.currency_name') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.currencies.currency_name') }}"
                                />

                                <span class="control-error" v-if="errors.has('location_code')">
                                    @{{ errors.first('location_code') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('fx_rate') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.currencies.fx_rate') }}
                                </label>

                                <input
                                    type="text"
                                    name="fx_rate"
                                    class="control"
                                    value="{{ old('fx_rate') ?? $currency->fx_rate }}"
                                    placeholder="{{ __('admin::app.currencies.fx_rate') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.currencies.fx_rate') }}"
                                />

                                <span class="control-error" v-if="errors.has('fx_rate')">
                                    @{{ errors.first('fx_rate') }}
                                </span>
                            </div>
                        </div>

                        <div class="panel-header">
                            {!! view_render_event('admin.settings.currencies.edit.form_buttons.before', ['currency' => $currency]) !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.currencies.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.settings.currencies.index') }}">
                                {{ __('admin::app.layouts.back') }}
                            </a>

                            {!! view_render_event('admin.settings.currencies.edit.form_buttons.after', ['currency' => $currency]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
