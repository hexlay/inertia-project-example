<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
import UpdateRoleForm from "./Partials/UpdateRoleForm.vue"

defineProps({
    role: {
        type: Object,
    },
    permissions: {
        type: Array,
    },
})
</script>

<template>
    <Head title="Update role" />

    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateRoleForm
                        class="max-w-xl"
                        :role="role"
                        :permissions="permissions"
                    />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
