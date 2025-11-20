import { createRouter, createWebHistory } from 'vue-router'
import Login from '../Auth/Login.vue'
import Register from '../Auth/Register.vue'
import Kategori from '../Pages/Kategori.vue'
import home from '../Pages/home.vue'
import tugas from '../Pages/tugas.vue'
import "@fortawesome/fontawesome-free/css/all.min.css";

// import home from '../Pages/home.vue'
const routes = [
  { path: '/', component: home },
  { path: '/login', component: Login },
  { path: '/registrasi', component: Register },
  { path: '/kategori', component: Kategori },
  { path: '/tugas', component: tugas },


]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
