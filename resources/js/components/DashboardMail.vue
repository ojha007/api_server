<template>
    <div class="box-body" id="email">
        <vue-modal :show="showModal" :modalData="mail" modalTitle="View Mail"></vue-modal>
        <div class="col-xs-12 text-center" v-if="!isLogged">
            <a href="/oauth/gmail" class="nav-link">Login to Your gmail account</a>
        </div>
        <div v-if="isLogged && !allMail.length" class="text-center">
            <button class="btn btn-default btn-flat"><i class="fa fa-refresh fa-spin"></i> Loading......</button>
        </div>
        <div v-if="allMail.length && isLogged">
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <tbody>
                    <tr v-for="(mail,key) in allMail" :key="key" @click="viewModal(mail.id)" style="cursor: pointer;">
                        <td class="mailbox-name">{{ mail.from }}</td>
                        <td class="mailbox-subject"><b>{{ mail.subject }}</b></td>
                        <td class="mailbox-attachment"></td>
                        <td class="mailbox-date">{{ mail.date }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "DashboardMail",
    props: ['logged', 'url'],

    data() {
        return {
            allMail: [],
            loading: true,
            isLogged: this.logged,
            showModal: false,
            mail: {},
        }
    },

    async mounted() {
        if (this.logged) {
            await this.getMailInbox(this.url)
        }

    },
    methods: {
        async viewModal(id) {
            let response = await axios.get(`/mails/view/${id}`);
            if (response?.data?.data) {
                this.mail = response.data.data;
                this.showModal = true
            }
        },
        async getMailInbox(url) {
            let response = await axios.get(url);
            if (response?.data?.data) {
                this.loading = false;
                this.allMail = response.data.data;
            }

        }
    },

}
</script>

<style scoped>

</style>
