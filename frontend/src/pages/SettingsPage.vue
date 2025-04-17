<template>
    <div class="main-class">
        <nav-bar v-if="$route.path !== '/'" ></nav-bar>
        <div class="main-menu__settings">
            <my-foot-settings></my-foot-settings>
            <div class="settings-menu">
                <div class="tabs">
                    <div
                        class="tab"
                        :class="{ active: activeTab === 'General' }"
                        @click="activeTab = 'General'"
                    >
                        Основные
                    </div>
                    <div
                        class="tab"
                        :class="{ active: activeTab === 'Notification' }"
                        @click="activeTab = 'Notification'"
                    >
                        Уведомления
                    </div>
                </div>
                <div class="tab-content">
                    <component :is="activeTabComponent"></component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import mySettingsGeneral from '@/components/UI/mySettingsGeneral.vue';
import mySettingsNotification from '@/components/UI/mySettingsNotification.vue';

    export default {
        data() {
            return {
                activeTab: 'General',
            };
        },
        computed: {
            // Определяем, какой компонент отображать
            activeTabComponent() {
                return this.activeTab === 'General' ? mySettingsGeneral : mySettingsNotification;
            },
        },
    };
</script>

<style lang="scss" scoped>
.main-class {
    display: grid;
    grid-template-columns: 17.5% 83.5%;
}
.main-menu__settings{
    grid-column: 2;
    padding-left: 2px;
    background-color: #FAFAFA;
}
.settings-menu{
    max-width: 1124px;
    min-height: 584px;
    margin: 32px 0 0 32px;
    background-color: #FFFFFF;

}
.tabs {
    display: flex;
    gap: 36px;
    border-bottom: 1px solid #F5F5F7;
    max-width: 1060px;
    margin: 0 0 16px 32px;
    padding-top: 52.5px;
    padding-bottom: 14px;
}
.tab {
    display: flex;
    justify-content: center;
    width: 76px;
    font-family: NimbusRegular;
    font-size: 14px;
    cursor: pointer;
    color: #8E92BC;
    position: relative;
}
.tab.active {
    color: #141522;
}
.tab.active::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 0;
    width: 76px;
    height: 2px;
    background-color: #546FFF;
}
</style>