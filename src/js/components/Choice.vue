<template>
    <div>
        <div style="min-height: 10rem;" class="flex">
            <div class="choices relative mb-5 self-center w-full" >
                <div
                    class="choice-display bg-orange-900 text-white shadow-md py-6 px-3 w-auto absolute rounded-full"
                >
                    <i class="fal fa-question fa-fw fa-7x" v-show="choose(null)"></i>
                    <i class="fas fa-heart fa-fw fa-7x" v-show="choose(1)"></i>
                    <i class="fad fa-angel fa-fw fa-7x" v-show="choose(2)"></i>
                    <i class="fad fa-user-secret fa-fw fa-7x" v-show="choose(3)"></i>
                    <i class="fad fa-poo fa-fw fa-7x" v-show="choose(4)"></i>
                    <i class="fad fa-thumbs-up fa-fw fa-7x" v-show="choose(5)"></i>
                    <i class="fad fa-thumbs-down fa-fw fa-7x" v-show="choose(6)"></i>
                    <i class="fad fa-user-injured fa-fw fa-7x" v-show="choose(7)"></i>
                    <i class="fad fa-user-graduate fa-fw fa-7x" v-show="choose(8)"></i>
                    <i class="fad fa-lightbulb fa-fw fa-7x" v-show="choose(9)"></i>
                    <i class="fad fa-user-shield-alt fa-fw fa-7x" v-show="choose(10)"></i>
                    <i class="fad fa-tint fa-fw fa-7x" v-show="choose(11)"></i>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div
                        class="choice p-3 bg-orange-700 text-white even:text-right odd:pr-12 even:pl-12 rounded hover:bg-orange-500"
                        @mouseover="choice = 1"
                        @mouseout="choice = null"
                    >
                        <span class="py-2 px-4 rounded-full bg-orange-900 text-white m-1">1</span>
                        <span class="hidden lg:block">Etiam et sodales odio.</span>
                    </div>
                    <div
                        class="choice p-3 bg-orange-700 text-white even:text-right odd:pr-12 even:pl-12 rounded hover:bg-orange-500"
                        @mouseover="choice = 2"
                        @mouseout="choice = null"
                    >
                        <span class="py-2 px-4 rounded-full bg-orange-900 text-white m-1">2</span>
                        <span class="hidden lg:block">Etiam et sodales odio.</span>
                    </div>
                    <div
                        class="choice p-3 bg-orange-700 text-white even:text-right odd:pr-12 even:pl-12 rounded hover:bg-orange-500"
                        @mouseover="choice = 3"
                        @mouseout="choice = null"
                    >
                        <span class="py-2 px-4 rounded-full bg-orange-900 text-white m-1">3</span>
                        <span class="hidden lg:block">Etiam et sodales odio.</span>
                    </div>
                    <div
                        class="choice p-3 bg-orange-700 text-white even:text-right odd:pr-12 even:pl-12 rounded hover:bg-orange-500"
                        @mouseover="choice = 4"
                        @mouseout="choice = null"
                    >
                        <span class="py-2 px-4 rounded-full bg-orange-900 text-white m-1">4</span>
                        <span class="hidden lg:block">Etiam et sodales odio.</span>
                    </div>
                </div>
            </div>
        </div>
        <ol class="small-options block lg:hidden list-decimal list-inside">
            <li :class="{ 'bg-orange-500': choose(1), 'text-white': choose(1) }">Etiam et sodales odio.</li>
            <li :class="{ 'bg-orange-500': choose(2), 'text-white': choose(2) }">Etiam et sodales odio.</li>
            <li :class="{ 'bg-orange-500': choose(3), 'text-white': choose(3) }">Etiam et sodales odio.</li>
            <li :class="{ 'bg-orange-500': choose(4), 'text-white': choose(4) }">Etiam et sodales odio.</li>
        </ol>
    </div>
</template>

<script>
    export default {
        name: 'tag-choice',
        data() {
            return {
                choice: null,
            };
        },
        methods: {
            choose(choice) {
                return choice === this.choice;
            }
        }
    }
</script>
