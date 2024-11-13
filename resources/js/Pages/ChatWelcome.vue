<script setup>
import HeaderComponent from "../Components/Header.vue"
import NavComponent from "../Components/NavComponent.vue";
import QuoteComponent from "../Components/QuoteComponent.vue";
import {onMounted, onUpdated, ref} from 'vue'
import useAuth from "../services/authState";
import axios from "axios";

const $auth = useAuth()

</script>

<template>
    <div class="container mx-auto">

        <header-component></header-component>

        <quote-component v-if="!$auth.isAuthenticated"></quote-component>
        <nav-component v-if="$auth.isAuthenticated"></nav-component>

        <main class="mx-auto max-w-3xl pt-5">
            <router-view></router-view>
        </main>

    </div>
</template>

<style scoped>

</style>
