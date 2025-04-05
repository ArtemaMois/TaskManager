<template>
    <div>
        <div class="chat__content">
            <my-chat-navbar
                :image="user.image"
                :login="user.login"
                :online="false"
                class="chat__navbar"
            ></my-chat-navbar>
            <my-chat-body
                class="chat__history"
                :messages="messages"
            ></my-chat-body>
            <div class="chat__message-new">
                <my-input
                    @keypress.enter="publishMessage"
                    v-model="messageInput"
                    class="chat__message-input"
                    placeholder="Enter message..."
                ></my-input>
                <div class="chat__message-options">
                    <button @click="publishMessage">
                        <svg
                            width="44"
                            height="44"
                            viewBox="0 0 44 44"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <rect
                                width="44"
                                height="44"
                                rx="10"
                                fill="#546FFF"
                            />
                            <path
                                d="M26.14 12.96L17.11 15.96C11.04 17.99 11.04 21.3 17.11 23.32L19.79 24.21L20.68 26.89C22.7 32.96 26.02 32.96 28.04 26.89L31.05 17.87C32.39 13.82 30.19 11.61 26.14 12.96ZM26.46 18.34L22.66 22.16C22.51 22.31 22.32 22.38 22.13 22.38C21.94 22.38 21.75 22.31 21.6 22.16C21.31 21.87 21.31 21.39 21.6 21.1L25.4 17.28C25.69 16.99 26.17 16.99 26.46 17.28C26.75 17.57 26.75 18.05 26.46 18.34Z"
                                fill="white"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MyChatNavbar from './MyChatNavbar.vue'
import MyChatBody from './MyChatBody.vue'
import axios from 'axios'
import { mapGetters } from 'vuex';
export default {
    components: {
        MyChatNavbar,
        MyChatBody,
    },
    data() {
        return {
            messageInput: '',
        }
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
        messages: {
            type: Array,
            required: true,
        },
        chat: {
            type: Object,
            required: true,
        },
    },
    computed: {
        ...mapGetters(['getCentrifuge'])
    },
    methods: {
        async publishMessage(event) {
            if (event.target.value != '') {
                try {
                    const response = await axios.post(
                        `http://localhost:80/api/ws/${this.chat.id}/publish`,
                        {
                            message: event.target.value,
                        },
                        {
                            headers: {
                                Authorization:
                                    localStorage.getItem('api_token'),
                            },
                        }
                    )
                    event.target.value = ''
                } catch (e) {
                    console.log(e)
                }
            }
        },
        updateLastMessage(message, time)
        {
            document.querySelector("#last-message").innerText = message;
            document.querySelector("#last-time").innerText = time;
        }
    },
    mounted() {
        console.log(this.getCentrifuge);
        try {
            const sub = this.getCentrifuge.newSubscription(this.chat.title);
            sub.on('publication', (msg) => {
                const message = msg.data.message
                if (this.user.id == message.user) {
                    message.isMy = false;
                }
                console.log(message);
                this.messages.push(message);
                this.updateLastMessage(message.body, message.updatedAt);
                
            })
            sub.subscribe()
        } catch (e) {
            console.log(e)
        }
    },
}
</script>
<style scoped>
input,
input:hover,
input:focus,
input:active {
    border: none;
    outline: none;
    all: none;
}
.chat__content {
    height: calc(100vh - 120px);
    display: grid;
    grid-template-rows: 80px 1fr 60px;
}

.chat__navbar {
    height: 80px;
}
.chat__history {
    background-color: #e9e9e9;
    padding: 10px;
    overflow-y: scroll;
    scroll-behavior: smooth;
    scrollbar-width: thin;
}

.chat__message-new {
    border-top: 2px solid #8e92bc44;
    border-bottom: 2px solid #8e92bc44;
    padding: 0px 30px;
    display: flex;
    align-items: center;
    gap: 20px;
    align-items: center;
}

.chat__message-options {
    display: flex;
    align-items: center;
    width: 35px;
    height: 35px;
}

.chat__message-input {
    font-family: 'JakartaSansRegular';
    border: none;
    font-size: 16px;
    min-width: calc(100% - 55px);
    padding: 25px 7px;
}
</style>