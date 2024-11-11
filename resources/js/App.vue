<script setup>
import HeaderComponent from "./Components/Header.vue"
import NavComponent from "./Components/NavComponent.vue";
import ChatList from "./Components/ChatList.vue"
import ChatStore from "./Components/ChatStore.vue";
import Profile from "./Components/Profile.vue"
import UserChats from "./Components/UserChats.vue"
import ChatShow from "./Components/ChatShow.vue"
</script>

<template>
    <div class="container mx-auto">
        <header-component></header-component>
        <nav-component></nav-component>
        <main class="mx-auto max-w-3xl pt-5">
<!--            <chat-list></chat-list>-->
<!--            <chat-store></chat-store>-->
            <!--                        <profile></profile>-->
            <!--            <user-chats></user-chats>-->
           <chat-show></chat-show>
        </main>

    </div>
</template>

<style scoped>

</style>
