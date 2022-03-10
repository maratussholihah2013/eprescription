import { createRouter, createWebHistory } from 'vue-router'

import createResep from "./pages/createResep.vue";
import showResep from "./pages/showResep.vue";
import reseps from "./pages/reseps.vue";

const routes = [
    {
      path:"/eprescription/public/resep",
      name: "AllResep",
      component: reseps,
    },    
    {
      path:"/eprescription/public/resep/create",
      name: "CreateResep",
      component: createResep,
    },

    {
      path:"/eprescription/public/resep/:id",
      name: "ShowResep",
      component: showResep,
      props: true,
    },
	
    {
        path: '/eprescription/public/',
        redirect: "/eprescription/public/resep"
    },
  ]

const router = createRouter({
  history: createWebHistory(),
  routes,
  linkActiveClass:'active'
})

export default router 