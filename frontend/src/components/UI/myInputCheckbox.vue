<template>
    <div class="notif-toggle">
      <span class="notif-toggle__label"> <slot></slot> </span>
        <div class="notif-toggle__button" @click="toggle">
            <div
                class="notif-toggle__circle"
                :class="{ active: modelValue }"
            ></div>
        </div>
  </div>
</template>

<script>
    export default {
        name: 'my-checkbox',
        props: {
            modelValue: {
                type: Boolean,
                default: false,
            },
        },
        emits: ["update:modelValue"],
        data() {
            
        },
        methods: {
            toggle() {
                this.$emit("update:modelValue", !this.modelValue);
            },
        },
    };
</script>

<style lang="scss" scoped>
.notif-toggle {
  display: flex;
  align-items: center;
  gap: 20px;
  font-family: Arial, sans-serif;
  font-size: 14px;
}

.notif-toggle__button {
  position: relative;
  width: 55px;
  height: 30px;
  background-color: #fff;
  border: 1px solid #F5F5F7;
  border-radius: 100px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.notif-toggle__button:hover {
  background-color: #fff;
}

.notif-toggle__button.active {
  background-color: #546FFF;
}

.notif-toggle__circle {
  position: absolute;
  top: 50%;
  left: 5px;
  width: 20px;
  height: 20px;
  background-color: #F5F5F7;
  border-radius: 50%;
  transform: translateY(-50%);
  transition: left 0.3s, background-color 0.3s;
}

.notif-toggle__circle.active {
  left: 30px;
  background-color: #546FFF;
}

.notif-toggle__label {
  color: #333;
  font-weight: bold;
}
</style>