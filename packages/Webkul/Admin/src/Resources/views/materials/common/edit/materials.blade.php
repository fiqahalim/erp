<div class="lead-product-list">
    <div class="lead-product">
        <div class="bottom-control-group" style="padding-right: 0; margin-top: 1rem;">
            <div class="form-group date" :class="[errors.has('date') ? 'has-error' : '']">
                <label>
                    {{ __('admin::app.materials.date') }}
                </label>

                <date>
                    <input
                        type="text"
                        name="date"
                        class="control"
                        value="{{ old('date', $material->date) }}"
                        data-vv-as="{{ __('admin::app.materials.date') }}"
                        disabled
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

            <div class="form-group" :class="[errors.has('status') ? 'has-error' : '']">
                <label class="required">
                    {{ __('admin::app.materials.status') }}
                </label>

                <select
                    class="control"
                    name="status"
                    data-vv-as="{{ __('admin::app.materials.status') }}"
                    >
                    <option value="Approved">Approved</option>
                    <option value="Reject">Reject</option>
                </select>
            </div>
        </div>
    </div>
</div>
