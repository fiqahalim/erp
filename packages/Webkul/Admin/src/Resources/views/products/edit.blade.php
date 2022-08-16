@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.products.edit-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">
        {!! view_render_event('admin.products.edit.header.before', ['product' => $product]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('products.edit', $product) }}

            <div class="page-title">
                <h1>{{ __('admin::app.products.edit-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.products.edit.header.after', ['product' => $product]) !!}

        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-content">
                <div class="form-container">

                    <div class="panel">
                        <div class="panel-header">
                            {!! view_render_event('admin.products.edit.form_buttons.before', ['product' => $product]) !!}

                            <button type="submit" class="btn btn-md btn-primary">
                                {{ __('admin::app.products.save-btn-title') }}
                            </button>

                            <a href="{{ route('admin.products.index') }}">{{ __('admin::app.products.back') }}</a>

                            {!! view_render_event('admin.products.edit.form_buttons.after', ['product' => $product]) !!}
                        </div>
        
                        <div class="panel-body">
                            {!! view_render_event('admin.products.edit.form_controls.before', ['product' => $product]) !!}

                            @csrf()

                            <input name="_method" type="hidden" value="PUT">

                            <div class="form-group" :class="[errors.has('item_code') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.item_code') }}
                                </label>

                                <input
                                    type="text"
                                    name="item_code"
                                    class="control"
                                    value="{{ $product->item_code }}"
                                    placeholder="{{ __('admin::app.products.item_code') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.item_code') }}"
                                />

                                <span class="control-error" v-if="errors.has('item_code')">
                                    @{{ errors.first('item_code') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('item_name') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.item_name') }}
                                </label>

                                <input
                                    type="text"
                                    name="item_name"
                                    class="control"
                                    value="{{ $product->item_name }}"
                                    placeholder="{{ __('admin::app.products.item_name') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.item_name') }}"
                                />

                                <span class="control-error" v-if="errors.has('item_name')">
                                    @{{ errors.first('item_name') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('spec') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.spec') }}
                                </label>

                                <input
                                    type="text"
                                    name="spec"
                                    class="control"
                                    value="{{ $product->spec }}"
                                    placeholder="{{ __('admin::app.products.spec') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.spec') }}"
                                />

                                <span class="control-error" v-if="errors.has('spec')">
                                    @{{ errors.first('spec') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('additional_spec') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.additional_spec') }}
                                </label>

                                <textarea name="description" class="control">{{ old('additional_spec') }}</textarea>

                                <span class="control-error" v-if="errors.has('additional_spec')">
                                    @{{ errors.first('additional_spec') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('remarks') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.remarks') }}
                                </label>

                                <input
                                    type="text"
                                    name="remarks"
                                    class="control"
                                    value="{{ $product->remarks }}"
                                    placeholder="{{ __('admin::app.products.remarks') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.remarks') }}"
                                />

                                <span class="control-error" v-if="errors.has('remarks')">
                                    @{{ errors.first('remarks') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('purchase_price') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.purchase_price') }} (RM)
                                </label>

                                <input
                                    type="text"
                                    name="purchase_price"
                                    class="control"
                                    value="{{ number_format($product->purchase_price, 2, '.', ',') }}"
                                    placeholder="{{ __('admin::app.products.purchase_price') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.purchase_price') }}"
                                />

                                <span class="control-error" v-if="errors.has('purchase_price')">
                                    @{{ errors.first('purchase_price') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('sale_price') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.sale_price') }} (RM)
                                </label>

                                <input
                                    type="text"
                                    name="sale_price"
                                    class="control"
                                    value="{{ number_format($product->sale_price, 2, '.', ',') }}"
                                    placeholder="{{ __('admin::app.products.sale_price') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.sale_price') }}"
                                />

                                <span class="control-error" v-if="errors.has('sale_price')">
                                    @{{ errors.first('sale_price') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('unit') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.unit') }}
                                </label>

                                <input
                                    type="text"
                                    name="unit"
                                    class="control"
                                    value="{{ $product->unit }}"
                                    placeholder="{{ __('admin::app.products.unit') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.unit') }}"
                                />

                                <span class="control-error" v-if="errors.has('unit')">
                                    @{{ errors.first('unit') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('catalogue_number') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.catalogue_number') }}
                                </label>

                                <input
                                    type="text"
                                    name="catalogue_number"
                                    class="control"
                                    value="{{ $product->catalogue_number }}"
                                    placeholder="{{ __('admin::app.products.catalogue_number') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.catalogue_number') }}"
                                />

                                <span class="control-error" v-if="errors.has('catalogue_number')">
                                    @{{ errors.first('catalogue_number') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('lead_time') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.lead_time') }}
                                </label>

                                <input
                                    type="text"
                                    name="lead_time"
                                    class="control"
                                    value="{{ $product->lead_time }}"
                                    placeholder="{{ __('admin::app.products.lead_time') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.lead_time') }}"
                                />

                                <span class="control-error" v-if="errors.has('lead_time')">
                                    @{{ errors.first('lead_time') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('shelf_life') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.shelf_life') }}
                                </label>

                                <input
                                    type="text"
                                    name="shelf_life"
                                    class="control"
                                    value="{{ $product->shelf_life }}"
                                    placeholder="{{ __('admin::app.products.shelf_life') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.shelf_life') }}"
                                />

                                <span class="control-error" v-if="errors.has('shelf_life')">
                                    @{{ errors.first('shelf_life') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('barcode') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.barcode') }}
                                </label>

                                <input
                                    type="text"
                                    name="barcode"
                                    class="control"
                                    value="{{ $product->barcode }}"
                                    placeholder="{{ __('admin::app.products.barcode') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.barcode') }}"
                                />

                                <span class="control-error" v-if="errors.has('barcode')">
                                    @{{ errors.first('barcode') }}
                                </span>
                            </div>

                            <div class="form-group" :class="[errors.has('quantity') ? 'has-error' : '']">
                                <label class="required">
                                    {{ __('admin::app.products.quantity') }}
                                </label>

                                <input
                                    type="text"
                                    name="quantity"
                                    class="control"
                                    value="{{ $product->quantity }}"
                                    placeholder="{{ __('admin::app.products.quantity') }}"
                                    v-validate="'required'"
                                    data-vv-as="{{ __('admin::app.products.quantity') }}"
                                />

                                <span class="control-error" v-if="errors.has('quantity')">
                                    @{{ errors.first('quantity') }}
                                </span>
                            </div>

                            {!! view_render_event('admin.products.edit.form_controls.after', ['product' => $product]) !!}

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
