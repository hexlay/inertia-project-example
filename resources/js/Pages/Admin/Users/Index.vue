<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import {Head} from '@inertiajs/vue3'
import Table from "@/Components/Table.vue"

defineProps({
    users: {
        type: Array
    },
    columns: {
        type: Array
    },
})
</script>

<template>
    <Head title="Users"/>

    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <Table
                        more-customization
                        create-route="admin.users.create"
                        destroy-route="admin.users.destroy"
                        edit-route="admin.users.edit"
                        :columns="columns"
                        :items="users"
                    >
                        <template #cell(user)="{ value, item }">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <img class="w-10 h-10 rounded-full" :src="item.avatar" :alt="item.name">
                                <div class="pl-3">
                                    <div class="text-base font-semibold">{{ item.name }}</div>
                                    <div class="font-normal text-gray-500">{{ item.email }}</div>
                                </div>
                            </th>
                        </template>
                        <template #cell(role)="{ value, item }">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ item.current_role.name }}
                            </th>
                        </template>
                    </Table>

                </div>
            </div>
        </div>
    </AdminLayout>
</template>
