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
  
      <Swiper
        :slides-per-view="2"
        :space-between="20"
        :navigation="{
          prevEl: prev,
          nextEl: next,
        }"
        :loop="true"
        :modules="modules"
        class="slider"
      >
        <SwiperSlide v-for="(slide, index) in slides" :key="index">
          <div class="slide-content">
            <img :src="slide.image" :alt="`Slide ${index + 1}`" />
            <div  class="slide-title" style="margin-left: 15px;"> {{ slide.title }} </div>
            <div  class="slide-title__small" style="font-size: 12px; color: gray; margin-left: 15px;"> {{ slide.title1 }} </div>
          </div>
        </SwiperSlide>
      </Swiper>

    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import 'swiper/css';
  import { Swiper, SwiperSlide, useSwiper} from 'swiper/vue';
  import { Navigation } from 'swiper/modules';

  
  
  export default {
    name: 'my-sslider',
    components: {
      Swiper,
      SwiperSlide,
    },
    setup() {
      const swiper = useSwiper();
      const prev = ref(null);
      const next = ref(null);
      const slides = ref([
        { image: './assets/slider-images/SliderImage.png',
          title: 'Создание приложения WEB',
          title1: 'Категории: IOS, Android, WEB',
        },
        { image: './assets/slider-images/SliderImage2.png',
          title: 'Создание приложения Android',
          title1: 'Категории: IOS, Android, WEB',
        },
        { image: './assets/slider-images/SliderImage.png',
          title: 'Создание приложения IOS',
          title1: 'Категории: IOS, Android, WEB',
        },
        { image: './assets/slider-images/SliderImage2.png',
          title: 'Создание приложения',
          title1: 'Категории: IOS, Android, WEB',
        },
        
      ]);

      return {
        slides,
        modules: [Navigation,],
        swiper,
        prev,
        next,
      };
    },
  };
  </script>
  
  
  
  <style>
  .slider-container {
    width: 100%;
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
  }
  
  .slider-controls {
    display: flex;
    gap: 20px;
  }
  
  .slider-button {
    background: none;
    border: none;
    border-radius: 5px;
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
    background-color: #f9f9f9;
    border-radius: 10px;
    max-height: 230px;
    padding-bottom: 20px;
    max-width: 350px;
    font-family: NimbusRegular;
    font-size: 18px;
    background-color: #fff;
    border-radius: 20px;;

  }
  
  .slide-content img {
    border-radius: 10px;
    width: 100%;
    object-fit: cover;
  
  }
  
  </style>