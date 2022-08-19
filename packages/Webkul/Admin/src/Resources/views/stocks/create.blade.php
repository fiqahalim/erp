@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.stocks.create-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('admin.stocks.create.header.before') !!}

        <div class="page-header">

            {{ Breadcrumbs::render('stocks.create') }}

            <div class="page-title">
                <h1>{{ __('admin::app.stocks.create-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.stocks.create.header.after') !!}

        <form  method="POST" action="{{ route('admin.stocks.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-content">
                <div class="form-container">
                    <div class="panel">
                        <div class="panel-header">
                            {!! view_render_event('admin.stocks.create.form_buttons.before') !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.stocks.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.stocks.index') }}">{{ __('admin::app.stocks.back') }}</a>

                            {!! view_render_event('admin.stocks.create.form_buttons.after') !!}
                        </div>

                        <div class="panel-body">
                            {!! view_render_event('admin.stocks.create.form_controls.before') !!}

                            @csrf()

                            <div class="form-group date" :class="[errors.has('expired_at') ? 'has-error' : '']">
                                <label>{{ __('admin::app.stocks.expired_at') }}</label>

                                <date>
                                    <input
                                        type="text"
                                        name="expired_at"
                                        class="control"
                                        placeholder="{{ __('admin::app.stocks.expired_at') }}"
                                        data-vv-as="{{ __('admin::app.stocks.expired_at') }}"
                                    />

                                    <span class="control-error" v-if="errors.has('expired_at')">
                                        @{{ errors.first('expired_at') }}
                                    </span>
                                </date>
                            </div>

                            <div class="form-group" :class="[errors.has('product') ? 'has-error' : '']">
                                <label>
                                    {{ __('admin::app.products.title') }}
                                </label>

                                <select
                                    name="product_id"
                                    class="control"
                                    data-vv-as="{{ __('admin::app.contacts.persons.title') }}"
                                    v-validate="'required'"
                                    >
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->sku }} | {{ $product->name }}
                                    </option>
                                    @endforeach
                                </select>

                                <span class="control-error" v-if="errors.has('product_id')">
                                    @{{ errors.first('product_id') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('current_stock') ? 'has-error' : '']">
                                <label>
                                    {{ __('admin::app.stocks.balance') }}
                                </label>

                                <input
                                    type="number"
                                    name="current_stock"
                                    class="control"
                                    placeholder="{{ __('admin::app.stocks.balance') }}"
                                    data-vv-as="{{ __('admin::app.stocks.balance') }}"
                                />

                                <span class="control-error" v-if="errors.has('current_stock')">
                                    @{{ errors.first('current_stock') }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
