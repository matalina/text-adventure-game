<template>
    <div id="app" class="display font-sans">
        <header class="p-3 bg-orange-600 text-gray-800">
            Header
        </header>
        <main class="p-3 lg:px-64 text-gray-800 mx-auto" ref="container">
            <tag-room :filename="current_room"/>
        </main>
        <aside class="p-3 bg-orange-700 text-white flex">
            <div class="flex pt-1 pr-3 text-white">
                <i class="fad fa-keyboard fa-fw fa-2x"></i>
            </div>
            <tag-command-line/>
        </aside>
        <footer class="p-3 bg-orange-900 text-gray-300 text-xs text-center">
            Copyright &copy; {{ getCopyright()  }} All Rights Reserved - Any unauthorized reproduction, alteration, distribution, or other use of this work is prohibited. | This software is open-sourced and can be found on <a class=" text-orange-500" href="https://github.com/matalina/text-adventure-game">Github</a> licensed under the <a class="text-orange-500" href="https://opensource.org/licenses/MIT">MIT License</a>
        </footer>
    </div>
</template>

<script>
    import moment from "moment";
    import TagChoice from './Choice';
    import TagRoom from "./Room";
    import Command from "./Command";
    import Vue from 'vue';
    const md = require('markdown-it')();
    import TagCommandLine from "../CommandLine";

    export default {
        components: {TagCommandLine, TagRoom, TagChoice },
        data() {
            return {
                current_room: 'room_1',
            };
        },
        methods: {
           /* nextEvent() {
                // https://css-tricks.com/creating-vue-js-component-instances-programmatically/
                var ComponentClass = Vue.extend(Button)
                var instance = new ComponentClass({
                    propsData: { type: 'primary' }
                })
                instance.$slots.default = ['Click me!']
                instance.$mount() // pass nothing
//         console.log(this.$refs)
                this.$refs.container.appendChild(instance.$el)
            },*/
            getCopyright() {
                let year = moment().year();

                if(year === 2020) {
                    return `2020`;
                }

                return `2020-${{year}}`
            },
            displayCommand(command, string,error) {
                let ComponentClass = Vue.extend(Command);
                let instance = new ComponentClass({
                    propsData: {
                        command,
                        string,
                        error,
                    }
                });
                instance.$mount();
                this.$refs.container.appendChild(instance.$el);
                this.command = null;
            }
        },
        mounted() {
            EventBus.listen('command-sent', ({command, string, error}) => {
                this.displayCommand(command,string,error);
            });
        }
    }
</script>
