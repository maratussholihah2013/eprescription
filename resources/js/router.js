import { createRouter, createWebHistory } from 'vue-router'

import createResep from "./pages/createResep.vue";
import showResep from "./pages/showResep.vue";

const routes = [
  	{
  	  path:"/eprescription/public/",
  	  name: "CreateResep",
  	  component: createResep,
  	},

    {
      path:"/eprescription/public/resep/:id",
      name: "ShowResep",
      component: showResep,
      props: true,
    },
	/*
    {
        path: '/:pathMatch(.*)*',
        redirect: "/"
    },*/
  ]

const router = createRouter({
  history: createWebHistory(),
  routes,
  linkActiveClass:'active'
})

export default router 