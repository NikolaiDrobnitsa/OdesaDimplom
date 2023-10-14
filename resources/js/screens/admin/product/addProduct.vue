<template>
    <v-container style="background: white;">
        <v-form ref="form">
            <v-text-field
                :counter="35"
                label="Name"
                v-model="name"
            ></v-text-field>
            <v-textarea
                name="Description"
                label="Enter Description..."
                v-model="description"
            ></v-textarea>

            <v-text-field
                label="Price"
                required
                v-model="price"
            ></v-text-field>
            <v-select
                v-model="category"
                return-object
                :items="categories"
                item-text="name"
                label="Category"
                dense
                outlined
            ></v-select>

            <v-row class="mb-2">
                <font-awesome-icon
                    icon="camera"
                    class="white--text mt-4 ml-2"
                    style="font-size:30px;margin-right:-20px"
                />
                <v-file-input multiple label="Images" show-size v-model="images"></v-file-input>

            </v-row>

            <v-btn color="success" v-on:click="submitForm()" class="mr-4">
                Submit
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>

export default {
    data: function () {
        return{
            name: "",
            price: null,
            images: [],
            description: null,
            categories: [],
            category: ""
        }

    },
    methods: {
        submitForm() {
            const formData = new FormData();
            formData.append('name', this.name);
            formData.append('price', this.price);
            formData.append('description', this.description);
            formData.append('category_id', this.category.id);

            // Добавление каждого изображения в formData
            for (let i = 0; i < this.images.length; i++) {
                formData.append('images[]', this.images[i]);
            }

            axios.post('api/add/product', formData).then(response => {
                if (response.status >= 200 && response.status < 300) {
                    this.$router.push('products');
                }
            });
        },
        getCategories() {
            axios.get("api/categories").then(response => {
                if (response.status >= 200 && response.status < 300) {
                    let categoryArray = [];
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
        this.getCategories();
    }


}
</script>

<style scoped>

</style>
