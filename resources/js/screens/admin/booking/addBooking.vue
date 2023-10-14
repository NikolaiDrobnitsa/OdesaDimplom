<template >
    <v-container style="background: white;">
        <v-form ref="form">
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

            ></v-textarea>
            <v-select
                v-model="product"
                return-object
                :items="products"
                item-text="name"
                label="Будиночек"
                dense
                outlined
                @change="onProductChange"
            ></v-select>
            <v-date-picker
                locale="uk"
                v-model="selectedDates"
                :events="bookedDates"
                event-color="grey"
                :allowed-dates="isDateAvailable"
                multiple

            ></v-date-picker>
<!--            <v-select-->
<!--                v-model="product"-->
<!--                return-object-->
<!--                :items="products"-->
<!--                item-text="name"-->
<!--                label="Будиночек"-->
<!--                dense-->
<!--                outlined-->
<!--            ></v-select>-->

            <v-btn color="success" v-on:click="confirmBooking()" class="mr-4">
                Створити бронювання
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>

export default {
    data: function () {
        return{
            bookingForm: {
                clientName: '', // имя клиента
                clientPhone: '', // телефон клиента
                clientEmail: '', // email клиента
                arrivalTime: '', // время прибытия
                specialRequests: '', // особые пожелания
                //bookingDates: [], // просто инициализируйте как пустую строку

            },
            arrivalTimes: ["08:00","09:00","10:00","11:00","12:00","13:00","14:00", "15:00", "16:00", "17:00"],

            products: [],
            product: "",
            selectedDates: [], // даты, выбранные пользователем
            bookedDates: [],

        }

    },
    methods: {

        getProducts(){
            axios.get('api/products')
                .then(response =>{
                    if (response.status >= 200 && response.status < 300){
                        this.products = response.data.products;
                        let productArray = [];
                        response.data.products.map(product => {
                            productArray.push({
                                name: product.name,
                                id: product.id
                            });
                        });
                        this.products = productArray;
                    }
                })
        },
        fetchBookings() {
            axios.get(`api/bookings/${this.product.id}`).then(response => {
                console.log("Заброньовані дати:", response.data);
                this.bookedDates = [];
                response.data.forEach(booking => {
                    this.bookedDates.push(booking.booking_date);
                });
            });
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
            console.log('info',bookingData);
            // Отправка данных на сервер для бронирования
            axios.post('api/book', bookingData)
                .then(response => {
                    if(response.status === 200) {
                        this.fetchBookings(); // обновите список забронированных дат
                        alert('Успішне бронювання!');
                    }
                })
                .catch(error => {
                    alert('Помилка бронювання. Можлива дата вже заброньована');
                });

        },
        onProductChange() {
            // Вызываем метод для загрузки забронированных дат для выбранного "Будиночка"
            this.fetchBookings();
        },
    },
    mounted() {

        this.getProducts();
        this.fetchBookings();
    }


}
</script>

<style scoped>

</style>
