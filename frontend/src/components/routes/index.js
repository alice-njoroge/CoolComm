import {createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/categories',
            name: 'categories',
            component: () => import('@/components/ProductCategories/CategoryList.vue')
        },
        {
            path: '/categories/create',
            name: 'CategoryCreate',
            component: () => import('@/components/ProductCategories/CategoryCreate.vue')
        },
        {
            path: '/categories/edit/:id',
            name: 'CategoryEdit',
            component: () => import('@/components/ProductCategories/categoryEdit.vue')
        }
    ],

})

export default router;