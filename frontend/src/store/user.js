import { defineStore } from 'pinia';
import axios from 'axios';

export const useUserStore = defineStore('user', {
  state: () => ({
    avatarUrl: null,
  }),
  actions: {
    async fetchAvatar() {
      try {
        const response = await axios.get('http://localhost:80/api/accounts/me/image', {
          headers: {
            Authorization: localStorage.getItem('api_token'),
          },
        });
        console.log("Аватарка пользователя:", response);
        
        if (response.data.image) {
          this.avatarUrl = response.data.image;
        }
      } catch (error) {
        console.error('Ошибка при загрузке аватара:', error);
      }
    },
    setAvatar(url) {
      this.avatarUrl = url;
    },
  },
});