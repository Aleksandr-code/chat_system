<script setup>

import {onMounted, ref} from "vue";
import {useRoute} from 'vue-router'
import useAuth from "../services/authState";
import axios from "axios";

const $route = useRoute(),
    $auth = useAuth()

const _messages = ref([]),
    _message = ref(''),
    _isLoading = ref(false)


async function getMessages(){
    _isLoading.value = true
    await axios.get(`/chat/${$route.params.id}`).then(res => {
        console.log(res.data)
        _messages.value = res.data
    })
    _isLoading.value = false
}

function storeMessage(){
    axios.post(`/chat/${$route.params.id}/message`, {content: _message.value}).then(res => {
        //console.log(res.data)
        // edit push date and user
        _messages.value.push(res.data)
    })
    _message.value= ''
}

function connectToMessageChannel(){
    // type => public
    Echo.channel(`chats.${$route.params.id}`)
        .listen('.message.sent', (e) => {
        console.log('public')
        console.log(e)
        _messages.value.push(e.data)
    })
    // type => private
    /*Echo.private(`chats.${$route.params.id}`)
        .listen('.message.sent', (e) => {
            console.log('private')
            console.log(e)
            _messages.value.push(e.data)
        })
     */
}

onMounted(() => {
    getMessages()
    connectToMessageChannel()
})

</script>

<template>
        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl my-2 border-b-4 border-gray-500">Чат: name</h1>
        <div class="messages flex flex-col justify-between mb-5">
            <div v-if="_isLoading">Loading ...</div>
            <div v-else-if="_messages.length !== 0" class="chats">
                <template v-for="message in _messages" :key="message.id">
                    <div  class="chat" :class="Number(message.user_id) === $auth.user.id ? 'chat-end' : 'chat-start' ">
                        <div class="chat-header">
                            {{message.user_name}}
                            <time class="text-xs opacity-50">({{message.created_at}})</time>
                        </div>
                        <div class="chat-bubble">{{message.content}}</div>
                    </div>
                </template>
            </div>
            <div v-else class="chats">
                <div  class="chat chat-start">
                    <div class="chat-header">
                        chat-system
                    </div>
                    <div class="chat-bubble italic">В этом чате ещё нет сообщений</div>
                </div>
            </div>
            <div class="flex my-5 max-w-3xl w-full">
                <textarea v-model="_message" class="textarea textarea-bordered mr-5 h-5 w-full" placeholder="Text ..."></textarea>
                <button @click.prevent="storeMessage" class="btn">Отправить</button>
            </div>
        </div>

</template>

<style scoped>
.messages {
    min-height:calc(100vh - 250px);
}
</style>
