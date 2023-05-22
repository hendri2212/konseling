<template>
    <template v-if="!error">
        <navbar></navbar>
        <div class="k-layout">
            <sidebar ref="sidebar" @watchexpanded="watchexpandedleft"></sidebar>
            <main class="k-main py-4 px-5">
                <div class="drawer-toggles d-flex">
                    <button @click="$refs.sidebar.expand()" v-if="!expanded_left"
                        class="text-large drawer-toggler drawer-left-toggle">
                        <i class="bx bx-chevron-right bx-sm align-middle"></i>
                    </button>
                    <button @click="$refs.angketnavigation.expand()" v-if="!expanded_right && angketnavigation"
                        class="text-large drawer-toggler drawer-right-toggle">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </button>
                </div>
                <slot></slot>
            </main>
            <angket-navigation v-if="angketnavigation" ref="angketnavigation" :token="token"
                @watchexpanded="watchexpandedright"></angket-navigation>
        </div>
    </template>
    <ErrorID v-else :message="message"></ErrorID>
</template>
<script>
import Navbar from '@/components/Navbar.vue'
import Sidebar from '@/components/Sidebar.vue'
import AngketNavigation from '@/components/AngketNavigation.vue'
import ErrorID from '@/components/ErrorID.vue'
import { mapActions } from 'pinia'
import { useLayoutStore } from '@/stores/layout'
export default {
    name: "LayoutDefault",
    components: {
        Navbar,
        Sidebar,
        AngketNavigation,
        ErrorID,
    },
    props: {
        token: String,
        angketnavigation: {
            type: Boolean,
            default: false
        },
        error: {
            type: Boolean,
            default: false,
        },
        message: String,
    },
    data() {
        return {
            expanded_left: false,
            expanded_right: false,
        }
    },
    mounted() {
        this.$watch(
            () => this.$route.meta,
            () => {
                if (!this.$route.meta.angketnavigation) {
                    this.expanded_right = false
                    this.set_navigation(false)
                }
            }
        )
        window.addEventListener('resize', (p) => {
            if (p.target.innerWidth < 1390) {
                this.$refs.sidebar.expand(false)
                if (this.angketnavigation) {
                    this.$refs.angketnavigation.expand(false)
                }
            }
        })
    },
    methods: {
        ...mapActions(useLayoutStore, ['set_sidebar', 'set_navigation']),
        watchexpandedleft(expanded) {
            this.expanded_left = expanded
            this.set_sidebar(expanded)
        },
        watchexpandedright(expanded) {
            this.expanded_right = expanded
            this.set_navigation(expanded)
        }
    }
}
</script>
<style>
.k-layout {
    display: grid;
    grid-template-areas: "sidebar main angket-navigation";
    grid-template-columns: auto 1fr auto;
    /* gap: 1.5rem */
}

.k-main {
    grid-area: main;
    margin: 0 auto;
    width: 100%;
    max-width: 100%;
}

@media (min-width: 768px) {
    .k-main {
        max-width: 830px;
    }
}

.drawer-toggles .drawer-toggler {
    position: fixed;
    top: calc(60px + 0.7rem);
    z-index: 2;
    border-radius: 200px;
    padding: 16px;
    background-color: #dee2e6;
    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
    transition: padding 200ms;
    border: 0;
}

.drawer-toggles .drawer-left-toggle {
    left: 0;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    padding-right: 14px;
    padding-left: 10px;
}

.drawer-toggles .drawer-right-toggle {
    right: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    padding-right: 14px;
    padding-right: 10px;
}

.drawer-toggles .drawer-toggler:hover {
    padding-left: 20px;
}</style>