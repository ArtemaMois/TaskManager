<template>
  <div class="main-foot-settings">
    <div class="welcome-message-settings">
      <div class="welcome-message-settings__main">Настройки</div>
    </div>
    <div class="user_image-block-settings">
      <div class="notif-settings">
        <svg
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M3.50083 13.7871V13.5681C3.53295 12.9202 3.7406 12.2925 4.10236 11.7496C4.7045 11.0975 5.1167 10.2983 5.29571 9.43598C5.29571 8.7695 5.29571 8.0935 5.35393 7.42703C5.65469 4.21842 8.82728 2 11.9611 2H12.0387C15.1725 2 18.345 4.21842 18.6555 7.42703C18.7137 8.0935 18.6555 8.7695 18.704 9.43598C18.8854 10.3003 19.2972 11.1019 19.8974 11.7591C20.2618 12.2972 20.4698 12.9227 20.4989 13.5681V13.7776C20.5206 14.648 20.2208 15.4968 19.6548 16.1674C18.907 16.9515 17.8921 17.4393 16.8024 17.5384C13.607 17.8812 10.383 17.8812 7.18762 17.5384C6.09914 17.435 5.08576 16.9479 4.33521 16.1674C3.778 15.4963 3.48224 14.6526 3.50083 13.7871Z"
            stroke="#8E92BC"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M9.55493 20.8518C10.0542 21.4784 10.7874 21.884 11.5922 21.9787C12.3971 22.0734 13.2072 21.8495 13.8433 21.3564C14.0389 21.2106 14.2149 21.041 14.3672 20.8518"
            stroke="#8E92BC"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </div>
      <div class="profile-settings">
        <img
          :src="avatarUrl || '/assets/foot-images/lam.jpg'"
          alt="Аватар пользователя"
          class="profile-image"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { useUserStore } from '@/store/user';

export default {
  name: 'my-foot-settings',
  setup() {
    const userStore = useUserStore();
    userStore.fetchAvatar(); // Загружаем аватар при монтировании
    return { userStore };
  },
  computed: {
    avatarUrl() {
      return this.userStore.avatarUrl;
    },
  },
};
</script>

<style lang="scss" scoped>
.main-foot-settings {
  display: flex;
  justify-content: space-between;
  padding-right: 32px;
  height: 116px;
  background-color: #ffffff;
  align-items: center;
}

.welcome-message-settings {
  max-height: 36px;
  margin: 0 0 0 32px;
}

.welcome-message-settings__main {
  font-family: NimbusRegular, sans-serif;
  font-weight: bold;
  color: #141522;
  font-size: clamp(1.2rem, 2vw, 2rem);
}

.user_image-block-settings {
  display: flex;
  flex-direction: row;
  gap: 24px;
  width: 128px;
  height: 52px;
}

.notif-settings {
  width: 52px;
  border: 1px solid #F5F5F7;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.profile-settings img {
  border-radius: 50%;
  width: 52px;
  height: 52px;
  object-fit: cover;
}
</style>