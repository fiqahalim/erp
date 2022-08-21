@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.contacts.persons.view-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page adjacent-center">

        {!! view_render_event('admin.contacts.persons.view.header.before', ['person' => $person]) !!}

        <div class="page-header">

            {{ Breadcrumbs::render('contacts.persons.view', $person) }}

            <div class="page-title">
                <h1>{{ __('admin::app.contacts.persons.view-title') }}</h1>
            </div>
        </div>

        {!! view_render_event('admin.contacts.persons.view.header.after', ['person' => $person]) !!}

        {!! view_render_event('admin.contacts.persons.view.before', ['person' => $person]) !!}

        <div class="page-content">

            <div class="form-container">

                <div class="panel">
                    <div class="panel-header">
                        {!! view_render_event('admin.contacts.persons.view.details.before', ['person' => $person]) !!}

                        <a href="{{ route('admin.contacts.persons.index') }}">{{ __('admin::app.contacts.persons.back') }}</a>

                        {!! view_render_event('admin.contacts.persons.view.details.after', ['person' => $person]) !!}
                    </div>

                    <div class="panel-body">

                        <div class="form-group" :class="[errors.has('code') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.code') }}
                            </label>

                            <input
                                type="text"
                                name="code"
                                class="control"
                                value="{{ old('code', $person->code) }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.code') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.name') }}
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="control"
                                value="{{ old('name', $person->name) }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.name') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('ceo_name') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.ceo_name') }}
                            </label>

                            <input
                                type="text"
                                name="ceo_name"
                                class="control"
                                value="{{ old('ceo_name', $person->ceo_name) }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.ceo_name') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('bank_name') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.bank_name') }}
                            </label>

                            <input
                                type="text"
                                name="bank_name"
                                class="control"
                                value="{{ old('bank_name', $person->bank_name) }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.bank_name') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('account_no') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.account_no') }}
                            </label>

                            <input
                                type="text"
                                name="account_no"
                                class="control"
                                value="{{ old('account_no', $person->account_no) }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.account_no') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('account_holder') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.account_holder') }}
                            </label>

                            <input
                                type="text"
                                name="account_holder"
                                class="control"
                                value="{{ old('account_holder', $person->account_holder) }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.account_holder') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('business_type') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.business_type') }}
                            </label>

                            <input
                                type="text"
                                name="business_type"
                                class="control"
                                value="{{ old('business_type', $person->business_type) }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.business_type') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('business_item') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.business_item') }}
                            </label>

                            <input
                                type="text"
                                name="business_item"
                                class="control"
                                value="{{ old('business_item', $person->business_item) }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.business_item') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('contact_numbers') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.contact_numbers') }}
                            </label>

                            <input
                                type="text"
                                name="contact_numbers[]"
                                class="control"
                                value="{{ $mobile }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.contact_numbers') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('phone_numbers') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.phone_numbers') }}
                            </label>

                            <input
                                type="text"
                                name="phone_numbers[]"
                                class="control"
                                value="{{ $phone }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.phone_numbers') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('fax_numbers') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.fax_numbers') }}
                            </label>

                            <input
                                type="text"
                                name="fax_numbers[]"
                                class="control"
                                value="{{ $fax }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.fax_numbers') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('emails') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.emails') }}
                            </label>

                            <input
                                type="text"
                                name="emails[]"
                                class="control"
                                value="{{ $email }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.emails') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('address_1') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.address_1') }}
                            </label>

                            <textarea readonly
                                name="{{ $address }}"
                                class="control"
                                v-pre>{{ $address}}
                            </textarea>
                        </div>

                        <div class="form-group" :class="[errors.has('keyword') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.keyword') }}
                            </label>

                            <input
                                type="text"
                                name="keyword"
                                class="control"
                                value="{{ $person->keyword }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.keyword') }}"
                                readonly
                            />
                        </div>

                        <div class="form-group" :class="[errors.has('remarks') ? 'has-error' : '']">
                            <label>
                                {{ __('admin::app.contacts.persons.remarks') }}
                            </label>

                            <input
                                type="text"
                                name="remarks"
                                class="control"
                                value="{{ $person->remarks }}"
                                data-vv-as="{{ __('admin::app.contacts.persons.remarks') }}"
                                readonly
                            />
                        </div>
                    </div>
                </div>

                {!! view_render_event('admin.contacts.persons.view.informations.details.after', ['person' => $person]) !!}

                {!! view_render_event('admin.contacts.persons.view.informations.before', ['person' => $person]) !!}
            </div>
        </div>

        {!! view_render_event('admin.contacts.persons.view.informations.after', ['person' => $person]) !!}
    </div>
@stop
