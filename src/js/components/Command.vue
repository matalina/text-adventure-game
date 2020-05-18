<template>
    <p class="command">
        <span v-if="isError()">
            <i class="fad fa-bomb fa-fw"></i>
            {{ command }}
        </span>
        <span v-if="! isError()">
            <i class="fad fa-terminal fa-fw"></i>
            {{ command }}
        </span>
        <small class="text-gray-500">{{ string }}</small>
    </p>
</template>

<script>
    export default {
        name: 'tag-command',
        props: ['command','string','error'],
        methods: {
            isError() {
                return this.error === true;
            }
        }
    }
</script>
