<template>
    <CCard accent-color="primary">
        <CCardBody>
            <table border="1" class="w-100" v-if="sip != null">
                <template v-for="(child, index) in sip.service_implementation_plan_details">
                    <!-- <template v-if="getDeep(child) == 1">
                        <tr :key="child.id">
                            <td class="text-uppercase">{{ abjad[index % abjad.length] }}</td>
                            <td colspan="4">{{ child.value }}</td>
                            <td class="text-center">-</td>
                            <td></td>
                        </tr>
                    </template> -->
                    <template v-if="getDeep(child) == 2 || getDeep(child) == 1">
                        <tr :key="child.id">
                            <td :rowspan="getRowspan(child)" class="text-uppercase text-center"><b>{{ abjad[index %
                                abjad.length] }}</b></td>
                            <td colspan="4" :rowspan="getRowspan(child)"><b>{{ child.value }}</b></td>
                            <td class="text-center">{{ child.child.length > 0 ? 1 : "" }}</td>
                            <td>{{ child.child.length > 0 ? child.child[0].value : "" }}</td>
                        </tr>
                        <template v-for="(child2, index2) in child.child">
                            <tr :key="child2.id" v-if="index2 != 0">
                                <td class="text-center">{{ index2 + 1 }}</td>
                                <td colspan="4">{{ child2.value }}</td>
                            </tr>
                        </template>
                    </template>
                    <template v-if="getDeep(child) == 3">
                        <tr :key="child.id">
                            <td :rowspan="getRowspan(child) + 1" class="text-uppercase text-center"><b>{{ abjad[index %
                                abjad.length] }}</b></td>
                            <td colspan="6"><b>{{ child.value }}</b></td>
                        </tr>
                        <template v-for="(child2, index2) in child.child">
                            <tr :key="child2.id">
                                <td :rowspan="child2.child.length" :class="{ 'align-top': child2.child.length > 0 }">{{
                                    index2 + 1 }}</td>
                                <td colspan="3" :rowspan="child2.child.length"
                                    :class="{ 'align-top': child2.child.length > 0 }">{{ child2.value }}</td>
                                <td class="text-center">-</td>
                                <td>{{ child2.child[0].value }}</td>
                            </tr>
                            <template v-for="(child3, index3) in child2.child">
                                <tr :key="child3.id" v-if="index3 != 0">
                                    <td class="text-center">-</td>
                                    <td>{{ child3.value }}</td>
                                </tr>
                            </template>
                        </template>
                    </template>
                </template>
            </table>
        </CCardBody>
    </CCard>
</template>

<script>

export default {
    data() {
        return {
            loading: true,
            abjad: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'],
            sip: null,
        }
    },
    created() {
        // if (this.api_sip == "") {
        //     this.$router.replace({ name: "Error404" })
        //     return;
        // }
        let sip_id = this.$route.query.sip_id ?? null;
        if (sip_id) {
            this.getSip(sip_id)
        } else {
            this.$router.replace({ name: "Error404" })
        }
    },
    props: {
        service_strategy: {
            required: true,
            type: String,
        },
    },
    computed: {
        survey_id() {
            return this.$route.query.id
        },
    },
    methods: {
        async getSip(sip_id) {
            this.loading = true
            try {
                const { data } = await this.axios.get(`service-implementation-plan-klasikals/${sip_id}`, {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.auth.token
                    }
                })
                this.sip = data.data
            } catch (e) {
                if (e.response.status === 400) {
                    await this.$swal({
                        icon: 'error',
                        title: 'Request tidak valid !',
                        html: e.response.data.message,
                    })
                }
            } finally {
                this.loading = false
            }
        },
        getDeep(el, deep = 0) {
            deep++
            if (el.child.length < 1) {
                return deep
            }
            return this.getDeep(el.child[0], deep)
        },
        getRowspan(el) {
            if (el.child.length < 1) {
                return 1
            }
            let rowspan = 1
            for (let i = 0; i < el.child.length; i++) {
                rowspan += this.getRowspan(el.child[i])
            }

            return rowspan - 1

        }
    }
}
</script>