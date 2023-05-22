<template>
    <aside class="k-sidebar menu-vertical menu bg-menu-theme" :class="`${expanded && 'expanded'}`">

        <!-- <div class="menu-inner-shadow"></div> -->

        <ul class="menu-inner ps pt-2">
            <li class="menu-item mb-3">
                <button class="menu-link border-0" @click="expand(false)">
                    <i class="bx bx-x bx-sm align-middle"></i></button>
            </li>
            <!-- Dashboard -->
            <li class="menu-item" :class="{ 'active': thats_route('Dashboard') }">
                <router-link :to="{ name: 'Dashboard' }" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </router-link>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
                <span class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-detail"></i>
                    <div data-i18n="Layouts">Angket</div>
                </span>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="layouts-without-menu.html" class="menu-link">
                            <div data-i18n="Without menu">Without menu</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layouts-without-menu.html" class="menu-link">
                            <div data-i18n="Without menu">Without menu</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layouts-without-menu.html" class="menu-link">
                            <div data-i18n="Without menu">Without menu</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layouts-without-menu.html" class="menu-link">
                            <div data-i18n="Without menu">Without menu</div>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </aside>
</template>
<script>
export default {
    name: "Sidebar",
    emits: ['watchexpanded'],
    data() {
        return {
            expanded: false,
        }
    },
    mounted() {
        const menu_toggle = document.querySelectorAll('.menu-toggle')
        menu_toggle.forEach(item => {
            item.addEventListener('click', e => {
                let classlist = item.parentElement.classList
                if (classlist.contains('open')) {
                    classlist.remove('open')
                } else {
                    classlist.add('open')
                }
            })
        })
        const demo = document.querySelector('.menu-inner');
        new PerfectScrollbar(demo);
    },
    methods: {
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
    },
}
</script>
<style scoped>
.k-sidebar {
    grid-area: sidebar;
    display: flex;
    height: 100vh;
    position: fixed;
    top: 0;
    overflow-y: auto;
    width: 0;
    z-index: 1050;
}

@media (min-width: 992px) {
    .k-sidebar {
        position: sticky;
        top: 4.1rem;
        height: calc(100vh - 4.1rem);
    }
}

.k-sidebar.expanded,
.k-sidebar.expanded .menu-block,
.k-sidebar.expanded .menu-inner>.menu-item,
.k-sidebar.expanded .menu-inner>.menu-header {
    width: 16.25rem;
}
</style>