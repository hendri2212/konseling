<template>
    <div>
        <CRow>
            <CCol class="transition" :lg="!rpl ? '12' : '5'">
                <CCard accent-color="primary">
                    <CCardBody>

                        <CButton color="secondary" class="mb-3" @click="moveComponent('ListRplKlasikal')">
                            <CIcon name="cil-arrow-left" class="mr-2" />Kembali
                        </CButton>
                        <CDataTable :responsive="true" :items="items" :fields="fields" hover>
                            <template #order="{ index }">
                                <td>{{ index + 1 }}</td>
                            </template>
                            <template #action="{ item }">
                                <td>
                                    <CButton @click="openFormRpl(item.id, item.have_sip)" :color="'secondary'">
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
                                            <child-form v-for="(child, key2) in dynamic_form.child" :key="`child_${key2}`"
                                                :dynamic_form="child" :my_key="key2" :level="1"
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
    </div>
</template>
<script>
import moment from 'moment'
import ChildForm from './ChildForm.vue'
// import { baseURLTeacher } from '../../../main.js'

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
    },
    props: ['moveComponent'],
    data() {
        return {
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
    created() {
        this.getData()
    },
    methods: {
        reactEmitForRemoveElement(array_of_key, key) {
            let el = this.content[key]
            for (var i = array_of_key.length - 1; i > 0; i--) {
                el = el.child[array_of_key[i]]
            }
            el.child.splice(array_of_key[0], 1)

        },
        reactEmitForAddChildElement(array_of_key, key) {
            let el = this.content[key]
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
            let el = this.content[key]
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
        async openFormRpl(id, have_sip) {
            this.loading_get_rpl = true
            try {
                let rpl = null;
                if (have_sip) {
                    const { data } = await this.axios.get(`surveys/${this.survey_id}/service-implementation-plans/${id}`, {
                        headers: {
                            Authorization: "Bearer " + this.$store.state.auth.token
                        }
                    })
                    rpl = data.data

                } else {
                    const { data } = await this.axios.post(`surveys/${this.survey_id}/service-implementation-plans/${id}`, null, {
                        headers: {
                            Authorization: "Bearer " + this.$store.state.auth.token
                        }
                    })
                    rpl = data.data
                }
                this.rpl = rpl
            } catch (e) {
                console.log(e)
            } finally {
                this.loading_get_rpl = false
            }
        },
        async saveRpl() {
            this.loading = true
            try {
                let payload = {
                    survey_item_id: this.rpl.survey_item_id,
                    content: this.content
                }
                await this.axios.post(`surveys/${this.survey_id}/service-implementation-plans/${this.rpl.survey_item_id}`, payload, {
                // await baseURLTeacher.post(`surveys/${this.survey_id}/service-implementation-plans`, payload, {
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