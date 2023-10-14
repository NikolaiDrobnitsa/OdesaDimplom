<template >
    <div style="background-color: white" class="pt-5">
        <v-container>
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <transition name="fade" mode="out-in">
                    <v-img v-if="product?.image" style="height: 500px; position: relative;" :src="'/products/' + product.image" :key="product.image">

<!--                        <v-btn @click="nextImage" icon class="chevron-button">-->
<!--                            <font-awesome-icon icon="circle-chevron-right" style="font-size:25px" />-->

<!--                        </v-btn>-->
                        <v-btn class="chevron-button-right" fab dark x-small color="white"  v-on:click="nextImage()">
                            <font-awesome-icon :icon="['fas', 'chevron-right']" style="color: black"/>
                        </v-btn>
                        <v-btn  class="chevron-button-left" fab dark x-small color="white"  v-on:click="prevImage()">
                            <font-awesome-icon :icon="['fas', 'chevron-left']" style="color: black"/>
                        </v-btn>
                    </v-img>
                    </transition>
                    <v-row class="carousel ma-1" v-if="carouselImages && carouselImages.length">
                        <v-col
                            v-for="(image, index) in carouselImages"
                            :key="index"
                            cols="auto"
                            class="py-1 px-1"
                        >
                        <v-img
                            @click="changeMainImage(image)"
                            :src="'/products/' + image"
                            height="60"
                            width="60"
                            :class="{ active: index === currentImageIndex }"
                            elevation="10"
                            class="image-hover"
                        ></v-img>
                        </v-col>
                    </v-row>
                </div>
                <div class="col-md-7 col-sm-7 col-sx-12">
                    <div class="pl-6">
                        <p class="display-1 mb-0">{{ product.name }}</p>
                        <v-card-actions class="pa-0">
                            <p class="headline font-weight-light pt-3">
                                {{ product.price }}
                            </p>

                            <v-spacer></v-spacer>
                        </v-card-actions>
                        <p v-for="(line, index) in formattedDescription" :key="index" class="subtitle-1 font-weight-thin mb-1">
                            {{ line }}
                        </p>
<!--                        <p class="subtitle-1 font-weight-thin">{{ product.description }}</p>-->
<!--                        <v-btn class="primary white&#45;&#45;text" outlined tile dense>ADD to card</v-btn>-->
                        <v-date-picker
                            locale="uk"
                            v-model="selectedDates"
                            :events="bookedDates"
                            event-color="grey"
                            :allowed-dates="isDateAvailable"
                            multiple

                        ></v-date-picker>
                        <v-btn @click="bookProduct">Забронировать</v-btn>
                        <v-dialog v-model="dialog" max-width="600px">
                            <v-card>
                                <v-card-title>
                                    <span class="headline">Бронювання: {{ product.name}}</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-form ref="form" v-model="valid">
                                        <v-text-field
                                            v-model="bookingForm.clientName"
                                            :rules="[v => !!v || 'Ім\'я обов\'язкове']"
                                            label="Ім'я та прізвище"
                                            required
                                        ></v-text-field>

                                        <v-text-field
                                            v-model="bookingForm.clientPhone"
                                            :rules="[v => !!v || 'Телефон обов\'язково']"
                                            label="Телефон"
                                            required
                                        ></v-text-field>

                                        <v-text-field
                                            v-model="bookingForm.clientEmail"
                                            :rules="[v => !!v || 'E-mail обов\'язково']"
                                            label="E-mail"
                                            required
                                        ></v-text-field>

                                        <v-text-field
                                            v-model="bookedDatesString"
                                            label="Дати бронювання"
                                            readonly
                                        ></v-text-field>

                                        <v-select
                                            v-model="bookingForm.arrivalTime"
                                            :items="arrivalTimes"
                                            :rules="[v => !!v || 'Час обов\'язково']"
                                            label="Час прибуття"
                                            required
                                        ></v-select>

                                        <v-textarea
                                            v-model="bookingForm.specialRequests"
                                            label="Особливі побажання"
                                            hint="Адміністрація об'єкта розміщення не може гарантувати виконання особливих побажань, але зробить для цього все можливе. Ви завжди можете залишити особливе бажання після завершення бронювання!"
                                            persistent-hint
                                        ></v-textarea>
                                    </v-form>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="dialog = false">Відміна</v-btn>
                                    <v-btn color="blue darken-1" text @click="confirmBooking">Підтвердити</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <v-tabs>
                        <v-tab @click="toggleText">Павила перебування</v-tab>
                    </v-tabs>
                    <v-card-text class="pa-0 pt-4" title outline>
                        <p class="subtitle-1 font-weight-light pt-3 text-center text-h5" >
                            Останні заброньовані
                        </p>
                        <v-divider></v-divider>
                        <div class="row text-center">
                            <div class="col-md-3 col-sm-4 col-xs-12 text-center " v-for="productItem in products" :key="productItem.id">
                                <v-hover v-slot:default="{hover}" open-delay="240">
                                    <v-card :elevation="hover ? 16 : 2">
                                        <v-img v-if="productItem.images?.[0]?.image" :src="'/products/'+ productItem.images[0].image" height="200px" class="white--text align-end">
                                            <v-card-title class="white--text with-black-border">{{ productItem.name }}</v-card-title>
                                        </v-img>
                                        <v-card-text class="text-primary text-center">
                                            <div>{{ productItem.price}}</div>
                                            <div>{{ productItem.category.name}}</div>
                                        </v-card-text>
                                        <div class="text-center" >
                                            <v-btn class="ma-2"
                                                   @click="viewSelectedProduct(productItem)"
                                                   outlined color="info">
                                                Детальніше
                                            </v-btn>
                                        </div>
                                    </v-card>
                                </v-hover>
                            </div>
                        </div>
                    </v-card-text>
                </div>
            </div>
        </v-container>
        <v-snackbar v-model="snackbar" :timeout="3000" color="error" top>
            {{ snackbarText }}
        </v-snackbar>
        <v-dialog v-model="isTextExpanded" max-width="750px">
            <v-card>
                <v-card-title class="center-content">
                    <span class="custom-title">Правила перебування на території «Одеса»</span>
                </v-card-title>
                <v-card-text class="center-content"> <!-- Используем класс для ограничения высоты и добавления прокрутки -->
                    <p class="p--rules" v-html="formattedText">{{ fullText }}</p>

                </v-card-text>
                <v-card-actions class="justify-center">
                    <v-btn @click="isTextExpanded = false" outlined color="black" >Закрити</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {

    data: function () {
        return{
            dialog: false,
            valid: true,
            bookingForm: {
                clientName: '', // имя клиента
                clientPhone: '', // телефон клиента
                clientEmail: '', // email клиента
                arrivalTime: '', // время прибытия
                specialRequests: '', // особые пожелания
                //bookingDates: [], // просто инициализируйте как пустую строку

            },
            arrivalTimes: ["08:00","09:00","10:00","11:00","12:00","13:00","14:00", "15:00", "16:00", "17:00"],
            isTextExpanded: false,
            fullText: "1.   Оформлення поселення відбувається після надання гостем громадянського паспорту / водійського посвідчення і внесення оплати за весь період перебування.\n" +
                "2.   Час заїзду (поселення) о 14:00, розрахунковий час виїзду о 12:00.\n" +
                "3.   Денне перебування додатково кожного гостя на території сплачується у розмірі 200 грн.\n" +
                "4.   Перебування із тваринами узгоджується із адміністрацією заздалегідь, та сплачується додатково. У разі не повідомлення, адміністрація комплексу має право відмовити гостю в поселенні.\n" +
                "5.   У випадку дострокового виїзду або у випадку не заїзду, повернення грошових коштів проводиться при умові, що гість повідомляє про своє рішення адміністратору не пізніше ніж за 96 годин. В будь-якому іншому випадку повернення грошових коштів не відбувається.\n" +
                "6.   Прохання дбайливо відноситися до майна комплексу. У випадку навмисного/ненавмисного псування/втрати майна комплексу, оплата стягується згідно затвердженому прейскуранту.\n" +
                "7.   В разі нанесення шкоди, яка призводить до зупинки номера та унеможливлює його продаж на наступну добу, сплачується штраф в розмірі вартості номера.\n" +
                "8.   Прохання з повагою відноситися до інших гостей, не шуміти після 22:00.\n" +
                "9.   Заборонено куріння тютюнових виробів і кальяну в номерах. В разі порушені правил протипожежної безпеки стягується штраф у розмірі 3 000 грн.\n" +
                "10. Використання на території феєрверків та салютів категорично заборонено.\n" +
                "11.  Використання хлопавок з конфеті на території, а також в середині номерів, категорично заборонено. Збір за додаткове прибирання – 500,00 грн.\n" +
                "12.  Категорично заборонено переміщувати меблі з одного номеру в інший, а також перенесення з літньої тераси меблів в середину номеру.\n" +
                "13.  Для приготування BBQ на території є спеціальна гриль-зона, використання власного мангалу заборонено.\n" +
                "14.  У разі втрати ключа – штраф 200 грн. Штраф за порушення правил перебування – 5000 грн.\n" +
                "15.  При виїзді із номера, номер потрібно здати адміністратору, тому розрахуйте свій час.\n" +
                "16.  Щоб не потрапити в незручну ситуацію, пам'ятайте, у зимовий період 21:00 двері нашої території зачиняються до 7:00. Якщо Ви запросили до себе гостей, то у призначений час вони мають залишити територію.",
            snackbar: false,
            snackbarText: '',
            products: [],
            product: {
                name: "",
                price: null,
                images: [],
                description: null,
            },

            //carouselImages: ['1_1.jfif', 'img_mini_2.jpg', '1695837391IMG_2978.jpg', '1695835026IMG_2973.jpg', '1696188879IMG_3446.jpg', 'img_mini_2.jpg', 'img_mini_2.jpg'],
            carouselImages: [],
            currentImageIndex: 0,
            selectedDates: [], // даты, выбранные пользователем
            bookedDates: [],  // забронированные даты



        }
    },
    methods: {
        getLatestProducts() {
            axios.get('api/latestProducts').then(response =>{
                if (response.status >= 200 && response.status < 300){
                    this.products = response.data.products;
                }
            })
        },
        changeMainImage(image) {
            this.product.image = image;
            this.currentImageIndex = this.carouselImages.indexOf(image);
            //console.log('Changing main image to:', image);
        },
        nextImage() {
            // Переключение на следующее изображение
            if (this.currentImageIndex < this.carouselImages.length - 1 && this.carouselImages[this.currentImageIndex + 1] !== undefined) {
                this.currentImageIndex++;
                this.product.image = this.carouselImages[this.currentImageIndex];
            }
        },
        prevImage() {
            // Переключение на предыдущее изображение
            if (this.currentImageIndex > 0 && this.carouselImages[this.currentImageIndex - 1] !== undefined) {
                this.currentImageIndex--;
                this.product.image = this.carouselImages[this.currentImageIndex];
            }

        },
        viewSelectedProduct(selectedProduct) {
            if (selectedProduct.id !== this.$route.query.productId) {
                this.product = selectedProduct;
                this.carouselImages = this.product.images.map(img => img.image);
                this.currentImageIndex = 0;
                this.product.image = this.carouselImages[0];

                this.$router.push({
                    name: 'ProductDetails',
                    query: {productId: selectedProduct.id}
                });
                this.fetchBookings();
            }

        },
        fetchBookings() {
            axios.get(`api/bookings/${this.product.id}`).then(response => {
                console.log("Забронированные даты:", response.data);
                this.bookedDates = [];
                response.data.forEach(booking => {
                    this.bookedDates.push(booking.booking_date);
                });
            });
        },
        bookProduct() {
            if (this.selectedDates.length === 0) {
                this.snackbarText = 'Ви не обрали дату, виберіть для продовження!';
                this.snackbar = true;
                return;
            }else {
                this.dialog = true;
            }

            // console.log(this.selectedDates);
            // console.log("Бронирование продукта...");
            // if(this.selectedDates.length === 0) {
            //     alert('Пожалуйста, выберите даты.');
            //     return;
            // }
            // axios.post('api/book', {
            //     product_id: this.product.id,
            //     booking_dates: this.selectedDates
            // }).then(response => {
            //     if(response.status === 200) {
            //         this.fetchBookings(); // обновите список забронированных дат
            //         alert('Успешное бронирование!');
            //     }
            // }).catch(error => {
            //     alert('Ошибка при бронировании. Возможно, эти даты уже забронированы.');
            // });
        },
        isDateAvailable(date) {
            // Парсим дату, переданную из компонента, чтобы работать с объектом Date
            const selectedDate = new Date(date);
            const today = new Date();

            // Очищаем часы, минуты и секунды для корректного сравнения
            selectedDate.setHours(0, 0, 0, 0);
            today.setHours(0, 0, 0, 0);

            // Проверяем, что выбранная дата не в прошлом и не забронирована
            return selectedDate >= today && !this.bookedDates.includes(date);
        },
        confirmBooking() {

            // Форматирование данных для отправки
            const bookingData = {
                product_id: this.product.id,
                booking_dates: this.selectedDates,
                client_name: this.bookingForm.clientName,
                client_phone: this.bookingForm.clientPhone,
                client_email: this.bookingForm.clientEmail,
                arrival_time: this.bookingForm.arrivalTime,
                special_requests: this.bookingForm.specialRequests,
                // ...this.bookingForm,
            };
            console.log(bookingData);
            // Отправка данных на сервер для бронирования
            axios.post('api/book', bookingData)
                .then(response => {
                    if(response.status === 200) {
                        this.fetchBookings(); // обновите список забронированных дат
                        alert('Успешное бронирование!');
                    }
                })
                .catch(error => {
                    alert('Ошибка при бронировании. Возможно, эти даты уже забронированы.');
                });
            // axios.post('api/book', bookingData)
            //     .then(response => {
            //         console.log('Response:', response.data);
            //     })
            //     .catch(error => {
            //         console.error('Error:', error.response.data);
            //     });
        },
        toggleText() {
            this.isTextExpanded = !this.isTextExpanded;
        }


    },
    mounted() {
        const productId = this.$route.query.productId;

        axios.get(`api/product/${productId}`).then(response => {
            if (response.status >= 200 && response.status < 300) {
                if (response.data && response.data.product) {
                    this.product = response.data.product;
                    this.carouselImages = this.product.images.map(img => img.image);

                    // Устанавливаем основное изображение в первую картинку
                    if (this.carouselImages.length > 0) {
                        this.product.image = this.carouselImages[0];
                    }
                    this.fetchBookings();
                }
            }
        });

        this.getLatestProducts();

    },
    computed: {

        bookedDatesString: function() {
            return this.selectedDates.join(", ");
        },
        // shortenedText() {
        //     if (this.fullText.length <= 100) {
        //         return this.fullText;
        //     }
        //     return this.fullText.substring(0, 300) + '...';
        // }
        formattedText() {
            return this.fullText.replace(/\n/g, '<br><br>');
        },
        formattedDescription() {
            return this.product.description
                ? this.product.description.split('⁃').map((line, index) => (index > 0 ? '⁃ ' : '') + line.trim())
                : [];
        }
    },


}
</script>

<style scoped>
.carousel img.active {
    border: 2px solid blue; /* Пример стиля для активного изображения */
}

.carousel-navigation {
    margin-top: 10px; /* Пример стилей для навигационных кнопок */
}

.carousel-navigation button {
    margin-right: 10px;
}
.chevron-button-right {
    position: absolute;
    top: 50%;
    right: 4%;
    transform: translateY(-50%);

}
.chevron-button-left {
    position: absolute;
    top: 50%;
    left: 4%;
    transform: translateY(-50%);

}
.image-hover:hover {
    opacity: 0.6;
}
.with-black-border {
    text-shadow: 3px 3px 4px rgba(0, 0, 0, 0.9);
}
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.1s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active в <2.1.8 */ {
    opacity: 0;
}
.p--rules{
    font-size: 16px;
    font-weight: bold;
    color: black;
    font-style: italic;
}
.custom-title {
    font-size: 24px;  /* Размер шрифта */
    font-weight: bold;  /* Жирный шрифт */
    color: #333;  /* Цвет текста */
}
.center-content {
    display: flex;  /* Включаем flexbox */
    justify-content: center;  /* Выравнивание содержимого по горизонтали */
    align-items: center;  /* Выравнивание содержимого по вертикали */
    text-align: center;  /* Выравнивание текста по центру */
}

</style>
