<template>
    <div class="items">
        <div v-for="chat in chats.value" :key="chat.id" >
            <my-chat-list-item 
                :login="chat.login"
                :image="chat.image"
                :time="chat.updatedAt"
                :message="chat.message"
                :chatTitle="chat.title"
                @openChat="openChat(chat)"
            ></my-chat-list-item>
        </div>
    </div>
</template>

<script>
import MyChatListItem from './MyChatListItem.vue'
export default {
    components: {
        MyChatListItem,
    },
    props: {
        chats: {
            type: Array,
        },
    },
    methods: {
        openChat(chat)
        {
            this.$emit('openChat', chat.userId);
        }
    },

}
</script>
<style scoped>


</style>