<template>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <sidebar></sidebar>
            <div class="layout-page">
                <navbar></navbar>
                <slot></slot>
            </div>
        </div>
    </div>
</template>
<script>
import Navbar from '@/components/Navbar.vue'
import Sidebar from '@/components/Sidebar.vue'
export default {
    name: "LayoutDefault",
    components: {
        Navbar,
        Sidebar,
    }
}
</script>