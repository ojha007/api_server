<template>
    <ul class="dropdown-menu">
        <li class="header">You have <span
            class="notification_count_li"></span>
            Notification
        <li>
            <!-- Inner Menu: contains the notifications -->
            <div class="text-center loading" v-if="loading">
                <div class="overlay">
                    <i class="fa fa-refresh  fa-2x fa-spin"></i>
                </div>
            </div>
            <ul class="menu notifications-list" v-for="message in messages">
                <li>
                    <a href="#" data-toggle="control-sidebar">
                        <i class="fa fa-gears"></i>
                        {{ message.message }}
                    </a>
                </li>
            </ul>
        </li>
        <li class="footer">
            <a href="#">
                View all</a>
        </li>

    </ul>

</template>

<script>
export default {
    data() {
        return {
            loading: true,
            messages: [],
            limit: 10,
            offset: 0,
        }
    },
    mounted() {
        console.log('Component mounted.');
        this.getChatNotification();
        this.getOldChats();
    },
    methods: {
        showNotificationModel() {

        },
        getChatNotification() {
            window.Echo.channel('mibsoftChat.admin')
                .listen('.MessageReceived', (data) => {
                    this.messages.push(data)
                });
        },
        getOldChats() {
            axios.get(`/getAllChats?limit=${this.limit}`)
                .then(response => {
                    this.messages.push(response.data);
                });
        }
    }
}
</script>

<style scoped>

</style>
