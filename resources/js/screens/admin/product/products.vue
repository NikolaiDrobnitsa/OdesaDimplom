<template>
    <v-container style="background: white;">
    <v-simple-table>
        <template v-slot:default>
            <thead>
            <tr >
                <th class="text-center">
                    Світлина
                </th>
                <th class="text-center">
                    Назва
                </th>
                <th class="text-center">
                    Категорія
                </th>
                <th class="text-center">
                    Ціня
                </th>
                <th class="text-center">
                    Редагування
                </th>
                <th class="text-center">
                    Видалення
                </th>
                <th class="text-center">
                    Показати всі світлини
                </th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="product in products" :key="product.id">
                <td  class="text-center">
                    <div v-if="product.images && product.images.length">
                        <img class="pt-2" :src="url+'/products/'+product.images[0].image" style="height: 100px; width: 100px" alt="">

                    </div>
                    <div v-else>
                        <img class="pt-2" src="https://thumb.tildacdn.com/tild6463-3761-4638-a261-653363643361/-/format/webp/IMG_4057.JPG" style="height: 100px; width: 100px" alt="">
                    </div>
                </td>
                <td class="text-center">{{ product.name}}</td>
                <td class="text-center">{{ product.category.name}}</td>
                <td class="text-center">{{ product.price}}</td>

                <td class="text-center">
                    <v-btn
                        class="mx-2"
                        fab
                        dark
                        large
                        color="cyan"
                        v-on:click="() => $router.push({name: 'editProduct', params: {product}})"
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
                        v-on:click="deleteProduct(product.id)"
                    >
                        <font-awesome-icon icon="trash" />
                    </v-btn>
                </td>
                <td class="text-center">
                    <v-btn
                        class="mx-2"
                        fab
                        dark
                        large
                        color="grey"
                        v-on:click="showProductImages(product)"
                    >
                        <font-awesome-icon icon="images" />
                    </v-btn>
<!--                    <v-btn class="mx-2" fab large icon color="gray"  @click="showProductImages(product)"></v-btn>-->
                </td>

            </tr>
            </tbody>
        </template>
    </v-simple-table>
        <v-dialog v-model="imageDialog" max-width="800px">
            <v-card v-if="activeProduct" class="dialog-content">
                <v-card-title>
                    Світлини: {{ activeProduct.name }}
                    <v-spacer></v-spacer>
                    <v-btn icon @click="imageDialog = false">
                        <font-awesome-icon :icon="['fas', 'times']" />
                    </v-btn>
                </v-card-title>
                <v-carousel v-model="activeCarouselItem" class="carousel-container">
                    <v-carousel-item
                        v-for="(image, index) in activeProduct.images"
                        :key="index"
                    >
                        <v-img :src="'/products/' + image.image" class="carousel-image"></v-img>
                    </v-carousel-item>
                </v-carousel>
                <v-row class="thumbnails">
                    <v-col
                        v-for="(image, index) in activeProduct.images"
                        :key="index"
                        cols="auto"
                        @click="activeCarouselItem = index"
                    >
                        <v-img :src="'/products/' + image.image" height="100" width="100"></v-img>
                        <v-col class="pa-0" style="display: flex;flex-direction: column;">
                            <v-btn style=" max-width: 100px; width: 100%;" small @click.stop="changeImage(index)">
                                Змінити
                                <font-awesome-icon icon="upload" />
                            </v-btn>
                            <v-btn style=" max-width: 100px; width: 100%;" small @click.stop="swapImageNames(index)">Головна</v-btn>
                        </v-col>
                    </v-col>
                </v-row>
            </v-card>
        </v-dialog>


    </v-container>

</template>

<script>
export default {
    data () {
        return {
            products: [],
            url: window.location.origin,
            imageDialog: false,
            activeCarouselItem: 0,
            activeProduct: null
        }
    },
    methods:{
        getProducts(){
            axios.get('api/products')
                .then(response =>{
                    if (response.status >= 200 && response.status < 300){
                        this.products = response.data.products;
                    }
                })
        },
        deleteProduct(id){
            axios.get('api/delete/product/'+id).then(response =>{
                if (response.status >= 200 && response.status < 300){
                    alert(response.data.message)
                    this.getProducts()
                }
            });
        },
        openImages(product) {
            this.product = product;
            this.imageDialog = true;
        },
        showProductImages(product) {
            this.activeProduct = product;
            this.imageDialog = true;
        },
        changeImage(index) {
            let input = document.createElement('input');
            input.type = 'file';
            input.onchange = e => {
                let file = e.target.files[0];
                this.uploadNewImage(file, index);
            };
            input.click();
        },
        uploadNewImage(file, index) {
            let formData = new FormData();
            formData.append('newImage', file);
            axios.post(`api/update/product/${this.activeProduct.id}/image/${index}`, formData)
                .then(response => {
                    if (response.status >= 200 && response.status < 300) {
                        this.activeProduct.images[index].image = response.data.newImageName;
                    }
                });
        },
        swapImageNames(index) {
            console.log(index);
            axios.post(`/api/swapImageNames/${this.activeProduct.id}`, {

                swappedIndex: index

            }).then((response) => {
                console.log(response.data.message);
                // Здесь вы можете также обновить изображения в локальном состоянии, чтобы пользователь видел изменения без перезагрузки страницы
            }).catch((error) => {
                console.log(error.response.data.message);
            });
        }
    },
    mounted() {
        this.getProducts();
    }
}
</script>

<style scoped>
.thumbnails .active {
    border: 2px solid blue;
}
.thumbnails {
    overflow-x: auto;
    white-space: nowrap;

}

.thumbnails > v-col {
    display: inline-block;
}
.carousel-image {
    width: 100%;
    height: 100%;
    object-fit: contain; /* Change from cover to contain */
}
.dialog-content {
    max-height: 90vh;  /* Reduce from 80vh to 75vh or adjust as needed */
    overflow-y: auto;
}
.carousel-container {
    height: 350px;
}

</style>
