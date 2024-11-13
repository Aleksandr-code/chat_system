import {createRouter, createWebHistory} from "vue-router";
import useAuth from "../services/authState";

const $auth = useAuth()

const routes = [
    {
        path: '/',
        component: () => import('../Components/ChatList.vue'),
        name:'chats.index'
    },
    {
        path: '/dashboard/chats',
        component: () => import('../Components/UserChats.vue'),
        name:'user.chats'
    },
    {
        path: '/dashboard/profile',
        component: () => import('../Components/Profile.vue'),
        name: 'user.profile'
    },
    {
        path: '/dashboard/chat/create',
        component: () => import('../Components/ChatStore.vue'),
        name:'chats.create'
    },
    {
        path: '/dashboard/chat/:id',
        component: () => import('../Components/ChatMessagesShow.vue'),
        name:'chats.show'
    },
    {
        path: '/:catchAll(.*)',
        component: () => import('../Components/NotFound.vue'),
        name: '404'
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to, from) => {
    if(!$auth.isAuthenticated && to.name !== 'chats.index'){
        return {name: 'chats.index'}
    }
})

export default router
