<template>
    <div class="input">
        <input id="link" type="text" :placeholder="this.$lang.get('link.report.link.placeholder')" v-model="url" @keyup.enter="submitReport" autofocus="on" autocomplete="off"/>
        <br/><br/>
        <input type="text" :placeholder="this.$lang.get('link.report.reason.placeholder')" v-model="reason" @keyup.enter="submitReport" autofocus="on" autocomplete="off"/>
        <p class="tooltip" v-bind:class="{ hidden: !tooltip }">{{ notice }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            url: '',
            reason: '',
            tooltip: false,
            tooltiplock: false,
            notice: this.$lang.get('link.report.tooltip')
        }
    },

    created() {
        this.debouncedShowTooltip = _.debounce(this.showTooltip, 1250);
        this.debouncedResetForm = _.debounce(this.resetForm, 10000);
    },


    mounted() {
        $('#link').focus();
    },

    methods: {
        submitReport() {
            axios.post('/report', {
                link: this.url,
                reason: this.reason
            }).then(res => {
                if (!res.data.report) return;
                this.tooltiplock = true;
                this.tooltip = true;
                this.notice = this.$lang.get('link.report.created');
                this.debouncedResetForm();
            }).catch(res => {
                this.tooltip = true;
                this.notice = this.$lang.get('link.report.error');
            });
        },
        showTooltip() {
            this.tooltip = true;
        },
        resetForm() {
            this.tooltip = false;
            this.tooltiplock = false;
            this.notice = this.$lang.get('link.report.tooltip');
        }
    },

    watch: {
        url() {
            if (this.tooltiplock) return;
            this.tooltip = false;
            this.debouncedShowTooltip();
        }
    }
}
</script>
