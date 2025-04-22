<template>
    <div class="main-class">
        <nav-bar v-if="$route.path !== '/'" ></nav-bar>
        <div class="task-container">
            <my-main-foot>
                <template v-slot:name>
                    <h1 class="task-title">Исследуйте задачу</h1>
                </template>
            </my-main-foot>
            <div class="task-search">
                <my-input
                    class="task-search__input"
                    v-model="searchQuery"
                    placeholder="Поиск задания"
                />
                <my-select 
                    class="task-search__select"
                    v-model="selected"
                    :options="options"
                    >
                </my-select>
            </div>
            <my-sliderTask :searchQuery="searchQuery" :selected="selected"></my-sliderTask>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
    export default {
        setup () {
            const searchQuery = ref('');
            const selected = ref(null);
            return {
                selected,
                searchQuery,
                select: null,
                options: [
                    {
                        value: 1, label: "Сортировать по рейтингу"
                    },
                    {
                        value: 2, label: "Backend-разработка"
                    },
                    {
                        value: 3, label: "Frontend-разработка"
                    },
                    {
                        value: 4, label: "DevOps"
                    },
                ],
            };
        },
    };
</script>

<style lang="scss" scoped>
.main-class {
    display: grid;
    grid-template-columns: 17.5% 83.5%;
    padding: 32px;
}
.task-container {
    padding-left: 32px;
    background: #FAFAFA;
}
.task-dialog-view {
    margin: auto;
}
.task-title {
    font-size: clamp(1.2rem, 2vw, 2rem);
}
.task-search{
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding-top: 24px;
    padding-right: 24px;
    margin-bottom: 32px;
}
.task-search__input{
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
.task-search__select {
    flex: 1 1 200px;
    height: 52px;
    border-radius: 10px;
    font-family: NimbusRegular, sans-serif;
    font-size: clamp(0.875rem, 2vw, 1rem);
    border: 1px solid #e0e0e0;
    background: #fff;
    box-sizing: border-box;
}

@media (max-width: 1024px) {
    .main-class {
        display: grid;
        grid-template-columns: 5% 1fr;
        padding: 16px;
    }

    .task-container {
        margin-left: 16px;
        padding-left: 16px;
        background: #FAFAFA;
    }

    .task-search {
        padding-right: 16px;
    }
}

@media (max-width: 767px) {
  .main-class {
    grid-template-columns: 5% 1fr;
    padding: 16px;
  }
}

@media (max-width: 480px) {
  
  .task-container {
    padding: 16px;
  }

  .task-search__input,
  .task-search__select {
    height: 44px;
    font-size: 0.875rem;
  }
}
</style>