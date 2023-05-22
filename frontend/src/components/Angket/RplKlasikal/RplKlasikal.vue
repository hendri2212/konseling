<template>
    <div>
        <CRow>
            <CCol :lg="12" class="">
                <component :moveComponent="moveComponent" :is="component"></component>
            </CCol>
        </CRow>
    </div>
</template>

<script>
import AddRplKlasikal from './AddRplKlasikal.vue';
import ListRplKlasikal from './ListRplKlasikal.vue';
export default {
    name: "RplKlasikal",
    components: {
        ListRplKlasikal,
        AddRplKlasikal,
    },
    data() {
        return {
            component: 'ListRplKlasikal'
        }
    },
    methods: {
        moveComponent(component) {
            this.component = component
        }
    }

}
</script>