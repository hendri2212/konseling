<template>
    <div>
        <CCard accent-color="primary">
            <CCardHeader>
                Angket semester genap 2022

                <div class="card-header-actions">
                    <!-- <CButton color="primary" @click="$refs.addModal.setModal(true)">Tambah Angket</CButton>
                    <AddModal @saved="saved" ref="addModal"></AddModal> -->
                </div>
            </CCardHeader>

            <CCardBody>
                <CNav variant="tabs">
                    <CNavItem :active="$route.name == 'Setelan'">
                        <router-link class="nav-link" :to="{ name: 'Setelan', query: { id: id } }">Setelan</router-link>
                    </CNavItem>
                    <CNavItem :active="$route.name == 'Hasil'">
                        <router-link class="nav-link" :to="{ name: 'Hasil', query: { id: id } }">Hasil</router-link>
                    </CNavItem>
                </CNav>
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>
            </CCardBody>
        </CCard>
        <Loading ref="loading"></Loading>
    </div>
</template>

<script>
import Loading from '@/components/Loading.vue'
export default {
    name: "AngketView",
    components: {
        Loading,
    },
    computed: {
        id() {
            return this.$route.query.id
        }
    }
}
</script>
<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.nav-item>.nav-link {
    padding: 0;
}
</style>