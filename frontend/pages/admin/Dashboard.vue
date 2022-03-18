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
            user: this.$store.userName,
            fixed: true,
        }
    },
    methods: {
        fixedCollapsed(bool) {
            this.fixed = bool;
        },
        async fetch() {
            // let data = await this.$axios.get('/user');
            // this.$store.dispatch('addUser', data.data);
        }
    },
    mounted() {
        this.fetch();
    },

}
</script>

<style>


</style>