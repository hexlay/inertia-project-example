<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue"
import UpdateSettingsForm from "./Partials/UpdateSettingsForm.vue"
import { Head } from '@inertiajs/vue3'

defineProps({
    settings: {
        type: Object,
    },
})
</script>

<template>
    <Head title="Settings" />

    <AdminLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateSettingsForm
                        class="max-w-xl"
                        :settings="settings"
                    />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
