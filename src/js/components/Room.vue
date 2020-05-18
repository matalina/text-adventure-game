<template>
    <div class="room">
        <h1>{{ name }}</h1>
        <div v-html="content"></div>
        <ul class="exits">
            <li v-for="(exit, dir) in exits">
                <strong>{{ dir }}</strong>: {{ exit.text }} (<strong>{{ exit.name }}</strong>)
            </li>
        </ul>
    </div>
</template>

<script>
    import * as matter from 'gray-matter';
    const md = require('markdown-it')();
    export default {
        name: 'tag-room',
        props: ['filename'],
        data() {
            return {
                id: null,
                name: null,
                items: {},
                exits: {},
                content: null,
            };
        },
        mounted() {
            axios.get(`./game/rooms/${this.filename}.md`)
                .then((response) => {
                    let file = response.data;
                    let data = matter(file);
                    this.id = data.data.id;
                    this.name = data.data.name;
                    this.items = data.data.items;
                    this.exits = data.data.exits;
                    this.content = md.render(data.content);
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    }
</script>
