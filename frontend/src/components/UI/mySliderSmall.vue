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
          <img :src="slide.image" :alt="`Task ${index + 1}`" loading="lazy" />
          <div class="slide-title">
            {{ slide.title }}
          </div>
          <div class="slide-title__small">
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
            image: task.image || './assets/task-card/task2.jpg',
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

    const slidesPerView = ref('auto');
    const breakpoints = {
      320: {
        slidesPerView: 'auto',
        spaceBetween: 10,
      },
      480: {
        slidesPerView: 'auto',
        spaceBetween: 15,
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
  max-width: 100%;
  position: relative;
  margin: 16px 0 0 0;
  overflow-x: hidden;
  padding: 0 10px;
  touch-action: pan-y;
}

.slider-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 10px;
  margin-bottom: 15px;
}

.slider-title {
  font-family: NimbusRegular;
  font-size: clamp(1.25rem, 5vw, 1.5rem);
  font-weight: bold;
  margin: 0;
  color: #141522;
}

.slider-controls {
  display: flex;
  gap: 10px;
}

.slider-button {
  background: none;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.3s;
}

.slider-button:hover {
  background-color: rgba(0, 0, 0, 0.1);
}

.swiper-button-prev svg,
.swiper-button-next svg {
  width: 20px;
  height: 20px;
}

.slider {
  width: 100%;
  padding: 0 5px;
}

.swiper-slide {
  width: auto !important;
  max-width: 350px;
}

.slide-content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 8px;
  background-color: #fff;
  border-radius: 15px;
  max-height: 200px;
  padding-bottom: 15px;
  width: 100%;
  max-width: 350px;
  font-family: NimbusRegular;
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
}

.slide-content img {
  border-radius: 15px 15px 0 0;
  width: 100%;
  height: 120px;
  object-fit: cover;
}

.slide-title {
  font-family: NimbusRegular;
  font-size: clamp(14px, 4vw, 16px);
  color: #141522;
  margin-left: 10px;
}

.slide-title__small {
  font-family: NimbusRegular;
  font-size: clamp(10px, 3vw, 11px);
  color: #8e92bc;
  margin-left: 10px;
}

.loading,
.error {
  text-align: center;
  font-family: NimbusRegular;
  font-size: clamp(14px, 4vw, 16px);
  padding: 15px;
}

.error {
  color: #ff4d4f;
}

/* Медиа-запросы для мобильных устройств */
@media (max-width: 768px) {
  .slider-container {
    margin: 10px 0 0 0;
    padding: 0 5px;
  }

  .slider-header {
    padding: 0 5px;
  }

  .slider-title {
    font-size: clamp(1rem, 4vw, 1.25rem);
  }

  .slider-controls {
    gap: 5px;
  }

  .slider-button {
    width: 36px;
    height: 36px;
  }

  .swiper-button-prev svg,
  .swiper-button-next svg {
    width: 18px;
    height: 18px;
  }

  .slide-content {
    max-height: 180px;
    border-radius: 12px;
    padding-bottom: 10px;
  }

  .slide-content img {
    height: 100px;
    border-radius: 12px 12px 0 0;
  }
}

@media (max-width: 480px) {
  .slider-container {
    margin: 8px 0 0 0;
    padding: 0 3px;
  }

  .slider-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }

  .slider-title {
    font-size: clamp(0.875rem, 3.5vw, 1rem);
  }

  .slider-controls {
    width: 100%;
    justify-content: flex-end;
  }

  .slide-content {
    max-height: 160px;
    border-radius: 10px;
    max-width: 300px;
  }

  .slide-content img {
    height: 90px;
    border-radius: 10px 10px 0 0;
  }

  .slide-title {
    font-size: clamp(12px, 3.5vw, 14px);
    margin-left: 8px;
  }

  .slide-title__small {
    font-size: clamp(9px, 2.5vw, 10px);
    margin-left: 8px;
  }

  .loading,
  .error {
    font-size: clamp(12px, 3.5vw, 14px);
    padding: 10px;
  }
}

/* Отключение hover на мобильных устройствах */
@media (hover: none) {
  .slide-content:hover {
    transform: none;
    box-shadow: none;
  }
}
</style>
```