<template>
    <header>
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl">Chat-system</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li><a onclick="signin_modal.showModal()">Log in</a></li>
                    <li><a onclick="register_modal.showModal()">Register</a></li>
                </ul>
            </div>
        </div>
    </header>

    <sign-in-modal></sign-in-modal>
    <register-modal></register-modal>

</template>

<script setup>
import SignInModal from "./SignInModal.vue";
import RegisterModal from "./RegisterModal.vue"
</script>

<style scoped>

</style>
