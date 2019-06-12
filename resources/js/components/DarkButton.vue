<template>
    <a class="item" @click.prevent="switchTheme" v-if="!dark">{{ this.$lang.get('layout.theme.dark') }}</a>
    <a class="item" @click.prevent="switchTheme" v-else>{{ this.$lang.get('layout.theme.light') }}</a>
</template>

<script>
import Cookie from "cookie-universal";
const cookies = Cookie();
export default {
    data() {
        return {
            dark: false
        };
    },
    /**
     * Prepare the component (Vue 1.x).
     */
    ready() {
        this.prepareComponent();
    },
    /**
     * Prepare the component (Vue 2.x).
     */
    mounted() {
        this.prepareComponent();
    },
    methods: {
        prepareComponent: function() {
            var darkmode = cookies.get('dark-mode');
            if (darkmode == 'enabled') {
                this.dark = true;
                this.$emit('change-theme', this.dark);
            } else if (darkmode == 'disabled') {
                this.dark = false;
            } else {
                this.dark = false;
                cookies.set('dark-mode', 'disabled', {
                    path: '/',
                    maxAge: 60 * 60 * 24 * 365
                });
            }
        },
        switchTheme: function() {
            if (this.dark) {
                this.dark = false;
                cookies.set('dark-mode', 'disabled', {
                    path: '/',
                    maxAge: 60 * 60 * 24 * 365
                });
                this.$emit('change-theme', this.dark);
            } else {
                this.dark = true;
                cookies.set('dark-mode', 'enabled', {
                    path: '/',
                    maxAge: 60 * 60 * 24 * 365
                });
                this.$emit('change-theme', this.dark);
            }
        }
    }
}
</script>
