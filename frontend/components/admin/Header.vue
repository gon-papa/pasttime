<template>
    <div>
        <a-page-header
            :ghost="false"
            title="PAST←TIME"
            sub-title="~徒然と書く技術ブログ~"
            @back="() => $router.go(-1)"
        >
            <template slot="extra">
                <a-button>
                    {{ $store.state.user.name || login }}
                </a-button>
                <a-button @click="logout">
                    ログアウト
                </a-button>
            </template>
        </a-page-header>
    </div>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            login: 'Login中',
        } 
    },
    methods: {
        async logout() {
            let response = await this.$store.dispatch('logout');
            if(response.status === 200) {
                this.$message.success(response.message.success, 2.5);
            } else {
                this.$message.error('ログアウトできませんでした', 2.5);
            }
        }
    },
}
</script>

<style lang="scss">
.ant-page-header {
    background-color: #4169e1;
    .ant-page-header-heading {
        .ant-page-header-back-button{
            color: #fff!important;
        }
        .ant-page-header-heading-title {
            color: #fff!important;
        }
        .ant-page-header-heading-sub-title {
            color: #fff!important;
        }
    }
}

</style>