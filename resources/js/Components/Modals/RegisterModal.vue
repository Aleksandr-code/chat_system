<script setup>
import LogoIcon from '../images/LogoIcon.vue'
import {ref} from 'vue'
import {useRouter} from 'vue-router'
import useAuth from "../../services/authState";
import axios from "axios";

const $router = useRouter(),
    $auth = useAuth();

const _name = ref(''),
    _email = ref(''),
    _password = ref(''),
    _password_comfirmation = ref('')

function registration(){
    axios.post('/auth/register', {name: _name.value, email: _email.value, password: _password.value, password_comfirmation: _password_comfirmation.value}).then(res => {
        register_modal.close();
        $auth.isAuthenticated = true;
        axios.get('/api/user').then(res => {
            $auth.user = res.data
        })
        localStorage.setItem('isLoggedin', true)
        $router.push({name: 'user.profile'});
    }).catch(err => {
        if(err.response){
            console.log(err.response.data.message)
        }
    })
}

</script>

<template>
    <dialog id="register_modal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <div class="text-right">
                    <button class="outline-none">
                        <svg class="h-5 w-5 hover:fill-stone-400" xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 460.775 460.775" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55
                                c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55
                                c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505
                                c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55
                                l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719
                                c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"/>
                        </svg>
                    </button>
                </div>
            </form>
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <logo-icon class="mx-auto h-24 w-auto"></logo-icon>
                <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Registration</h2>
            </div>
            <div class="my-6 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="#" method="POST">
                    <div>
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                        <div class="mt-2">
                            <input id="name" v-model="_name" name="name" type="text" required="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6 pl-1" />
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input id="email" v-model="_email" name="email" type="email" autocomplete="email" required="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6 pl-1" />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" v-model="_password" name="password" type="password" autocomplete="current-password" required="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6 pl-1" />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password_comfirmation" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        </div>
                        <div class="mt-2">
                            <input id="password_comfirmation" v-model="_password_comfirmation" name="password_comfirmation" type="password" required="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6 pl-1" />
                        </div>
                    </div>
                    <div>
                        <button type="submit" @click.prevent="registration" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Зарегистрироваться</button>
                    </div>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>

<style scoped>

</style>
