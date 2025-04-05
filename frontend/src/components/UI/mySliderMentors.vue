<template>
    <div class="slider-container">
      <div class="slider-header">
        <h2 class="slider-title">Наставники</h2>
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
      <TransitionGroup name="slide-fade" tag="div" class="slides-wrapper">
        <Swiper
          :slides-per-view="3"
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
              <div class="slide-content-mentor-box">
                  <img :src="slide.image" :alt="`Slide ${index + 1}`" />
                  <div class="slide-content-mentor">
                      <div  class="slide-content-mentor__title" style="margin-left: 15px;"> {{ slide.title }} </div>
                      <div @click="mentorsFollow" class="slide-content-mentor__follow">+ Follow</div>
                  </div>
                  <div  class="slide-content-title__small" style="font-size: 12px; color: gray; margin-left: 15px;"> {{ slide.title1 }} </div>
                  <div class="slide-content-mentor-top">
                      <div class="slide-content-mentor-top__tasks">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M21.66 10.44L20.68 14.62C19.84 18.23 18.18 19.69 15.06 19.39C14.56 19.35 14.02 19.26 13.44 19.12L11.76 18.72C7.59 17.73 6.3 15.67 7.28 11.49L8.26 7.30001C8.46 6.45001 8.7 5.71001 9 5.10001C10.17 2.68001 12.16 2.03001 15.5 2.82001L17.17 3.21001C21.36 4.19001 22.64 6.26001 21.66 10.44Z" stroke="#54577A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M15.06 19.39C14.44 19.81 13.66 20.16 12.71 20.47L11.13 20.99C7.15998 22.27 5.06997 21.2 3.77997 17.23L2.49997 13.28C1.21997 9.30998 2.27997 7.20998 6.24997 5.92998L7.82997 5.40998C8.23997 5.27998 8.62997 5.16998 8.99997 5.09998C8.69997 5.70998 8.45997 6.44998 8.25997 7.29998L7.27997 11.49C6.29997 15.67 7.58998 17.73 11.76 18.72L13.44 19.12C14.02 19.26 14.56 19.35 15.06 19.39Z" stroke="#54577A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M12.64 8.53003L17.49 9.76003" stroke="#54577A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M11.66 12.4L14.56 13.14" stroke="#54577A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                          {{ slide.tasks }} Task
                      </div>
                      <div class="slide-content-mentor-top__rev">
                          <div class="slide-content-mentor-top__rev-1">
                              <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M9.04894 0.927052C9.3483 0.00574112 10.6517 0.00573993 10.9511 0.927051L12.4697 5.60081C12.6035 6.01284 12.9875 6.2918 13.4207 6.2918H18.335C19.3037 6.2918 19.7065 7.53141 18.9228 8.10081L14.947 10.9894C14.5966 11.244 14.4499 11.6954 14.5838 12.1074L16.1024 16.7812C16.4017 17.7025 15.3472 18.4686 14.5635 17.8992L10.5878 15.0106C10.2373 14.756 9.7627 14.756 9.41221 15.0106L5.43648 17.8992C4.65276 18.4686 3.59828 17.7025 3.89763 16.7812L5.41623 12.1074C5.55011 11.6954 5.40345 11.244 5.05296 10.9894L1.07722 8.10081C0.293507 7.53141 0.696283 6.2918 1.66501 6.2918H6.57929C7.01252 6.2918 7.39647 6.01284 7.53035 5.60081L9.04894 0.927052Z" fill="#FFB054"/>
                              </svg>
                          </div>
                          <div class="slide-content-mentor-top__rev-2">{{ slide.rank }} ({{ slide.reviews }} Reviews)</div>
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
  import 'swiper/css';
  import { Swiper, SwiperSlide, useSwiper} from 'swiper/vue';
  import { Navigation } from 'swiper/modules';

  
  
  export default {
    name: 'my-sliderMentors',
    props: {
      searchQuery1: String,
      selected1: Number,
    },
    components: {
      Swiper,
      SwiperSlide,
    },
    setup(props) {
      const swiper = useSwiper();
      const prev = ref(null);
      const next = ref(null);
      const breakpoints = {
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 15,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
      };
      const slidesMentor = ref([
        { image: './assets/mentors-slider/mentors1.jpg',
          title: 'Curious George',
          title1: 'UI UX Design',
          message: 40,
          rank: 4.6,
          reviews: 750,
        },
        { image: './assets/mentors-slider/mentors2.png',
          title: 'Abraham Lincoln',
          title1: '3D Design',
          message: 40,
          rank: 4.6,
          reviews: 750,
        },
        { image: './assets/mentors-slider/mentors1.jpg',
          title: 'Curious George',
          title1: 'UI UX Design',
          message: 40,
          rank: 4.6,
          reviews: 750,
        },
        { image: './assets/mentors-slider/mentors2.png',
          title: 'Abraham Lincoln',
          title1: '3D Design',
          message: 40,
          rank: 4.6,
          reviews: 750,
        },
      ])

      const filteredSlides = computed(() => {
        let filtered = slidesMentor.value
        if (props.searchQuery1) {
          const query = props.searchQuery1.toLowerCase()
          filtered = filtered.filter(
            (slide) =>
              slide.title.toLowerCase().includes(query) ||
              slide.title1.toLowerCase().includes(query)
          )
      }
      if (props.selected1 === 1) {
        filtered = [...filtered].sort((a, b) => b.rank - a.rank)
      } else if (props.selected1 === 2) {
        filtered = filtered.filter((slide) => slide.title1 === 'UI UX Design')
      } else if (props.selected1 === 3) {
        filtered = filtered.filter((slide) => slide.title1 === 'Web Developer')
      } else if (props.selected1 === 4) {
        filtered = filtered.filter((slide) => slide.title1 === '3D Design')
      }

      return filtered

      })

      

      return {
        slidesMentor,
        modules: [Navigation,],
        swiper,
        prev,
        next,
        filteredSlides,
        breakpoints,
      };
    },
  };
  </script>
  
  
  
  <style lang="scss" scoped>
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
  
  .slide-content-mentor-box {
    display: flex;
    flex-direction: column;
    background-color: #f9f9f9;
    max-height: 450px;
    max-width: 350px;
    font-family: NimbusRegular;
    font-size: 18px;
    background-color: #fff;
    border-radius: 50% 50% 20px 20px;
    cursor: pointer;

  }
  
  .slide-content-mentor-box img {
    border-radius: 50%;
    width: 100%;
    object-fit: cover;
  
  }
  .slide-content-mentor{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding-right: 10px;
    width: 100%;
  }
  .slide-content-mentor__title {
    font-family: NimbusRegular;
    font-size: 18px;
    padding-bottom: 5px;
  }
  .slide-content-mentor__follow {
    font-family: NimbusRegular;
    font-size: 14px;
    color: #546FFF;
    cursor: pointer;
  }
  .slide-content-mentor__follow:hover {
    text-decoration: underline;
  }
  

  .slide-content-mentor-top {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    margin: 20px 0 20px 0;
    padding-left: 20px;
    padding-right: 20px;
    width: 100%;
}
.slide-content-mentor-top__tasks {
    display: flex;
    align-items: center;
    gap: 5px;
    font-family: NimbusRegular;
    font-size: 14px;
}
.slide-content-mentor-top__rev {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 5px;
}
.slide-content-mentor-top__rev-1 {
display: flex;
}
.slide-content-mentor-top__rev-2 {
    font-family: NimbusRegular;
    font-size: 14px;
}

  
  
  </style>