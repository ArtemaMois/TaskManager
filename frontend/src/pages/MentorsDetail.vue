```vue
<template>
  <div class="main-class">
    <nav-bar v-if="$route.path !== '/'"></nav-bar>
    <div class="mentor-container">
      <my-main-foot class="mentor-detail-header">
        <template v-slot:name>
          <h1 class="mentor-title">Наставник</h1>
        </template>
      </my-main-foot>

      <div v-if="loading" class="loading">Загрузка...</div>
      <div v-else-if="error" class="error">{{ error }}</div>
      <div v-else-if="!mentor" class="error">Данные наставника не загружены</div>
      <div v-else class="mentor-detail">
        <!-- Информация о наставнике -->
        <div class="mentor-info">
          <div class="mentor-info_box">
            <img
              :src="mentor.image || '../assets/default-images/user-img/user.png'"
              alt="Mentor Avatar"
              class="mentor-avatar"
            />
            <div class="mentor-details">
              <div class="mentor-details_1">
                <h1 class="mentor-title">{{ mentor.title || 'Наставник' }}</h1>
                <p class="mentor-category">{{ mentor.title1 }}</p>
              </div>
              <div class="mentor-details_2">
                <p class="mentor-tasks">Задач: {{ mentor.tasks }}</p>
                <p class="mentor-grade">Рейтинг: {{ mentor.rank }}</p>
              </div>
            </div>
          </div>

          <div class="mentor-description">
            <div class="mentor-description_title">О наставнике</div>
            <div class="mentor-description_body">
              {{ mentor.description || 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam enim impedit ullam corrupti, atque consequuntur velit? Dolorum excepturi rerum minima optio illum ipsum obcaecati ab explicabo repellat! Voluptatum, distinctio reiciendis.' }}
            </div>
          </div>

          <div class="mentor-tasks-list">
            <h2 class="tasks-title">Задания наставника</h2>
            <div v-if="!mentor.mentor_tasks || mentor.mentor_tasks.length === 0" class="no-tasks">
              Нет заданий
            </div>
            <div
              v-else
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
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import { inject } from 'vue';
export default {
  setup() {
    const mentor = ref(null);
    const loading = ref(true);
    const error = ref(null);
    const route = useRoute();
    const apiDomain = inject('apiDomain');

    const fetchMentor = async () => {
      error.value = '';
      try {
        const token = localStorage.getItem('api_token');
        if (!token) {
          throw new Error('Токен не найден. Пожалуйста, войдите в систему.');
        }

        const mentorId = route.params.id;
        console.log('Загрузка данных для mentorId:', mentorId);
        const response = await axios.get(`${apiDomain}/api/mentors/${mentorId}`, {
          headers: {
            Authorization: token,
          },
        });

        if (response.data.status === 'success' && response.data.data) {
          const mentorData = response.data.data;
          mentor.value = {
            id: mentorData.id,
            image: mentorData.image,
            title: mentorData.login || 'Наставник',
            title1: mentorData.categories?.[0]?.title || 'Без категории',
            tasks: mentorData.tasks || 0,
            rank: mentorData.grade || 0,
            mentor_tasks: mentorData.mentor_tasks || [],
            description: mentorData.description || null,
          };
        } else {
          throw new Error('Не удалось загрузить данные наставника');
        }
      } catch (e) {
        console.error('Ошибка при загрузке данных:', e);
        if (e.response) {
          console.error('Детали ответа сервера:', e.response.data);
          if (e.response.status === 401) {
            error.value = 'Неавторизован. Пожалуйста, войдите снова.';
          } else if (e.response.status === 404) {
            error.value = 'Наставник не найден';
          } else {
            error.value = e.response.data.message || 'Произошла ошибка сервера';
          }
        } else {
          error.value = e.message || 'Произошла непредвиденная ошибка!';
        }
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
  grid-template-columns: 17.5% 82.5%;
  min-height: 100vh;
}

.mentor-detail-header {
  background: #fff;
  padding-left: 32px;
  padding-top: 32px;
  padding-bottom: 32px;
}

.mentor-container {
  background: #fafafa;
}

.mentor-title {
  font-family: NimbusRegular, sans-serif;
  font-weight: bold;
  background: #fff;
  color: #141522;
  font-size: clamp(1.5rem, 4vw, 2.5rem);
  line-height: 1.2;
  margin: 0;
}

.mentor-detail {
  padding: 32px 32px 24px 32px;
}

.mentor-info {
  display: flex;
  flex-direction: column;
  background: #fff;
  padding: 20px;
  margin-bottom: 32px;
}

.mentor-info_box {
  display: flex;
  flex-direction: row;
}

.mentor-avatar,
.default-avatar {
  width: 170px;
  height: 170px;
  object-fit: cover;
  border-radius: 50%;
  margin-right: 20px;
}

.default-avatar {
  width: 48px;
  height: 48px;
}

.mentor-details {
  display: flex;
  justify-content: space-between;
  flex-grow: 1;
  padding: 29px;
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

.mentor-description_title {
  font-family: NimbusRegular, sans-serif;
  font-weight: bold;
  background: #fff;
  color: #141522;
  font-size: clamp(1rem, 3vw, 1.5rem);
  line-height: 1.2;
  margin-top: 50px;
  padding-left: 20px;
}

.mentor-description_body {
  font-family: NimbusRegular, sans-serif;
  font-size: clamp(0.875rem, 2vw, 1rem);
  margin-top: 20px;
  padding-left: 20px;
}

.mentor-tasks-list {
  margin-top: 30px;
  padding: 20px;
  border-radius: 10px;
}

.tasks-title {
  font-family: NimbusRegular, sans-serif;
  font-size: 1.3rem;
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
  font-size: clamp(1rem, 2vw, 1.5rem);
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
    grid-template-columns: 10% 90%;
  }
}

@media (max-width: 768px) {
  .main-class {
    grid-template-columns: 10% 90%;
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

  .mentor-details {
    display: block;
    padding: 16px;
  }

  .mentor-detail {
    padding: 16px;
  }
}

@media (max-width: 480px) {
  .main-class {
    grid-template-columns: 12% 88%;
  }

  .mentor-detail-header {
    padding: 10px 10px 0 24px;
  }

  .mentor-avatar,
  .default-avatar {
    width: 80px;
    height: 80px;
  }

  .mentor-title {
    font-size: clamp(1rem, 3vw, 1.5rem);
  }

  .mentor-details {
    padding: 10px;
  }

  .mentor-description_title {
    font-size: clamp(0.875rem, 2vw, 1.25rem);
  }

  .mentor-description_body {
    font-size: clamp(0.75rem, 2vw, 0.875rem);
  }

  .tasks-title {
    font-size: 1.1rem;
  }

  .task-title {
    font-size: clamp(0.875rem, 2vw, 1.25rem);
  }
}
</style>
```