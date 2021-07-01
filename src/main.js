import Vue from 'vue'
import App from './App.vue'
import { vueBaberrage } from 'vue-baberrage'

Vue.config.productionTip = false

new Vue({
    render: h => h(App),
}).$mount('#app')

Vue.use(vueBaberrage)