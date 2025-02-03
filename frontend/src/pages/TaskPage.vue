<template>
    <div class="main-class">
        <nav-bar v-if="$route.path !== '/'" ></nav-bar>
        <div class="task-container">
            <my-main-foot>
                <template v-slot:name>Исследуйте задачу</template>
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
}
.task-container {
    padding-left: 32px;
    background: #FAFAFA;
}
.task-dialog-view {
    margin: auto;
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
</style>