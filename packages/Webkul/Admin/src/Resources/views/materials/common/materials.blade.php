<div class="form-group date" :class="[errors.has('date') ? 'has-error' : '']">
    <label class="required">
        {{ __('admin::app.materials.date') }}
    </label>

    <date>
        <input
            type="text"
            name="date"
            class="control"
            placeholder="{{ __('admin::app.materials.date') }}"
            v-validate="'required'"
            data-vv-as="{{ __('admin::app.materials.date') }}"
        />
    </date>
    <span class="control-error" v-if="errors.has('date')">
        @{{ errors.first('date') }}
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

<div class="form-group" :class="[errors.has('qc_insp_req_no') ? 'has-error' : '']">
    <label class="required">
        {{ __('admin::app.materials.qc_insp_req_no') }}
    </label>

    <input
        type="text"
        name="qc_insp_req_no"
        class="control"
        placeholder="{{ __('admin::app.materials.qc_insp_req_no') }}"
        v-validate="'required'"
        data-vv-as="{{ __('admin::app.materials.qc_insp_req_no') }}"
    />

    <span class="control-error" v-if="errors.has('qc_insp_req_no')">
        @{{ errors.first('qc_insp_req_no') }}
    </span>
</div>

<div class="form-group" :class="[errors.has('qc_insp_req_no') ? 'has-error' : '']">
    <label>
        {{ __('admin::app.materials.inspection_method') }}
    </label>

    <select
        class="control"
        name="inspection_method"
        data-vv-as="{{ __('admin::app.materials.inspection_method') }}"
        v-validate="'required'"
        >
        <option value="Lot">Lot</option>
        <option value="Sampling">Sampling</option>
    </select>
</div>
