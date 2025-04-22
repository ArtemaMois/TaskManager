```vue
<template>
  <div class="slider-container">
    <div class="slider-header">
      <h2 class="slider-title">Задачи</h2>
      <div class="slider-controls">
        <button ref="prev" class="swiper-button-prev slider-button">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 19.92L8.48 13.4C7.71 12.63 7.71 11.37 8.48 10.6L15 4.08002" stroke="#54577A" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <button ref="next" class="swiper-button-next slider-button">
          <svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.910004 16.92L7.43 10.4C8.2 9.63002 8.2 8.37002 7.43 7.60002L0.910004 1.08002" stroke="#141522" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>
    </div>

    <div v-if="loading" class="loading">Загрузка...</div>
    <div v-else-if="error" class="error">{{ error }}</div>
    <Swiper
      v-else
      :slides-per-view="slidesPerView"
      :space-between="20"
      :navigation="{
        prevEl: prev,
        nextEl: next,
      }"
      :loop="true"
      :modules="modules"
      :breakpoints="breakpoints"
      class="slider"
    >
      <SwiperSlide v-for="(slide, index) in filteredSlides" :key="index">
        <div class="slide-content" @click="taskDetail(slide.id)">
          <img :src="slide.image" :alt="`Task ${index + 1}`" />
          <div class="slide-title" style="margin-left: 15px;">
            {{ slide.title }}
          </div>
          <div class="slide-title__small" style="font-size: 12px; color: gray; margin-left: 15px;">
            {{ slide.title1 }}
          </div>
        </div>
      </SwiperSlide>
    </Swiper>
  </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import 'swiper/css';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation } from 'swiper/modules';
import axios from 'axios';

export default {
  name: 'my-sslider',
  components: {
    Swiper,
    SwiperSlide,
  },
  props: {
    searchQuery: String,
    selected: Number,
  },
  setup(props) {
    const prev = ref(null);
    const next = ref(null);
    const slidesTasks = ref([]);
    const loading = ref(true);
    const error = ref(null);

    // Функция для получения данных с бэкенда
    const fetchTasks = async () => {
      error.value = '';
      try {
        const token = localStorage.getItem('api_token');
        if (!token) {
          throw new Error('Токен не найден. Пожалуйста, войдите в систему.');
        }

        const response = await axios.get('http://localhost:80/api/tasks', {
          headers: {
            Authorization: token,
          },
        });

        if (response.data.status === 'success') {
          slidesTasks.value = response.data.tasks.map((task) => ({
            id: task.id,
            image: task.image || './assets/task-card/default.jpg',
            title: task.title,
            title1: task.category?.title || 'Без категории',
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

    // Фильтрация данных
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
        filtered = filtered.filter((slide) => slide.title1 === 'UI UX Design');
      } else if (props.selected === 3) {
        filtered = filtered.filter((slide) => slide.title1 === 'Web Developer');
      } else if (props.selected === 4) {
        filtered = filtered.filter((slide) => slide.title1 === '3D Design');
      }

      return filtered;
    });

    // Адаптивные настройки для Swiper
    const slidesPerView = ref(2);
    const breakpoints = {
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
    };

    return {
      slidesTasks,
      filteredSlides,
      modules: [Navigation],
      prev,
      next,
      loading,
      error,
      slidesPerView,
      breakpoints,
    };
  },
  methods: {
    taskDetail(taskId) {
      console.log('Переход к детальной странице задания с ID:', taskId);
      this.$router.push(`/tasks/${taskId}`);
    },
  },
};
</script>

<style lang="scss" scoped>
.slider-container {
  max-width: 688px;
  position: relative;
  margin: 32px 0 0 0;
}

.slider-header {
  display: flex;
  justify-content: space-between;
  padding-right: 32px;
  margin-bottom: 20px;
}

.slider-title {
  font-family: NimbusRegular;
  font-size: 1.5rem;
  font-weight: bold;
  margin: 0;
  color: #141522;
}

.slider-controls {
  display: flex;
  gap: 20px;
}

.slider-button {
  background: none;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.swiper-button-prev {
  left: -10px;
}

.swiper-button-next {
  right: -10px;
}

.slider {
  width: 100%;
  padding-right: 24px;
}

.slide-content {
  display: flex;
  flex-direction: column;
  align-items: start;
  gap: 10px;
  background-color: #fff;
  border-radius: 20px;
  max-height: 230px;
  padding-bottom: 20px;
  max-width: 350px;
  font-family: NimbusRegular;
  font-size: 18px;
  cursor: pointer;

  &:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
  }
}

.slide-content img {
  border-radius: 20px 20px 0 0;
  width: 100%;
  height: 150px;
  object-fit: cover;
}

.slide-title {
  font-family: NimbusRegular;
  font-size: 18px;
  color: #141522;
}

.slide-title__small {
  font-family: NimbusRegular;
  font-size: 12px;
  color: #8e92bc;
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

@media (max-width: 768px) {
  .slider-container {
    max-width: 100%;
    padding: 0 15px;
  }

  .slider-header {
    padding-right: 15px;
  }


  .slide-title {
    font-size: 16px;
  }

  .slide-title__small {
    font-size: 11px;
  }
}

@media (max-width: 480px) {
  .slider-title {
    font-size: 1.25rem;
  }

  .slide-content {
    max-height: 200px;
  }

  .slide-content img {
    height: 120px;
  }
}
</style>
```