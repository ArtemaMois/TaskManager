<template>
    <div class="items">
        <div v-for="user in users" :key="user.id">
            <my-chat-user-item @openChat="openChat(user.id)"
                :login="user.login"
                :image="user.image"
                :time="user.updated_at"
                :message="user.message"
            ></my-chat-user-item>
        </div>
    </div>
</template>

<script>
import MyChatUserItem from './MyChatUserItem.vue'
export default {
    components: {
        MyChatUserItem,
    },
    props: {
        users: {
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
.items {
    gap: 20px;;
}

</style>