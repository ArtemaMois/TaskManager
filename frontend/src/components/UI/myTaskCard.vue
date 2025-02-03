<template>
    <div class="card-wrapper">
        <div class="card-title-block">
            <div class="card-title__text">Задача сегодня</div>
            <div class="card-title__btn">...</div>
        </div>
        <div class="card-image">
            <img src="/assets/task-images/taskImage.png" alt="img">
        </div>
        <div class="card-name">
            <div class="card-name__title">Создание потрясающих мобильных приложений</div>
            <div class="card-name__title-small">UI/UX Дизайнер</div>
        </div>
        <div class="card-progress">
            <div class="card-progress__title">
                <div class="card-progress__title-text">Прогресс</div>
                <div class="card-progress__title-number">90%</div>
            </div>
            <div class="card-progress__bar">
                <input type="range" id="volume" name="volume" value="90" min="0" max="100" />
            </div>
        </div>
        <div class="card-activ">
            <div class="card-activ__time">
                <svg width="18.5" height="18.5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2498 10.0005C19.2498 15.1095 15.1088 19.2505 9.9998 19.2505C4.8908 19.2505 0.749802 15.1095 0.749802 10.0005C0.749802 4.89149 4.8908 0.750488 9.9998 0.750488C15.1088 0.750488 19.2498 4.89149 19.2498 10.0005Z" stroke="#54577A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.4314 12.9429L9.6614 10.6939V5.84686" stroke="#54577A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                1 hour
            </div>
            <div class="card-activ__images">
                <div class="card-activ__img" v-for="(avatar, index) in cardImg" :key="index">
                    <img :src="avatar.image" :alt="`Slide ${index + 1}`">
                </div>
            </div>
        </div>
        <div class="card-line"></div>
        <div class="card-detail">
            <div class="card-detail__title">
                <div class="card-detail__title-1">Подробно о задачи</div>
                <div class="card-detail__title-2">UI/UX Дизайнер</div>
            </div>
            <div class="card-detail-box" v-for="(item, index) in detailItems" :key="index">
                <div class="card-detail__item">
                    <div class="card-detail__item-num"> {{ item.number }} </div>
                    <div class="card-detail__item-title"> {{ item.title }} </div>
                </div>
            </div>
        </div>
        <div class="card-button">
            <my-button class="card-button__btn">Подробнее</my-button>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
    export default {
        name: 'my-taskcard',
        setup() {
            const cardImg = ref([
                { image: '/assets/card-avatars/1.jpg',
                },
                { image: '/assets/card-avatars/2.jpg',
                },
                { image: '/assets/card-avatars/3.jpg',
                },
                { image: '/assets/card-avatars/4.jpg',
                },
                { image: '/assets/card-avatars/5.jpg',
                },
                
            ]);
            

            return {
                cardImg,
                detailItems: [
                    {
                        number: 1,
                        title: 'Понимание инструментов в Figma',
                    },
                    {
                        number: 2,
                        title: 'Понимать основы создания дизайна',
                    },
                    {
                        number: 3,
                        title: 'Разработайте мобильное приложение',
                    },
                ],
            }
        },
    }
</script>

<style lang="scss" scoped>
.card-wrapper {
    display: flex;
    flex-direction: column;
    margin: 32px;
    background: #FFFFFF;
    width: 85%;
    border-radius: 10px;
}
.card-title-block {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin: 24px 24px 0 24px;
}
.card-title__text {
    font-family: NimbusRegular;
    font-size: 14px;
}
.card-image {
    padding: 24px 24px 0 24px;
}
.card-image img {
    width: 100%;
    object-fit: cover;
}
.card-name {
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding: 20px 24px 0 24px;
}
.card-name__title {
    font-family: NimbusRegular;
    font-size: 14px;
}
.card-name__title-small{
    font-family: NimbusRegular;
    font-size: 12px;
    color: #54577A;
}

.card-detail__title-2 {
    font-family: NimbusRegular;
    font-size: 14px;
    color: #54577A;

}

.card-detail__title-2 {
    font-family: NimbusRegular;
    font-size: 14px;
    color: #54577A;

}

.card-progress {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 20px 24px 0 24px;
}
.card-progress__title {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
.card-progress__title-text {
    color: #141522;
    font-family: NimbusRegular;
    font-size: 16px;
}
.card-progress__title-number {
    color: #141522;
    font-family: NimbusRegular;
    font-size: 16px;
}
.card-progress__bar input {
    width: 100%;
}
input[type="range"] {
    accent-color: #546FFF;
}
input[type=range]::-moz-range-track {
 width: 300px;
 height: 5px;
 background: #d2d2d2;
 border: none;
 border-radius: 3px;
}
input[type=range]::-moz-range-thumb {
 border: none;
 height: 16px;
 width: 16px;
 border-radius: 50%;
 background: #fff;
 border:5px outset #ddd;
 margin-top: -4px;
}
input[type=range]:focus::-moz-range-track {
 background: #008489;
}


.card-activ {
    display: flex;
    justify-content: space-between;
    padding: 10px 24px 0 24px;
}
.card-activ__time {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 3px;
    font-family: NimbusRegular;
    font-size: 16px;
}
.card-activ__images {
    display: flex;
    flex-direction: row;
    padding: 0 24px 0 0;
}
.card-activ__img {
    max-width: 24px;
    margin-left: 16px;
}
.card-activ__img img {

    position: absolute;
    width: 24px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #fff;
}
.card-line{
    margin: 32px 24px;
    height: 1px;
    background: #F5F5F7;
}

.card-detail__title {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 0 24px 0 24px;
}
.card-detail__item {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 12px;
    margin-top: 20px;
    padding: 0 24px 0 24px;
}
.card-detail__item-num {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 36px;
    height: 36px;
    background: #F5F5F7;
    border-radius: 10px;

}
.card-detail__item-title {
    font-family: NimbusRegular;
    font-size: 14px;
}

.card-button {
    padding: 0 24px 0 20px;
}
.card-button__btn {
    margin: 56px 0 24px 0;
    background: #546FFF;
    max-width: 324px;
    width: 100%;
    height: 44px;
    font-family: NimbusRegular;
    font-size: 14px;
    color: #FFF;
    justify-content: center;
}

</style>