<template>
    <span>
        <v-toolbar color="white" >

            <v-toolbar-title >
                <router-link to="/home">

                <v-img src="/assets/logo_2.jpg" max-height="55" max-width="55" contain></v-img>
                </router-link>
            </v-toolbar-title>

                <div class="font-weight-medium black--text ml-2 text-h5">Одеса</div>

                <v-spacer></v-spacer>
            <v-btn class="hidden-sm-and-down white font-weight-bold black--text" @click="() => this.$router.push({name: 'Shop'})">Бронювання будиночків</v-btn>
            <v-btn class="hidden-md-and-up white font-weight-bold black--text" @click="() => this.$router.push({name: 'Shop'})">Бронювання</v-btn>
<!--                <v-btn class="hidden-sm-and-down white font-weight-bold black&#45;&#45;text" @click="() => this.$router.push({name: 'Shop'})">Бронювання будиночків</v-btn>-->
            <!-- <v-btn class="hidden-sm-and-down white font-weight-bold black--text ml-3">Order now</v-btn> -->
                <v-spacer></v-spacer>
        </v-toolbar>
    </span>
</template>

<script>
export default {

}
</script>

<style scoped>

</style>
