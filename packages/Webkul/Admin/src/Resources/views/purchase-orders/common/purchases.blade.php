<div class="form-group date" :class="[errors.has('delivery_date') || errors.has('expired_date') ? 'has-error' : '']">
    <label class="required">
        {{ __('admin::app.purchases.date') }}
    </label>

    <div class="input-group">
        <date>
            <input
                type="text"
                name="delivery_date"
                class="control"
                placeholder="{{ __('admin::app.purchases.delivery_date') }}"
                v-validate="'required'"
                data-vv-as="{{ __('admin::app.purchases.delivery_date') }}"
            />
            <span class="control-error" v-if="errors.has('delivery_date')">
                @{{ errors.first('delivery_date') }}
            </span>
        </date>

        <date>
            <input
                type="text"
                name="expired_date"
                class="control"
                placeholder="{{ __('admin::app.purchases.expired_date') }}"
                v-validate="'required'"
                data-vv-as="{{ __('admin::app.purchases.expired_date') }}"
            />
            <span class="control-error" v-if="errors.has('expired_date')">
                @{{ errors.first('expired_date') }}
            </span>
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
                        placeholder="{{ __('admin::app.purchases.purchase_no') }}"
                        v-validate="'required'"
                        data-vv-as="{{ __('admin::app.purchases.purchase_no') }}"
                    />

                    <span class="control-error" v-if="errors.has('purchase_no')">
                        @{{ errors.first('purchase_no') }}
                    </span>
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
                        placeholder="{{ __('admin::app.purchases.ref_no') }}"
                        v-validate="'required'"
                        data-vv-as="{{ __('admin::app.purchases.ref_no') }}"
                    />

                    <span class="control-error" v-if="errors.has('ref_no')">
                        @{{ errors.first('ref_no') }}
                    </span>
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
                        v-validate="'required'"
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
                        v-validate="'required'"
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
                        v-validate="'required'"
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

<input name="progress_status" type="hidden" value="New">
