<template>
  <div class="slider-container">
    <div class="slider-header">
      <h2 class="slider-title">Задания</h2>
      <div class="slider-controls">
        <button ref="prev" class="swiper-button-prev slider-button">
          <svg
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M15 19.92L8.48 13.4C7.71 12.63 7.71 11.37 8.48 10.6L15 4.08002"
              stroke="#54577A"
              stroke-width="1.5"
              stroke-miterlimit="10"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
        <button ref="next" class="swiper-button-next slider-button">
          <svg
            width="9"
            height="18"
            viewBox="0 0 9 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M0.910004 16.92L7.43 10.4C8.2 9.63002 8.2 8.37002 7.43 7.60002L0.910004 1.08002"
              stroke="#141522"
              stroke-width="1.5"
              stroke-miterlimit="10"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
      </div>
    </div>
    <TransitionGroup name="slide-fade" tag="div" class="slides-wrapper">
      <Swiper
        :slides-per-view="3"
        :space-between="20"
        :navigation="{
          prevEl: prev,
          nextEl: next,
        }"
        :modules="modules"
        class="slider"
      >
        <SwiperSlide v-for="(slide, index) in filteredSlides" :key="index">
          <div @click="pushComments" class="slide-content-task-box">
            <img :src="slide.image" :alt="`Slide ${index + 1}`" />
            <div class="slide-content-task">
              <div class="slide-content-task__title" style="margin-left: 15px">
                {{ slide.title }}
              </div>
            </div>
            <div
              class="slide-content-task-title__small"
              style="font-size: 12px; color: gray; margin-left: 15px"
            >
              {{ slide.title1 }}
            </div>
            <div class="slide-content-task-top">
              <div class="slide-content-task-top__tasks">
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
              <div class="slide-content-task-top__rev">
                <div class="slide-content-task-top__rev-1">
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
                <div class="slide-content-task-top__rev-2">
                  {{ slide.rank }} ({{ slide.reviews }} Reviews)
                </div>
              </div>
            </div>
          </div>
        </SwiperSlide>
      </Swiper>
    </TransitionGroup>
  </div>
</template>

<script>
import { ref, computed } from 'vue'
import 'swiper/css'
import { Swiper, SwiperSlide, useSwiper } from 'swiper/vue'
import { Navigation } from 'swiper/modules'

export default {
  name: 'my-sliderTask',
  props: {
    searchQuery: String,
    selected: Number,
  },
  components: {
    Swiper,
    SwiperSlide,
  },
  setup(props) {
    const swiper = useSwiper()
    const prev = ref(null)
    const next = ref(null)
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
        title: 'Creating Color Palletes',
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
    ])

    const filteredSlides = computed(() => {
      let filtered = slidesTasks.value
      if (props.searchQuery) {
        const query = props.searchQuery.toLowerCase()
        filtered = filtered.filter(
          (slide) =>
            slide.title.toLowerCase().includes(query) ||
            slide.title1.toLowerCase().includes(query)
        )
      }

      if (props.selected === 1) {
        filtered = [...filtered].sort((a, b) => b.rank - a.rank)
      } else if (props.selected === 2) {
        filtered = filtered.filter((slide) => slide.title1 === 'UI UX Design')
      } else if (props.selected === 3) {
        filtered = filtered.filter((slide) => slide.title1 === 'Web Developer')
      } else if (props.selected === 4) {
        filtered = filtered.filter((slide) => slide.title1 === '3D Design')
      }

      return filtered
    })

    return {
      slidesTasks,
      modules: [Navigation],
      swiper,
      prev,
      next,
      filteredSlides,
    }
  },
  methods: {
    pushComments() {
      this.$router.push('/settings')
    },
  },
}
</script>

<style>
.slider-container {
  width: 100%;
  max-width: 1200px;
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
  padding-right: 20px;
}

.slide-content-task-box {
  display: flex;
  flex-direction: column;
  background-color: #f9f9f9;
  max-height: 450px;
  max-width: 350px;
  font-family: NimbusRegular;
  font-size: 18px;
  background-color: #fff;
  border-radius: 5%;
  cursor: pointer;
}

.slide-content-task-box img {
  border-radius: 5%;
  width: 100%;
  height: 150px;
  object-fit: cover;
}
.slide-content-task {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  padding-top: 20px;
  padding-right: 10px;
  width: 100%;
}
.slide-content-task__title {
  font-family: NimbusRegular;
  font-size: 18px;
  padding-bottom: 5px;
}

.slide-content-task-top {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  margin: 20px 0 20px 0;
  padding-left: 20px;
  padding-right: 20px;
  width: 100%;
}
.slide-content-task-top__tasks {
  display: flex;
  align-items: center;
  gap: 5px;
  font-family: NimbusRegular;
  color: #141522;
  font-size: 14px;
}

.slide-content-task-top__rev {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 5px;
}
.slide-content-task-top__rev-1 {
  display: flex;
}
.slide-content-task-top__rev-2 {
  font-family: NimbusRegular;
  font-size: 14px;
}

/* Анимация для слайдов */
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.5s ease;
}
.slide-fade-enter-from {
  opacity: 0;
  transform: translateY(20px);
}
.slide-fade-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}
</style>
