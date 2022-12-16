<template>
    <component :is="component"></component>
</template>
<script>
import Butir from '@/components/analisis/Butir'
import Siswa from '@/components/analisis/Siswa'

export default {
    name: "ProfilePerAngketPage",
    components:{
        Butir,
        Siswa,
    },
    computed:{
        component(){
            return this.$route.meta.type == 'butir' ? 'Butir' : 'Siswa'
        }
    },
    created(){
        
    },
}
</script>