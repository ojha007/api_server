<template>
    <div class="panel panel-chat">
        <div class="box direct-chat">
            <div class="box-header with-border"><h3 class="box-title">Chat</h3>
                <div class="box-tools pull-right">
                    <button type="button" data-widget="remove"
                            @click="toggleChatBox"
                            class="btn btn-box-tool"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="direct-chat-messages">
                    <div class="direct-chat-msg" v-for="chat in chats" :class="chat.class">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-" :class="chat.pull ? 'left' :'right'"
                                  v-text="chat.type"></span>
                        </div>
                        <img class="direct-chat-img" :src="image" alt="message user image">
                        <div class="direct-chat-text">
                            {{ chat.message }}
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <form @submit.prevent="submitForm">
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control"
                               v-model="message">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-flat">Send</button>
                          </span>
                    </div>
                </form>
            </div>
            <!-- /.box-footer-->
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex';

export default {

    data() {
        return {
            image: `${process.env.MIX_APP_URL}/backend/images/default-user.png`,
            message: '',
        }
    },
    computed: mapState(['chats', 'currentIdentifier']),
    mounted() {
        this.getOldChatByIdentifier();
    },
    methods: {
        getOldChatByIdentifier() {
            let identifier = this.currentIdentifier;
            axios.get(`/getOldChats?identifier=${identifier}`)
                .then(response => {
                    let data = response.data.data;
                    this.$store.commit('SET_CHATS', data);
                })
        },
        toggleChatBox() {
            this.$store.commit('TOGGLE_CHAT_BOX');
        },
        submitForm() {
            let payload = {
                message: this.message,
                identifier: this.currentIdentifier,
                type: 'You',
                class: 'right',
                pull: 'right',
            }
            this.$store.commit('SET_CHATS', payload);
            axios.post('/chat', payload)
                .then(() => {
                    this.message = '';
                }).catch(error => {
                console.log(error);
            })
        }
    }

}
</script>

<style scoped>
.panel.panel-chat {
    position: fixed;
    bottom: 0;
    right: 0;
    max-width: 350px;
    box-shadow: none;
    -webkit-box-shadow: none;
}


</style>
