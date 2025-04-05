<template>
    <div v-if="posts.length > 0">
        <h2>Список</h2>
        <transition-group name="post-list">
            <postItem 
            v-for="(post, id) in posts" 
            :post="post"
            :key="id"
            @remove="$emit('remove', post)"
            >
            </postItem>
        </transition-group>
    </div>
    <h2 v-else style="color: blue;">
        Список пустой...
    </h2>
</template>

<script>
import postItem from './postItem.vue';
    export default {
        components: {postItem},
        props: {
            posts: {
                type: Array,
                required: true,
            }
        }
    }
</script>

<style lang="scss" scoped>
.post-list-item {
  display: inline-block;
  margin-right: 10px;
}
.post-list-enter-active,
.post-list-leave-active {
  transition: all 0.5s ease;
}
.post-list-enter-from,
.post-list-leave-to {
  opacity: 0;
  transform: translateX(130px);
}
.post-list-move {
  transition: transform 0.8s ease;
}
</style>