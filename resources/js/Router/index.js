import { createRouter, createWebHistory } from 'vue-router'
import Login from '../Auth/Login.vue'
import Register from '../Auth/Register.vue'
import Kategori from '../Pages/Kategori.vue'
import home from '../Pages/home.vue'
import tugas from '../Pages/tugas.vue'
import CreateTugasPage from '../Public/CreateTugasPage.vue'
import "@fortawesome/fontawesome-free/css/all.min.css";
import CreateKategoriPage from '../Public/CreateKategoriPage.vue'

// import home from '../Pages/home.vue'
const routes = [
  { path: '/', component: home },
  { path: '/login', component: Login },
  { path: '/registrasi', component: Register },
  { path: '/kategori', component: Kategori },
  { path: '/tugas', component: tugas },
  { path: '/Create_Tugas', component: CreateTugasPage },
  { path: '/Create_kategori', component: CreateKategoriPage },



]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
