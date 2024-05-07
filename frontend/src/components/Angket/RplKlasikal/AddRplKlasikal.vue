<template>
    <div>
        <CRow>
            <CCol class="transition" :lg="!rpl ? '12' : '5'">
                <CCard accent-color="primary">
                    <CCardBody>

                        <CButton color="secondary" class="mb-3"
                            @click="$router.push({ name: 'ListRplKlasikal', query: {id: $route.query.id} })">
                            <CIcon name="cil-arrow-left" class="mr-2" />Kembali
                        </CButton>
                        <CDataTable :responsive="true" :items="items" :fields="fields" hover>
                            <template #order="{ index }">
                                <td>{{ index + 1 }}</td>
                            </template>
                            <template #action="{ item, index }">
                                <td>
                                    <CButton @click="openFormRpl(index)" :color="'secondary'">
                                        <span v-if="item.have_sip">Ubah RPL</span>
                                        <span v-else>Buat RPL</span>
                                        <CIcon color="white" name="cil-arrow-right" />
                                    </CButton>
                                </td>
                            </template>
                        </CDataTable>
                    </CCardBody>
                </CCard>
            </CCol>
            <CCol v-if="rpl" lg="7">
                <CCard accent-color="primary">
                    <CCardBody>
                        <CRow class="mb-2" v-for="(dynamic_form, key) in rpl.service_implementation_plan_details"
                            :key="`dynamic_form_${key}`">
                            <CCol sm="12">
                                <CRow class="mb-2">
                                    <CCol sm="12">
                                        <ul>
                                            <label for="exampleFormControlInput1" class="form-label w-100">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    {{ dynamic_form.value }}
                                                    <button @click="reactEmitForAddChildElement([], key)"
                                                        class="input-group-text bg-success text-white text-bold button-add">
                                                        <CIcon name="cil-plus" class="text-white" />
                                                    </button>
                                                </div>
                                            </label>
                                            <child-form v-for="(child, key2) in dynamic_form.child"
                                                :key="`child_${key2}`" :dynamic_form="child" :my_key="key2" :level="1"
                                                @emit_remove_from_child="(array_of_key) => reactEmitForRemoveElement(array_of_key, key)"
                                                @emit_edit_from_child="(array_of_key, value) => reactEmitForEditElement(array_of_key, value, key)"
                                                @emit_add_child_from_child="(array_of_key) => reactEmitForAddChildElement(array_of_key, key)"></child-form>
                                        </ul>
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
            </CCol>
        </CRow>
        <Loading :loading="loading"></Loading>
    </div>
</template>
<script>
import moment from 'moment'
import ChildForm from './ChildForm.vue'
import Loading from '@/components/Loading.vue'

const fields = [
    { label: 'No', key: 'order' },
    { label: 'Butir Angket', key: 'question' },
    { label: 'Jml Responden', key: 'students_count' },
    { label: '%', key: 'result_as_percent' },
    { label: '', key: 'action' },
]

export default {
    name: "AddRplKlasikal",
    components: {
        ChildForm,
        Loading,
    },
    props: ['moveComponent'],
    data() {
        return {
            loading: false,
            loading_get_rpl: false,
            fields: fields,
            items: [],
            survey_item_has_rpl: false,
            rpl: null,
        }
    },
    computed: {
        survey_id() {
            return this.$route.query.id
        }
    },
    watch: {
        async '$route.query.rpl_id'(rpl_id) {
            this.rpl = await this.getRpl(rpl_id)
        }
    },
    async mounted() {
        this.getData()
        if (this.$route.query.rpl_id) {
            this.rpl = await this.getRpl(this.$route.query.rpl_id)
        }
    },
    methods: {
        reactEmitForRemoveElement(array_of_key, key) {
            let el = this.rpl.service_implementation_plan_details[key]
            for (var i = array_of_key.length - 1; i > 0; i--) {
                el = el.child[array_of_key[i]]
            }
            el.child.splice(array_of_key[0], 1)

        },
        reactEmitForAddChildElement(array_of_key, key) {
            let el = this.rpl.service_implementation_plan_details[key]
            for (var i = array_of_key.length - 1; i >= 0; i--) {
                el = el.child[array_of_key[i]]
            }
            el.child.push({
                id: null,
                value: "",
                child: [],
            })

        },
        reactEmitForEditElement(array_of_key, value, key) {
            let el = this.rpl.service_implementation_plan_details[key]
            for (var i = array_of_key.length - 1; i > 0; i--) {
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
        async getData() {
            this.loading = true
            try {
                const { data } = await this.axios.get(`surveys/${this.survey_id}/result-per-survey-items?filter_by_service_strategy=klasikal`, {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.auth.token
                    }
                })
                this.items = data.data
            } catch (e) {
                console.log(e)
            } finally {
                this.loading = false
            }
        },
        async getRpl(id) {
            const { data } = await this.axios.get(`surveys/${this.survey_id}/service-implementation-plans/${id}`, {
                headers: {
                    Authorization: "Bearer " + this.$store.state.auth.token
                }
            })
            return data.data
        },
        async openFormRpl(index) {
            this.loading_get_rpl = true
            try {
                if (!this.items[index].have_sip) {
                    await this.axios.post(`surveys/${this.survey_id}/service-implementation-plans/${this.items[index].id}`, null, {
                        headers: {
                            Authorization: "Bearer " + this.$store.state.auth.token
                        }
                    })
                    this.items[index].have_sip = true
                }
                this.$router.push({ name: 'AddRplKlasikal', query: {...this.$route.query, rpl_id:this.items[index].id} })
            } catch (e) {
                console.log(e)
            } finally {
                this.loading_get_rpl = false
            }
        },
        async saveRpl() {
            this.loading = true
            try {
                let payload = this.rpl
                await this.axios.put(`service-implementation-plans/${this.rpl.id}`, payload, {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.auth.token
                    }
                })
            } catch (e) {
                console.log(e)
            } finally {
                this.loading = false
            }
        }
    }
}
</script>
<style scoped>
.table td {
    vertical-align: middle !important;
}

.transition {
    transition: .5s;
}

/* .wrapper-tree>.button-add {
    display: none;
}

.wrapper-tree:hover>.button-add {
    display: block;
} */
ul {
    list-style: none;
    padding: 0;
}
</style>