<div class="form-group date" :class="[errors.has('date') ? 'has-error' : '']">
    <label>
        {{ __('admin::app.purchases.delivery_date') }} and {{ __('admin::app.purchases.expired_date') }}
    </label>

    <div class="input-group">
        <date>
            <input
                type="text"
                name="delivery_date"
                class="control"
                value="{{ old('delivery_date', $purchase->delivery_date) }}"
                data-vv-as="{{ __('admin::app.purchases.delivery_date') }}"
                disabled
            />
        </date>

        <date>
            <input
                type="text"
                name="expired_date"
                class="control"
                value="{{ old('expired_date', $purchase->expired_date) }}"
                data-vv-as="{{ __('admin::app.purchases.expired_date') }}"
                disabled
            />
        </date>
    </div>
</div>

<div class="lead-product-list">
    <div class="lead-product">
        <div class="top-control-group">
            <div class="form-group">
                <label>{{ __('admin::app.purchases.purchase_no') }}</label>

                <div class="control-faker">
                    <input
                        type="text"
                        name="purchase_no"
                        class="control"
                        value="{{ old('purchase_no', $purchase->purchase_no) }}"
                        v-validate="'required'"
                        data-vv-as="{{ __('admin::app.purchases.purchase_no') }}"
                        readonly
                    />
                </div>
            </div>
        </div>

        <div class="top-control-group">
            <div class="form-group">
                <label>{{ __('admin::app.purchases.ref_no') }}</label>

                <div class="control-faker">
                    <input
                        type="text"
                        name="ref_no"
                        class="control"
                        value="{{ old('ref_no', $purchase->ref_no) }}"
                        data-vv-as="{{ __('admin::app.purchases.ref_no') }}"
                        readonly
                    />
                </div>
            </div>
        </div>

        <div class="bottom-control-group" :class="[errors.has('user') ? 'has-error' : '']" style="padding-right: 0;">
            <div class="form-group">
                <label>{{ __('admin::app.settings.users.title') }}</label>

                <div class="control-faker">
                    <select
                        name="user_id"
                        class="control"
                        data-vv-as="{{ __('admin::app.settings.users.title') }}"
                        disabled
                        >
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->code }} | {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group" :class="[errors.has('person') ? 'has-error' : '']">
                <label>{{ __('admin::app.contacts.persons.title') }}</label>

                <div class="control-faker">
                    <select
                        name="person_id"
                        class="control"
                        data-vv-as="{{ __('admin::app.contacts.persons.title') }}"
                        disabled
                        >
                        @foreach ($persons as $person)
                        <option value="{{ $person->id }}" {{ old('person_id') == $person->id ? 'selected' : '' }}>
                            {{ $person->code }} | {{ $person->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group" :class="[errors.has('location') ? 'has-error' : '']">
                <label>{{ __('admin::app.locations.title') }}</label>

                <div class="control-faker">
                    <select
                        name="location_id"
                        class="control"
                        data-vv-as="{{ __('admin::app.locations.title') }}"
                        disabled
                        >
                        @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->location_code }} - {{ $location->location_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group" :class="[errors.has('progress_status') ? 'has-error' : '']">
    <label>
        {{ __('admin::app.purchases.progress_status') }}
    </label>

    <select
        class="control"
        name="progress_status"
        data-vv-as="{{ __('admin::app.purchases.progress_status') }}"
        disabled
        >
        <option value="In Progress">In Progress</option>
        <option value="Finish">Finished</option>
        <option value="Cancel">Cancel</option>
    </select>
</div>

<div class="form-group" :class="[errors.has('approved') ? 'has-error' : '']">
    <label>
        {{ __('admin::app.purchases.approved') }}?
    </label>
    <label class="switch">
        <input
            type="checkbox"
            name="approved"
            class="control"
            value="1"
            data-vv-as="&quot;{{ $purchase->id }}&quot;"
            {{ $purchase->approved ? 'checked' : ''}}
            disabled
        >
        <span class="slider round"></span>
    </label>
</div>
