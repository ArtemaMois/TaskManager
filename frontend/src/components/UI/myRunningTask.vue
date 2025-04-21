<template>
    <div class="runing-block">
        <div class="runing__task">Runing Task</div>
        <div class="progress-task__number">65</div>
        <div class="progress-task__percent">
            <svg class="progress-circle" :viewBox="`0 0 ${size} ${size}`">
                <circle
                    class="progress-background"
                    :r="radius"
                    :cx="size / 2"
                    :cy="size / 2"
                />
                <circle
                    class="progress-bar"
                    :r="radius"
                    :cx="size / 2"
                    :cy="size / 2"
                    :stroke-dasharray="circumference"
                    :stroke-dashoffset="strokeOffset"
                />
            </svg>
            <div class="progress-text">{{ percentage }}%</div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        name: 'my-runing',
        data() {
            return {
                percentage: 40,
                size: 300,
                strokeWidth: 10,
            }
        },
        computed: {
            radius() {
                return (this.size - this.strokeWidth) / 2;
            },
            circumference() {
                return 2 * Math.PI * this.radius;
            },
            strokeOffset() {
                return this.circumference - (this.percentage / 100) * this.circumference;
            },
            
        },
        mounted() {
            this.fetchPercentage();
            this.startAutoUpdate();
        },
        methods: {
            async fetchPercentage() {
                try {
                    const response = await axios.get('https://jsonplaceholder.typicode.com/posts/22');
                    this.percentage = response.data.id;
                } catch (error) {
                    console.error('Ошибка при получении данных:', error);
                }
            },
            startAutoUpdate() {
                setInterval(() => {
                    this.fetchPercentage();
                }, 500000);
            },
        },
    };
    
    
</script>

<style lang="scss" scoped>
.runing-block{
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 160px;
    height: auto;
    padding: 16px;
    border-radius: 10px;
    background: #141522;
}
.runing__task{
    padding: 20px 0 0 20px;
    font-family: NimbusRegular;
    color: #FFFFFF;
    height: 24px;
}
.progress__task{
    font-family: NimbusBold;
    color: #FFFFFF;
    font-size: 32px;
    height: 48px;
    margin: 30px 0 0 20px;
}
.progress-task__number{
    font-family: NimbusRegular;
    color: #FFFFFF;
    font-size: 32px;
    margin: 20px 0 0 20px;
    height: 48px;
}
.progress-task__percent{
    display: flex;
    flex-direction: row;
    position: relative;
    width: 90px;
    height: 90px;
    margin: 0 0 0 20px;
}
.progress-circle {
  width: 90px;
  height: 90px;
  position: relative;
}

.progress-background {
  fill: none;
  stroke: #546FFF;
  opacity: 10%;
  stroke-width: 10;
}

.progress-bar {
  fill: none;
  stroke: #546FFF;
  stroke-width: 10;
  stroke-linecap: round;
  transition: stroke-dashoffset 0.3s ease;
  transform: rotate(-90deg);
  transform-origin: 50% 50%;
}

.progress-text {
    display: flex;
    align-items: center;
    position: absolute;
    font-family: NimbusRegular;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 18px;
    color: #ffffff;
}
</style>