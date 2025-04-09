<template>
    <div>
        <div class="navbar">
            <div class="navbar__image">
                <img v-if="image" :src="image" alt="Avatar" />
                <div v-else>
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12ZM15 9C15 9.79565 14.6839 10.5587 14.1213 11.1213C13.5587 11.6839 12.7956 12 12 12C11.2044 12 10.4413 11.6839 9.87868 11.1213C9.31607 10.5587 9 9.79565 9 9C9 8.20435 9.31607 7.44129 9.87868 6.87868C10.4413 6.31607 11.2044 6 12 6C12.7956 6 13.5587 6.31607 14.1213 6.87868C14.6839 7.44129 15 8.20435 15 9ZM12 20.5C13.7163 20.5028 15.3928 19.9834 16.807 19.011C17.411 18.596 17.669 17.806 17.317 17.163C16.59 15.83 15.09 15 12 15C8.91 15 7.41 15.83 6.682 17.163C6.331 17.806 6.589 18.596 7.193 19.011C8.6072 19.9834 10.2837 20.5028 12 20.5Z"
                            fill="black"
                        />
                    </svg>
                </div>
            </div>
            <div class="navbar__info">
                <div class="navbar__login">{{ login }}</div>
                <div class="navbar__status">
                    <div v-if="online" class="navbar__online status">
                        <div class="navbar__circle green"></div>
                        <div class="navbar__status-text">Online</div>
                    </div>
                    <div v-else class="navbar__offline status">
                        <div class="navbar__circle red"></div>
                        <div class="navbar__status-text">Offline</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        image: {
            type: String,
            require: true,
        },
        login: {
            type: String,
        },
        online: {
            type: Boolean,
            require: true,
        },
    },
    watch:{
        online(oldValue, newValue)
        {
        }
    }
}
</script>
<style scoped>
.navbar {
    width: 100%;
    height: 80px;
    padding: 20px 40px;
    display: flex;
    gap: 20px;
    align-items: center;
    -webkit-box-shadow: 0px 19px 27px -9px rgba(105, 141, 168, 0.2);
    -moz-box-shadow: 0px 19px 27px -9px rgba(105, 141, 168, 0.2);
    box-shadow: 0px 19px 27px -9px rgba(105, 141, 168, 0.2);
}

.navbar__image img {
    width: 52px;
    height: 52px;
    border-radius: 26px;
    overflow: hidden;
}

.navbar__info {
    display: flex;
    flex-direction: column;
    gap: 10px;
    color: #141522;
}

.navbar__login {
    font-family: 'Ubuntu Medium';
    font-size: 16px;
}

.navbar__status {
    font-family: 'Ubuntu Medium';
    font-size: 14px;
    color: #b9b9bafd;
}

.status {
    display: flex;
    align-items: center;
    gap: 5px;
}

.navbar__circle {
    width: 10px;
    height: 10px;
    border-radius: 5px;
}

.green {
    background-color: #25c78b;
}

.red {
    background-color: #db5962;
}
</style>