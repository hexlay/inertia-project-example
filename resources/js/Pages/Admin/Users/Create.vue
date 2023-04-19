<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
import UpdateUserForm from "./Partials/UpdateUserForm.vue"
import CreateUserForm from "@/Pages/Admin/Users/Partials/CreateUserForm.vue"

defineProps({
    roles: {
        type: Array,
    },
})
</script>

<template>
    <Head title="Create user" />

    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <CreateUserForm
                        class="max-w-xl"
                        :roles="roles"
                    />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
