<template>
  <div
    ref="dropZone"
    class="drop-zone"
    @dragover.prevent="onDragOver"
    @dragleave="onDragLeave"
    @drop.prevent="onDrop"
  >
    <p v-if="!image">Перетащите фото сюда<br>(.jpg, .png и т.д.)</p>
    <img v-if="image" :src="image" alt="Фото профиля" class="profile-photo" />
  </div>
</template>

<script>
import axios from 'axios';
import { useUserStore } from '@/store/user';
import { inject } from 'vue';
export default {
  name: 'my-dragdrop',
  data() {
    return {
      image: null,
      apiDomain: '',
    };
  },
  created() {
    this.apiDomain = inject('apiDomain');
  },
  setup() {
    const userStore = useUserStore();
    return { userStore};
  },
  methods: {
    onDragOver() {
      this.$refs.dropZone?.classList.add('drag-over');
    },
    onDragLeave() {
      this.$refs.dropZone?.classList.remove('drag-over');
    },
    async onDrop(event) {
      this.$refs.dropZone?.classList.remove('drag-over');
      const files = event.dataTransfer.files;
      if (files.length === 0) return;

      const file = files[0];
      if (!file.type.startsWith('image/')) {
        this.$emit('show-error', {
          message: 'Файл должен быть изображением',
          type: 'error',
        });
        return;
      }

      if (file.size > 2 * 1024 * 1024) {
        this.$emit('show-error', {
          message: 'Файл слишком большой (максимум 2MB)',
          type: 'error',
        });
        return;
      }

      const reader = new FileReader();
      reader.onload = () => {
        this.image = reader.result;
      };
      reader.readAsDataURL(file);

      const formData = new FormData();
      formData.append('photo', file);

      try {
        const response = await axios.post(
          `${this.apiDomain}/api/accounts/me`,
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
              Authorization: localStorage.getItem('api_token'),
            },
          }
        );

        console.log('Полный ответ сервера:', response);

        if (response.data.status === 'success' && response.data.image) {
          this.image = response.data.image;
          this.userStore.setAvatar(response.data.image);
          this.$emit('show-error', {
            message: 'Изображение успешно загружено',
            type: 'success',
          });
          console.log('Изображение обновлено с URL:', this.image);
        } else {
          console.warn(
            'Сервер не вернул URL изображения, используется локальное изображение'
          );
        }
      } catch (error) {
        console.error('Ошибка при загрузке файла:', error);
        if (error.response) {
          console.error('Детали ошибки сервера:', error.response.data);
          if (error.response.data.errors) {
            this.$emit('show-error', {
              message: Object.values(error.response.data.errors).flat().join(' '),
              type: 'error',
            });
          }
        }
        this.image = null;
      }
    },
  },
};
</script>

<style scoped>
.drop-zone {
  margin: 32px 0 0 32px;
  width: 200px;
  height: 250px;
  border: 1px dashed #546FFF;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  color: #aaa;
  background-color: #f9f9f9;
  transition: background-color 0.3s;
}

.drop-zone:hover,
.drop-zone.drag-over {
  opacity: 30%;
  border-color: #333;
  transition: 0.3s;
}

.profile-photo {
  max-width: 100%;
  max-height: 100%;
}

.drop-zone img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 10px;
}
</style>