<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import {Head, router} from '@inertiajs/vue3'
import DangerButton from "@/Components/DangerButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import Table from "@/Components/Table.vue"
import FlashMessage from "@/Components/FlashMessage.vue"

defineProps({
    roles: {
        type: Array
    },
    columns: {
        type: Array
    },
})
</script>

<template>
    <Head title="Roles" />

    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <Table
                        create-route="admin.roles.create"
                        destroy-route="admin.roles.destroy"
                        edit-route="admin.roles.edit"
                        :columns="columns"
                        :items="roles"
                    />

                </div>
            </div>
        </div>
    </AdminLayout>
</template>
