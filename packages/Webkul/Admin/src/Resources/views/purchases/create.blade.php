@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.purchases.create-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('admin.purchases.create.header.before') !!}

        <div class="page-header">

            {{ Breadcrumbs::render('purchases.create') }}

            <div class="page-title">
                <h1>{{ __('admin::app.purchases.create-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.purchases.create.header.after') !!}

        <form method="POST" action="{{ route('admin.purchases.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-content">
                <div class="form-container">
                    <div class="panel">
                        <div class="panel-header">
                            {!! view_render_event('admin.purchases.create.form_buttons.before') !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.purchases.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.purchases.index') }}">{{ __('admin::app.purchases.back') }}</a>

                            {!! view_render_event('admin.purchases.create.form_buttons.after') !!}
                        </div>

                        <div class="panel-body">
                            {!! view_render_event('admin.purchases.create.form_controls.before') !!}

                            @csrf()

                            <div class="form-group" :class="[errors.has('purchase_no') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.purchases.purchase_no') }}
                                </label>

                                <input
                                    type="text"
                                    name="purchase_no"
                                    class="control"
                                    placeholder="{{ __('admin::app.purchases.purchase_no') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.purchases.purchase_no') }}"
                                />

                                <span class="control-error" v-if="errors.has('purchase_no')">
                                    @{{ errors.first('purchase_no') }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label>{{ __('admin::app.purchases.date') }}</label>
                                <input
                                    type="date"
                                    name="date"
                                    class="control"
                                    placeholder="{{ __('admin::app.purchases.date') }}"
                                    data-vv-as="{{ __('admin::app.purchases.date') }}"
                                />

                                <span class="control-error" v-if="errors.has('date')">
                                    @{{ errors.first('date') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('person') ? 'has-error' : '']">
                                <label>
                                    {{ __('admin::app.contacts.persons.title') }}
                                </label>

                                <select
                                    name="person_id"
                                    class="control"
                                    data-vv-as="{{ __('admin::app.contacts.persons.title') }}"
                                    v-validate="'required'"
                                    >
                                    @foreach ($persons as $person)
                                    <option value="{{ $person->id }}" {{ old('person_id') == $person->id ? 'selected' : '' }}>
                                        {{ $person->code }} | {{ $person->company_name }}
                                    </option>
                                    @endforeach
                                </select>

                                <span class="control-error" v-if="errors.has('person_id')">
                                    @{{ errors.first('person_id') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('user') ? 'has-error' : '']">
                                <label>
                                    {{ __('admin::app.settings.users.title') }}
                                </label>

                                <select
                                    name="user_id"
                                    class="control"
                                    data-vv-as="{{ __('admin::app.settings.users.title') }}"
                                    v-validate="'required'"
                                    >
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->code }} | {{ $user->name }}
                                    </option>
                                    @endforeach
                                </select>

                                <span class="control-error" v-if="errors.has('user_id')">
                                    @{{ errors.first('user_id') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('product') ? 'has-error' : '']">
                                <label>
                                    {{ __('admin::app.products.title') }}
                                </label>

                                <select
                                    name="product_id"
                                    class="control"
                                    data-vv-as="{{ __('admin::app.products.title') }}"
                                    v-validate="'required'"
                                    >
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->item_code }} | {{ $product->item_name }}
                                    </option>
                                    @endforeach
                                </select>

                                <span class="control-error" v-if="errors.has('product_id')">
                                    @{{ errors.first('product_id') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('location') ? 'has-error' : '']">
                                <label>
                                    {{ __('admin::app.products.title') }}
                                </label>

                                <select
                                    name="product_id"
                                    class="form control"
                                    data-vv-as="{{ __('admin::app.products.title') }}"
                                    v-validate="'required'"
                                    >
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('product_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->item_code }} | {{ $location->item_name }}
                                    </option>
                                    @endforeach
                                </select>

                                <span class="control-error" v-if="errors.has('product_id')">
                                    @{{ errors.first('product_id') }}
                                </span>
                            </div>

                            {!! view_render_event('admin.purchases.create.form_controls.after') !!}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
