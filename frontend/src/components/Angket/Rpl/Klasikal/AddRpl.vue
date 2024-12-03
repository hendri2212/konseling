<template>
    <div>
        <CCard accent-color="primary" v-if="!loading">
            <CCardHeader>
                <CButton color="secondary"
                    @click="$router.push({ name: 'ListRplKlasikal', query: { id: $route.query.id } })">
                    <CIcon name="cil-arrow-left" class="mr-2" />Kembali
                </CButton>
            </CCardHeader>
            <CCardBody>
                <!-- <CRow class="mb-2">
                    <CCol sm="12">
                        <button class="input-group-text bg-success text-white text-bold button-add">
                            <CIcon name="cil-plus" class="text-white" />
                        </button>
                    </CCol>
                </CRow> -->
                <CRow>
                    <CCol sm="12">
                        <div class="form-group">
                            <label for="">Topik / Tema Layanan</label>
                            <v-select :options="[1, 2, 3, 4]"></v-select>
                        </div>
                    </CCol>
                </CRow>
                <CRow class="mb-2" v-for="(dynamic_form, key) in rpl.service_implementation_plan_details"
                    :key="`dynamic_form_${key}`">
                    <CCol sm="12">
                        <CRow class="mb-2">
                            <CCol sm="12">
                                <!-- <label for="exampleFormControlInput1" class="form-label w-100">
                                    <div class="d-flex align-items-center justify-content-between">
                                        {{ dynamic_form.value }}
                                        <button @click="reactEmitForAddChildElement([], key)"
                                            class="input-group-text bg-success text-white text-bold button-add">
                                            <CIcon name="cil-plus" class="text-white" />
                                        </button>
                                    </div>
                                </label> -->
                                <child-form :key="`child_${key}`" :dynamic_form="dynamic_form" :my_key="key" :level="1"
                                    @emit_remove_from_child="(array_of_key) => reactEmitForRemoveElement(array_of_key)"
                                    @emit_edit_from_child="(array_of_key, value) => reactEmitForEditElement(array_of_key, value)"
                                    @emit_add_child_from_child="(array_of_key) => reactEmitForAddChildElement(array_of_key)"></child-form>
                            </CCol>
                        </CRow>
                    </CCol>
                </CRow>
                <CRow>
                    <CCol sm="12">
                        <CButton @click="saveRpl()" class="w-100" color="primary">Simpan</CButton>
                    </CCol>
                </CRow>
            </CCardBody>
        </CCard>
        <Loading :loading="loading"></Loading>
    </div>
</template>

<script>
import moment from 'moment'
import ChildForm from '@/components/ChildForm.vue'
import Loading from '@/components/Loading.vue'

export default {
    name: "FormRpl",
    components: {
        ChildForm,
        Loading,
    },
    data() {
        return {
            loading: false,
            rpl: {
                sip_id: null,
                service_implementation_plan_details: [],
            },
        }
    },
    computed: {
        survey_id() {
            return this.$route.query.id
        },
        sip_id() {
            return this.$route.query.sip_id ?? null
        },
    },
    beforeRouteEnter(to, from, next) {
        if (!to.query.id) {
            next({ name: "Angket" })
        }
        next()
    },
    async mounted() {
        if (this.sip_id) {
            console.log("tes")
        } else {
            let service_implementation_plan_details = await this.getDefaultRplDetails()
            this.rpl = {
                service_implementation_plan_details: service_implementation_plan_details
            }
        }
        // await this.getData()
        // if (this.$route.query.rpl_id) {
        //     this.rpl = await this.getRpl(this.$route.query.rpl_id)
        // }
    },
    methods: {
        reactEmitForRemoveElement(array_of_key) {
            if (array_of_key.length == 1) {
                this.rpl.service_implementation_plan_details.splice(array_of_key[0], 1)
                return
            }
            let el = this.rpl.service_implementation_plan_details[array_of_key[array_of_key.length - 1]]
            for (var i = array_of_key.length - 2; i > 0; i--) {
                el = el.child[array_of_key[i]]
            }
            el.child.splice(array_of_key[0], 1)

        },
        reactEmitForAddChildElement(array_of_key) {
            let el = this.rpl.service_implementation_plan_details[array_of_key[array_of_key.length - 1]]
            for (var i = array_of_key.length - 2; i >= 0; i--) {
                el = el.child[array_of_key[i]]
            }
            el.child.push({
                id: null,
                value: "",
                child: [],
            })

        },
        reactEmitForEditElement(array_of_key, value) {
            if (array_of_key.length == 1) {
                this.rpl.service_implementation_plan_details[array_of_key[0]].value = value
                return
            }
            let el = this.rpl.service_implementation_plan_details[array_of_key[array_of_key.length - 1]]
            for (var i = array_of_key.length - 2; i > 0; i--) {
                el = el.child[array_of_key[i]]
            }
            el.child[array_of_key[0]].value = value

        },
        dateTime(value) {
            return moment(new Date(value)).format('dddd, DD MMMM YYYY, HH:mm');
        },
        duration(start, finish) {
            return moment().endOf(new Date(finish)).from(new Date(start));
        },
        async getDefaultRplDetails() {
            this.loading = true
            const { data } = await this.axios.get(`default-service-implementation-plan-details?service_strategy=klasikal`, {
                headers: {
                    Authorization: "Bearer " + this.$store.state.auth.token
                }
            })
            this.loading = false
            return data.data
        },
        async getRpl(id) {
            const { data } = await this.axios.get(`surveys/${this.survey_id}/service-implementation-plans/${id}`, {
                headers: {
                    Authorization: "Bearer " + this.$store.state.auth.token
                }
            })
            return data.data
        },
        async openFormRpl() {

            // this.loading_get_rpl = true
            // try {
            //     if (!this.items[index].have_sip) {
            //         await this.axios.post(`surveys/${this.survey_id}/service-implementation-plans/${this.items[index].id}`, null, {
            //             headers: {
            //                 Authorization: "Bearer " + this.$store.state.auth.token
            //             }
            //         })
            //         this.items[index].have_sip = true
            //     }
            //     this.$router.push({ name: this.add_component, query: { ...this.$route.query, rpl_id: this.items[index].id } })
            // } catch (e) {
            //     console.log(e)
            // } finally {
            //     this.loading_get_rpl = false
            // }
        },
        saveRpl() {
            if (this.sip_id) {
                this.updateRpl()
            } else {
                this.createRpl()
            }
        },
        async createRpl() {
            this.loading = true
            try {
                let payload = this.rpl
                payload.survey_item_id = this.survey_item_id
                const { data } = await this.axios.post(`surveys/${this.survey_id}/service-implementation-plan-klasikals`, payload, {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.auth.token
                    }
                })
                await this.$swal({
                    icon: 'success',
                    title: data.message,
                })
            } catch (e) {
                await this.$swal({
                    icon: 'error',
                    title: e.response.data.message,
                })
            } finally {
                this.loading = false
            }
        },
        async updateRpl() {
            this.loading = true
            try {
                let payload = this.rpl
                await this.axios.put(`service-implementation-plan-klasikals/${this.rpl.id}`, payload, {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.auth.token
                    }
                })
                // await this.$swal({
                //     icon: 'success',
                //     title: e.response.data.message,
                // })
            } catch (e) {
                await this.$swal({
                    icon: 'error',
                    title: e.response.data.message,
                })
            } finally {
                this.loading = false
            }
        }
    }
}
</script>