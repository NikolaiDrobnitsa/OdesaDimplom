<template>
    <v-container style="background: white;">
        <v-form ref="form">
            <v-text-field
                :counter="35"
                label="Name"
                v-model="name"
            ></v-text-field>

            <v-text-field
                label="Order"
                required
                v-model="order"
            ></v-text-field>

            <v-row class="mb-2">
                <font-awesome-icon
                    icon="camera"
                    class="white--text mt-4 ml-2"
                    style="font-size:30px;margin-right:-20px"
                />
                <v-file-input label="Image" show-size v-model="image"></v-file-input>
            </v-row>

            <v-btn color="success" v-on:click="submitForm()" class="mr-4">
                Submit
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>
export default {
    props: ['category'],
    data: function () {
        return{
            name: this.category.name,
            order: this.category.order,
            image: null
        }
    },
    methods: {
        submitForm(){
            const FormData = require('form-data');
            const formData = new FormData();
            this.name && formData.append('name', this.name);
            this.order && formData.append('order', this.order);
            this.image && formData.append('image', this.image);
            axios.post('api/update/category/' + this.category.id,formData).then(response =>{
                if (response.status >= 200 && response.status < 300){
                    this.$router.push('categories')
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
