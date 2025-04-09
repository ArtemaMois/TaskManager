<template>
  <div class="grid-container">
    <div class="grid-header">
      <h2 class="grid-title">Задания</h2>
    </div>
    <TransitionGroup name="grid-fade" tag="div" class="grid-wrapper">
      <div
        v-for="(slide, index) in filteredSlides"
        :key="index"
        class="grid-item"
        @click="pushComments"
      >
        <img :src="slide.image" :alt="`Task ${index + 1}`" />
        <div class="grid-content-task">
          <div class="grid-content-task__title">{{ slide.title }}</div>
        </div>
        <div class="grid-content-task-title__small">
          {{ slide.title1 }}
        </div>
        <div class="grid-content-task-top">
          <div class="grid-content-task-top__tasks">
            <svg
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M8.5 19H8C4 19 2 18 2 13V8C2 4 4 2 8 2H16C20 2 22 4 22 8V13C22 17 20 19 16 19H15.5C15.19 19 14.89 19.15 14.7 19.4L13.2 21.4C12.54 22.28 11.46 22.28 10.8 21.4L9.3 19.4C9.14 19.18 8.77 19 8.5 19Z"
                stroke="#8E92BC"
                stroke-width="1.5"
                stroke-miterlimit="10"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M15.9965 11H16.0054"
                stroke="#8E92BC"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M11.9955 11H12.0045"
                stroke="#8E92BC"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M7.99451 11H8.00349"
                stroke="#8E92BC"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            {{ slide.message }} messages
          </div>
          <div class="grid-content-task-top__rev">
            <div class="grid-content-task-top__rev-1">
              <svg
                width="20"
                height="19"
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
            <div class="grid-content-task-top__rev-2">
              {{ slide.rank }} ({{ slide.reviews }} Reviews)
            </div>
          </div>
        </div>
      </div>
    </TransitionGroup>
  </div>
</template>

<script>
import { ref, computed } from 'vue';

export default {
  name: 'my-gridTask',
  props: {
    searchQuery: String,
    selected: Number,
  },
  setup(props) {
    const slidesTasks = ref([
      {
        image: './assets/task-card/task1.jpg',
        title: 'Creating Awesome Mobile Apps',
        title1: 'UI UX Design',
        message: 40,
        rank: 4,
        reviews: 750,
      },
      {
        image: './assets/task-card/task2.jpg',
        title: 'Creating Awesome Mobile Apps',
        title1: 'Web Developer',
        message: 40,
        rank: 4.2,
        reviews: 750,
      },
      {
        image: './assets/task-card/task1.jpg',
        title: 'Creating Awesome Mobile Apps',
        title1: 'UI UX Design',
        message: 40,
        rank: 4.6,
        reviews: 750,
      },
      {
        image: './assets/task-card/task2.jpg',
        title: 'Creating Fresh Website',
        title1: '3D Design',
        message: 40,
        rank: 4.5,
        reviews: 750,
      },
      {
        image: './assets/task-card/task3.jpg',
        title: 'Creating Color Palettes',
        title1: 'UI UX Design',
        message: 40,
        rank: 4.6,
        reviews: 750,
      },
      {
        image: './assets/task-card/task4.jpg',
        title: 'Creating Mobile App Design',
        title1: 'Web Developer',
        message: 40,
        rank: 4.6,
        reviews: 750,
      },
    ]);

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

    return {
      slidesTasks,
      filteredSlides,
    };
  },
  methods: {
    pushComments() {
      this.$router.push('/settings');
    },
  },
};
</script>

<style lang="scss" scoped>
.grid-container {
  width: 100%;
  max-width: 1200px;
  margin: 32px 0 0 0;
}

.grid-header {
  margin-bottom: 20px;
}

.grid-title {
  font-family: NimbusRegular;
  font-size: 1.5rem;
  font-weight: bold;
  margin: 0;
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
  border-radius: 5%;
  cursor: pointer;
  font-family: NimbusRegular;
  font-size: 18px;
  max-height: 450px;
}

.grid-item img {
  border-radius: 5% 5% 0 0;
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
}

.grid-content-task-title__small {
  font-size: 12px;
  color: gray;
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
  color: #141522;
}

.grid-content-task-top__rev {
  display: flex;
  align-items: center;
  gap: 5px;
}

.grid-content-task-top__rev-2 {
  font-size: 14px;
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