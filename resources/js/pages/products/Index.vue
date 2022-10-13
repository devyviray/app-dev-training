<template>
    <div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">All Products</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" @click="openModal()" class="btn btn-sm btn-outline-primary">New</button>
            </div> 
        </div>

        <table class="table">
            <thead>
                <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Product Details</th>
                <th scope="col">Option</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="loading === false && products" v-for="(product,i) in products.data" :key="i">
                    <td>{{ product.name }}</td>
                    <td>{{ product.detail }}</td>
                    <td>
                        <button @click="modifyProduct(product)" class="btn btn-primary">Edit</button>
                        <button @click="deleteProduct(i,product.id)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>

                <tr v-if="loading === true">
                    <td colspan="2">
                        <div class="spiner-example">
                            <!-- <div class="sk-spinner sk-spinner-double-bounce">
                                <div class="sk-double-bounce1"></div>
                                <div class="sk-double-bounce2"></div>
                            </div> -->
                            <p class="text-center">
                                Please wait...
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

            <div class="row mb-3">
                <div class="col-6">
                    <button :disabled="products.current_page == 1" @click="prevPage()" class="btn btn-primary btn-sm btn-fill"> Previous </button>
                        <span class="text-dark">Page {{ products.current_page  }} of {{ products.last_page }}</span>
                    <!-- <button :disabled="!showNextLink()" class="btn btn-default btn-sm btn-fill"> Next </button> -->
                    <button  @click="nextPage()" :disabled="products.current_page == products.last_page" class="btn btn-primary btn-sm btn-fill"> Next </button>
                </div>
                <div class="col-6 text-right">
                    <span>{{ products.total }} Total</span>
                </div>
            </div>

            <!-- modal component -->
            <modal-product 
                :product="product" 
                :isForEdit="isForEdit"
                @resetEdit="isForEdit = $event"
                @returnUpdate="updateProduct($event)"
                @return="pushNewProduct($event)"
                @close="show = $event"
                :show="show">
            </modal-product>

    </div>
</template>

<script>
    import ModalProduct from '../../components/ModalProduct.vue';

    export default {

        data() {
            return {
                show: false,
                loading: false,
                products: [],
                search: "",
                current_page: 1,
                last_page_url: "",
                next_page_url: "",
                prev_page_url: "",
                isForEdit: false,
                product: {},
            }
        },

        components: {
            ModalProduct,
        },
        
        mounted() {
            console.log('Component mounted.')
            this.fetchProducts();
        },

        methods: {

            openModal() {
                this.show = !this.show;
            },

            pushNewProduct(event) {
                this.products.data.push(event);
            },

            fetchProducts() {
                this.loading = true;
                axios.get(`/api/products`)
                .then(response => {
                    console.log('response: ', response.data)
                    this.products = response.data
                    this.loading = false;
                })
            },

            deleteProduct(index, id) {
                axios.delete(`/api/products/${id}`)
                .then(response => {
                    if(response.status === 200 || response.status === 201) {
                        this.products.data.splice(index,1);
                    }
                })
            },

            modifyProduct(product) {
                this.show = !this.show;
                this.product = product;
                this.isForEdit = true;
            },


            // event = new product {id, name, detail, created_at, updated_at}
            // find index in prodcuts wherin the value is the event.id (1) == current product where in the id == 1
            // current view of the products === updated event
            // as a result the product entry will change based form event data

            updateProduct(event) {

                let findProduct = this.products.data.findIndex(x => x.id === event.id);

                this.products.data[findProduct] = event;
                
            },

            prevPage() {
                this.loading = true
                axios.get(`${this.products.prev_page_url}`)
                .then(response => {
                    this.products = response.data;
                    this.loading = false;
                });
            },

            nextPage() {
                this.loading = true
                axios.get(`${this.products.next_page_url}`)
                .then(response => {
                    console.log('check response ter: ', response)
                    this.products = response.data
                    this.loading = false;
                });
            },
        }
        
    }
</script>
