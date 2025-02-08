<template>
    <div>
        <div class="chat">
            <div class="chat__body"></div>
            <div class="chat__footer">
                <input
                    type="text"
                    v-model="message"
                    placeholder="Enter message"
                />
                <button @click="publishMessage" class="chat__button">
                    Отправить
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { Centrifuge } from 'centrifuge'
import { onMounted, ref } from 'vue'

const wsToken = ref('')
const message = ref('')
const centrifuge = ref({})
let publishMessage = () => {
    try {
        const response = axios.post(
            'http://localhost:80/api/ws/publish',
            {
                channel: 'news',
                message: message.value,
            },
            {
                headers: {
                    Authorization: localStorage.getItem('api_token'),
                },
            }
        )
        const data = response.then(
            () => {},
            (err) => err
        )
        console.log(data);
    } catch (e) {
        console.log(e)
    }
}

onMounted(async () => {
    try {
        const response = await axios.get('http://localhost/api/ws/token', {
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
        centrifuge.value.on('connected', () => {
            console.log('connected')
        })
        centrifuge.value.on('subscribed', function (msg) {
            console.log({ channel: msg.channel })
        })
        const sub = centrifuge.value.newSubscription('news')
        sub.subscribe()
        sub.on('publication', (msg) => {
            console.log({ channel: msg.channel, message: msg.data })
        })
        centrifuge.value.connect()
    } catch (e) {
        console.log(e)
    }
})
</script>
<style scoped></style>