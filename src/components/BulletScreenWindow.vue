<template>
  <div class="bullet-screen-window">
    <div class="topic">Topic: {{ topic }}</div>
    <!-- <div class="message">
      <p v-for="(msg, index) in childMessages" :key="index">{{ msg }}</p>
    </div> -->
    <vue-baberrage
      :barrageList="childMessages"
      :isShow="barrageIsShow"
      :loop="barrageLoop"
    >
    </vue-baberrage>
  </div>
</template>

<script>
export default {
  name: "bulletScreenWindow",
  props: {
    topic: String,
    messages: Array,
  },
  data() {
    return {
      childMessages: this.messages,
      barrageIsShow: true,
      barrageLoop: false,
    };
  },
  watch: {
    messages: function (newVal) {
      this.childMessages = newVal;
    },
  },
};
</script>

<style scoped>
.bullet-screen-window {
  height: 300px;
  margin: 0 0 10px 0;
  border: 1px solid #ccc;
}
</style>
