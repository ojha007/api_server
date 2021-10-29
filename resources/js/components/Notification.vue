<template>
    <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success" v-if="count">{{ count }}</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have {{ count }} new messages</li>
            <li>
                <ul class="menu">
                    <li v-for="message in messages" @click="toggleChatBox(message.identifier)">
                        <a href="javascript:void (0)">
                            <div class="pull-left">
                                <img :src="image" class="img-circle img-sm" alt="User Image">
                            </div>
                            <h4>
                                <small><i class="fa fa-clock-o"></i> {{ convertTimeFormat(message.time) }}</small>
                            </h4>
                            <p v-text="message.message"></p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="footer">
                <a href="#">See All Messages</a>
            </li>
        </ul>
    </li>
</template>

<script>

export default {
    data() {
        return {
            loading: true,
            limit: 10,
            messages: [],
            offset: 0,
            count: 0,
            image: `${process.env.MIX_APP_URL}/backend/images/default-user.png`
        }
    },
    mounted() {
        this.getChatNotification();
        this.listChats();
    },
    methods: {
        convertTimeFormat(time) {
            if (!time) return '1s';
            if (parseInt(time) > 60) {
                return Math.ceil(time / 60) + 'hr';
            } else {
                return time + 'M'
            }
        },
        getChatNotification() {
            window.Echo.channel('mibsoftChat.admin')
                .listen('.MessageReceived', (data) => {
                    this.count++;
                    let matched = false;
                    this.messages.map(m => {
                        if (m.identifier === data.identifier) {
                            m.message = data.message;
                            matched = true;
                            this.$store.commit('SET_CHATS', {
                                message: m.message,
                                identifier: data.identifier,
                                type: "Customer",
                                pull: 'right',
                                class: ''
                            });
                        }
                    });
                    if (!matched)
                        this.messages.unshift(data);
                });
        },
        listChats() {
            axios.get(`/getAllChats?limit=${this.limit}`)
                .then(response => {
                    this.loading = false;
                    this.messages = response.data.data;
                });
        },
        toggleChatBox(identifier) {
            this.$store.commit('TOGGLE_CHAT_BOX', identifier);
        }
    }
}
</script>

<style scoped>

</style>
