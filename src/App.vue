<template>
  <div id="app">
    <BulletScreenWindow
      v-for="(topicKey, index) in topicArr"
      :key="index"
      :topic="topicKey"
      :messages="messages[topicKey]"
    ></BulletScreenWindow>
  </div>
</template>

<script>
import BulletScreenWindow from "./components/BulletScreenWindow.vue";
import mqtt from "mqtt";

export default {
  name: "App",
  components: {
    BulletScreenWindow,
  },
  data() {
    return {
      client: null,
      config: {
        // host: "broker.emqx.io",
        host: "127.0.0.1",
        port: 8083,
      },
      messages: {},
      topicArr: [],
      topicObj: {},
    };
  },
  methods: {
    init() {
      for (let i = 1; i <= 5; i++) {
        this.topicArr.push("vue/mqtt/test/" + i);
        this.topicObj["vue/mqtt/test/" + i] = "vue/mqtt/test/" + i;
        this.messages["vue/mqtt/test/" + i] = [];
      }

      try {
        let connectUrl = `ws://${this.config.host}:${this.config.port}/mqtt`;
        this.client = mqtt.connect(connectUrl, {
          clientId: "this.clientId",
          clean: false,
        });

        this.client.on("connect", () => {
          console.log("Connection succeeded!");
          this.client.subscribe(this.topicArr);
        });

        this.client.on("error", (err) => {
          console.log("Connection failed", err);
        });

        this.client.on("message", (topic, message) => {
          // console.log(topic, message);
          this.messages[topic].unshift(new TextDecoder().decode(message));
          if (this.messages[topic].length > 10) {
            this.messages[topic].pop();
          }
        });
      } catch (error) {
        console.log("mqtt.connect error", error);
      }
    },
  },
  mounted: function () {
    this.init();
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin: 0 auto;
  margin-top: 10px;
}
</style>
