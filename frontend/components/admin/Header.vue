<template>
    <div>
        <a-page-header
            :ghost="false"
            title="PAST←TIME"
            sub-title="~徒然と書く技術ブログ~"
        >
            <template slot="extra">
                <a-button>
                    {{ loginName }}
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
    computed: {
        loginName() {
            let strageItem = JSON.parse(window.sessionStorage.getItem('pasttime'));
            return this.login = strageItem.user.name;
        }
    }
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