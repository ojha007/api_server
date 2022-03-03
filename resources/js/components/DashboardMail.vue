<template>
    <div class="box-body" id="email">
        <div class="row">
            <div class="col-xs-12 text-center" v-if="!isLogged">
                <a :href="this.oauthurl" class="nav-link">Login to Your gmail account</a>
            </div>
            <div v-if="isLogged && !allMail.length" class="text-center">
                <button class="btn btn-default btn-flat"><i class="fa fa-refresh"></i> Loading......</button>
            </div>
            <div v-if="allMail.length && isLogged">
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <tbody>
                        <tr v-for="(mail,key) in allMail" :key="key">
                            <td class="mailbox-name"><a href="">{{mail.from}}</a></td>
                            <td class="mailbox-subject"><b>{{mail.subject}}</b></td>
                            <td class="mailbox-attachment"></td>
                            <td class="mailbox-date">{{mail.time}}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

</template>

<script>

export default {
    name: "DashboardMail",
    props: ['oauthurl', 'logged', 'url'],
    data() {
        return {
            allMail: [],
            loading: true,
            isLogged: this.logged
        }
    },

    async mounted() {
        if (this.logged) {
            await this.getMailInbox(this.url)
        }

    },
    methods: {
        getMailInbox(url) {
            axios.get(url)
                .then(response => {
                    this.loading = false;
                    this.allMail = response.data.data;
                    console.log(response);
                });
        }
    },

}
</script>

<style scoped>

</style>
