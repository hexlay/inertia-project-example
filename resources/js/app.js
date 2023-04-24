import '../css/app.css'
import 'flowbite'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Toast, {
                transition: "Vue-Toastification__bounce",
                maxToasts: 20,
                newestOnTop: true
            })
            .use(ZiggyVue, Ziggy)
            .mount(el)
    },
    progress: {
        color: '#4B5563',
    },
})
