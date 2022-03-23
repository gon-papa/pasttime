<template>
    <div class="dashbord">
        <a-layout>
            <a-layout-header style="padding: 0;">
                <AdminHeader />
            </a-layout-header>
            <a-layout>
                <a-layout-sider 
                    v-model="collapsed"
                    @mouseenter="openCollapsed"
                    @mouseleave="closeCollapsed"
                >
                    <AdminSidebar @fixed="fixedCollapsed" />
                </a-layout-sider>
                <a-layout-content style="padding: 15px;">
                    <AdminContents />
                </a-layout-content>
            </a-layout>
        </a-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: this.$store.userName,
            fixed: true,
            collapsed: true,
        }
    },
    methods: {
        fixedCollapsed(bool) {
            this.fixed = bool;
        },
        openCollapsed() {
            if(this.fixed) this.collapsed = false;
        },
        closeCollapsed() {
            if(this.fixed) this.collapsed = true;
        },
    },
}
</script>

<style>


</style>