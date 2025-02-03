<template>
  <transition name="fade">
    <div v-if="isVisible" class="error-box">
      <svg
        width="25px"
        height="25px"
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g
          id="SVGRepo_tracerCarrier"
          stroke-linecap="round"
          stroke-linejoin="round"
        ></g>
        <g id="SVGRepo_iconCarrier">
          <path
            d="M3.23 7.913 7.91 3.23c.15-.15.35-.23.57-.23h7.05c.21 0 .42.08.57.23l4.67 4.673c.15.15.23.35.23.57v7.054c0 .21-.08.42-.23.57L16.1 20.77c-.15.15-.35.23-.57.23H8.47a.81.81 0 0 1-.57-.23l-4.67-4.673a.793.793 0 0 1-.23-.57V8.473c0-.21.08-.42.23-.57v.01Z"
            fill="#FFFFFF"
            fill-opacity=".16"
            stroke="#FFFFFF"
            stroke-width="1.5"
            stroke-miterlimit="10"
            stroke-linejoin="round"
          ></path>
          <path
            d="M12 16h.008M12 8v5"
            stroke="#FFFFFF"
            stroke-width="1.5"
            stroke-miterlimit="10"
            stroke-linecap="round"
          ></path>
        </g>
      </svg>
      <p class="error"><slot></slot></p>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'my-error',
  props: {
    timeout: {
      type: Number,
      default: 5000,
    },
  },
  data() {
    return {
      isVisible: true,
    }
  },
  mounted() {
    setTimeout(() => {
      this.isVisible = false
    }, this.timeout)
  },
}
</script>

<style lang="scss" scoped>
.error-box {
  display: flex;
  justify-content: start;
  align-items: center;
  gap: 10px;
  margin-top: 40px;
  border-radius: 5px;
  background: #546FFF;
  opacity: 50%;
}
.error-box svg {
    margin-left: 15px;
    margin: 5px;
}
.error {
  font-family: NimbusBold;
  display: flex;
  align-items: center;
  max-width: 250px;
  color: #fff;
  white-space: nowrap;
  font-size: 12px;
}
.error-logo {
  color: #546fff;
  font-family: NimbusBold;
  font-size: 16px;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
