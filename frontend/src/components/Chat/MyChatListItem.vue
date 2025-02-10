<template>
    <div>
        <div class="user__list-item item" @click="openChat">
            <div class="item__info">
                <div class="item__image">
                    <img
                        v-if="image"
                        :src="image"
                        alt="Avatar"
                    />
                    <div v-else class="item__image-svg">
                        <svg
                            width="48"
                            height="48"
                            viewBox="0 0 24 24"
                            fill="none"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12ZM15 9C15 9.79565 14.6839 10.5587 14.1213 11.1213C13.5587 11.6839 12.7956 12 12 12C11.2044 12 10.4413 11.6839 9.87868 11.1213C9.31607 10.5587 9 9.79565 9 9C9 8.20435 9.31607 7.44129 9.87868 6.87868C10.4413 6.31607 11.2044 6 12 6C12.7956 6 13.5587 6.31607 14.1213 6.87868C14.6839 7.44129 15 8.20435 15 9ZM12 20.5C13.7163 20.5028 15.3928 19.9834 16.807 19.011C17.411 18.596 17.669 17.806 17.317 17.163C16.59 15.83 15.09 15 12 15C8.91 15 7.41 15.83 6.682 17.163C6.331 17.806 6.589 18.596 7.193 19.011C8.6072 19.9834 10.2837 20.5028 12 20.5Z"
                                fill="black"
                            />
                        </svg>
                    </div>
                </div>
                <div class="item__info-text">
                    <div class="item__login">{{ login }}</div>
                    <div v-if="message" class="item__message">{{ message }}</div>
                </div>
            </div>
            <div v-if="time" class="item__time">{{ time }}</div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        login: {
            type: String,
        },
        image: {
            type: String,
        },
        time: {
            type: String,
            required: false
        },
        message: {
            type: String,
            required: false
        }
    },
    methods: {
        openChat()
        {
            this.$emit('openChat');
        }
    }
}
</script>
<style scoped>
.user__list-item {
    width: 100%;
    padding: 10px 20px;
    max-height: 70px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 20px;
    border: 1px solid #8e92bc33;
    cursor: pointer;
}
.user__list-item:hover {
    transition: all .2s ease;
    background-color: rgb(220, 222, 234);
}

.item__info {
    display: flex;
    align-items: center;
    gap: 12px;

}

.item__image img{
    height: 48px;
    width: 48px;
    border-radius: 24px;
}

.item__image {
    width: 55px;
    height: 55px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 24px;
    overflow: hidden;
}

.item__image-svg{
    height: 48px;
    width: 48px;
}

.item__info-text {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.item__login {
    font-size: 14px;
    font-family: 'JakartaSansSemiBold';
}

.item__time {
    font-size: 12px;
    color: #8e92bc;
    font-family: 'JakartaSansRegular';
}

.item__message{
    font-family: 'JakartaSansRegular';
    font-size: 12px;
    color: #8E92BC;
}
</style>