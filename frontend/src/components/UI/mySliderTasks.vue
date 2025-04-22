<template>
  <div class="grid-container">
    <div class="grid-header">
      <h2 class="grid-title">Задания</h2>
    </div>
    <div v-if="loading" class="loading">Загрузка...</div>
    <div v-else-if="error" class="error">{{ error }}</div>
    <TransitionGroup v-else name="grid-fade" tag="div" class="grid-wrapper">
      <div
        v-for="(slide, index) in filteredSlides"
        :key="index"
        class="grid-item"
        @click="pushDetail(slide.id)"
      >
        <img :src="slide.image" :alt="`Task ${index + 1}`" />
        <div class="grid-content-task">
          <div class="grid-content-task__title">{{ slide.title }}</div>
        </div>
        <div class="grid-content-task-title__small">
          {{ slide.title1 }}
        </div>
        <div class="grid-content-task-top">
          <div class="grid-content-task-top__rev">
            <div class="grid-content-task-top__rev-1">
            </div>
          </div>
        </div>
      </div>
    </TransitionGroup>
  </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { inject } from 'vue';
export default {
  name: 'my-gridTask',
  props: {
    searchQuery: String,
    selected: Number,
  },
  setup(props) {
    const slidesTasks = ref([]);
    const loading = ref(true);
    const error = ref(null);
    const apiDomain = inject('apiDomain');

    // Функция для получения данных с бэкенда
    const fetchTasks = async () => {
      error.value = '';
      try {
        const token = localStorage.getItem('api_token');
        if (!token) {
          throw new Error('Токен не найден. Пожалуйста, войдите в систему.');
        }

        const response = await axios.get(`${apiDomain}/api/tasks`, {
          headers: {
            Authorization: token,
          },
        });

        console.log("tassks", response);
        

        if (response.data.status === 'success') {
          slidesTasks.value = response.data.tasks.map((task) => ({
            id: task.id,
            image: task.image || './assets/task-card/task1.jpg',
            title: task.title,
            title1: task.category?.title || 'Без категории',
            message: task.messages_count || 0,
            rank: task.rating || 0,
            reviews: task.reviews_count || 0,
          }));
        } else {
          throw new Error('Не удалось загрузить данные заданий');
        }
      } catch (e) {
        if (e.response && e.response.status === 401) {
          error.value = 'Неавторизован. Пожалуйста, войдите снова.';
        } else if (e.response && e.response.status === 422) {
          error.value = 'Ошибка валидации данных';
        } else {
          error.value = e.message || 'Произошла непредвиденная ошибка!';
        }
        console.log(e);
      } finally {
        loading.value = false;
      }
    };

    onMounted(() => {
      fetchTasks();
    });

    const filteredSlides = computed(() => {
      let filtered = slidesTasks.value;
      if (props.searchQuery) {
        const query = props.searchQuery.toLowerCase();
        filtered = filtered.filter(
          (slide) =>
            slide.title.toLowerCase().includes(query) ||
            slide.title1.toLowerCase().includes(query)
        );
      }

      if (props.selected === 1) {
        filtered = [...filtered].sort((a, b) => b.rank - a.rank);
      } else if (props.selected === 2) {
        filtered = filtered.filter((slide) => slide.title1 === 'Backend-разработка');
      } else if (props.selected === 3) {
        filtered = filtered.filter((slide) => slide.title1 === 'Frontend-разработка');
      } else if (props.selected === 4) {
        filtered = filtered.filter((slide) => slide.title1 === 'DevOps');
      }

      return filtered;
    });

    return {
      slidesTasks,
      filteredSlides,
      loading,
      error,
    };
  },
  methods: {
    // pushComments(taskId) {
    //   console.log('Переход к комментариям задания с ID:', taskId);
    //   this.$router.push(`/task/${taskId}/comments`); // Предполагаемый маршрут
    // },
    pushDetail(taskId) {
      console.log('Переход к детальной странице задания с ID:', taskId);
      this.$router.push(`/tasks/${taskId}`);
    },
  },
};
</script>

<style lang="scss" scoped>
.grid-container {
  width: 100%;
  max-width: 1200px;
  margin: 32px 0 0 0;
  padding-right: 16px;
}

.grid-header {
  margin-bottom: 20px;
}

.grid-title {
  font-family: NimbusRegular;
  font-size: 1.5rem;
  font-weight: bold;
  margin: 0;
  color: #141522;
}

.grid-wrapper {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 20px;
}

.grid-item {
  display: flex;
  flex-direction: column;
  background-color: #fff;
  border-radius: 10px;
  cursor: pointer;
  font-family: NimbusRegular;
  font-size: 18px;
  max-height: 245px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); /* Тень по умолчанию */
  transition: transform 0.3s ease, box-shadow 0.3s ease; /* Анимация */

  &:hover {
    transform: translateY(-5px); /* Поднятие карточки */
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1); /* Усиленная тень */
  }
}

.grid-item img {
  border-radius: 10px 10px 0 0;
  width: 100%;
  height: 150px;
  object-fit: cover;
}

.grid-content-task {
  padding-top: 20px;
  padding-left: 15px;
}

.grid-content-task__title {
  font-size: 18px;
  padding-bottom: 5px;
  color: #141522;
}

.grid-content-task-title__small {
  font-size: 12px;
  color: #8e92bc;
  padding-left: 15px;
}

.grid-content-task-top {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  margin: 20px 0;
  padding: 0 20px;
}

.grid-content-task-top__tasks {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 14px;
  color: #54577a;
}

.grid-content-task-top__rev {
  display: flex;
  align-items: center;
  gap: 5px;
}

.grid-content-task-top__rev-2 {
  font-size: 14px;
  color: #54577a;
}

.loading,
.error {
  text-align: center;
  font-family: NimbusRegular;
  font-size: 1rem;
  padding: 20px;
}

.error {
  color: #ff4d4f;
}

.grid-fade-enter-active,
.grid-fade-leave-active {
  transition: all 0.5s ease;
}
.grid-fade-enter-from,
.grid-fade-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
</style>