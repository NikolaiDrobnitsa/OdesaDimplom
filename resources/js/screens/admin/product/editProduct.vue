<template>
    <v-container style="background: white;">
        <v-form ref="form">
            <v-text-field
                :counter="35"
                label="Name"
                v-model="name"
                :value="name"
            ></v-text-field>
            <v-textarea
                name="Description"
                label="Enter Description..."
                v-model="description"
                :value="description"
            ></v-textarea>

            <v-text-field
                label="Price"
                required
                v-model="price"
                :value="price"
            ></v-text-field>
            <v-select
                v-model="category"
                return-object
                :items="categories"
                item-text="name"
                dense
                outlined
            >
            </v-select>


            <v-btn color="success" v-on:click="submitForm()" class="mr-4">
                Submit
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>


export default {
    props: ['product'],
    data: function () {
        return{
            name: this.product.name,
            price: this.product.price,
            description: this.product.description,
            categories: [],
            category: this.product.category


        }
    },
    methods: {
        submitForm(){
            const FormData = require('form-data');
            const formData = new FormData();
            this.name && formData.append('name', this.name);
            this.price && formData.append('price', this.price);
            this.description && formData.append('description', this.description);
            this.category && formData.append('category_id', this.category.id);
            axios.post('api/update/product/' + this.product.id,formData).then(response =>{
                if (response.status >= 200 && response.status < 300){
                    this.$router.push('products')
                }
            })
        },
        getCategories() {
            axios.get("api/categories").then(response => {
                if (response.status >= 200 && response.status < 300) {
                    var categoryArray = [];
                    response.data.categories.map(category => {
                        categoryArray.push({
                            name: category.name,
                            id: category.id
                        });
                    });
                    this.categories = categoryArray;
                }
            });
        }
    },
    mounted() {
        this.getCategories()
    }

}
</script>

<style scoped>

</style>
