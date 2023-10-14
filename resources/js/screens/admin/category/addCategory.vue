<template>
    <v-container style="background: white;">
        <v-form ref="form">
            <v-text-field
                :counter="35"
                label="Назва"
                v-model="name"
            ></v-text-field>

            <v-text-field
                label="Кількість"
                required
                v-model="order"
            ></v-text-field>

            <v-row class="mb-2">
                <font-awesome-icon
                    icon="camera"
                    class="white--text mt-4 ml-2"
                    style="font-size:30px;margin-right:-20px"
                />
                <v-file-input label="Світлина" show-size v-model="image"></v-file-input>
            </v-row>

            <v-btn color="success" v-on:click="submitForm()" class="mr-4">
                Створити категорію
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data: function(){
        return{
            name: '',
            order: null,
            image: null
        }
    },
    methods: {
        submitForm(){
            const FormData = require('form-data');
            const formData = new FormData();
            formData.append('name', this.name);
            formData.append('order', this.order);
            formData.append('image', this.image);
            axios.post('api/add/category',formData).then(response =>{
                if (response.status >= 200 && response.status < 300){
                    this.$router.push('categories')
                }
            })
        }
    }
}
</script>

<style  scoped>

</style>
