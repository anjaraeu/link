<template>
    <div class="input" v-if="!loggedin">
        <input type="text" :placeholder="this.$lang.get('admin.login.password')" v-model="password" @keyup.enter="submitLogin" autofocus="on"/>
    </div>
    <div v-else>
        <h3><a href="/report">{{ this.$lang.get('admin.reports.access') }}</a></h3>
    </div>
</template>

<script>
export default {
    props: ['initlogin'],

    data() {
        return {
            loggedin: this.initlogin,
            password: ''
        }
    },

    methods: {
        submitLogin() {
            axios.post('/login', {
                password: this.password
            }).then(res => {
                if (res.data.loggedin) this.loggedin = true;
            }).catch(err => {
                console.warn('Bad password');
            });
        }
    }
}
</script>
