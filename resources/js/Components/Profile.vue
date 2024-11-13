<script setup>
import {ref, onMounted} from "vue";
import axios from "axios";
import useAuth from "../services/authState";

const _name = ref(''),
    _email = ref(''),
    $auth = useAuth()

function getUser(){
    axios.get('/api/user').then(res => {
        _name.value = res.data.name
        _email.value = res.data.email
    })
}

function updateUser(){
    console.log($auth)
    alert('Coming soon!')
}

onMounted(() => {
    getUser()
})

</script>

<template>
    <!-- Функционал для профиля отсутствует -->
    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl my-5">Профиль: информация</h1>
    <div class="my-2">
        <input type="text" v-model="_name" placeholder="Имя" class="input input-bordered w-full max-w-xl"/>
    </div>
    <div class="my-5">
        <input type="email" v-model="_email" placeholder="Email" class="input input-bordered w-full max-w-xl bg-stone-100" disabled/>
    </div>
    <div class="col-span-full my-5">
        <label for="photo" class="block text-sm/6 font-medium text-gray-900">Фото</label>
        <div class="mt-2 flex items-center gap-x-3">
            <img class="h-12 w-12 text-gray-300" aria-hidden="true" />
            <!--<input type="file" id="photo">-->
            <button @click.prevent="updateUser" type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Изменить</button>
        </div>
    </div>
    <button @click.prevent="updateUser" class="btn btn-primary">Сохранить</button>
</template>

<style scoped>

</style>
