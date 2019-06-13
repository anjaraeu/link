<template>
    <div class="report" v-if="show">
        <div class="header">
            <div class="link">
                <a :href="'/' + link.slug" target="_blank">{{ link.slug }}</a>
            </div>
            <div class="actions">
                <a class="delete" @click.prevent="deleteLink">Supprimer</a>
                <a class="ignore" @click.prevent="ignoreLink">Ignorer</a>
            </div>
        </div>
        <div class="target">
            Cible : {{ link.link }}
        </div>
        <div class="reasons">
            <ul>
                <li v-for="report in link.reports" v-bind:key="report.id">{{ report.reason }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {

    props: ['initreport'],

    data() {
        return {
            link: JSON.parse(this.initreport),
            show: true
        };
    },

    methods: {
        processReport(del = false) {
            axios.delete('/report/'+this.link.reports[0].id, {data: {delete_link: del}}).then(res => {
                this.show = false;
            });
        },
        deleteLink() {
            this.processReport(true);
        },
        ignoreLink() {
            this.processReport(false);
        }
    }

}
</script>
