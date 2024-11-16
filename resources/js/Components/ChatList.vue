<script setup>

import {onMounted, onUpdated, ref} from 'vue'
import {useRouter} from 'vue-router'
import axios from "axios";
import useAuth from "../services/authState";
import ChatPrivateModal from "./Modals/ChatPrivateModal.vue"

const $router = useRouter(),
    $auth = useAuth()
const _chat_list = ref([]),
    _chat_join_id = ref()

const IS_PUBLIC = 'public'
const IS_PRIVATE = 'private'



function getChats(){
    // Тип отредактировать
    axios.get('/chat')
        .then(res => {
            console.log(res.data)
            _chat_list.value = res.data
        })
}

async function inputInChat(chat_id, chat_type){
    // проверка аутентифицирован ли пользователь
    if(!$auth.isAuthenticated){
        alert('вход в чат доступен только авторизованных пользователям')
        return false
    }
    // Проверить состоит ли пользователь в чате
    const userHasChat = await axios.get('/dashboard/user/chats')
        .then(res => {
            const hasChat = res.data.some((chat) => {
                return chat.id === chat_id
            })
            if(hasChat){
                $router.push({name:'chats.show', params:{id: chat_id}})
            }
            return hasChat;
        })
    // Если нет, проверка на тип чата -> модальная форма
    if(!userHasChat){
        if(chat_type === IS_PRIVATE){
            document.querySelector('#chat_private_modal').showModal()
            _chat_join_id.value = chat_id
        } else {
            await joinToChat(chat_id, '')
        }
    }
}

function passwordGetEmit(password){
    joinToChat(_chat_join_id.value, password)
}

function joinToChat(chat_id, password = ''){
    // присоединение к чату
    axios.post('/chat/sign', {chatId: chat_id, userId: $auth.user.id, password: password}).then(res => {
        console.log(res)
        $router.push({name:'chats.show', params:{id: chat_id}})
    })
}

onMounted(() => {
    getChats()
})


</script>

<template>
    <div class="chats">
        <div class="chats-filter">
            <label class="input input-bordered flex items-center gap-2">
                <input type="text" class="grow" placeholder="Введите имя чата ..." />
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path
                        fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
            </label>
        </div>
        <div class="chat-table">
            <ul role="list" class="divide-y divide-gray-400">
                <li v-for="chat in _chat_list" :key="chat.id"  class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <div class="flex items-start gap-x-3">
                                <p class="text-sm/6 font-semibold text-gray-900">{{chat.title}}</p>
                                <p v-if="chat.type === 'public'" class="ring-green-600 ring-1 shadow-inner text-green-700 font-medium text-xs py-0.5 px-1.5 bg-green-50 rounded-md whitespace-nowrap mt-0.5">Public</p>
                                <p v-if="chat.type === 'private'" class="ring-red-600 ring-1 shadow-inner text-red-700 font-medium text-xs py-0.5 px-1.5 bg-red-50 rounded-md whitespace-nowrap mt-0.5">Private</p>
                            </div>
                            <div class="flex flex-nowrap mt-1 items-center gap-x-2 truncate text-xs/5 text-gray-500">
                                <p>
                                    Дата: <time :datetime="chat.created_at">{{chat.created_at}}</time>
                                </p>
                                <svg viewBox="0 0 2 2" class="fill-current h-0.5 w-0.5">
                                    <circle r="1" cx="1" cy="1"></circle>
                                </svg>
                                <p>Админ: {{ chat.user_name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-none gap-6 justify-between items-center">
                        <button @click="inputInChat(chat.id, chat.type)" class="btn btn-sm btn-outline">Войти</button>
                        <div class="flex gap-2 items-center text-gray-500">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path></svg>
                            <dd class="text-sm pb-px">{{chat.users_count}}</dd>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <chat-private-modal @pass-input="passwordGetEmit"></chat-private-modal>
</template>

<style scoped>

</style>
