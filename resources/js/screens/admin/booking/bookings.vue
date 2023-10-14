<template>
    <div>

    <v-simple-table>
        <template v-slot:default>

            <thead>
            <tr >
                <th class="text-center" @click="sortTable('product.category.name')">
                    Категорія
                    <span v-if="sortBy === 'product.category.name'">
                        <font-awesome-icon :icon="sortDesc ? 'sort-down' : 'sort-up'" />
                    </span>
                </th>
                <th class="text-center" @click="sortTable('name')">
                    Назва будиночка
                    <span v-if="sortBy === 'name'">
                      <font-awesome-icon :icon="sortDesc ? 'sort-down' : 'sort-up'" />
                    </span>
                </th>
                <th class="text-center" @click="sortTable('booking_date')">
                    Дата броні
                    <span v-if="sortBy === 'booking_date'">
                      <font-awesome-icon :icon="sortDesc ? 'sort-down' : 'sort-up'" />
                    </span>
                </th>
                <th class="text-center" @click="sortTable('client_name')">
                    Інформація клієнта
                    <span v-if="sortBy === 'client_name'">
                      <font-awesome-icon :icon="sortDesc ? 'sort-down' : 'sort-up'" />
                    </span>
                </th>

                <th class="text-center" @click="sortTable('arrival_time')">
                    Час прибуття
                    <span v-if="sortBy === 'arrival_time'">
                      <font-awesome-icon :icon="sortDesc ? 'sort-down' : 'sort-up'" />
                    </span>
                </th>
                <th class="text-center" @click="sortTable('special_requests')">
                    Особливі побажання
                    <span v-if="sortBy === 'special_requests'">
                      <font-awesome-icon :icon="sortDesc ? 'sort-down' : 'sort-up'" />
                    </span>

                </th>
                <th class="text-center">
                    Статус
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

                <tr v-for="booking in bookings" :key="booking.id">
                    <td class="text-center">{{ booking.product.category.name }}</td>
                    <td class="text-center">{{ booking.product.name}}</td>
                    <td class="text-center">{{ booking.booking_date }}</td>
                    <td class="text-center">    {{ booking.client_name }}<br>
                        {{ booking.client_phone }}<br>
                        {{ booking.client_email }}</td>
                    <td class="text-center">{{ booking.arrival_time}}</td>

    <!--                <td class="text-center">{{ booking.special_request}}</td>-->
                    <td class="text-center"><textarea readonly>{{ booking.special_requests }}</textarea></td>
                    <td class="text-center">
                        <v-select
                            v-model="booking.status"
                            :items="statuses"
                            @change="updateStatus(booking)"
                        ></v-select>
                    </td>
                <td class="text-center"><v-btn
                    class="mx-2"
                    fab
                    dark
                    large
                    color="cyan"

                    v-on:click="() => $router.push({name: 'editBooking', params: {booking}})"
                >
                    <font-awesome-icon icon="pen" />
                </v-btn></td>
                <td class="text-center"><v-btn
                    class="mx-2"
                    fab
                    dark
                    large
                    color="red"
                    v-on:click="deleteBookings(booking.id)"

                >
                    <font-awesome-icon icon="trash" />
                </v-btn></td>
            </tr>
            </tbody>
        </template>
    </v-simple-table>
        </div>
</template>

<script>
export default {
    data () {
        return {
            bookings: [],
            sortBy: 'booking_date', // Имя столбца, по которому нужно сортировать
            sortDesc: false,
            statuses: ['очікує оплату', 'Заброньовано', 'Відмінено']
        }
    },
    methods:{
        getBookings(){
            axios.get('api/booking')
                .then(response => {
                    console.log('API Response:', response); // Log entire response for debugging
                    if (response.status >= 200 && response.status < 300){
                        this.bookings = response.data.bookings || []; // Use empty array as fallback
                        console.log('Bookings Data:', this.bookings); // Log bookings data for debugging
                    }
                })
                .catch(error => {
                    console.error('API Error:', error); // Log error for debugging
                });
        },

        sortTable(columnName) {
            if (this.sortBy === columnName) {
                this.sortDesc = !this.sortDesc;
            } else {
                this.sortBy = columnName;
                this.sortDesc = false;
            }

            // Теперь выполните сортировку массива this.bookings в зависимости от выбранных параметров
            this.bookings.sort((a, b) => {
                const aValue = a[this.sortBy];
                const bValue = b[this.sortBy];

                if (this.sortDesc) {
                    return aValue > bValue ? -1 : aValue < bValue ? 1 : 0;
                } else {
                    return aValue < bValue ? -1 : aValue > bValue ? 1 : 0;
                }
            });
        },

        deleteBookings(id){
            axios.get('api/delete/booking/'+id).then(response =>{
                if (response.status >= 200 && response.status < 300){
                    alert(response.data.message)
                    this.getBookings();
                }
            });
        },
        updateStatus(booking) {
            axios.post('api/update/booking-status', {
                bookingId: booking.id,
                newStatus: booking.status
            })
                .then(response => {
                    console.log('Status Update Response:', response);
                    if (response.status >= 200 && response.status < 300){
                        alert('Статус успішно змінений');
                    }
                })
                .catch(error => {
                    console.error('Status Update Error:', error);
                    alert('Не вдалося оновити статус');
                    // Здесь вам следует также добавить некоторую логику для отката статуса на фронтенде обратно на оригинальный, если обновление не удалось
                });
        }
    },
    mounted() {
        this.getBookings();
    }

}
</script>

<style scoped>
.centered-container {
    /*margin: 0 auto;*/
    /*text-align: center;*/
    background: white;
    /*padding: 10px;*/
    /*border-bottom: 1px solid #ccc;*/
    display: flex; /* Используйте flex-контейнер */
    justify-content: center; /* Горизонтальное выравнивание по центру */
    align-items: center; /* Вертикальное выравнивание по центру */
}
</style>
