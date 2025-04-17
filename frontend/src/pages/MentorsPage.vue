<template>
    <div class="main-class">
      <nav-bar v-if="$route.path !== '/'"></nav-bar>
      <div class="mentor-container">
        <my-main-foot>
          <template v-slot:name>
            <h1 class="mentor-title">Выберите наставника</h1>
          </template>
        </my-main-foot>
        <div class="mentor-search">
          <my-input
            class="mentor-search__input"
            v-model="searchQuery1"
            placeholder="Поиск ментора"
          />
          <my-select
            class="mentor-search__select"
            v-model="selected1"
            :options="options1"
          />
        </div>
        <my-sliderMentors :searchQuery1="searchQuery1" :selected1="selected1" />
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';  
  export default {
    setup() {
      const searchQuery1 = ref('');
      const selected1 = ref(null);
      return {
        selected1,
        searchQuery1,
        options1: [
          { value: 1, label: 'Сортировать по рейтингу' },
          { value: 2, label: 'UI UX Design' },
          { value: 3, label: 'Web Developer' },
          { value: 4, label: '3D Design' },
        ],
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
    font-size: clamp(1.2rem, 2vw, 2rem);
    line-height: 1.2;
    margin: 0;
  }
  
  .mentor-search {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding-top: 24px;
    padding-right: 24px;
    margin-bottom: 32px;
  }
  
  .mentor-search__input {
    flex: 1 1 300px;
    height: 52px;
    border-radius: 10px;
    padding-left: 28px;
    font-family: NimbusRegular, sans-serif;
    font-size: clamp(0.875rem, 2vw, 1rem);
    border: 1px solid #e0e0e0;
    background: #fff;
    box-sizing: border-box;
  }
  
  .mentor-search__select {
    flex: 1 1 200px;
    height: 52px;
    border-radius: 10px;
    font-family: NimbusRegular, sans-serif;
    font-size: clamp(0.875rem, 2vw, 1rem);
    border: 1px solid #e0e0e0;
    background: #fff;
    box-sizing: border-box;
  }
  
  /* Медиа-запросы */
  @media (max-width: 1024px) {
    .main-class {
      grid-template-columns: 5% 1fr;
      padding: 16px;
    }
  
    .mentor-container {
      margin-left: 16px;
      padding: 16px;
    }
  }
  
  @media (max-width: 768px) {
    .main-class {
      grid-template-columns: 5% 1fr;
    }
  
    .mentor-search {
      flex-direction: column;
    }
  
    .mentor-search__input,
    .mentor-search__select {
      flex: 1 1 auto;
      width: 100%;
    }
  }
  
  @media (max-width: 480px) {
  
    .mentor-container {
      padding: 16px;
    }
  
    .mentor-search__input,
    .mentor-search__select {
      height: 44px;
      font-size: 0.875rem;
    }
  }
  </style>