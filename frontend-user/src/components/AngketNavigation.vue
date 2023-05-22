<template>
    <aside class="k-angket-navigation menu-vertical menu bg-menu-theme" :class="`${expanded && 'expanded'}`">

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner pt-2" id="angket_navigation">
            <li class="menu-item mb-3 align-items-end justify-content-end">
                <button class="menu-link border-0" @click="expand(false)">
                    <i class="bx bx-x bx-sm align-middle"></i>
                </button>
            </li>
            <li class="menu-item px-3">
                <div class="card border">
                    <div class="card-body py-3 px-3">
                        <h1 class="h5"><b>Butir angket</b></h1>
                        <div class="d-flex justify-content-between flex-wrap box-btn-number">
                            <a class="btn-number" v-for="survey_item in survey_items" @click="move(survey_item.order)">
                                <span v-if="survey_item.answered" class="flag-number bg-primary"></span>
                                <span class="thispageholder"
                                    :class="{ 'thispage': (current_page == survey_item.order - 1 && !is_summary) }"></span>
                                {{ survey_item.order }}
                            </a>
                            <a class="btn-number hidden" v-for="n in 5 - (50 % 5)"></a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </aside>
</template>
<script>
import { mapState, mapActions } from 'pinia'
import { useAttemptStore } from '@/stores/attempt'
export default {
    name: "Sidebar",
    emits: ['watchexpanded'],
    props: {
        token: String,
    },
    data() {
        return {
            loading: false,
            expanded: false,
        }
    },
    computed: {
        ...mapState(useAttemptStore, ['survey_items']),
        id() {
            return this.$route.query.id
        },
        current_page() {
            return this.$route.query.page ?? 0
        },
        is_summary() {
            return this.$route.name == "AttemptSummary"
        }
    },
    async created() {
        
    },
    mounted() {
        new PerfectScrollbar(document.querySelector('#angket_navigation'));
    },
    methods: {
        ...mapActions(useAttemptStore, ['saveAnswer']),
        thats_route(...name) {
            return name.some(p => {
                return this.$route.name == p
            })
        },
        is_expanded() {
            return this.expanded
        },
        expand(expanded = true) {
            this.expanded = expanded
            this.$emit('watchexpanded', expanded)
        },
        move(number) {
            let id = this.$route.query.id ? this.$route.query.id : 0
            this.saveAnswer()
            if (number) {
                this.$router.push({ name: this.$route.name, query: { id: id, page: number - 1 } })
            }
        },
    },
}
</script>
<style scoped>
.k-angket-navigation {
    grid-area: angket-navigation;
    display: flex;
    height: 100vh;
    position: fixed;
    right: 0;
    top: 0;
    overflow-y: auto;
    width: 0;
    z-index: 1050;
}

@media (min-width: 992px) {
    .k-angket-navigation {
        position: sticky;
        top: 4.1rem;
        height: calc(100vh - 4.1rem);
    }
}

.k-angket-navigation.expanded,
.k-angket-navigation.expanded .menu-block,
.k-angket-navigation.expanded .menu-inner>.menu-item,
.k-angket-navigation.expanded .menu-inner>.menu-header {
    width: 18.25rem;
}


.btn-number {
    text-decoration: none;
    background-color: #fff;
    width: 36px;
    height: 46px;
    border-radius: 3px;
    border: 0;
    margin: 0 6px 6px 0;
    position: relative;
    text-align: center;
    line-height: 23px;
    font-size: 13px;
}


.btn-number:not(.hidden) {
    cursor: pointer;
}

.btn-number:hover {
    text-decoration: underline;
}

.btn-number .thispageholder {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    border: 1px solid #000;
    border-radius: 3px;
}

.btn-number .thispageholder.thispage {
    border: 3px solid #000;
}

.btn-number .flag-number {
    position: absolute;
    left: 0;
    bottom: 0;
    right: 0;
    border-radius: 3px;
    height: 23px;
}
</style>