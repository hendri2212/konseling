<template>
    <div tabindex="-1" class="position-relative" ref="parent">
        <input type="text" class="form-control" :style="show
            ? 'border-bottom-right-radius: 0; border-bottom-left-radius: 0'
            : ''
            " :placeholder="placeholder" v-model="value" @focus="onFocus" @blur="onFocusOut($event)" />
        <div class="list-group position-absolute bg-white w-100"
            style="border-top-right-radius: 0; border-top-left-radius: 0; max-height: 200px; overflow-y: scroll; z-index: 3;"
            v-show="show" ref="listSearch">
            <!-- <span class="list-group-item">
        <slot name="default_first"></slot>
      </span> -->
            <div v-if="!loading">
                <span style="cursor: pointer" class="list-group-item list-group-item-action"
                    v-for="(data, n) in resultSearch" @click="onSelected(data)" :key="`search_${n}`">
                    <slot :data="{ ...data, key: n }"></slot>
                </span>
            </div>
            <span v-else style="cursor: pointer" class="list-group-item list-group-item-action">
                Loading ...
            </span>
        </div>
    </div>
</template>
<script>
export default {
    name: "SearchInput",
    model: {
        prop: 'modelValue',
        event: 'update:modelValue'
    },
    props: {
        placeholder: {
            type: String,
            default: "",
        },
        url: {
            type: String,
        },
        filter: Object,
        headers: {
            type: Object,
            default: null,
        },
    },
    emits: ["change"],
    data() {
        return {
            success_search: null,
            value: "",
            focus: false,
            resultSearch: [],
            timeoutSearch: null,
            loading: false,
            busy: false,
            next: this.url,
        };
    },
    computed: {
        show() {
            return this.focus;
        },
    },
    mounted() {
        this.$watch(
            () => [this.value, this.show],
            () => {
                if (this.show && this.value != this.success_search) {
                    this.onSearch(this.value);
                    this.$refs.listSearch.addEventListener("scroll", this.handleScroll);
                }
            },
            { immediate: true }
        );
    },
    methods: {
        handleScroll() {
            const { scrollHeight, scrollTop, clientHeight } = this.$refs.listSearch;
            if (scrollTop + clientHeight >= scrollHeight - 3) {
                this.getData();
            }
        },
        search() {
            this.onSearch(this.value);
            this.$refs.listSearch.addEventListener("scroll", this.handleScroll);
        },
        onSearch(value) {
            if (this.timeoutSearch != null) {
                clearTimeout(this.timeoutSearch);
            }
            this.timeoutSearch = setTimeout(() => {
                this.loading = true;
                this.resultSearch = [];
                this.busy = false;
                this.next = `${this.url}?search=${value}`;
                this.getData(value);
            }, 500);
        },
        getData() {
            if (this.next && !this.busy) {
                this.busy = true;
                let filter = "";
                if (this.filter) {
                    for (let [key, value] of Object.entries(this.filter)) {
                        filter += `&${key}=${value}`;
                    }
                }

                if (!this.axios) {
                    console.error('Axios instance not available!');
                    this.busy = false;
                    this.loading = false;
                    return;
                }

                const token = this.$store?.state?.auth?.token;

                if (!token) {
                    console.error('Token not available!');
                    this.busy = false;
                    this.loading = false;
                    return;
                }

                this.axios.get(this.next + filter, {
                    headers: {
                        Authorization: "Bearer " + token
                    }
                })
                    .then((response) => {
                        const resp = response && response.data ? response.data : null;
                        const pagination = resp && resp.pagination ? resp.pagination : null;
                        const nextUrl = pagination && pagination.next ? pagination.next : null;

                        if (nextUrl) {
                            const sep = nextUrl.includes('?') ? '&' : '?';
                            this.next = `${nextUrl}${sep}search=${encodeURIComponent(this.value)}${filter}`;
                        } else {
                            this.next = null;
                        }

                        const items = Array.isArray(resp?.data)
                            ? resp.data
                            : (Array.isArray(resp) ? resp : []);

                        items.forEach((p) => {
                            this.resultSearch.push(p);
                        });

                        this.success_search = this.value;
                    })
                    .catch((error) => {
                        console.error('SearchInput Error:', error);

                        if (error.response?.status === 401) {
                            this.$swal({
                                icon: 'error',
                                title: 'Sesi Berakhir',
                                text: 'Sesi Anda telah berakhir. Silakan login kembali.',
                            }).then(() => {
                                if (this.$router) {
                                    this.$router.push('/login');
                                }
                            });
                        }
                    })
                    .finally(() => {
                        this.busy = false;
                        this.loading = false;
                    });
            }
        },
        onSelected(data) {
            let result = this.modelValue;
            if (Array.isArray(this.modelValue)) {
                if (!this.modelValue.some(p => p.id == data.id)) {
                    result.push(data);
                }
            } else {
                result = data;
            }
            this.$emit("update:modelValue", result);
            this.$emit("change", result);
            this.focus = false;
        },
        onFocus() {
            this.focus = true;
        },
        onFocusOut(event) {
            if (!this.$refs.parent.contains(event.relatedTarget)) {
                this.focus = false;
            }
        },
    },
};
</script>