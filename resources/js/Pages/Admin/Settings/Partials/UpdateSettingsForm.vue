<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import {useForm} from '@inertiajs/vue3'
import FileInput from "@/Components/FileInput.vue"

const props = defineProps({
    settings: {
        type: Object,
    },
})

const form = useForm({
    _method: 'patch',
    site_name: props.settings.site_name,
    mail_from: props.settings.mail_from,
    logo: props.settings.logo,
})

const submitForm = () => {
    form.post(route('admin.settings.update'))
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">General Settings</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your website's general settings.
            </p>
        </header>

        <form @submit.prevent="submitForm" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name"/>

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.site_name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.site_name"/>
            </div>

            <div>
                <InputLabel for="email" value="Email"/>

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.mail_from"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.mail_from"/>
            </div>

            <div>
                <InputLabel for="logo" value="Logo"/>

                <FileInput
                    id="logo"
                    class="mt-1 block w-full"
                    v-model="form.logo"
                />

                <InputError class="mt-2" :message="form.errors.logo"/>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
