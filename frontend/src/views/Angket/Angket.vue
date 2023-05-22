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

            <CNav variant="tabs">
                <CNavItem :active="$route.name == 'Hasil'">
                    <router-link class="nav-link" :to="{ name: 'Hasil', query: { id: id } }">Analisis
                        Siswa</router-link>
                </CNavItem>
                <CNavItem :active="$route.name == 'HasilPerButir'">
                    <router-link class="nav-link" :to="{ name: 'HasilPerButir', query: { id: id } }">Analisis
                        Butir</router-link>
                </CNavItem>
                <CNavItem :active="$route.name == 'RplKlasikal'">
                    <router-link class="nav-link" :to="{ name: 'RplKlasikal', query: { id: id } }">RPL
                        Klasikal</router-link>
                </CNavItem>
            </CNav>
        </CCard>
        <transition name="fade" mode="out-in">
            <keep-alive>
                <router-view></router-view>
            </keep-alive>
        </transition>
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