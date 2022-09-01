@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.products.view-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">

        {!! view_render_event('admin.products.view.header.before', ['product' => $product]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('products.view', $product) }}

            <div class="page-title" style="padding-top:25px;">
                <h1>{{ __('admin::app.products.view-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.products.view.header.after', ['product' => $product]) !!}

        {!! view_render_event('admin.leads.view.informations.before', ['product' => $product]) !!}

        <div class="page-content">
            <div class="form-container">

                <div class="panel">
                    <div class="panel-header">
                        {!! view_render_event('admin.products.view.form_buttons.before', ['product' => $product]) !!}

                        {{-- <a href="{{ route('admin.products.print', ['id' => $product]) }}">
                            <button type="submit" class="btn btn-md btn-primary">
                            {{ __('admin::app.acl.print') }}
                            </button>
                        </a> --}}

                        <a href="{{ route('admin.products.index') }}">{{ __('admin::app.products.back') }}</a>

                        {!! view_render_event('admin.products.view.form_buttons.after', ['product' => $product]) !!}
                    </div>

                    <div class="panel-body">
                        {!! view_render_event('admin.products.view.form_controls.before', ['product' => $product]) !!}

                        <div class="form-group" :class="[errors.has('sku') ? 'has-error' : '']">
                            <label class="required">
                                {{ __('admin::app.products.item_code') }}
                            </label>

                            <input
                                type="text"
                                name="sku"
                                class="control"
                                value="{{ old('sku', $product->sku) }}"
                                data-vv-as="{{ __('admin::app.products.item_code') }}"
                                disabled
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.products.item_name') }}
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="control"
                                value="{{ old('name', $product->name) }}"
                                data-vv-as="{{ __('admin::app.products.item_name') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('description') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.products.spec') }}
                            </label>

                            <textarea
                                name="description"
                                class="control"
                                data-vv-as="{{ __('admin::app.products.spec') }}"
                                v-pre readonly>{{ old('description', $product->description) }}
                            </textarea>
                        </div>

                        <div class="form-group" :class="[errors.has('remarks') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.products.remarks') }}
                            </label>

                            <textarea
                                name="remarks"
                                class="control"
                                data-vv-as="{{ __('admin::app.products.remarks') }}"
                                v-pre readonly>{{ old('remarks', $product->remarks) }}
                            </textarea>
                        </div>

                        <div class="form-group" :class="[errors.has('unit') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.products.unit') }}
                            </label>

                            <input
                                type="text"
                                name="unit"
                                class="control"
                                value="{{ old('unit', $product->unit) }}"
                                data-vv-as="{{ __('admin::app.products.unit') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('item_category') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.products.item_category') }}
                            </label>

                            <input
                                type="text"
                                name="item_category"
                                class="control"
                                value="{{ old('item_category', $product->item_category) }}"
                                data-vv-as="{{ __('admin::app.products.item_category') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('catalogue_number') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.products.catalogue_number') }}
                            </label>

                            <input
                                type="text"
                                name="catalogue_number"
                                class="control"
                                value="{{ old('catalogue_number', $product->catalogue_number) }}"
                                data-vv-as="{{ __('admin::app.products.catalogue_number') }}"
                                readonly
                            />
                        </div>

                        <div class="lead-product-list">
                            <div class="lead-product">
                                <div class="bottom-control-group" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label>{{ __('admin::app.products.purchase_price') }} (RM)</label>

                                        <div class="control-faker">
                                            <input
                                                type="text"
                                                name="price"
                                                class="control"
                                                value="{{ old('price', $product->price) }}"
                                                data-vv-as="{{ __('admin::app.products.purchase_price') }}"
                                                readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('admin::app.products.sale_price') }} (RM)</label>

                                        <div class="control-faker">
                                            <input
                                                type="text"
                                                name="sale_price"
                                                class="control"
                                                value="{{ old('sale_price', $product->sale_price) }}"
                                                data-vv-as="{{ __('admin::app.products.sale_price') }}"
                                                readonly
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('admin::app.products.quantity') }}</label>

                                        <div class="control-faker">
                                            <input
                                                type="text"
                                                name="quantity"
                                                class="control"
                                                value="{{ old('quantity', $product->quantity) }}"
                                                data-vv-as="{{ __('admin::app.products.quantity') }}"
                                                readonly
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group date">
                            <label>
                                {{ __('admin::app.products.lead_time') }}
                            </label>

                            <div class="input-group">
                                <date>
                                    <input
                                        type="text"
                                        name="lead_time"
                                        class="control"
                                        value="{{ old('lead_time', $product->lead_time) }}"
                                        data-vv-as="{{ __('admin::app.products.lead_time') }}"
                                        disabled
                                    />
                                </date>
                            </div>
                        </div>

                        <div class="form-group date">
                            <label>
                                {{ __('admin::app.products.shelf_life') }}
                            </label>

                            <div class="input-group">
                                <date>
                                    <input
                                        type="text"
                                        name="shelf_life"
                                        class="control"
                                        value="{{ old('shelf_life', $product->shelf_life) }}"
                                        data-vv-as="{{ __('admin::app.products.shelf_life') }}"
                                        disabled
                                    />
                                </date>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Manufacturer</label>

                            <input
                                type="text"
                                name="person_id"
                                class="control"
                                value="{{ old('person_id', $person->name) }}"
                                data-vv-as="{{ __('Manufacturer') }}"
                                readonly
                            />
                        </div>

                        {!! view_render_event('admin.products.view.form_controls.after', ['product' => $product]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
