<template>
    <div class="dashbord">
        <AdminHeader />
        <div>
            <a-row>
                <a-col :span="fixed? 2 : 5">
                    <AdminSidebar @fixed="fixedCollapsed" />
                </a-col>
                <a-col :span="fixed? 22 : 19">
                    <AdminContents />
                </a-col>
            </a-row>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            fixed: true,
        }
    },
    methods: {
        fixedCollapsed(bool) {
            this.fixed = bool;
        }
    },

}
</script>

<style>


</style>