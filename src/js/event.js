import Vue from "vue";

/*
    # EventBus listing

 */

export default new class {
    constructor() {
        this.vue = new Vue();
    }

    fire(event, data = null) {
        this.vue.$emit(event, data);
    }

    listen(event, callback) {
        this.vue.$on(event, callback);
    }

    forget(event, callback) {
        this.vue.$off(event, callback);
    }
};
