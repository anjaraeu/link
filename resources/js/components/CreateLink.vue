<template>
    <div class="input">
        <input
            type="text"
            :placeholder="this.$lang.get('link.form.placeholder')"
            v-model="url"
            @keyup.enter="submitLink"
            autofocus="on"
        />
        <p class="tooltip" v-bind:class="{ hidden: !tooltip }">
            {{ notice }}<br v-if="deletenotice" />{{ deletenotice }}
        </p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            url: "",
            tooltip: false,
            tooltiplock: false,
            notice: this.$lang.get("link.form.tooltip"),
            created: false,
            deletenotice: ""
        };
    },

    created() {
        this.debouncedShowTooltip = _.debounce(this.showTooltip, 1250);
        this.debouncedResetForm = _.debounce(this.resetForm, 10000);
    },

    mounted() {
        $(".linkinput > input").focus();
    },

    methods: {
        submitLink() {
            if (this.created) return;
            axios
                .post("/link", {
                    link: this.url
                })
                .then(res => {
                    this.url = res.data.link;
                    this.tooltiplock = true;
                    this.tooltip = true;
                    this.notice = this.$lang.get("link.form.created");
                    this.deletenotice = this.$lang.get("link.form.deletelink", {
                        mgmtlink: res.data.deletelink
                    });
                    this.debouncedResetForm();
                    this.$nextTick(() => {
                        this.created = true;
                    });
                })
                .catch(res => {
                    this.tooltip = true;
                    this.notice = this.$lang.get("link.form.error");
                });
        },
        showTooltip() {
            this.tooltip = true;
        },
        resetForm() {
            this.tooltip = false;
            this.tooltiplock = false;
            this.created = false;
            this.deletenotice = "";
            this.notice = this.$lang.get("link.form.tooltip");
        }
    },

    watch: {
        url() {
            this.created = false;
            if (this.tooltiplock) return;
            this.tooltip = false;
            this.debouncedShowTooltip();
        }
    }
};
</script>
