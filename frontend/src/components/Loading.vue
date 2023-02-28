<template>
    <CModal :backdrop="true" :fade="true" :closeOnBackdrop="false" :centered="true" :show.sync="loading_data">
        <template #header-wrapper>
            <div></div>
        </template>
        <template #footer-wrapper>
            <div></div>
        </template>
        <div class="d-flex flex-column justify-content-center align-items-center p-5">
            <CSpinner color="primary" style="width:3rem; height:3rem;" />
            <div class="pt-2">Loading ...</div>
        </div>
    </CModal>
</template>
<script>
export default {
    props: {
        loading: Boolean
    },
    data() {
        return {
            loading_data: this.loading
        }
    },
    mounted() {
        this.$watch(
            () => this.loading,
            (v) => {
                this.loading_data = v
            },
            {immediate: true}
        )
    }
}
</script>