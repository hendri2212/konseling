<template>
    <div v-if="!error" class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <sidebar></sidebar>
            <div class="layout-page">
                <navbar></navbar>
                <slot></slot>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <ErrorID v-else :message="message"></ErrorID>
</template>
<script>
import Navbar from '@/components/Navbar.vue'
import Sidebar from '@/components/Sidebar.vue'
import ErrorID from '@/components/ErrorID.vue'
export default {
    name: "LayoutDefault",
    components: {
        Navbar,
        Sidebar,
        ErrorID,
    },
    props: {
        error: {
            type: Boolean,
            default: false,
        },
        message: String,
    },
    mounted() {
        if (!document.getElementById('main_script_for_template')) {
            let externalScript = document.createElement('script')
            externalScript.setAttribute('id', 'main_script_for_template')
            externalScript.setAttribute('src', '/src/assets/js/main.js')
            document.head.appendChild(externalScript)
        }
    },
}
</script>