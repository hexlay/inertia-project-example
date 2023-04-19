<script setup>
import {router} from '@inertiajs/vue3'
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"
import DangerButton from "@/Components/DangerButton.vue"

defineProps({
    viewRoute: {
        type: String,
        default: null,
    },
    editRoute: {
        type: String,
        default: null,
    },
    destroyRoute: {
        type: String,
        default: null,
    },
    createRoute: {
        type: String,
        default: null,
    },
    columns: {
        type: Array,
        default: [],
    },
    items: {
        type: Array,
        default: [],
    },
    moreCustomization: {
        type: Boolean,
        default: false,
    }
})
</script>

<template>
    <div class="relative overflow-x-auto">

        <div v-if="createRoute" class="flex items-center justify-between py-4 bg-white dark:bg-gray-800">
            <div></div>
            <div class="relative">
                <PrimaryButton @click="router.visit(route(createRoute))">Create New</PrimaryButton>
            </div>
        </div>

        <div v-if="!items.length" class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
            No items found
        </div>

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th v-for="column in columns" scope="col" class="px-6 py-3">
                    {{ column }}
                </th>
                <th v-if="editRoute || destroyRoute || viewRoute" scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="item in items" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <template v-if="moreCustomization">
                    <template v-for="columnKey in Object.keys(columns)">
                        <slot
                            :name="`cell(${columnKey})`"
                            :value="item[columnKey]"
                            :item="item"
                        >
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ item[columnKey] }}
                            </th>
                        </slot>
                    </template>
                </template>
                <template v-else>
                    <th v-for="columnKey in Object.keys(columns)" scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <slot
                            :name="`cell(${columnKey})`"
                            :value="item[columnKey]"
                            :item="item"
                        >
                            {{ item[columnKey] }}
                        </slot>
                    </th>
                </template>
                <td v-if="editRoute || destroyRoute || viewRoute" class="px-6 py-4">
                    <SecondaryButton v-if="viewRoute" @click="router.visit(route(viewRoute, item.id))">View</SecondaryButton>
                    <SecondaryButton v-if="editRoute" @click="router.visit(route(editRoute, item.id))">Edit</SecondaryButton>
                    <DangerButton v-if="destroyRoute" @click="router.delete(route(destroyRoute, item.id))">Delete</DangerButton>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
