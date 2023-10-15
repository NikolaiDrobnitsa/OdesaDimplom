<template>
    <div >

        <v-parallax src="https://thumb.tildacdn.com/tild6566-3537-4534-b663-303237366161/-/format/webp/_2.jpg" >
            <v-main>
                <div class="text-center " style="margin-top:13%;  ">
                    <h1 class=" white--text v-text-field--outlined ">
                        ОДЕСА —
                    </h1>
                    <h1 class=" white--text v-text-field--outlined ">
                        найкраще місце для яскравого відпочинку в Кам'янському
                    </h1>
                </div>
            </v-main>
        </v-parallax>
        <v-container style="background-color: white;margin-top: -10px;" fill-width fluid>
            <v-container fluid class="fill-height">
                <v-row align="center" justify="center">
                    <v-col style="font-weight: bold;" cols="12" class="text-center display-1 ma-5">
                        ЗНАЙОМСТВО З НАМИ
                    </v-col>
                </v-row>
            </v-container>
            <v-row>
                <v-col md="6" xs="12">
                    <v-row>
                        <v-col md="10" xs="12" offset-md="2">
                            <v-img width="100%" src="https://static.tildacdn.com/tild3432-3935-4163-b239-346130646530/IMG_4256.JPG"></v-img>
                        </v-col>
                    </v-row>
                </v-col>
                <v-col md="6" xs="12" class="black--text" style="align-self:center">
                    <div class="mb-2 mr-4 ml-md-0" style="width:75%;">
            <span style="font-size:27px; font-weight: bold;">
        Ласково просимо на територію відпочинку «ОДЕСА»
      </span>
                        <br>
                        <span>
        На вас чекає затишний, комфортний, веселий і водночас релаксуючий відпочинок.
        До Ваших послуг: величезне озеро, чистий пісочний пляж, на якому розташовані
        шезлонги та зони під накриттям, альтанки, бари, комфортні номери, можливість
        зайнятися різними водними видами спорту. Також, у нас є карпатські чани та
        лазня на дровах.
      </span>
                    </div>
                </v-col>
            </v-row>




            <v-row>
                <v-col md="6" xs="12" order-md="2">
                    <v-row justify="start" justify-md="end">
                        <v-col cols="10" md="auto">
                            <v-img width="85%" src="https://static.tildacdn.com/tild6437-6266-4536-a635-633833623661/IMG_5967_1.PNG"></v-img>
                        </v-col>
                    </v-row>
                </v-col>
                <v-col md="6" xs="12" class="black--text" order-md="1" style="align-self:center">
                    <v-row justify="end">
                        <div class="mb-2 mr-4 ml-md-4" style="width:75%;">
                <span style="font-size:27px; font-weight: bold;">
                    Сімейний відпочинок на чистому пляжі
                </span>
                            <br>
                            <span>
                    Територія відпочинку розташована в курортній частині селища Єлизаветівка на березі Блакитних Озер за 50 км від Дніпра, і за 10 км від Кам'янського.
                    Ми приймаємо відпочиваючих цілий рік. Завітайте у гості до нас, та насолоджуйтесь приємним відпочинком. Ви полюбите це місце та захочете сюди повернутися.
                </span>
                        </div>
                    </v-row>
                </v-col>
            </v-row>

            <v-row>
                <v-col md="6" xs="12">
                    <v-row>
                        <v-col md="10" xs="12" offset-md="2">
                            <v-img width="100%" src="https://static.tildacdn.com/tild6166-6533-4364-a331-396665366638/DJI_089400_05_08_27S.jpg"></v-img>
                        </v-col>
                    </v-row>
                </v-col>
                <v-col md="6" xs="12" class="black--text" style="align-self:center">
                    <div class="mb-2 mr-4 ml-md-0" style="width:75%;">
            <span style="font-size:23px" class="mb-2">
                Пляж
            </span>
                        <br>
                        <span>
                Найкраще місце для вашого спекотного літнього відпочинку. Чистий пісочний пляж обладнаний: дитячою зоною, пляжними барами, шезлонгами та зонами під накриттям – chill zone на 2х, 3х та 6х осіб.
                Також розташовані душові кабінки, санвузли, роздягальні.
            </span>
                    </div>
                </v-col>
            </v-row>

        </v-container>
        <v-container style="background-color: white;margin-top: -10px;" fill-width fluid>
            <v-container fluid class="fill-height">
                <v-row align="center" justify="center">
                    <v-col style="font-weight: bold;" cols="12" class="text-center display-1 ma-5">
                        ПОСЛУГИ
                    </v-col>
                </v-row>
            </v-container>
            <v-row>
                <v-col cols="12" md="8" offset-md="2">
                    <v-tabs v-model="tab" centered grow>
                        <v-tab v-for="(item, index) in tabs" :key="index">
                            {{ item }}
                        </v-tab>
                    </v-tabs>
                </v-col>
            </v-row>
            <v-tabs-items v-model="tab">
                <v-tab-item key="1">
                    <v-row style="width: 80%; margin: 0 auto;">
                        <v-col cols="12" md="6">
                            <v-img width="85%" height="85%" src="assets/main_tabs_img/island_2.jpg"></v-img>
                        </v-col>
                        <v-col cols="12" md="6" class="black--text" style="align-self:center">
                            <div class="ml-4" style="width:75%">
            <span>
            Найкраще місце для вашого спекотного літнього відпочинку. Чистий пісочний пляж обладнаний: дитячою зоною, пляжними барами, шезлонгами та зонами під накриттям – chill zone на 2х, 3х та 6х осіб.
Також розташовані душові кабінки, санвузли, роздягальні.
Резервування у адміністратора за телефоном: 097 905 78 12; 067 695 03 35<br>

Побувавши одного разу, ви закохаєтесь у це місце!
            </span>
                            </div>
                        </v-col>
                    </v-row>
                </v-tab-item>
                <v-tab-item key="2">
                    <v-row style="width: 80%; margin: 0 auto;">
                        <v-col cols="12" md="6">
                            <v-img width="100%" src="assets/main_tabs_img/altaka.jpg"></v-img>
                        </v-col>
                        <v-col cols="12" md="6" class="black--text" style="align-self:center">
                            <div class="ml-4" style="width:75%">
            <span>
            Відкриті альтанки біля води – ідеальне місце для проведення свят, корпоративів, сімейних урочистостей та просто приємного відпочинку. Розраховані на компанії: 8, 12 та 16 осіб. Біля кожної альтанки є своя мангальна зона.
Альтанки резервуються у адміністратора за номером телефону: 097 905 78 12; 067 695 03 35
Вхід на територію комплексу не входить у вартість оренди альтанки та оплачується додатково згідно із затвердженим прейскурантом.
            </span>
                            </div>
                        </v-col>
                    </v-row>
                </v-tab-item>
                <v-tab-item key="3">
                    <v-row style="width: 80%; margin: 0 auto;">
                        <v-col cols="12" md="6">
                            <v-img width="100%" src="assets/main_tabs_img/water.jpg"></v-img>
                        </v-col>
                        <v-col cols="12" md="6" class="black--text" style="align-self:center">
                            <div class="ml-4" style="width:75%">
            <span>
            Для любителів активного відпочинку на території «ОДЕСА» є:<br>
⁃ прогулянки на катері;<br>
⁃ катання на банані та плюшці;<br>
⁃ sup;<br>
⁃ байдарки;<br>
⁃ вейкбординг;<br>
⁃ флейбординг.
            </span>
                            </div>
                        </v-col>
                    </v-row>
                </v-tab-item>
                <v-tab-item key="4">
                    <v-row style="width: 80%; margin: 0 auto;">
                        <v-col cols="12" md="6">
                            <v-img width="100%" src="assets/main_tabs_img/chan.jfif"></v-img>
                        </v-col>
                        <v-col cols="12" md="6" class="black--text" style="align-self:center">
                            <div class="ml-4" style="width:75%">
            <span>
            Територія відпочинку «ОДЕСА» пропонує своїм гостям випробувати незвичайний спосіб паріння — чан на дровах просто неба. Це великий котел, здатний вмістити до 6 осіб, що наповнюють водою з артезіанської свердловини та підігрівають від багаття до температури +38–43 °C.<br>
                Ця процедура загартовує, зміцнює імунітет, нормалізує обмінні процеси в організмі, стабілізує тиск, активізує кровообіг, справляється зі стресами та безсонням, людина відчуває приплив сил і бадьорості.<br>
                Купатися у чані на дровах однаково корисно та безпечно як для дітей, так і для людей старшого віку.<br>
                Чани здаються в комплексі з будиночками на компанію 4-х та 6-х осіб.
            </span>
                            </div>
                        </v-col>
                    </v-row>
                </v-tab-item>
                <v-tab-item key="5">
                    <v-row style="width: 80%; margin: 0 auto;">
                        <v-col cols="12" md="6" style="height: 85%;">
                            <v-img width="100%" src="assets/main_tabs_img/banya.jpeg"></v-img>
                        </v-col>
                        <v-col cols="12" md="6" class="black--text" style="align-self:center">
                            <div class="mb-2 mr-4" style="width:75%">
            <span>
            Справжнісінькою вважається лазня на дровах - найкраще місце для відпочинку з друзями або в кола близьких. Одночасно в її лазні зі зручністю можуть розміститися до 6 осіб, для водних процедур є відро-водоспад також затишна гостьова кімната.<br>
                Ви чудово відпочинете, оздоровитеся та заповніть заряд бадьорості та сил!
            </span>
                            </div>
                        </v-col>
                    </v-row>
                </v-tab-item>
            </v-tabs-items>

        </v-container>
        <v-container>
            <v-row style="width: 75%; margin: 0 auto;">
                <v-col >
                    <v-card class="scaled-table " style="background-color: black">

                        <v-list-item-group style="height: 50px">
                            <v-list-item >
                                <v-list-item-content class="white--text" >
                                    Вхід до комплексу
                                </v-list-item-content>
                                <v-list-item-content class=" white--text align-end">
                                    Вартість
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                        <v-divider></v-divider>
                        <v-list>
                            <v-list-item-group>
                                <v-list-item :class="index % 2 ? 'grey-bg' : ''" v-for="(item, index) in items_entry" :key="index">
                                    <v-list-item-content>
                                        {{ item.name }}
                                    </v-list-item-content>
                                    <v-list-item-content class="align-end">
                                        {{ item.price }}
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-card>
                </v-col>
            </v-row>
            <v-row style="width: 75%; margin: 0 auto;">
                <v-col >
                    <v-card class="scaled-table " style="background-color: black">

                        <v-list-item-group style="height: 50px">
                            <v-list-item >
                                <v-list-item-content class="white--text" >
                                    Альтанки
                                </v-list-item-content>
                                <v-list-item-content class=" white--text align-end">
                                    Вартість
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                        <v-divider></v-divider>
                        <v-list>
                            <v-list-item-group>
                                <v-list-item :class="index % 2 ? 'grey-bg' : ''" v-for="(item, index) in items_altanka" :key="index">
                                    <v-list-item-content>
                                        {{ item.name }}
                                    </v-list-item-content>
                                    <v-list-item-content class="align-end">
                                        {{ item.price }}
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-card>
                </v-col>
            </v-row>
            <v-row style="width: 75%; margin: 0 auto;">
                <v-col >
                    <v-card class="scaled-table " style="background-color: black">

                        <v-list-item-group style="height: 50px">
                            <v-list-item >
                                <v-list-item-content class="white--text" >
                                    Послуги
                                </v-list-item-content>
                                <v-list-item-content class=" white--text align-end">
                                    Вартість
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                        <v-divider></v-divider>
                        <v-list>
                            <v-list-item-group>
                                <v-list-item :class="index % 2 ? 'grey-bg' : ''" v-for="(item, index) in items_poslug" :key="index">
                                    <v-list-item-content>
                                        {{ item.name }}
                                    </v-list-item-content>
                                    <v-list-item-content class="align-end">
                                        {{ item.price }}
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-card>
                </v-col>
            </v-row>
            <v-row style="width: 75%; margin: 0 auto;">
                <v-col >
                    <v-card class="scaled-table " style="background-color: black">

                        <v-list-item-group style="height: 50px">
                            <v-list-item >
                                <v-list-item-content class="white--text" >
                                    Пляж
                                </v-list-item-content>
                                <v-list-item-content class=" white--text align-end">
                                    Вартість
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                        <v-divider></v-divider>
                        <v-list>
                            <v-list-item-group>
                                <v-list-item :class="index % 2 ? 'grey-bg' : ''" v-for="(item, index) in items_island" :key="index">
                                    <v-list-item-content>
                                        {{ item.name }}
                                    </v-list-item-content>
                                    <v-list-item-content class="align-end">
                                        {{ item.price }}
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-card>
                </v-col>
            </v-row>
            <v-row style="width: 75%; margin: 0 auto;">
                <v-col >
                    <v-card class="scaled-table " style="background-color: black">


                            <v-list-item-group style="height: 50px">
                                <v-list-item >
                                    <v-list-item-content class="white--text" >
                                        Будиночки
                                    </v-list-item-content>
                                    <v-list-item-content class=" white--text align-end">
                                        Вартість
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>

                        <v-divider></v-divider>
                        <v-list>
                            <v-list-item-group>
                                <v-list-item :class="index % 2 ? 'grey-bg' : ''" v-for="(item, index) in items_house" :key="index">
                                    <v-list-item-content>
                                        {{ item.name }}
                                    </v-list-item-content>
                                    <v-list-item-content class="align-end">
                                        {{ item.price }}
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
        <v-container class="d-flex justify-center align-center" >
            <v-btn @click="() => this.$router.push({name: 'Shop'})" large outlined height="50">Перейти до бронювання</v-btn>
        </v-container>
        <v-container class="d-flex justify-center align-center mt-5" >
            <v-row align="center" justify="center">
                <v-col style="font-weight: bold;" cols="12" class="text-center display-1 ma-5">
                    КОНТАКТИ
                </v-col>
                <v-col cols="12" class="text-center text-h5 ma-5">
                    +38 (097) 905 78 12<br>
                    +38 (067) 695 03 35<br>
                    loungezone.lake@gmail.com
                </v-col>

            </v-row>
        </v-container>

    </div>
</template>

<script>
export default {
    data() {
        return {
            tab: null,  // активная вкладка
            tabs: ['ПЛЯЖ', 'АЛЬТАНКИ', 'АКТИВНИЙ ВІДПОЧИНОК', 'КАРПАТСЬКИЙ ЧАН', 'ЛАЗНЯ НА ДРОВАХ'],
            items_entry: [
                { name: 'Людина', price: '50 грн' },
                { name: 'Авто (Пн-Пт)', price: '200 грн' },
                { name: 'Авто (Сб-Нд)', price: '300 грн' },
                { name: 'Мікроавтобус', price: '400 грн' },
                { name: 'Гідроцикл', price: '500 грн' }
            ],
            items_altanka: [
                { name: 'На 8 осіб', price: '1000 грн/день' },
                { name: 'На 12 осіб', price: '1400 грн/день' },
                { name: 'На 16-18 осіб', price: '1600 грн/день' },
                { name: 'Оренда BBQ', price: '200 грн' },
            ],
            items_poslug: [
                { name: 'Чан на дровах', price: '2000 грн (3 год)' },
                { name: 'Баня на дровах + чан', price: '6000 грн(10:00-21:00)' },
                { name: 'На 16-18 осіб', price: '1600 грн/день' },
                { name: 'Оренда BBQ', price: '200 грн' },
            ],
            items_island: [
                { name: 'Шезлонг', price: '200 грн' },
                { name: 'Chill zone на 2-х', price: '500 грн' },
                { name: 'Chill zone на 3-х', price: '500 грн' },
                { name: 'Chill zone «Blue»', price: '1400 грн' },
                { name: 'Chill aut', price: '600 грн' },
            ],
            items_house: [
                { name: 'На 10-х осіб', price: '3800 грн' },
                { name: 'На 8-х осіб', price: '3500 грн' },
                { name: 'На 6-х осіб', price: '3300 грн' },
                { name: 'На 4-х осіб', price: '2300 грн' },
                { name: 'На 3-х осіб(без зручностей)', price: '1200 грн' },
            ]
        };
    },

}
</script>

<style scoped>
.price-tag {

    margin-right: 150px;
}
.align-end {
    justify-content: center;
}


.grey-bg {
    background-color: #f7f7f7; /* Светло-серый фон */
}
.promo {
    background: url('https://thumb.tildacdn.com/tild6566-3537-4534-b663-303237366161/-/format/webp/_2.jpg');
    background-size: cover;
    width:100%;
    height:100vh;
}
.promo_2{
    background: url('https://thumb.tildacdn.com/tild6566-3537-4534-b663-303237366161/-/format/webp/_2.jpg');
    background-size: cover;
    width:100%;
    height:200vh;
}
.v-text-field--outlined {

    font-family:monospace;
    font-size: 40px;
    text-shadow: 2px 1px 3px black;
}
.background {
    background: url('/assets/tesla-specs.jpeg');
    background-size:cover;
    width: 100%;
    height:70vh;
}
.tab-image {
    width: 80%;
height: auto;
margin: 20px auto;
}
</style>
