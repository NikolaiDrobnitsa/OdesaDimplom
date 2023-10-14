<template>
    <div>
        <div>
            <v-toolbar
                dark
                src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
            >
                <v-toolbar-title>Odesa Admin</v-toolbar-title>

                <v-spacer></v-spacer>
                <v-btn  @click="() => this.$router.push('addCategory')" class="mr-2">
                    Add Category
                </v-btn>
                <v-btn @click="() => this.$router.push('categories')">
                     Categories
                </v-btn>
                <v-btn @click="() => this.$router.push('products')" class="ml-2">
                    Products
                </v-btn>
                <v-btn @click="() => this.$router.push('addProduct')" class="ml-2">
                    AddProduct
                </v-btn>
                <v-btn @click="() => this.$router.push('bookings')" class="ml-2">
                    Booking
                </v-btn>
                <v-btn @click="() => this.$router.push('addBooking')" class="ml-2">
                    addBooking
                </v-btn>
                <v-btn class="mx-2" fab dark medium color="red" v-on:click="logout()">
                    <font-awesome-icon icon="sign-out-alt" style="font-size:25px"></font-awesome-icon>
                </v-btn>

            </v-toolbar>
        </div>
    </div>
</template>

<script>


import EventBus from "../../eventbus";

export default {


    methods: {
        logout() {
            axios.post('admin/logout').then(response => {
                if(response.status >= 200 && response.status < 300) {
                    EventBus.$emit('authCheck')
                    this.$router.push({name: 'Login'})
                }
            })
        }
    },
}
</script>

<style scoped>

</style>
