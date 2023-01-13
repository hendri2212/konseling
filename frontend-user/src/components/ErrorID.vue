<template>
    <div class="container mt-5">
        <div class="alert alert-danger py-5" role="alert">{{ message }}</div>
        <div class="text-center">
            <router-link :to="{ name: 'Dashboard' }" class="btn btn-primary px-5 py-2">Lanjut</router-link>
        </div>
    </div>
</template>
<script>
export default {
    name: "ErrorID",
    props: {
        message: {
            type: String,
            default: "Server error !"
        }
    }
}
</script>