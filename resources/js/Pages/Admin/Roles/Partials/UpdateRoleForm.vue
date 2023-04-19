<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import {useForm} from '@inertiajs/vue3'
import FileInput from "@/Components/FileInput.vue"
import Toggle from "@/Components/Toggle.vue"

const props = defineProps({
    role: {
        type: Object,
    },
    permissions: {
        type: Array,
    },
})

const form = useForm({
    _method: 'patch',
    id: props.role.id,
    name: props.role.name,
    permissions: props.role.permissions.map(e => e.id)
})

const submitForm = () => {
    form.post(route('admin.roles.update', props.role.id))
}

const checkEvent = (event, permission) => {
    if (event && !form.permissions.includes(permission)) {
        form.permissions.push(permission)
    } else {
        const index = form.permissions.indexOf(permission)
        form.permissions.splice(index, 1)
    }
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">General</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your role.
            </p>
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
                <h2 class="mb-2 text-md font-semibold text-gray-900 dark:text-white">Permissions</h2>
                <ul class="list-none">
                    <li v-for="permission in permissions" >
                        <Toggle @update:checked="checkEvent($event, permission.id)" :checked="role.permissions.some(e => e.id === permission.id)" :text="permission.name.toUpperCase()" />
                    </li>
                </ul>
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
