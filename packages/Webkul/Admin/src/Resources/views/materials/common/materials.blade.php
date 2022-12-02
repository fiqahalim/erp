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

        <option value="{{ $users->id }}" {{ old('user_id') == $users->id ? 'selected' : '' }}>
            {{ Str::upper($dept) }} | {{ Str::upper($users->name) }}
        </option>
    </select>

    <span class="control-error" v-if="errors.has('user_id')">
        @{{ errors.first('user_id') }}
    </span>
</div>

<input name="status" type="hidden" value="Pending">
