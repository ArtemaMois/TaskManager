<template>
    <div class="items">
        <div v-for="user in users" :key="user.id">
            <my-chat-user-item @openChat="openChat(user)"
                :login="chats.login"
                :image="chats.image"
                :time="chats.updated_at"
                :message="chats.message"
            ></my-chat-user-item>
        </div>
    </div>
</template>

<script>
import MyChatUserItem from './MyChatUserItem.vue'
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
        openChat(user)
        {
            this.$emit('openChat', user);
        }
    }

}
</script>
<style scoped>


</style>