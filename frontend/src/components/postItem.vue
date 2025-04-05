<template>
    <div class="post">
        <div>
            <div>{{ post.id }}</div>
            <div><strong>Название:</strong>{{ post.title }}</div>
            <div><strong>Описание:</strong>{{ post.body }}</div>
        </div>
        <div class="post__btns">
            <my-button
                @click="$emit('remove', post)"
            >
            Удалить
            </my-button>
        </div>
    </div>
</template>

<script>
import myButton from './UI/myButton.vue';
    export default {
        components: {
            myButton
        },
        props: {
            post: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style lang="scss" scoped>
.post {
    padding: 5px;
    margin: 10px 0 0 0;
    border: 2px solid rgb(0, 0, 0);
    border-radius: 10%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.post__btns button{
    background: none;
    border: 2px solid #000000;
    border-radius: 50%;
    padding: 5px;

}

</style>