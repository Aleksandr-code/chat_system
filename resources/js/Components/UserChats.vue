<script setup>

</script>

<template>
    <div class="chat-table">
        <ul role="list" class="divide-y divide-gray-400">
            <li class="flex justify-between gap-x-6 py-5">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <div class="flex items-start gap-x-3">
                            <p class="text-sm/6 font-semibold text-gray-900">Name Chat</p>
                            <p class="ring-green-600 ring-1 shadow-inner text-green-700 font-medium text-xs py-0.5 px-1.5 bg-green-50 rounded-md whitespace-nowrap mt-0.5">Public</p>
                            <p class="ring-red-600 ring-1 shadow-inner text-red-700 font-medium text-xs py-0.5 px-1.5 bg-red-50 rounded-md whitespace-nowrap mt-0.5">Private</p>
                        </div>
                        <div class="flex flex-nowrap mt-1 items-center gap-x-2 truncate text-xs/5 text-gray-500">
                            <p>
                                Дата: <time datetime="2023-01-23T22:34Z">2d ago</time>
                            </p>
                            <svg viewBox="0 0 2 2" class="fill-current h-0.5 w-0.5">
                                <circle r="1" cx="1" cy="1"></circle>
                            </svg>
                            <p>Админ: Name User</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-none gap-6 justify-between items-center">
                    <button class="btn btn-sm btn-outline">Войти</button>
                    <div class="flex gap-2 items-center text-gray-500">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path></svg>
                        <dd class="text-sm pb-px">1</dd>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<style scoped>

</style>
