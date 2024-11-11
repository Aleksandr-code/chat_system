<script setup>

</script>

<template>
        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-2xl my-2">Чат: name</h1>
        <div class="messages flex flex-col justify-between mb-5">
            <div class="chats">
                <div class="chat chat-start">
                    <div class="chat-header">
                        Obi-Wan Kenobi
                        <time class="text-xs opacity-50">2 hours ago</time>
                    </div>
                    <div class="chat-bubble">You were the Chosen One!</div>
                </div>
                <div class="chat chat-end">
                    <div class="chat-header">
                        Obi-Wan Kenobi
                        <time class="text-xs opacity-50">2 hour ago</time>
                    </div>
                    <div class="chat-bubble">I loved you.</div>
                </div>
            </div>
            <div class="flex my-5 max-w-3xl w-full">
                <textarea class="textarea textarea-bordered mr-5 h-5 w-full" placeholder="Text ..."></textarea>
                <button class="btn">Отправить</button>
            </div>
        </div>

</template>

<style scoped>
.messages {
    min-height:calc(100vh - 240px);
}
</style>
