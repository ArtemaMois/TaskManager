<template>
  <div class="main-class">
    <nav-bar v-if="$route.path !== '/'"></nav-bar>
    <div class="task-container">
      <my-main-foot>
        <template v-slot:name>
          <h1 class="task-title">{{ task?.title || 'Задание' }}</h1>
        </template>
      </my-main-foot>

      <div v-if="loading" class="loading">Загрузка...</div>
      <div v-else-if="error" class="error">{{ error }}</div>
      <div v-else class="task-detail">
        <div class="task-info">
          <div class="task-details">
            <p class="task-category">{{ task.title1 }}</p>
          </div>
          <div v-if="task.iframe" class="video-container">
            <div class="video-wrapper" v-html="task.iframe"></div>
          </div>
          <div v-else class="no-video">Видео отсутствует</div>
          <p v-if="task.created_at" class="task-date">Создано: {{ task.created_at }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';
import NavBar from '@/components/UI/navBar.vue';
import MyMainFoot from '@/components/UI/myFootMain.vue';

export default {
  name: 'TaskDetail',
  components: {
    NavBar,
    MyMainFoot,
  },
  setup() {
    const task = ref(null);
    const loading = ref(true);
    const error = ref(null);
    const route = useRoute();
    const router = useRouter();

    const formatDate = (dateString) => {
      const date = new Date(dateString);
      const day = String(date.getDate()).padStart(2, '0');
      const month = String(date.getMonth() + 1).padStart(2, '0'); // Месяцы начинаются с 0
      const year = date.getFullYear();
      const hours = String(date.getHours()).padStart(2, '0');
      const minutes = String(date.getMinutes()).padStart(2, '0');
      return `${day}.${month}.${year} ${hours}:${minutes}`;
    };

    const fetchTask = async () => {
      error.value = '';
      try {
        const token = localStorage.getItem('api_token');
        if (!token) {
          console.log('Токен отсутствует, перенаправляем на логин');
          router.push('/login');
          return;
        }
        const taskId = route.params.id;
        console.log('Загрузка данных для taskId:', taskId);

        const response = await axios.get(`http://localhost:80/api/tasks/${taskId}`, {
          headers: {
            Authorization: token, // Проверьте, нужен ли Bearer
          },
        });

        console.log('Полный ответ сервера:', response.data);

        if (response.data.status === 'success') {
          const taskData = response.data.task;
          const iframe = taskData.iframe
            ? taskData.iframe
                .replace(/width="\d+"/, 'width="100%"')
                .replace(/height="\d+"/, 'height="100%"')
            : null;
          console.log('Обработанный iframe:', iframe); // Для отладки
          task.value = {
            id: taskData.id,
            image: taskData.image || null,
            title: taskData.title,
            title1: taskData.category?.title || 'Без категории',
            created_at: taskData.created_at ? formatDate(taskData.created_at) : null,
            iframe,
          };
        } else {
          throw new Error('Не удалось загрузить данные задания');
        }
      } catch (e) {
        console.error('Ошибка при загрузке задания:', e);
        if (e.response) {
          if (e.response.status === 401) {
            error.value = 'Неавторизован. Пожалуйста, войдите снова.';
            router.push('/login');
          } else if (e.response.status === 404) {
            error.value = 'Задание не найдено';
          } else {
            error.value = `Ошибка сервера: ${e.response.status}`;
          }
        } else {
          error.value = e.message || 'Произошла непредвиденная ошибка!';
        }
      } finally {
        loading.value = false;
      }
    };

    onMounted(() => {
      fetchTask();
    });

    return {
      task,
      loading,
      error,
    };
  },
};
</script>

<style lang="scss" scoped>
.main-class {
  display: grid;
  grid-template-columns: 17.5% 82.5%; /* Навбар слева, контент справа */
  min-height: 100vh;
}

.task-container {
  padding: 32px;
  background: #fafafa;
}

.task-title {
  font-family: NimbusRegular, sans-serif;
  font-weight: bold;
  color: #141522;
  font-size: clamp(1.5rem, 4vw, 2.5rem);
  line-height: 1.2;
  margin: 0;
}

.task-detail {
  margin-top: 24px;
}

.task-info {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  background: #fff;
  padding: 20px;
  margin-bottom: 32px;
}

.task-details {
  flex-grow: 1;
  margin-bottom: 16px; /* Отступ перед видео */
}

.task-category {
  font-family: NimbusRegular, sans-serif;
  font-size: 1rem;
  color: #8e92bc;
  margin: 0 0 8px;
}

.task-messages {
  font-family: NimbusRegular, sans-serif;
  font-size: 1rem;
  color: #54577a;
  margin: 0 0 8px;
}

/* Стили для видео */
.video-container {
  position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%;
    background-color: var(--vkui--color_background_secondary);
    background-repeat: no-repeat;
    background-position: center;
    border-radius: 8px;
    overflow: hidden;
    z-index: 1;
}
.video-wrapper {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.video-container iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100% !important;
  height: 100% !important;
  border: 0;
}


.no-video {
  font-family: NimbusRegular, sans-serif;
  font-size: 1rem;
  color: #8e92bc;
  text-align: center;
  padding: 20px;
  background: #fff;
  border-radius: 10px;
  margin-bottom: 32px;
}

.task-date {
  font-family: NimbusRegular, sans-serif;
  font-size: 0.875rem;
  color: #54577a;
  text-align: center;
  padding: 8px 0;
}

.loading,
.error {
  text-align: center;
  font-family: NimbusRegular, sans-serif;
  font-size: 1rem;
  padding: 20px;
}

.error {
  color: #ff4d4f;
}

/* Медиа-запросы */
@media (max-width: 1024px) {
  .main-class {
    grid-template-columns: 5% 1fr;
  }

  .task-container {
    padding: 20px;
  }

  .video-container {
    max-width: 100%; /* Полная ширина на планшетах */
    border-radius: 8px;
  }
}

@media (max-width: 768px) {
  .main-class {
    grid-template-columns: 5% 1fr;
  }

  .task-info {
    flex-direction: column;
    align-items: flex-start;
  }

  .video-container {
    margin: 0 0 24px 0; /* Уменьшаем отступы */
  }
}

@media (max-width: 480px) {
  .main-class {
    grid-template-columns: 5% 1fr;
  }

  .task-container {
    padding: 15px;
  }

  .task-title {
    font-size: 1.5rem;
  }

  .video-container {
    border-radius: 6px; /* Еще меньше скругление углов */
    margin: 0 0 16px 0;
  }
}
</style>