<script setup>
import {usePage} from "@inertiajs/vue3"
import {watch} from "vue"
import {useToast} from "vue-toastification"

const toast = useToast()

watch(() => usePage().props.messages.flash, message => {

    toast[message.type](message.text, {
        position: "bottom-right",
        timeout: 5000,
        closeOnClick: true,
        pauseOnFocusLoss: true,
        pauseOnHover: true,
        draggable: true,
        draggablePercent: 0.5,
        showCloseButtonOnHover: true,
        hideProgressBar: true,
        closeButton: "button",
        icon: true,
        rtl: false,
    })

}, {deep: true})
</script>
