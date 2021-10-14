<template>
    <div class="relative text-sm w-72 bg-gray-50 border border-gray-200">
        <div class="flex inline-flex">

            <!-- Left chevron -->
            <div class="mt-1 mb-1 ml-1">
                <button @click="prevMonth">
                    <hero-icon name="chevron-left" class="w-4 h-4"></hero-icon>
                </button>
            </div>

            <!-- Middle month -->
            <div class="mt-1 pl-24">
                <div class="flex inline-flex">
                    {{ loc_month(currentDate.getMonth()) + ` ` +  currentDate.getFullYear()}}
                </div>
            </div>

            <!-- Right chevron -->
            <div class="mt-1 mb-1 ml-28">
                <button @click="nextMonth">
                    <hero-icon name="chevron-right" class="w-4 h-4"></hero-icon>
                </button>
            </div>
        </div>
    </div>
    <div class="bg-gray-100 border-l-4 border-r border-b border-gray-200 h-48 w-72 text-sm">
        <table>
            <tr>
                <th v-for="name in loc_week()" class="px-2">
                    {{ name }}
                </th>
            </tr>
            <tr class="mx-3" v-for="chunks in chunk(monthDays[currentDate.getMonth()], 7)">
                <td @click="selectedDate = day" v-for="day in chunks" class="hover:bg-gray-200 cursor-pointer" :class="(currentDate.getDate() === day && currentDate.getMonth() === new Date().getMonth()) ? `border border-blue-500` : ``">
                    {{ day }}
                </td>
            </tr>
        </table>
    </div>

    <div v-if="selectedDate" class="m-5">
        Selected day: {{ selectedDate }}
    </div>

    <div class="m-5">
        <button @click="switchLanguage" class="bg-gray-50 px-3 py-1 cursor-pointer hover:bg-gray-100 border">
            Switch language
        </button>
    </div>
</template>

<script>
import HeroIcon from "../Shared/HeroIcon";
import Button from "../Jetstream/Button";
export default {
    components: {Button, HeroIcon},

    props: [
        'date'
    ],

    data() {
        return {
            currentSelectedLanguage: 'en',
            currentDate: this.date ?? new Date(),
            selectedDate: null,

            monthDays: {
                1: 31,
                2: 28,
                3: 31,
                4: 30,
                5: 31,
                6: 30,
                7: 31,
                8: 31,
                9: 30,
                10: 31,
                11: 30,
                12: 31
            },

            localization: {
                en: {
                    months: {
                        1: "Jan",
                        2: "Feb",
                        3: "Mar",
                        4: "Apr",
                        5: "May",
                        6: "Jun",
                        7: "Jul",
                        8: "Aug",
                        9: "Sep",
                        10: "Oct",
                        11: "Nov",
                        12: "Dec"
                    },

                    week: {
                        1: "Mon",
                        2: "Tue",
                        3: "Wed",
                        4: "Thu",
                        5: "Fri",
                        6: "Sat",
                        7: "Sun"
                    }
                },
                ru: {
                    months: {
                        1: "Янв",
                        2: "Фев",
                        3: "Мар",
                        4: "Апр",
                        5: "Май",
                        6: "Июнь",
                        7: "Июль",
                        8: "Авг",
                        9: "Сент",
                        10: "Окт",
                        11: "Нояб",
                        12: "Дек"
                    },

                    week: {
                        1: "Пон",
                        2: "Вт",
                        3: "Ср",
                        4: "Чт",
                        5: "Пт",
                        6: "Сб",
                        7: "Вс"
                    }
                },
            }
        }
    },

    methods: {
        switchLanguage() {
            if(this.currentSelectedLanguage === 'en') {
                this.currentSelectedLanguage = 'ru';
            }
            else {
                this.currentSelectedLanguage = 'en';
            }
        },

        loc_weekDay(index) {
            return this.loc_week()[index];
        },

        loc_week() {
            return this.localization[this.currentSelectedLanguage].week;
        },

        loc_month(index) {
            return this.localization[this.currentSelectedLanguage].months[index];
        },

        nextMonth() {
            let newDate = new Date(this.currentDate);
            newDate.setMonth(
                newDate.getMonth() + 1
            );

            this.currentDate = newDate;
        },

        prevMonth() {
            let newDate = new Date(this.currentDate);

            newDate.setMonth(
                newDate.getMonth() - 1
            );

            this.currentDate = newDate;
        },

        chunk(arr, size) {
            let intArray = [];
            for(let i = 1; i <= arr; i++) {
                intArray[i-1] = i;
            }
            arr = intArray;

            let chunks = [],
                i = 0,
                n = arr.length;

            while (i < n) {
                chunks.push(arr.slice(i, i += size));
            }

            return chunks;
        }
    }
}
</script>
