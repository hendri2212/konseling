<template>
    <CCard accent-color="primary">
        <CCardBody>
            <table v-if="sip" border="1" class="w-100">
                <template v-for="(child, index) in sip.service_implementation_plan_details">
                    <!-- Depth 1 or 2: Simple list structure -->
                    <template v-if="getDeep(child) <= 2">
                        <tr :key="getNodeKey(child, index)">
                            <td :rowspan="getRowspan(child)" class="text-uppercase text-center align-top">
                                <b>{{ getAlphabetLabel(index) }}</b>
                            </td>
                            <td colspan="4" :rowspan="getRowspan(child)" class="align-top">
                                <b>{{ child.value }}</b>
                            </td>
                            <td class="text-center">{{ child.child.length > 0 ? 1 : '' }}</td>
                            <td>{{ child.child[0]?.value || '' }}</td>
                        </tr>
                        <tr v-for="(child2, index2) in child.child.slice(1)" :key="getNodeKey(child2, index2, child)">
                            <td class="text-center">{{ index2 + 2 }}</td>
                            <td>{{ child2.value }}</td>
                        </tr>
                    </template>

                    <!-- Depth 3: Two-level hierarchy -->
                    <template v-else-if="getDeep(child) === 3">
                        <!-- Header row -->
                        <tr :key="getNodeKey(child, index)">
                            <td :rowspan="getRowspan(child) + 1" class="text-uppercase text-center align-top">
                                <b>{{ getAlphabetLabel(index) }}</b>
                            </td>
                            <td colspan="6"><b>{{ child.value }}</b></td>
                        </tr>
                        <!-- Child rows -->
                        <template v-for="(child2, index2) in child.child">
                            <tr :key="getNodeKey(child2, index2, child)">
                                <td :rowspan="getRowspan(child2)" class="text-center align-top">
                                    {{ index2 + 1 }}
                                </td>
                                <td colspan="3" :rowspan="getRowspan(child2)" class="align-top">
                                    {{ child2.value }}
                                </td>
                                <td class="text-center">{{ child2.child.length > 0 ? '-' : '' }}</td>
                                <td>{{ child2.child[0]?.value || '' }}</td>
                            </tr>
                            <tr v-for="(child3, index3) in child2.child.slice(1)"
                                :key="getNodeKey(child3, index3, child2)">
                                <td class="text-center">-</td>
                                <td>{{ child3.value }}</td>
                            </tr>
                        </template>
                    </template>

                    <!-- Depth 4: Three-level hierarchy -->
                    <template v-else-if="getDeep(child) === 4">
                        <!-- Main header row -->
                        <tr :key="getNodeKey(child, index)">
                            <td :rowspan="getTotalRowspan(child)" class="text-uppercase text-center align-top">
                                <b>{{ getAlphabetLabel(index) }}</b>
                            </td>
                            <td colspan="6"><b>{{ child.value }}</b></td>
                        </tr>

                        <!-- Level 2: child2 iterations -->
                         
                        <template v-for="(child2, index2) in child.child">
                            <tr :key="getNodeKey(child2, index2, child)">
                                <td :rowspan="getChild2Rowspan(child2)" class="text-center align-top">
                                    {{ index2 + 1 }}
                                </td>

                                <!-- If child2 is depth 3: has sub-structure -->
                                <td v-if="getDeep(child2) === 3" colspan="5" class="align-top">
                                    {{ child2.value }}
                                </td>

                                <!-- If child2 is depth 2: simple list -->
                                <template v-else-if="getDeep(child2) === 2">
                                    <td :rowspan="getRowspan(child2)" colspan="2" class="align-top">
                                        {{ child2.value }}
                                    </td>
                                    <td class="text-center">{{ child2.child.length > 0 ? '-' : '' }}</td>
                                    <td>{{ child2.child[0]?.value || '' }}</td>
                                </template>

                                <!-- If child2 is depth 1: single item -->
                                <td v-else-if="getDeep(child2) === 1" colspan="5">
                                    {{ child2.value }}
                                </td>
                            </tr>

                            <!-- Render remaining children for depth 2 -->
                            <template v-if="getDeep(child2) === 2">
                                <tr v-for="(child3, index3) in child2.child.slice(1)"
                                    :key="getNodeKey(child3, index3, child2, 'r')">
                                    <td class="text-center">-</td>
                                    <td>{{ child3.value }}</td>
                                </tr>
                            </template>

                            <!-- Render sub-structure for depth 3 -->
                            <template v-if="getDeep(child2) === 3">
                                <template v-for="(child3, index3) in child2.child">
                                    <!-- Sub-child with depth 2: has own list -->
                                    <template v-if="getDeep(child3) === 2">
                                        <tr :key="getNodeKey(child3, index3, child2)">
                                            <td :rowspan="getRowspan(child3)" class="text-center align-top">
                                                {{ getAlphabetLabel(index3) }}
                                            </td>
                                            <td :rowspan="getRowspan(child3)" colspan="2" class="align-top">
                                                {{ child3.value }}
                                            </td>
                                            <td class="text-center">{{ child3.child.length > 0 ? '-' : '' }}</td>
                                            <td>{{ child3.child[0]?.value || '' }}</td>
                                        </tr>
                                        <tr v-for="(child4, index4) in child3.child.slice(1)"
                                            :key="getNodeKey(child4, index4, child3)">
                                            <td class="text-center">-</td>
                                            <td>{{ child4.value }}</td>
                                        </tr>
                                    </template>

                                    <!-- Sub-child with depth 1: single item -->
                                    <tr v-else-if="getDeep(child3) === 1" :key="getNodeKey(child3, index3, child2)">
                                        <td class="text-center">-</td>
                                        <td colspan="3">{{ child3.value }}</td>
                                    </tr>
                                </template>
                            </template>
                        </template>
                    </template>
                </template>
            </table>
        </CCardBody>
    </CCard>
</template>

<script>
const ALPHABET = 'abcdefghijklmnopqrstuvwxyz'.split('')

export default {
    name: 'PrintRpl',

    data() {
        return {
            loading: true,
            sip: null,
            depthCache: new WeakMap(),
            rowspanCache: new WeakMap(),
            totalRowspanCache: new WeakMap(),
            child2RowspanCache: new WeakMap()
        }
    },

    created() {
        const sipId = this.$route?.query?.sip_id
        if (sipId) {
            this.fetchSip(sipId)
        } else {
            this.$router.replace({ name: 'Error404' })
        }
    },

    methods: {
        async fetchSip(sipId) {
            this.loading = true
            try {
                const { data } = await this.axios.get(
                    `service-implementation-plan-klasikals/${sipId}`,
                    { headers: { Authorization: `Bearer ${this.$store.state.auth.token}` } }
                )

                const payload = data?.data
                if (payload?.service_implementation_plan_details) {
                    payload.service_implementation_plan_details =
                        payload.service_implementation_plan_details.map(this.normalizeNode)
                }

                this.sip = payload
                this.clearCaches()
            } catch (error) {
                await this.handleError(error)
            } finally {
                this.loading = false
            }
        },

        normalizeNode(node) {
            node.child = Array.isArray(node.child) ? node.child : []
            node.child.forEach(child => this.normalizeNode(child))
            return node
        },

        clearCaches() {
            this.depthCache = new WeakMap()
            this.rowspanCache = new WeakMap()
            this.totalRowspanCache = new WeakMap()
            this.child2RowspanCache = new WeakMap()
        },

        async handleError(error) {
            const status = error?.response?.status
            const message = error?.response?.data?.message

            const errorMap = {
                400: { icon: 'error', title: 'Request tidak valid!', html: message || 'Periksa kembali parameter.' },
                401: { icon: 'warning', title: 'Sesi berakhir', text: 'Silakan login ulang.' },
                403: { icon: 'error', title: 'Akses ditolak', text: 'Anda tidak punya izin.' },
                404: { icon: 'error', title: 'Data tidak ditemukan', text: 'SIP tidak tersedia.' }
            }

            const errorConfig = errorMap[status] ||
                (status >= 500
                    ? { icon: 'error', title: 'Server bermasalah', text: 'Coba beberapa saat lagi.' }
                    : { icon: 'error', title: 'Kendala jaringan', text: 'Periksa koneksi internet Anda.' })

            await this.$swal(errorConfig)

            if (status === 401) {
                this.$store.dispatch('auth/logout')
                this.$router.replace({ name: 'Login' })
            } else if (status === 404) {
                this.$router.replace({ name: 'Error404' })
            }
        },

        /**
         * Calculate depth of a node (max depth of tree)
         */
        getDeep(node) {
            if (!node) return 0
            if (this.depthCache.has(node)) return this.depthCache.get(node)

            const children = node.child || []
            const depth = children.length === 0
                ? 1
                : 1 + Math.max(...children.map(c => this.getDeep(c)))

            this.depthCache.set(node, depth)
            return depth
        },

        /**
         * Calculate rowspan for a node (number of leaf nodes)
         */
        getRowspan(node) {
            if (!node) return 1
            if (this.rowspanCache.has(node)) return this.rowspanCache.get(node)

            const children = node.child || []
            const span = children.length === 0
                ? 1
                : children.reduce((sum, c) => sum + this.getRowspan(c), 0)

            this.rowspanCache.set(node, span)
            return span
        },

        /**
         * Calculate total rowspan for depth 4 main node
         * Formula: 1 (header) + sum of all child2 rowspans
         */
        getTotalRowspan(node) {
            if (!node) return 1
            if (this.totalRowspanCache.has(node)) return this.totalRowspanCache.get(node)

            const children = node.child || []
            // 1 for header + sum of each child2's rowspan
            const total = 1 + children.reduce((sum, child2) => sum + this.getChild2Rowspan(child2), 0)

            this.totalRowspanCache.set(node, total)
            return total
        },

        /**
         * Calculate rowspan for child2 in depth 4 structure
         * - Depth 3: 1 (own row) + sum of grandchildren rowspans
         * - Depth 2: number of leaf nodes (getRowspan)
         * - Depth 1: 1 (single row)
         */
        getChild2Rowspan(child2) {
            if (!child2) return 1
            if (this.child2RowspanCache.has(child2)) return this.child2RowspanCache.get(child2)

            const depth = this.getDeep(child2)
            let span

            if (depth === 3) {
                // Own header row + all grandchildren rows
                span = 1 + child2.child.reduce((sum, child3) => sum + this.getRowspan(child3), 0)
            } else if (depth === 2) {
                // All leaf nodes
                span = this.getRowspan(child2)
            } else {
                // Single row
                span = 1
            }

            this.child2RowspanCache.set(child2, span)
            return span
        },

        getAlphabetLabel(index) {
            return ALPHABET[index % ALPHABET.length]
        },

        hasChildren(node) {
            return node.child && node.child.length > 0
        },

        getNodeKey(node, index, parent = null, suffix = '') {
            const nodeId = node.id ?? `${index}-${this.hashString(node.value)}`
            const parentId = parent?.id ?? ''
            return `${parentId}-${nodeId}${suffix}`
        },

        hashString(str) {
            if (!str) return '0'
            let hash = 0
            for (let i = 0; i < str.length; i++) {
                hash = ((hash << 5) - hash) + str.charCodeAt(i)
                hash = hash & hash
            }
            return Math.abs(hash).toString(36)
        }
    }
}
</script>

<style scoped>
.align-top {
    vertical-align: top;
}
</style>