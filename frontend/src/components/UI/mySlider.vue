<template>
  <div class="grid-container">
    <div class="grid-header">
      <h2 class="grid-title">Наставники</h2>
    </div>
    <div v-if="loading" class="loading">Загрузка...</div>
    <div v-else-if="error" class="error">{{ error }}</div>
    <TransitionGroup v-else name="grid-fade" tag="div" class="grid-wrapper">
      <div
        v-for="(slide, index) in filteredSlides"
        :key="index"
        class="grid-item-mentor-box"
        @click="mentorsDetail(slide.id)"
      >
        <div class="grid-content-mentor">
          <img
            v-if="slide.image"
            :src="slide.image"
            :alt="`Mentor ${index + 1}`"
          />
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
              d="M22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12ZM15 9C15 9.79565 14.6839 10.5587 14.1213 11.1213C13.5587 11.6839 12.7956 12 12 12C11.2044 12 10.4413 11.6839 9.87868 11.1213C9.31607 10.5587 9 9.79565 9 9C9 8.20435 9.31607 7.44129 9.87868 6.87868C10.4413 6.31607 11.2044 6 12 6C12.7956 6 13.5587 6.31607 14.1213 6.87868C14.6839 7.44129 15 8.20435 15 9ZM12 20.5C13.7163 20.5028 15.3928 19.9834 16.807 19.011C17.411 18.596 17.669 17.806 17.317 17.163C16.59 15.83 15.09 15 12 15C8.91 15 7.41 15.83 6.682 17.163C6.331 17.806 6.589 17.806 7.193 19.011C8.6072 19.9834 10.2837 20.5028 12 20.5Z"
              fill="black"
            />
          </svg>
          <div class="grid-content-mentor__title">
            {{ slide.title }}
          </div>
          <div
            class="grid-content-mentor__follow"
            @click.stop="followMentor(slide.id)"
          >
            + Follow
          </div>
        </div>
        <div class="grid-content-title__small">
          {{ slide.title1 }}
        </div>
        <div class="grid-content-mentor-top">
          <div class="grid-content-mentor-top__tasks">
            <svg
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M21.66 10.44L20.68 14.62C19.84 18.23 18.18 19.69 15.06 19.39C14.56 19.35 14.02 19.26 13.44 19.12L11.76 18.72C7.59 17.73 6.3 15.67 7.28 11.49L8.26 7.30001C8.46 6.45001 8.7 5.71001 9 5.10001C10.17 2.68001 12.16 2.03001 15.5 2.82001L17.17 3.21001C21.36 4.19001 22.64 6.26001 21.66 10.44Z"
                stroke="#54577A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M15.06 19.39C14.44 19.81 13.66 20.16 12.71 20.47L11.13 20.99C7.15998 22.27 5.06997 21.2 3.77997 17.23L2.49997 13.28C1.21997 9.30998 2.27997 7.20998 6.24997 5.92998L7.82997 5.40998C8.23997 5.27998 8.62997 5.16998 8.99997 5.09998C8.69997 5.70998 8.45997 6.44998 8.25997 7.29998L7.27997 11.49C6.29997 15.67 7.58998 17.73 11.76 18.72L13.44 19.12C14.02 19.26 14.56 19.35 15.06 19.39Z"
                stroke="#54577A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12.64 8.53003L17.49 9.76003"
                stroke="#54577A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M11.66 12.4L14.56 13.14"
                stroke="#54577A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            {{ slide.tasks }} Задач
          </div>
          <div class="grid-content-mentor-top__rev">
            <div class="grid-content-mentor-top__rev-1">
              <svg
                width="16"
                height="16"
                viewBox="0 0 20 19"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M9.04894 0.927052C9.3483 0.00574112 10.6517 0.00573993 10.9511 0.927051L12.4697 5.60081C12.6035 6.01284 12.9875 6.2918 13.4207 6.2918H18.335C19.3037 6.2918 19.7065 7.53141 18.9228 8.10081L14.947 10.9894C14.5966 11.244 14.4499 11.6954 14.5838 12.1074L16.1024 16.7812C16.4017 17.7025 15.3472 18.4686 14.5635 17.8992L10.5878 15.0106C10.2373 14.756 9.7627 14.756 9.41221 15.0106L5.43648 17.8992C4.65276 18.4686 3.59828 17.7025 3.89763 16.7812L5.41623 12.1074C5.55011 11.6954 5.40345 11.244 5.05296 10.9894L1.07722 8.10081C0.293507 7.53141 0.696283 6.2918 1.66501 6.2918H6.57929C7.01252 6.2918 7.39647 6.01284 7.53035 5.60081L9.04894 0.927052Z"
                  fill="#FFB054"
                />
              </svg>
            </div>
            <div class="grid-content-mentor-top__rev-2">
              {{ slide.rank }}
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

export default {
  name: 'my-gridMentors',
  props: {
    searchQuery1: String,
    selected1: Number,
  },
  setup(props) {
    const slidesMentor = ref([]);
    const loading = ref(true);
    const error = ref(null);

    // Функция для получения данных с бэкенда
    const fetchMentors = async () => {
      error.value = '';
      try {
        const token = localStorage.getItem('api_token');
        if (!token) {
          throw new Error('Токен не найден. Пожалуйста, войдите в систему.');
        }

        const response = await axios.get('http://localhost:80/api/mentors', {
          headers: {
            Authorization: token,
          },
        });

        if (response.data.status === 'success') {
          slidesMentor.value = response.data.mentors.map((mentor) => ({
            id: mentor.id,
            image: mentor.image,
            title: mentor.login,
            title1: mentor.categories[0]?.title || 'Без категории',
            tasks: mentor.tasks,
            rank: mentor.grade,
            reviews: 0,
          }));
        } else {
          throw new Error('Не удалось загрузить данные наставников');
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
      fetchMentors();
    });

    const filteredSlides = computed(() => {
      let filtered = slidesMentor.value;
      if (props.searchQuery1) {
        const query = props.searchQuery1.toLowerCase();
        filtered = filtered.filter(
          (slide) =>
            slide.title.toLowerCase().includes(query) ||
            slide.title1.toLowerCase().includes(query)
        );
      }
      if (props.selected1 === 1) {
        filtered = [...filtered].sort((a, b) => b.rank - a.rank);
      } else if (props.selected1 === 2) {
        filtered = filtered.filter((slide) => slide.title1 === 'UI UX Design');
      } else if (props.selected1 === 3) {
        filtered = filtered.filter((slide) => slide.title1 === 'Веб разработка');
      } else if (props.selected1 === 4) {
        filtered = filtered.filter((slide) => slide.title1 === '3D Design');
      }

      return filtered;
    });

    return {
      slidesMentor,
      filteredSlides,
      loading,
      error,
    };
  },
  methods: {
    mentorsDetail(mentorId) {
      console.log('Переход на детальную страницу наставника с ID:', mentorId);
      this.$router.push(`/mentors/${mentorId}`);
    },
    async followMentor(mentorId) {
      console.log('Следование за ментором с ID:', mentorId);
      try {
        const token = localStorage.getItem('api_token');
        await axios.post(
          `http://localhost:80/api/mentors/${mentorId}/follow`,
          {},
          { headers: { Authorization: token } }
        );
        console.log(`Теперь вы следите за ментором ${mentorId}`);
      } catch (e) {
        console.error('Ошибка при подписке:', e);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.grid-container {
  max-width: 1200px;
  margin: 32px auto;
  padding: 0 40px 0 0;
}

.grid-header {
  margin-bottom: 24px;
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
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 20px;
}

.grid-item-mentor-box {
  display: flex;
  flex-direction: column;
  background-color: #fff;
  max-height: 250px;
  border-radius: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;

  &:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
  }
}

.grid-content-mentor {
  display: flex;
  align-items: center;
  padding: 15px 20px 5px;
}

.grid-item-mentor-box img,
.default-avatar {
  width: 20%;
  max-height: 100px;
  object-fit: cover;
  border-radius: 50%;
  margin-right: 15px;
}

.default-avatar {
  width: 48px;
  height: 48px;
}

.grid-content-mentor__title {
  font-family: NimbusRegular;
  font-size: 1.125rem;
  font-weight: 500;
  color: #141522;
  flex-grow: 1;
}

.grid-content-mentor__follow {
  font-family: NimbusRegular;
  font-size: 0.875rem;
  color: #546fff;
  cursor: pointer;
  transition: color 0.2s ease;

  &:hover {
    color: #3b50cc;
    text-decoration: underline;
  }
}

.grid-content-title__small {
  font-family: NimbusRegular;
  font-size: 0.75rem;
  color: #8e92bc;
  padding: 0 20px 10px;
}

.grid-content-mentor-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 20px 15px;
}

.grid-content-mentor-top__tasks {
  display: flex;
  align-items: center;
  gap: 6px;
  font-family: NimbusRegular;
  font-size: 0.875rem;
  color: #54577a;
}

.grid-content-mentor-top__rev {
  display: flex;
  align-items: center;
  gap: 6px;
}

.grid-content-mentor-top__rev-1 {
  display: flex;
  align-items: center;
}

.grid-content-mentor-top__rev-2 {
  font-family: NimbusRegular;
  font-size: 0.875rem;
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

@media (max-width: 768px) {
  .grid-wrapper {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  }

  .grid-content-mentor__title {
    font-size: 1rem;
  }
}

@media (max-width: 480px) {
  .grid-wrapper {
    grid-template-columns: 1fr;
  }

  .grid-item-mentor-box {
    max-width: 320px;
    margin: 0 auto;
  }
}
</style>