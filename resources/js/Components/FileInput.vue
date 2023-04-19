<script setup>
import {onMounted, ref} from 'vue'
import SecondaryButton from "@/Components/SecondaryButton.vue"
import DangerButton from "@/Components/DangerButton.vue"

defineProps({
    modelValue: {
        required: true,
    }
})

const emit = defineEmits(['update:modelValue'])

const input = ref(null)

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus()
    }
})

const openUrl = (url) => {
    window.open(url, '_blank')
}

const clear = () => {
    emit('update:modelValue', null)
    input.value.value = null
}

defineExpose({focus: () => input.value.focus()})
</script>

<template>
    <input
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        type="file"
        @input="$emit('update:modelValue', $event.target.files[0])"
        ref="input"
    />

    <div class="mt-2" v-if="modelValue">
        <SecondaryButton class="mr-2" @click="openUrl(modelValue)">Preview File</SecondaryButton>
        <DangerButton @click="clear">Remove File</DangerButton>
    </div>
</template>
