Nikita, [27.11.2024 0:04]
<template>
  <div class="activity-chart">
    <div class="header">
      <h3>Активность</h3>
      <select v-model="selectedWeek">
        <option class="header__option" v-for="(week, index) in weeks" :key="index" :value="week">
          {{ week }}
        </option>
      </select>
    </div>
    <div class="chart-container">
      <canvas style="width: 422px; height: 130px;" ref="canvas" @click="handleClick"></canvas>
      <div
        v-if="tooltip.visible"
        class="tooltip"
        :style="{
          left: tooltip.x + 'px',
          top: tooltip.y + 'px',
        }"
      >
        {{ tooltip.text }}
      </div>
      <div 
        v-if="tooltip2.visible" 
        class="tooltip2" 
        :style="{
          left: tooltip2.x + 'px',
          top: tooltip2.y + 'px',
        }">
        <svg width="64" height="60" viewBox="0 0 64 60" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g filter="url(#filter0_d_27_1488)">
        <path d="M30.4571 30.1293C31.2571 31.0992 32.7429 31.0992 33.5429 30.1293L37.9611 24.7726C39.037 23.4681 38.1091 21.5 36.4182 21.5H27.5818C25.8909 21.5 24.963 23.4681 26.0389 24.7726L30.4571 30.1293Z" fill="#141522"/>
        </g>
        <defs>
        <filter id="filter0_d_27_1488" x="0.578003" y="0.5" width="62.844" height="59.3568" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
        <feOffset dy="4"/>
        <feGaussianBlur stdDeviation="12.5"/>
        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_27_1488"/>
        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_27_1488" result="shape"/>
        </filter>
        </defs>
        </svg>

      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, watch } from "vue";

export default {
  name: "my-activity",
  setup() {
    const canvas = ref(null);
    const selectedWeek = ref("Текущая неделя");
    const weeks = ["Текущая неделя", "Прошлая неделя", "2 недели назад"];
    const data = ref({
      "Текущая неделя": [0, 3, 1, 2, 1, 3, 1],
      "Прошлая неделя": [1, 3, 2, 3, 1, 2, 1],
      "2 недели назад": [1, 5, 4, 3, 1, 2, 1],
    });

    const selectedPoint = ref(null);
    const tooltip = ref({
      visible: false,
      x: 0,
      y: 0,
      text: "",
    });
    const tooltip2 = ref({
      visible: false,
      x: 0,
      y: 0,
      text: "",
    });

    const drawChart = () => {
      const ctx = canvas.value.getContext("2d");
      const dpr = window.devicePixelRatio || 1;

      const canvasWidth = 422;
      const canvasHeight = 130;

      canvas.value.width = canvasWidth * dpr;
      canvas.value.height = canvasHeight * dpr;
      canvas.value.style.width = '${canvasWidth}px';
      canvas.value.style.height = '${canvasHeight}px';

      ctx.scale(dpr, dpr);

      const chartData = data.value[selectedWeek.value];
      const days = ["П", "В", "С", "Ч", "П", "С", "В"];
      const maxTasks = Math.max(...chartData);

      const padding = 30;
      const chartWidth = canvasWidth - padding * 1.6;
      const chartHeight = canvasHeight - padding * 1.6;
      const stepX = chartWidth / (chartData.length - 1);
      const stepY = chartHeight / maxTasks;

      ctx.clearRect(0, 0, canvas.value.width, canvas.value.height);

      ctx.font = "12px NimbusRegular";
      ctx.textAlign = "right";
      ctx.fillStyle = "#141522";
      for (let i = 0; i <= maxTasks; i += Math.ceil(maxTasks / 5)) {
        const y = canvasHeight - padding - i * stepY*0.9;
        ctx.fillText(i, padding - 10, y + 3);
      }

      ctx.textAlign = "center";
      days.forEach((day, index) => {
        const x = padding + index * stepX;
        ctx.fillText(day, x, canvasHeight - padding + 20);
        ctx.beginPath();
        ctx.moveTo(x, padding - 10);
        ctx.lineTo(x, canvasHeight - padding);
        ctx.strokeStyle = "#F5F5F7";
        ctx.stroke();
      });

      const points = chartData.map((value, index) => {
        const x = padding + index * stepX;
        const y = canvasHeight - padding - value * stepY;
        return { x, y, value };
      });

      ctx.beginPath();
      points.forEach((point, index) => {
        const shadowY = point.y + 10;
        if (index === 0) {
          ctx.moveTo(point.x, shadowY);
        } else {
          const prev = points[index - 1];
          const ctrlX = (prev.x + point.x) / 2;
          ctx.bezierCurveTo(ctrlX, prev.y + 5, ctrlX, shadowY, point.x, shadowY);
        }
      });
      ctx.strokeStyle = "#EBEDF7";
      ctx.lineWidth = 3;
      ctx.stroke();

        ctx.beginPath();
        points.forEach((point, index) => {
            if (index === 0) {
            ctx.moveTo(point.x, point.y);
            } else {
            const prev = points[index - 1];
            const ctrlX = (prev.x + point.x) / 2;
            ctx.bezierCurveTo(ctrlX, prev.y, ctrlX, point.
            y, point.x, point.y);
        }
      });
      ctx.strokeStyle = "#141522";
      ctx.lineWidth = 3;
      ctx.stroke();

      if (selectedPoint.value) {
        const { x, y, value } = selectedPoint.value;
        ctx.beginPath();
        ctx.arc(x, y, 7, 0, Math.PI * 2);
        ctx.fillStyle = "#fff";
        ctx.fill();
        ctx.strokeStyle = "#546FFF";
        ctx.lineWidth = 4.5;
        ctx.stroke();

        tooltip.value = {
          visible: true,
          x: x + 19.5,
          y: y - 44,
          text: value + ' Зад.',
        };
        tooltip2.value = {
          visible: true,
          x: x + 19.5,
          y: y - 20,
          text: value + ' Зад.',
        };
      } else {
        tooltip.value.visible = false;
        tooltip2.value.visible = false;
      }
    };


    const setPointForCurrentDay = () => {
    const currentDayIndex = (new Date().getDay() + 6) % 7;
    const chartData = data.value[selectedWeek.value];
    const padding = 30;
    const chartWidth = 422 - padding * 1.6;
    const chartHeight = 130 - padding * 1.6;
    const maxTasks = Math.max(...chartData);
    const stepX = chartWidth / (chartData.length - 1);
    const stepY = chartHeight / maxTasks;

    const points = chartData.map((value, index) => {
        const x = padding + index * stepX;
        const y = 130 - padding - value * stepY;
        return { x, y, value };
    });

    selectedPoint.value = points[currentDayIndex];
    };


    const handleClick = (event) => {
        const rect = canvas.value.getBoundingClientRect();
        const mouseX = event.clientX - rect.left;
        const mouseY = event.clientY - rect.top;    
        const padding = 30;
        const chartWidth = 422 - padding * 1.6;
        const chartHeight = 130 - padding * 1.6;
        const chartData = data.value[selectedWeek.value];
        const stepX = chartWidth / (chartData.length - 1);
        const stepY = chartHeight / Math.max(...chartData); 
        const points = chartData.map((value, index) => {
            const x = padding + index * stepX;
            const y = 130 - padding - value * stepY;
            return { x, y, value };
        }); 
        let closestPoint = null;
        let minDistance = Infinity; 
        points.forEach((point) => {
            const distance = Math.sqrt((mouseX - point.x) ** 2 + (mouseY - point.y) ** 2);
            if (distance < minDistance) {
                closestPoint = point;
                minDistance = distance;
            }
        }); 
        if (closestPoint) {
            selectedPoint.value = closestPoint;
            drawChart();
        }
    };

    onMounted(() => {
        setPointForCurrentDay();
        drawChart();
    });

    watch(selectedWeek, () => {
        selectedPoint.value = null;
        drawChart();
    });

    return {
        canvas,
        selectedWeek,
        weeks,
        handleClick,
        tooltip,
        tooltip2,
    };
  },
};
</script>

<style scoped>
.activity-chart {
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100%;
    max-width: 462px;
    font-family: NimbusBold;
    border-radius: 10px;
    background: #F5F5F7;
}

.chart-container {
    position: relative;
    width: 422px !important;
    height: 130px !important;
}

canvas {
    max-width: 422px;
    background: #fff;
    border-radius: 10px;
    margin: 0 0 0 20px;
}

.tooltip {
    position: absolute;
    background: #141522;
    color: #fff;
    padding: 8px 18px;
    border-radius: 10px;
    font-family: NimbusRegular;
    font-size: 12px;
    transform: translate(-50%, -50%);
    white-space: nowrap;
    pointer-events: none;
}
.tooltip2 {
    position: absolute;
    padding: 8px 18px;
    border-radius: 10px;
    font-family: NimbusRegular;
    font-size: 12px;
    transform: translate(-50%, -50%);
    white-space: nowrap;
    pointer-events: none;
}
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    border: none;
}

.header h3 {
    font-family: NimbusRegular;
    font-size: 16px;
    margin: 0 0 0 20px;
}

.header select {
    font-family: NimbusRegular;
    font-size: 14px;
    border: none;
    background: none;
    margin: 0 20px 0 0;
}
.header__option {
    font-family: NimbusRegular;
    font-size: 14px;
    border: none;
    background: #FFFFFF;
    margin: 0 20px 0 0;
}


</style>