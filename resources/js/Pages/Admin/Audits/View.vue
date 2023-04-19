<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import {Head} from '@inertiajs/vue3'

defineProps({
    audit: {
        type: Array
    }
})
</script>

<template>
    <Head title="Audits"/>

    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <header>
                    <h2 class="self-center text-lg font-medium text-gray-900">General Information</h2>
                </header>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="relative overflow-x-auto">
                        <ul class="max-w-7xl space-y-1 text-black-500 list-disc list-inside dark:text-gray-400">
                            <li>
                                Author: {{ audit.author }}
                            </li>
                            <li>
                                Event: {{ audit.event }}
                            </li>
                            <li>
                                Target: {{ audit.target }}
                            </li>
                            <li>
                                URL: {{ audit.url }}
                            </li>
                            <li>
                                IP Address: {{ audit.ip_address }}
                            </li>
                            <li>
                                User Agent: {{ audit.user_agent }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">Changes</h2>
                </header>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="relative overflow-x-auto">
                        <h2 class="mb-2 text-md font-semibold text-gray-900 dark:text-white">Old Values</h2>
                        <ul class="max-w-md space-y-1 text-black-500 list-disc list-inside dark:text-gray-400">
                            <li v-for="(value, key) in Object.values(audit.old_values)" :key="key">
                                {{ Object.keys(audit.old_values)[key] }}: {{ value ?? 'null' }}
                            </li>
                        </ul>
                        <h2 class="mt-5 mb-2 text-md font-semibold text-gray-900 dark:text-white">New Values</h2>
                        <ul class="max-w-md space-y-1 text-black-500 list-disc list-inside dark:text-gray-400">
                            <li v-for="(value, key) in Object.values(audit.new_values)" :key="key">
                                {{ Object.keys(audit.new_values)[key] }}: {{ value }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
