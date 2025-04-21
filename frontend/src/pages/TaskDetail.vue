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
          <!-- Информация о задании -->
          <div class="task-info">
            <img v-if="task.image" :src="task.image" alt="Task Image" class="task-image" />
            <svg
              v-else
              width="48"
              height="48"
              viewBox="0 0 24 24"
              fill="none"
              class="default-image"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M21 5H3C2.44772 5 2 5.44772 2 6V18C2 18.5523 2.44772 19 3 19H21C21.5523 19 22 18.5523 22 18V6C22 5.44772 21.5523 5 21 5ZM3 3C1.34315 3 0 4.34315 0 6V18C0 19.6569 1.34315 21 3 21H21C22.6569 21 24 19.6569 24 18V6C24 4.34315 22.6569 3 21 3H3ZM6 7H18C18.5523 7 19 7.44772 19 8V16C19 16.5523 18.5523 17 18 17H6C5.44772 17 5 16.5523 5 16V8C5 7.44772 5.44772 7 6 7Z"
                fill="black"
              />
            </svg>
            <div class="task-details">
              <p class="task-category">{{ task.title1 }}</p>
              <p class="task-messages">{{ task.message }} Сообщений</p>
              <p class="task-grade">Рейтинг: {{ task.rank }} ({{ task.reviews }} Отзывов)</p>
            </div>
          </div>
  
          <!-- Список комментариев -->
          <div class="task-comments-list">
            <h2 class="comments-title">Комментарии к заданию</h2>
            <div v-if="task.comments.length === 0" class="no-comments">
              Нет комментариев
            </div>
            <div
              v-for="comment in task.comments"
              :key="comment.id"
              class="comment-item"
            >
              <h3 class="comment-author">{{ comment.author }}</h3>
              <p class="comment-text">{{ comment.text }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import { useRoute } from 'vue-router';
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
  
      const fetchTask = async () => {
        error.value = '';
        try {
          const token = localStorage.getItem('api_token');
          if (!token) {
            throw new Error('Токен не найден. Пожалуйста, войдите в систему.');
          }
          const taskId = route.params.id;
          console.log('Загрузка данных для taskId:', taskId);
          const response = await axios.get(`http://localhost:80/api/tasks/${taskId}`, {
            headers: {
              Authorization: token,
            },
          });
  
          if (response.data.status === 'success') {
            const taskData = response.data.task;
            task.value = {
              id: taskData.id,
              image: taskData.image || null,
              title: taskData.title,
              title1: taskData.category?.title || 'Без категории',
              message: taskData.messages_count || 0,
              reviews: taskData.reviews_count || 0,
            };
          } else {
            throw new Error('Не удалось загрузить данные задания');
          }
        } catch (e) {
          if (e.response && e.response.status === 401) {
            error.value = 'Неавторизован. Пожалуйста, войдите снова.';
          } else if (e.response && e.response.status === 404) {
            error.value = 'Задание не найдено';
          } else {
            error.value = e.message || 'Произошла непредвиденная ошибка!';
          }
          console.log(e);
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
    align-items: center;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 32px;
  }
  
  .task-image,
  .default-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
    margin-right: 20px;
  }
  
  .default-image {
    width: 48px;
    height: 48px;
  }
  
  .task-details {
    flex-grow: 1;
  }
  
  .task-category {
    font-family: NimbusRegular, sans-serif;
    font-size: 1rem;
    color: #8e92bc;
    margin: 0 0 8px;
  }
  
  .task-messages,
  .task-grade {
    font-family: NimbusRegular, sans-serif;
    font-size: 1rem;
    color: #54577a;
    margin: 0 0 8px;
  }
  
  .task-comments-list {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  }
  
  .comments-title {
    font-family: NimbusRegular, sans-serif;
    font-size: 1.25rem;
    font-weight: bold;
    color: #141522;
    margin: 0 0 16px;
  }
  
  .no-comments {
    font-family: NimbusRegular, sans-serif;
    font-size: 1rem;
    color: #8e92bc;
    text-align: center;
  }
  
  .comment-item {
    padding: 16px 0;
    border-bottom: 1px solid #e0e0e0;
  }
  
  .comment-item:last-child {
    border-bottom: none;
  }
  
  .comment-author {
    font-family: NimbusRegular, sans-serif;
    font-size: 1.125rem;
    font-weight: 500;
    color: #141522;
    margin: 0 0 8px;
  }
  
  .comment-text {
    font-family: NimbusRegular, sans-serif;
    font-size: 0.875rem;
    color: #54577a;
    margin: 0;
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
      grid-template-columns: 25% 75%;
    }
  
    .task-container {
      padding: 20px;
    }
  }
  
  @media (max-width: 768px) {
    .main-class {
      grid-template-columns: 30% 70%;
    }
  
    .task-info {
      flex-direction: column;
      align-items: flex-start;
    }
  
    .task-image,
    .default-image {
      margin-right: 0;
      margin-bottom: 16px;
    }
  }
  
  @media (max-width: 480px) {
    .main-class {
      grid-template-columns: 40% 60%;
    }
  
    .task-container {
      padding: 15px;
    }
  
    .task-image,
    .default-image {
      width: 80px;
      height: 80px;
    }
  
    .task-title {
      font-size: 1.5rem;
    }
  }
  </style>