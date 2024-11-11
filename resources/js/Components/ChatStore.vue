<script setup>

</script>

<template>

    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Создать новый чат</h1>
    <input type="text" placeholder="Название чата" class="input input-bordered w-full my-5"/>
    <fieldset>
        <legend class="text-sm/6 font-semibold text-gray-900">Тип чата</legend>
        <p class="mt-1 text-sm/6 text-gray-600">Доступ аудитории к чату</p>
        <div class="mt-4 space-y-4">
            <div class="flex items-center gap-x-3">
                <input id="type-public" name="type" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                <label for="type-public" class="block text-sm/6 font-medium text-gray-900">Публичный</label>
            </div>
            <div class="flex items-center gap-x-3">
                <input id="type-private" name="type" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                <label for="type-private" class="block text-sm/6 font-medium text-gray-900">Приватный</label>
            </div>
        </div>
    </fieldset>
    <div class="my-5">
        <input type="password" placeholder="password" class="input input-bordered w-full max-w-xs" />
    </div>
    <button class="btn btn-primary">Создать</button>

</template>

<style scoped>

</style>
