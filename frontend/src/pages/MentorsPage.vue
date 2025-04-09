<template>
    <div class="main-class">
        <nav-bar v-if="$route.path !== '/'" ></nav-bar>
        <div class="mentor-container">
            <my-main-foot>
                <template v-slot:name>Выберите наставника</template>
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
                    >
                </my-select>
            </div>
            <my-sliderMentors :searchQuery1="searchQuery1" :selected1="selected1"></my-sliderMentors>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
    export default {
        setup () {
            const searchQuery1 = ref('');
            const selected1 = ref(null);
            return {
                selected1,
                searchQuery1,
                select: null,
                options1: [
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
    }
</script>

<style lang="scss" scoped>
.main-class {
    display: grid;
    grid-template-columns: 17.5% 83.5%;
}
.mentor-container {
    padding-left: 32px;
    background: #FAFAFA;
}
.mentor-dialog-view {
    margin: auto;
}
.mentor-search{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    gap: 24%;
    padding-top: 24px;
    padding-right: 24px;
}
.mentor-search__input{
    height: 52px;
    border-radius: 10px;
    padding-left: 28px;
}
.mentor-search__select {
    width: 50%;
}
</style>