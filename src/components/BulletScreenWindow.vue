<template>
  <div class="bullet-screen-window">
    <div class="topic">Topic: {{ topic }}</div>
    <div class="message">
      <p v-for="(msg, index) in childMessages" :key="index">{{ msg }}</p>
    </div>
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
  float: left;
  width: 300px;
  padding: 15px;
  margin: 10px;
  border: 1px solid #ccc;
}
</style>
