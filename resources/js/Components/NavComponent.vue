<script setup>

</script>

<template>
    <div class="hero bg-base-200">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <ul class="menu menu-vertical lg:menu-horizontal bg-base-100 rounded-box">
                    <li><RouterLink :to="{name:'user.profile'}">Профиль</RouterLink></li>
                    <li><RouterLink :to="{name:'user.chats'}">Мои чаты (㋛)</RouterLink></li>
                    <li><RouterLink :to="{name:'chats.create'}">Создать новый чат</RouterLink></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
