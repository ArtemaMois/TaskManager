<template>
    <div>
        <div class="chat__body body">
            <div class="test">
                <ul class="message__list">
                    <li
                        v-for="message in messages"
                        :key="message.id"
                        class="message__item"
                    >
                        <div v-if="message.isMy" class="message self">
                            <div class="message__text">{{ message.body }}</div>
                            <div class="message__time">{{ message.updatedAt }}</div>
                        </div>
                        <div v-else class="message">
                            <div class="message__text">{{ message.body }}</div>
                            <div class="message__time foreign">{{ message.updatedAt }}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        messages: {
            type: Array,
            required: false,
        },
    },

}
</script>
<style scoped>
.test {
    height: 1000px;
}

.message__list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.message__item {
    display: flex;
}
.message {
    background-color: #fff;
    color: #000;
    font-family: 'Ubuntu Regular', sans-serif;
    font-size: 16px;
    letter-spacing: 0.2px;;
    padding: 8px 12px;
    max-width: 440px;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    gap: 5px;
}
.self {
    margin-left: auto;
    background-color: #546fff;
    color: #fff;
}

.message__time{
    font-family: 'Ubuntu Regular', sans-serif;
    font-size: 12px;
    color: #fff;
}

.foreign{
    margin-left: auto;
    color: #8E92BC;
}
</style>