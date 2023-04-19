<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import {router} from "@inertiajs/vue3"
</script>

<template>
    <GuestLayout>
        This is a homepage and you are {{ $page.props.auth.user.name }}
        <div v-if="$page.props.auth.user.is_admin" class="grid">
            <hr class="mt-2 mb-2">
            <PrimaryButton @click="router.visit(route('admin.dashboard'))">View AdminCP</PrimaryButton>
        </div>
    </GuestLayout>
</template>
