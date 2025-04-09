<template>
    <div class="main-class">
      <nav-bar v-if="$route.path !== '/'"></nav-bar>
      <div class="mentor-container">
        <my-main-foot>
          <template v-slot:name>
            <h1 class="mentor-title">{{ mentor?.title || 'Наставник' }}</h1>
          </template>
        </my-main-foot>
  
        <div v-if="loading" class="loading">Загрузка...</div>
        <div v-else-if="error" class="error">{{ error }}</div>
        <div v-else class="mentor-detail">
          <!-- Информация о наставнике -->
          <div class="mentor-info">
            <img v-if="mentor.image" :src="mentor.image" alt="Mentor Avatar" class="mentor-avatar" />
            <svg
              v-else
              width="48"
              height="48"
              viewBox="0 0 24 24"
              fill="none"
              class="default-avatar"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12ZM15 9C15 9.79565 14.6839 10.5587 14.1213 11.1213C13.5587 11.6839 12.7956 12 12 12C11.2044 12 10.4413 11.6839 9.87868 11.1213C9.31607 10.5587 9 9.79565 9 9C9 8.20435 9.31607 7.44129 9.87868 6.87868C10.4413 6.31607 11.2044 6 12 6C12.7956 6 13.5587 6.31607 14.1213 6.87868C14.6839 7.44129 15 8.20435 15 9ZM12 20.5C13.7163 20.5028 15.3928 19.9834 16.807 19.011C17.411 18.596 17.669 17.806 17.317 17.163C16.59 15.83 15.09 15 12 15C8.91 15 7.41 15.83 6.682 17.163C6.331 17.806 6.589 18.596 7.193 19.011C8.6072 19.9834 10.2837 20.5028 12 20.5Z"
                fill="black"
              />
            </svg>
            <div class="mentor-details">
              <p class="mentor-category">{{ mentor.title1 }}</p>
              <p class="mentor-tasks">{{ mentor.tasks }} Задач</p>
              <p class="mentor-grade">Рейтинг: {{ mentor.rank }}</p>
            </div>
          </div>
  
          <!-- Список заданий -->
          <div class="mentor-tasks-list">
            <h2 class="tasks-title">Задания наставника</h2>
            <div v-if="mentor.mentor_tasks.length === 0" class="no-tasks">
              Нет заданий
            </div>
            <div
              v-for="task in mentor.mentor_tasks"
              :key="task.id"
              class="task-item"
            >
              <h3 class="task-title">{{ task.title }}</h3>
              <p class="task-description">{{ task.description }}</p>
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
  
  export default {
    setup() {
      const mentor = ref(null);
      const loading = ref(true);
      const error = ref(null);
      const route = useRoute();
      const fetchMentor = async () => {
        error.value = '';
        try {
          const token = localStorage.getItem('api_token');
          if (!token) {
            throw new Error('Токен не найден. Пожалуйста, войдите в систему.');
          }
          const mentorId = route.params.id;
          console.log('Загрузка данных для mentorId:', mentorId);
          const response = await axios.get(`http://localhost:80/api/mentors/${mentorId}`, {
            headers: {
              Authorization: token,
            },
          });
  
          if (response.data.status === 'success') {
            const mentorData = response.data.mentor;
            mentor.value = {
              id: mentorData.id,
              image: mentorData.image,
              title: mentorData.login,
              title1: mentorData.categories[0]?.title || 'Без категории',
              tasks: mentorData.tasks,
              rank: mentorData.grade,
              mentor_tasks: mentorData.mentor_tasks || [], // Задания наставника
            };
          } else {
            throw new Error('Не удалось загрузить данные наставника');
          }
        } catch (e) {
          if (e.response && e.response.status === 401) {
            error.value = 'Неавторизован. Пожалуйста, войдите снова.';
          } else if (e.response && e.response.status === 404) {
            error.value = 'Наставник не найден';
          } else {
            error.value = e.message || 'Произошла непредвиденная ошибка!';
          }
          console.log(e);
        } finally {
          loading.value = false;
        }
      };
  
      onMounted(() => {
        fetchMentor();
      });
  
      return {
        mentor,
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
  
  .mentor-container {
    padding: 32px;
    background: #fafafa;
  }
  
  .mentor-title {
    font-family: NimbusRegular, sans-serif;
    font-weight: bold;
    color: #141522;
    font-size: clamp(1.5rem, 4vw, 2.5rem);
    line-height: 1.2;
    margin: 0;
  }
  
  .mentor-detail {
    margin-top: 24px;
  }
  
  .mentor-info {
    display: flex;
    align-items: center;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 32px;
  }
  
  .mentor-avatar,
  .default-avatar {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: 20px;
  }
  
  .default-avatar {
    width: 48px;
    height: 48px;
  }
  
  .mentor-details {
    flex-grow: 1;
  }
  
  .mentor-category {
    font-family: NimbusRegular, sans-serif;
    font-size: 1rem;
    color: #8e92bc;
    margin: 0 0 8px;
  }
  
  .mentor-tasks,
  .mentor-grade {
    font-family: NimbusRegular, sans-serif;
    font-size: 1rem;
    color: #54577a;
    margin: 0 0 8px;
  }
  
  .mentor-tasks-list {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  }
  
  .tasks-title {
    font-family: NimbusRegular, sans-serif;
    font-size: 1.25rem;
    font-weight: bold;
    color: #141522;
    margin: 0 0 16px;
  }
  
  .no-tasks {
    font-family: NimbusRegular, sans-serif;
    font-size: 1rem;
    color: #8e92bc;
    text-align: center;
  }
  
  .task-item {
    padding: 16px 0;
    border-bottom: 1px solid #e0e0e0;
  }
  
  .task-item:last-child {
    border-bottom: none;
  }
  
  .task-title {
    font-family: NimbusRegular, sans-serif;
    font-size: 1.125rem;
    font-weight: 500;
    color: #141522;
    margin: 0 0 8px;
  }
  
  .task-description {
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
  
    .mentor-container {
      padding: 20px;
    }
  }
  
  @media (max-width: 768px) {
    .main-class {
      grid-template-columns: 30% 70%;
    }
  
    .mentor-info {
      flex-direction: column;
      align-items: flex-start;
    }
  
    .mentor-avatar,
    .default-avatar {
      margin-right: 0;
      margin-bottom: 16px;
    }
  }
  
  @media (max-width: 480px) {
    .main-class {
      grid-template-columns: 40% 60%;
    }
  
    .mentor-container {
      padding: 15px;
    }
  
    .mentor-avatar,
    .default-avatar {
      width: 80px;
      height: 80px;
    }
  
    .mentor-title {
      font-size: 1.5rem;
    }
  }
  </style>