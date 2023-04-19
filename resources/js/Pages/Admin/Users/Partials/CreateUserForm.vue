<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import {useForm} from '@inertiajs/vue3'
import FileInput from "@/Components/FileInput.vue"
import SelectInput from "@/Components/SelectInput.vue"

const props = defineProps({
    roles: {
        type: Array,
    },
})

const form = useForm({
    name: null,
    email: null,
    role: null,
    password: null,
    password_confirmation: null,
    avatar: null,
})

const submitForm = () => {
    form.post(route('admin.users.store'))
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Create new user</h2>
        </header>

        <form @submit.prevent="submitForm" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name"/>

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name"/>
            </div>

            <div>
                <InputLabel for="email" value="Email"/>

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div>
                <InputLabel for="role" value="Role"/>

                <SelectInput
                    id="role"
                    type="role"
                    class="mt-1 block w-full"
                    v-model="form.role"
                    required
                    autofocus
                    :options="roles"
                    option-label="name"
                    option-value="id"
                />

                <InputError class="mt-2" :message="form.errors.role"/>
            </div>

            <div>
                <InputLabel for="password" value="Password"/>

                <TextInput
                    id="password"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.password"/>
            </div>

            <div>
                <InputLabel for="password_confirmation" value="Confirm Password"/>

                <TextInput
                    id="password_confirmation"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation"/>
            </div>

            <div>
                <InputLabel for="avatar" value="Avatar"/>

                <FileInput
                    id="avatar"
                    class="mt-1 block w-full"
                    v-model="form.avatar"
                />

                <InputError class="mt-2" :message="form.errors.avatar"/>
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
