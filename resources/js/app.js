import './bootstrap'
import { createApp } from 'vue'
import ExampleComponent from './components/ExampleComponent.vue'
import TableUserComponent from './components/User/TableUserComponent.vue'
import TableUser from './components/User/TableUser.vue'


const app = createApp({
    components: {
        ExampleComponent,
        TableUserComponent,
        TableUser



    }
})

app.mount('#app')