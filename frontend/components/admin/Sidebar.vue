<template>
    <a-menu
        :default-selected-keys="['1']"
        mode="inline"
        theme="dark"
    >
        <a-button class="sidebar-btn" @click="fixedCollapsed">
            <a-icon :type="fixed ? 'right' : 'left'" />
        </a-button>
        <a-menu-item key="1">
            <nuxt-link to="/admin/BlogList">
                <a-icon type="inbox" />
                <span>投稿一覧</span>
            </nuxt-link>
        </a-menu-item>
        <a-menu-item key="2">
            <nuxt-link to="/admin/BlogDraft">
                <a-icon type="edit" />
                <span>下書き一覧</span>
            </nuxt-link>
        </a-menu-item>
        <a-menu-item key="3">
            <nuxt-link to="/admin/ImageUpload">
                <a-icon type="picture" />
                <span>画像一覧</span>
            </nuxt-link>
        </a-menu-item>
        <a-menu-item key="4" @click="logout">
            <a-icon type="user-delete" />
            <span>ログアウト</span>
        </a-menu-item>
    </a-menu>
</template>

<script>
export default {
    data() {
        return {
            fixed: true,
        };
    },
    methods: {
        fixedCollapsed() {
            this.fixed = !this.fixed;
            this.$emit('fixed', this.fixed);
        },
        async logout() {
            let response = await this.$store.dispatch('logout');
            if(response.status === 200) {
                location.reload();
                this.$message.success(response.message.success, 2.5);
            } else {
                this.$message.error('ログアウトできませんでした', 2.5);
            }
        },
    },
};
</script>

<style scoped>
.ant-menu-item-selected {
    background-color:  #4169e1!important;
}
.sidebar-btn {
    background-color: #001529;
    color: #fff;
    padding: 5px 10px;
    margin: 10px 10px;
}
</style>