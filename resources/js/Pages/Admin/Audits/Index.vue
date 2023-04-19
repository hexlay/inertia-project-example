<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import {Head, router} from '@inertiajs/vue3'
import SecondaryButton from "@/Components/SecondaryButton.vue"
import Table from "@/Components/Table.vue"

defineProps({
    audits: {
        type: Array
    },
    columns: {
        type: Array
    },
})
</script>

<template>
    <Head title="Audits"/>

    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <Table
                        view-route="admin.audits.show"
                        :columns="columns"
                        :items="audits"
                    />

                </div>
            </div>
        </div>
    </AdminLayout>
</template>
