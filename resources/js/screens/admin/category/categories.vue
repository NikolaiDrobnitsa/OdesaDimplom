<template>
    <v-simple-table>
        <template v-slot:default>
            <thead>
            <tr >
                <th class="text-center">
                    Свілина
                </th>
                <th class="text-center">
                    Назва категорії
                </th>
                <th class="text-center">
                    Кількість
                </th>
                <th class="text-center">
                    Редагування
                </th>
                <th class="text-center">

                    Видалення
                </th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="category in categories" :key="category.id">
                <td  class="text-center">
                    <div v-if="category.image">
                        <img class="pt-2" :src="url+'/categories/'+category.image" style="height: 100px; width: 100px" alt="">
                    </div>
                    <div v-else>
                        <img class="pt-2" src="https://thumb.tildacdn.com/tild6463-3761-4638-a261-653363643361/-/format/webp/IMG_4057.JPG" style="height: 100px; width: 100px" alt="">
                    </div>
                </td>
                <td class="text-center">{{ category.name}}</td>
                <td class="text-center">{{ category.order}}</td>
                <td class="text-center">
                    <v-btn
                        class="mx-2"
                        fab
                        dark
                        large
                        color="cyan"
                        v-on:click="() => $router.push({name: 'editCategory', params: {category}})"
                    >
                        <font-awesome-icon icon="pen" />
                    </v-btn>
                </td>
                <td class="text-center">
                    <v-btn
                        class="mx-2"
                        fab
                        dark
                        large
                        color="red"
                        v-on:click="deleteCategory(category.id)"
                    >
                        <font-awesome-icon icon="trash" />
                    </v-btn>
                </td>
            </tr>
            </tbody>
        </template>
    </v-simple-table>
</template>

<script>
export default {
    data () {
        return {
            categories: [],
            url: window.location.origin
        }
    },
    methods:{
        getCategories(){
            axios.get('api/categories')
                .then(response =>{
                    if (response.status >= 200 && response.status < 300){
                        this.categories = response.data.categories;
                    }
                })
        },

        deleteCategory(id){
            axios.get('api/delete/category/'+id).then(response =>{
                if (response.status >= 200 && response.status < 300){
                    alert(response.data.message)
                    this.getCategories()
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
