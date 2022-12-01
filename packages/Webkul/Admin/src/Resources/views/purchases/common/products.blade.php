@push('scripts')
    <script type="text/x-template" id="product-list-template">
        <div class="lead-product-list">
            <product-item
                v-for='(product, index) in products'
                :product="product"
                :key="index"
                :index="index"
                @onRemoveProduct="removeProduct($event)"
            ></product-item>

            <a class="add-more-link" href @click.prevent="addProduct">+ {{ __('admin::app.common.add_more') }}</a>
        </div>
    </script>

    <script type="text/x-template" id="product-item-template">
        <div class="lead-product">
            <div class="top-control-group">
                <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[product_id]') ? 'has-error' : '']">
                    <label for="item_name" class="required">{{ __('admin::app.products.item_name') }}</label>

                    <input
                        type="hidden"
                        :name="[inputName + '[name]']"
                        v-model="product['name']"
                    />

                    <input
                        type="text"
                        :name="[inputName + '[product_id]']"
                        class="control"
                        v-model="product['name']"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.products.item_name') }}&quot;"
                        v-on:keyup="search"
                        placeholder="{{ __('admin::app.common.start-typing') }}"
                    />

                    <input
                        type="hidden"
                        :name="[inputName + '[product_id]']"
                        v-model="product.product_id"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.products.item_name') }}&quot;"
                    />

                    <div class="lookup-results" v-if="state == ''">
                        <ul>
                            <li v-for='(product, index) in products' @click="addProduct(product)">
                                <span>@{{ product.name }}</span>
                            </li>

                            <li v-if="! products.length && product['name'].length && ! is_searching">
                                <span>{{ __('admin::app.common.no-result-found') }}</span>
                            </li>
                        </ul>
                    </div>

                    <i class="icon loader-active-icon" v-if="is_searching"></i>

                    <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[product_id]')">
                        @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[product_id]') }}
                    </span>
                </div>
            </div>

            <div class="top-control-group">
                <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[sku]') ? 'has-error' : '']" style="margin-top:1rem;">
                    <label for="sku">{{ __('admin::app.products.item_code') }}</label>

                    <input
                        type="text"
                        :name="[inputName + '[sku]']"
                        class="control"
                        v-model="product.sku"
                        data-vv-as="&quot;{{ __('admin::app.products.item_code') }}&quot;"
                        readonly
                    />

                    <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[sku]')">
                        @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[sku]') }}
                    </span>
                </div>

                <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[spec]') ? 'has-error' : '']" style="margin-top:1rem;">
                    <label for="spec">{{ __('admin::app.products.spec') }}</label>

                    <input
                        type="text"
                        :name="[inputName + '[spec]']"
                        class="control"
                        v-model="product.spec"
                        data-vv-as="&quot;{{ __('admin::app.products.spec') }}&quot;"
                        readonly
                    />

                    <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[spec]')">
                        @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[spec]') }}
                    </span>
                </div>

                <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[remarks]') ? 'has-error' : '']" style="margin-top:1rem;">
                    <label for="remarks">{{ __('admin::app.products.remarks') }}</label>

                    <input
                        type="text"
                        :name="[inputName + '[remarks]']"
                        class="control"
                        v-model="product.remarks"
                        data-vv-as="&quot;{{ __('admin::app.products.remarks') }}&quot;"
                    />

                    <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[sku]')">
                        @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[sku]') }}
                    </span>
                </div>

                <div class="bottom-control-group" style="margin-top:1rem;padding-right:0;">
                    <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[quantity]') ? 'has-error' : '']">
                        <label for="quantity" class="required">{{ __('admin::app.products.order_unit') }}</label>

                        <input
                            type="text"
                            :name="[inputName + '[quantity]']"
                            class="control"
                            v-model="product.quantity"
                            v-validate="'required'"
                            data-vv-as="&quot;{{ __('admin::app.products.order_unit') }}&quot;"
                        />

                        <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[quantity]')">
                            @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[quantity]') }}
                        </span>
                    </div>

                    <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[unit]') ? 'has-error' : '']">
                        <label for="unit" class="required">{{ __('admin::app.products.unit') }}</label>

                        <input
                            type="text"
                            :name="[inputName + '[unit]']"
                            class="control"
                            v-model="product.unit"
                            data-vv-as="&quot;{{ __('admin::app.products.unit') }}&quot;"
                            readonly
                        />

                        <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[unit]')">
                            @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[unit]') }}
                        </span>
                    </div>

                    <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[packaging]') ? 'has-error' : '']">
                        <label for="packaging" class="required">{{ __('admin::app.products.packaging') }}</label>

                        <input
                            type="text"
                            :name="[inputName + '[packaging]']"
                            class="control"
                            v-model="product.packaging"
                            data-vv-as="&quot;{{ __('admin::app.products.packaging') }}&quot;"
                            readonly
                        />

                        <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[packaging]')">
                            @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[packaging]') }}
                        </span>
                    </div>
                </div>

                <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[additional_spec]') ? 'has-error' : '']" style="margin-top:1rem;margin-bottom:1rem;">
                    <label for="additional_spec">{{ __('admin::app.products.requestor_remark') }}</label>

                    <input
                        type="text"
                        :name="[inputName + '[additional_spec]']"
                        class="control"
                        v-model="product.additional_spec"
                        data-vv-as="&quot;{{ __('admin::app.products.requestor_remark') }}&quot;"
                    />

                    <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[additional_spec]')">
                        @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[additional_spec]') }}
                    </span>
                </div>

                <i class="icon trash-icon" @click="removeProduct"></i>
            </div>

            {{-- <div class="bottom-control-group"> --}}
                {{-- <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[price]') ? 'has-error' : '']">
                    <label for="price" class="required">{{ __('admin::app.leads.price') }}(RM)</label>

                    <input
                        type="text"
                        :name="[inputName + '[price]']"
                        class="control"
                        v-model="product.price"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.leads.price') }}&quot;"
                    />

                    <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[price]')">
                        @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[price]') }}
                    </span>
                </div> --}}

                {{-- <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[quantity]') ? 'has-error' : '']">
                    <label for="quantity" class="required">{{ __('admin::app.leads.quantity') }}</label>

                    <input
                        type="text"
                        :name="[inputName + '[quantity]']"
                        class="control"
                        v-model="product.quantity"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.leads.quantity') }}&quot;"
                    />

                    <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[quantity]')">
                        @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[quantity]') }}
                    </span>
                </div> --}}

                {{-- <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}' + inputName + '[amount]') ? 'has-error' : '']">
                    <label for="amount" class="required">{{ __('admin::app.leads.amount') }}(RM)</label>

                    <input
                        type="text"
                        :name="[inputName + '[amount]']"
                        class="control"
                        v-model="product.price * product.quantity"
                        v-validate="'required'"
                        data-vv-as="&quot;{{ __('admin::app.leads.amount') }}&quot;"
                        disabled
                    />

                    <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}' + inputName + '[amount]')">
                        @{{ errors.first('{!! $formScope ?? '' !!}' + inputName + '[amount]') }}
                    </span>
                </div> --}}

                {{-- <i class="icon trash-icon" @click="removeProduct"></i> --}}
            {{-- </div> --}}
        </div>
    </script>

    <script>
        Vue.component('product-list', {

            template: '#product-list-template',

            props: ['data'],

            inject: ['$validator'],

            data: function () {
                return {
                    products: this.data ? this.data : [],
                }
            },

            methods: {
                addProduct: function() {
                    this.products.push({
                        'id': null,
                        'product_id': null,
                        'name': '',
                        'sku': null,
                        'spec': null,
                        'remarks': null,
                        'additional_spec': null,
                        'quantity': null,
                        'unit': null,
                        'packaging': null,
                        'price': null,
                        'amount': null,
                    })
                },

                removeProduct: function(product) {
                    const index = this.products.indexOf(product);

                    Vue.delete(this.products, index);
                }
            }
        });

        Vue.component('product-item', {

            template: '#product-item-template',

            props: ['index', 'product'],

            inject: ['$validator'],

            data: function () {
                return {
                    is_searching: false,

                    state: this.product['product_id'] ? 'old' : '',

                    products: [],
                }
            },

            computed: {
                inputName: function () {
                    if (this.product.id) {
                        return "products[" + this.product.id + "]";
                    }

                    return "products[product_" + this.index + "]";
                }
            },

            methods: {
                search: debounce(function () {
                    this.state = '';

                    this.product['product_id'] = null;

                    this.is_searching = true;

                    if (this.product['name'].length < 2) {
                        this.products = [];

                        this.is_searching = false;

                        return;
                    }

                    var self = this;

                    this.$http.get("{{ route('admin.products.search') }}", {params: {query: this.product['name']}})
                        .then (function(response) {
                            self.$parent.products.forEach(function(addedProduct) {

                                response.data.forEach(function(product, index) {
                                    if (product.id == addedProduct.product_id) {
                                        response.data.splice(index, 1);
                                    }
                                });

                            });

                            self.products = response.data;

                            self.is_searching = false;
                        })
                        .catch (function (error) {
                            self.is_searching = false;
                        })
                }, 500),

                addProduct: function(result) {
                    this.state = 'old';

                    Vue.set(this.product, 'product_id', result.id)
                    Vue.set(this.product, 'name', result.name)
                    Vue.set(this.product, 'sku', result.sku)
                    Vue.set(this.product, 'spec', result.spec)
                    Vue.set(this.product, 'remarks', result.remarks)
                    Vue.set(this.product, 'additional_spec', result.additional_spec)
                    Vue.set(this.product, 'price', result.price)
                    Vue.set(this.product, 'quantity', result.quantity)
                    Vue.set(this.product, 'unit', result.unit)
                    Vue.set(this.product, 'packaging', result.packaging)
                },

                removeProduct: function () {
                    this.$emit('onRemoveProduct', this.product)
                }
            }
        });
    </script>
@endpush
