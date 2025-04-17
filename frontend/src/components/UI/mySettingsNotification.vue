<template>
    <div>
        <div class="notif-checkbox">
            <my-checkbox
                v-model="isChecked"
            > {{ checkboxLebel }} </my-checkbox>
        </div>
        <div class="notif-lang">Язык</div>
        <my-select
            class="notif__select"
            v-model="selected"
            :options="options"    
        >
        <p>{{ selected }}</p>
        </my-select>
        <my-radio
            v-model="isRadied"    
        >{{ radioLabel }}</my-radio>
    </div>
</template>

<script>
    export default {
        name: 'my-settings-notif',
        data() {
            return {
                isChecked: false,
                isRadied: false,
                selected: null,
                login: '',
                radioLabel: 'Часовой пояс',
                checkboxLebel: 'Уведомления',
                options: [
                    {
                        value: 1, label: "Английский"
                    },
                    {
                        value: 2, label: "Русский"
                    },
                ],
            };
        },
    };
</script>

<style lang="scss" scoped>
.notif-checkbox{
    font-family: NimbusRegular;
    margin: 32px 0 0 32px;
}
.notif__select{
    max-width: 300px;
    margin: 16px 0 0 32px;
}
.notif-lang{
    font-family: NimbusRegular;
    margin: 32px 0 0 32px;
    font-size: 14px;
}
</style>