import { createRouter, createWebHistory } from 'vue-router'

import createResep from "./pages/createResep.vue";

const routes = [
  	{
	  path:"/eprescription/public/",
	  name: "CreateResep",
	  component: createResep,
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