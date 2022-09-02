<div class="form-group date" :class="[errors.has('date') ? 'has-error' : '']">
    <label>
        {{ __('admin::app.materials.date') }}
    </label>

    <div class="input-group">
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
    </div>
</div>

<div class="lead-product-list">
    <div class="lead-product">
        <div class="top-control-group">
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
        </div>

        <div class="top-control-group">
            <div class="form-group">
                <label>{{ __('admin::app.materials.qc_insp_req_no') }}</label>

                <div class="control-faker">
                    <input
                        type="text"
                        name="qc_insp_req_no"
                        class="control"
                        value="{{ old('qc_insp_req_no', $material->qc_insp_req_no) }}"
                        data-vv-as="{{ __('admin::app.materials.qc_insp_req_no') }}"
                        readonly
                    />
                </div>
            </div>
        </div>

         <div class="top-control-group">
            <div class="form-group">
                <label>{{ __('admin::app.materials.inspection_method') }}</label>

                <div class="control-faker">
                    <input
                        type="text"
                        name="inspection_method"
                        class="control"
                        value="{{ old('inspection_method', $material->inspection_method) }}"
                        data-vv-as="{{ __('admin::app.materials.inspection_method') }}"
                        readonly
                    />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group" :class="[errors.has('approved') ? 'has-error' : '']">
    <label>
        {{ __('admin::app.materials.approved') }}?
    </label>
    <label class="switch">
        <input
            type="checkbox"
            name="approved"
            class="control"
            value="1"
            data-vv-as="&quot;{{ $material->id }}&quot;"
            {{ $material->approved ? 'checked' : ''}}
            disabled
        >
        <span class="slider round"></span>
    </label>
</div>
