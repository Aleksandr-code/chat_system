<script setup>
import SignInModal from "./Modals/SignInModal.vue";
import RegisterModal from "./Modals/RegisterModal.vue"
import axios from "axios";
import {useRouter} from 'vue-router'
import useAuth from "../services/authState";

const $router = useRouter(),
    $auth = useAuth()

function logout(){
    axios.post('/auth/logout').then(res => {
        console.log(res)
        $auth.isAuthenticated = false;
        $auth.user = {}
        localStorage.setItem('isLoggedin', false)
        $router.push({name: 'chats.index'})
    })
}
</script>

<template>
    <header>
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <RouterLink :to="{name:'chats.index'}" class="btn btn-ghost text-xl">Chat-system</RouterLink>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li v-if="!$auth.isAuthenticated"><a onclick="signin_modal.showModal()">Log in</a></li>
                    <li v-if="!$auth.isAuthenticated"><a onclick="register_modal.showModal()">Register</a></li>
                    <li v-if="$auth.isAuthenticated">
                        <details>
                            <summary>{{$auth.user.name}}</summary>
                            <ul class="bg-base-100 rounded-t-none p-2">
                                <li><a @click.prevent="logout">Logout</a></li>
                            </ul>
                        </details>
                    </li>
                </ul>
            </div>

        </div>
    </header>

    <sign-in-modal></sign-in-modal>
    <register-modal></register-modal>

</template>

<style scoped>

</style>
