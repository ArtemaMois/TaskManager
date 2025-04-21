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
                        value: 2, label: "UI UX Design"
                    },
                    {
                        value: 3, label: "Web Developer"
                    },
                    {
                        value: 4, label: "3D Design"
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
    flex-direction: row;
    justify-content: space-between;
    gap: 24%;
    padding-top: 24px;
    padding-right: 24px;
}
.task-search__input{
    height: 52px;
    border-radius: 10px;
    padding-left: 28px;
}
.task-search__select {
    width: 50%;
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
}

@media (max-width: 767px) {
  .main-class {
    display: flex;
    padding: 16px;
  }

 
}
</style>