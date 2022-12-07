<div class="form-group date">
    <label class="required">
        {{ __('admin::app.purchases.date') }}
    </label>

    <div class="input-group">
        <date>
            <input
                type="text"
                name="created_at"
                class="control"
                value="{{ old('created_at', $purchase->created_at) }}"
                data-vv-as="{{ __('admin::app.purchases.created_at') }}"
                disabled
            />
        </date>
        <span class="control-error" v-if="errors.has('created_at')">
            @{{ errors.first('created_at') }}
        </span>

        {{-- <date>
            <input
                type="text"
                name="expired_date"
                class="control"
                value="{{ old('expired_date', $purchase->expired_date) }}"
                data-vv-as="{{ __('admin::app.purchases.expired_date') }}"
            />
        </date>
        <span class="control-error" v-if="errors.has('expired_date')">
            @{{ errors.first('expired_date') }}
        </span> --}}
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
                        disabled
                    />

                    <span class="control-error" v-if="errors.has('purchase_no')">
                        @{{ errors.first('purchase_no') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- <div class="top-control-group">
            <div class="form-group">
                <label>{{ __('admin::app.purchases.ref_no') }}</label>

                <div class="control-faker">
                    <input
                        type="text"
                        name="ref_no"
                        class="control"
                        value="{{ old('ref_no', $purchase->ref_no) }}"
                        data-vv-as="{{ __('admin::app.purchases.ref_no') }}"
                        disabled
                    />

                    <span class="control-error" v-if="errors.has('ref_no')">
                        @{{ errors.first('ref_no') }}
                    </span>
                </div>
            </div>
        </div> --}}

        <div class="bottom-control-group" :class="[errors.has('user') ? 'has-error' : '']" style="padding-right: 0; margin-top: 1rem;">
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
                        name="group_id"
                        class="control"
                        data-vv-as="{{ __('admin::app.contacts.persons.title') }}"
                        >
                        @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                            {{ $group->name }}
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
        v-validate="'required'"
        >
        <option value="Pending Review by Department HoD">Pending Review by Department HoD</option>
        <option value="Pending Review by Procurement">Pending Review by Procurement</option>
        <option value="Request Amendment">Request Amendment</option>
        <option value="PO Release">PO Release</option>
        <option value="Received">Received</option>
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
        >
        <span class="slider round"></span>
    </label>
</div>
