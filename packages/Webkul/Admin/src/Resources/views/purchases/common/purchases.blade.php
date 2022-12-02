<div class="form-group date">
    <label class="required">
        {{ __('admin::app.purchases.created_at') }}
    </label>

    <div class="input-group">
        <date>
            <input
                type="text"
                name="created_at"
                class="control"
                placeholder="{{ __('admin::app.purchases.created_at') }}"
                v-validate="'required'"
                data-vv-as="{{ __('admin::app.purchases.created_at') }}"
            />
            <span class="control-error" v-if="errors.has('created_at')">
                @{{ errors.first('created_at') }}
            </span>
        </date>

        {{-- <date>
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
        </date> --}}
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

        {{-- <div class="top-control-group">
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
        </div> --}}

        <div class="bottom-control-group" :class="[errors.has('user') ? 'has-error' : '']" style="padding-right: 0; margin-top: 1rem;">
            <div class="form-group">
                <label>{{ __('admin::app.settings.users.title') }}</label>

                <div class="control-faker">
                    <select
                        name="user_id"
                        class="control"
                        data-vv-as="{{ __('admin::app.settings.users.title') }}"
                        v-validate="'required'"
                        >

                        <option value="{{ $users->id }}" {{ old('user_id') == $users->id ? 'selected' : '' }}>
                            {{ $users->code }} | {{ $users->name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group" :class="[errors.has('person') ? 'has-error' : '']">
                <label>{{ __('admin::app.contacts.persons.department') }}</label>

                <div class="control-faker">
                    <select
                        name="group_id"
                        class="control"
                        data-vv-as="{{ __('admin::app.contacts.persons.department') }}"
                        v-validate="'required'"
                        >
                        <option>Please Select</option>
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
                        v-validate="'required'"
                        >
                        <option>Please Select</option>
                        @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->location_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<input name="progress_status" type="hidden" value="New">
