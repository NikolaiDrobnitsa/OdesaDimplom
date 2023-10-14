<template >
    <v-container style="background: white;">
        <v-form ref="form">
            <v-text-field
                v-model="clientName"
                :value="clientName"
                :rules="[v => !!v || 'Ім\'я обов\'язкове']"
                label="Ім'я та прізвище"
                required
            ></v-text-field>

            <v-text-field
                v-model="clientPhone"
                :value="clientPhone"
                :rules="[v => !!v || 'Телефон обов\'язково']"
                label="Телефон"
                required
            ></v-text-field>

            <v-text-field
                v-model="clientEmail"
                :value="clientEmail"
                :rules="[v => !!v || 'E-mail обов\'язково']"
                label="E-mail"
                required
            ></v-text-field>

                        <v-text-field
                            v-model="initialBookedDates"
                            :value="initialBookedDates"
                            label="Дати бронювання"
                            readonly
                        ></v-text-field>

            <v-select
                v-model="arrivalTime"
                :value="arrivalTime"
                :items="arrivalTimes"
                :rules="[v => !!v || 'Час обов\'язково']"
                label="Час прибуття"
                required
            ></v-select>

            <v-textarea
                v-model="specialRequests"
                :value="specialRequests"
                label="Особливі побажання"

            ></v-textarea>
            <v-date-picker
                locale="uk"
                v-model="selectedDates"
                :value="selectedDates"
                :events="bookedDates"
                event-color="grey"
                :allowed-dates="isDateAvailable"
                multiple
            ></v-date-picker>
            <v-select
                v-model="product"
                :value="product"
                return-object
                :items="products"
                item-text="name"
                label="Будиночек"
                dense
                outlined
            ></v-select>

            <v-btn color="success" v-on:click="confirmBooking(booking.id)" class="mr-4">
                Submit
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>

export default {
    props: ['booking'],
    data: function () {
        return {

                clientName: this.booking.client_name,
                clientPhone: this.booking.client_phone,
                clientEmail: this.booking.client_email,
                arrivalTime: this.formatArrivalTime(this.booking.arrival_time),
                specialRequests: this.booking.special_requests,

            arrivalTimes: ["08:00","09:00","10:00","11:00","12:00","13:00","14:00", "15:00", "16:00", "17:00"],
            products: [],
            product: this.booking.product,
            selectedDates: [],
            //bookedDates: [] = this.booking.booking_date,
            bookedDates: this.booking.booking_date.split(','),
            initialBookedDates: this.booking.booking_date.split(',').join(', '),


        }

    },
    // created() {
    //     console.log(this.booking); // Log to ensure booking is being passed correctly
    // },
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
                console.log("Забронированные даты:", response.data);
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
        confirmBooking(bookingId) {

            // Форматирование данных для отправки

            const bookingData = {
                product_id: this.product.id,
                booking_dates: this.selectedDates,
                client_name: this.clientName,
                client_phone: this.clientPhone,
                client_email: this.clientEmail,
                arrival_time: this.arrivalTime,
                special_requests: this.specialRequests,
                // ...this.bookingForm,
            };
            console.log('info',bookingData);
            axios.post(`/api/update/booking/${bookingId}`, bookingData)
                .then(response => {
                    console.log('Response:', response.data);
                    alert('Бронирование успешно обновлено!');
                })
                .catch(error => {
                    console.error('Error:', error.response.data);
                    alert('Ошибка при обновлении бронирования.');
                });
            // Отправка данных на сервер для бронирования
            // axios.post('api/book', bookingData)
            //     .then(response => {
            //         if(response.status === 200) {
            //             this.fetchBookings(); // обновите список забронированных дат
            //             alert('Успешное бронирование!');
            //         }
            //     })
            //     .catch(error => {
            //         alert('Ошибка при бронировании. Возможно, эти даты уже забронированы.');
            //     });
            // axios.post('api/book', bookingData)
            //     .then(response => {
            //         console.log('Response:', response.data);
            //     })
            //     .catch(error => {
            //         console.error('Error:', error.response.data);
            //     });
        },
        formatArrivalTime(time) {
            if (!time) return '';
            return time.split(':').slice(0, 2).join(':'); // Отсекает секунды
        },
        // loadBookingForEdit(bookingId) {
        //     axios.get(`api/bookings/${bookingId}`).then(response => {
        //         const bookingData = response.data;
        //         this.bookingForm.clientName = bookingData.clientName;
        //         this.bookingForm.clientPhone = bookingData.clientPhone;
        //         this.bookingForm.clientEmail = bookingData.clientEmail;
        //         this.bookingForm.arrivalTime = bookingData.arrivalTime;
        //         this.bookingForm.specialRequests = bookingData.specialRequests;
        //         this.product = { name: bookingData.productName, id: bookingData.productId };
        //         this.selectedDates = bookingData.bookingDates;
        //         // и так далее... подгоните под вашу структуру данных
        //     }).catch(error => {
        //         console.error('Error loading booking data:', error);
        //     });
        // }

    },
    mounted() {

        this.getProducts();
        this.fetchBookings();

        //const bookingId = /* Получите ID бронирования для редактирования, возможно, из маршрута или другого источника данных */;
        // if (this.$route.params.booking) {
        //     this.loadBookingForEdit(this.$route.params.booking);
        // }
    }


}
</script>

<style scoped>

</style>
