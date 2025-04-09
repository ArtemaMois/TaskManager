<template>
    <div @click="publishMessage" class="main-class">
        <nav-bar class="sidebar"></nav-bar>
        <my-main-foot class="my-main-foot"></my-main-foot>
        <div class="chat">
            <div class="chat__list">
                <div class="chat__search">
                    <my-input
                        v-model="userSearchQueryString"
                        class="chat__serach-input"
                        @keydown.enter="searchUsers"
                        placeholder="Search users"
                    ></my-input>
                    <button @click="searchUsers">
                        <svg
                            width="20"
                            height="20"
                            viewBox="0 0 20 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g clip-path="url(#clip0_52_2141)">
                                <path
                                    d="M9.58335 17.4998C13.9556 17.4998 17.5 13.9554 17.5 9.58317C17.5 5.21092 13.9556 1.6665 9.58335 1.6665C5.2111 1.6665 1.66669 5.21092 1.66669 9.58317C1.66669 13.9554 5.2111 17.4998 9.58335 17.4998Z"
                                    stroke="#141522"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M18.3334 18.3332L16.6667 16.6665"
                                    stroke="#141522"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </g>
                            <defs>
                                <clipPath id="clip0_52_2141">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
                <my-chat-user-list
                    class="chat__list-users"
                    v-if="isSearching"
                    :users="users"
                    @openChat="openChat"
                ></my-chat-user-list>
                <my-chat-list
                    v-else
                    :chats="myChats"
                    :centrifuge="centrifuge"
                    @openChat="openChat"
                    class="chat__list-self"
                ></my-chat-list>
            </div>
            <div v-if="isVisibleChat" class="chat__container">
                <my-chat
                    :user="currentUser"
                    :messages="messages"
                    :centrifuge="centrifuge"
                    :chat="chat"
                ></my-chat>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { Centrifuge } from 'centrifuge'
import MyChat from '@/components/Chat/MyChat.vue'
import MyChatList from '@/components/Chat/MyChatList.vue'
import { onMounted, ref, watch } from 'vue'
import MyChatUserList from '@/components/Chat/MyChatUserList.vue'
import { useSearchUsers } from '@/hooks/chat/useSearchUsers'
import { useInitialChats } from '@/hooks/chat/useInitialChats'
import { useStore } from 'vuex'
const userSearchQueryString = ref('')
const isVisibleChat = ref(false)
const isSearching = ref(false)
const store = useStore()
const currentUser = ref({})
const wsToken = ref('')
const messages = ref([])
const chat = ref('')
const centrifuge = ref({})
const myChats = useInitialChats();
const isNewChat = ref(false);
const { users, nextSearhUsersRef } = useSearchUsers(userSearchQueryString.value)
const openChat = (userId) => {
    currentUser.value = userId
    messages.value.splice(0)
    fetchChatInfo(currentUser.value)
    console.log(chat.value);
    if (chat.value != '') {
        isVisibleChat.value = true
        isSearching.value = false
        if (isNewChat.value) {
            myChats.value.push(chat.value)
        }
    }
}

const searchUsers = async () => {
    try {
        if (!userSearchQueryString.value == '') {
            const response = await axios.get(
                'http://localhost/api/accounts/chat?search=' +
                    userSearchQueryString.value,
                {
                    headers: {
                        Authorization: localStorage.getItem('api_token'),
                    },
                }
            )
            userSearchQueryString.value = ''
            users.value = response.data.data.users
            isSearching.value = true
        } else {
            isSearching.value = false
        }
    } catch (e) {
        console.log(e)
    }
}

const fetchChatInfo = async (userId) => {
    try {
        const response = await axios.post(
            'http://localhost:80/api/chats/personal/',
            {
                user_id: userId,
            },
            {
                headers: {
                    Authorization: localStorage.getItem('api_token'),
                },
            }
        )
        const data = response.data
        chat.value = data.chat;
        isNewChat.value = data.isNewChat;
        currentUser.value = data.user
        data.messages.forEach((item) => {
            messages.value.push(item)
        })
    } catch (e) {
        console.log(e)
    }
}

onMounted(async () => {
    try {
        const response = await axios.get('http://localhost:80/api/ws/token', {
            headers: {
                Authorization: localStorage.getItem('api_token'),
            },
        })
        wsToken.value = response.data.token
        centrifuge.value = new Centrifuge(
            'ws://localhost:8427/connection/websocket',
            {
                token: wsToken.value,
            }
        )
        store.dispatch('setCentrifuge', wsToken.value)
    } catch (e) {
        console.log(e)
    }
})
</script>

<style scoped>
input,
input:focus,
input:active,
input:hover {
    outline: none;
    border: none;
    all: none;
}

.main-class {
    display: grid;
    grid-template-columns: 17.5% 83.5%;
    grid-template-rows: 100px 1fr;
    grid-template-areas:
        'sidebar navbar'
        'sidebar content';
}

.sidebar {
    grid-area: sidebar;
}
.my-main-foot {
    grid-area: navbar;
    max-height: 100px;
    border-bottom: 2px solid #8e92bc44;
}

.chat {
    grid-area: content;
    display: grid;
    grid-template-columns: 400px 1fr;
    border: 2px solid #8e92bc47;
}

.chat__list {
    display: flex;
    width: 400px;
    padding: 30px 25px;
    flex-direction: column;
    gap: 30px;
    height: calc(100vh - 120px);
    max-height: 100vh;
    border-right: 1px solid #8e92bc47;
}

.chat__serach-input {
    height: 24px;
    border: none;
    outline: none;
    font-size: 16px;
    padding: 5px;
    font-family: 'Ubuntu Regular';
}

.chat__search {
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
    align-items: center;
    border: 1px solid #8e92bc;
    border-radius: 10px;
}

.chat__list-self,
.chat__list-users {
    display: flex;
    flex-direction: column;
    gap: 15px;
    height: 100%;
    padding-right: 15px;
    overflow-y: scroll;
    scrollbar-color: #8e92bc3d transparent;
    scrollbar-width: thin;
    scroll-behavior: smooth;
    scrollbar-gutter: stable;
    overflow-x: hidden;
}

/* .chat__container {
    /* border: 1px solid blue; */
/*}*/ 
button {
    background-color: transparent;
    outline: none;
    border: none;
    all: none;
}
</style>