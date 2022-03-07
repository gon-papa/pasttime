<template>
    <div style="width: 256px">
        <a-menu
            :default-selected-keys="['1']"
            :default-open-keys="['sub1']"
            mode="inline"
            theme="dark"
            :inline-collapsed="collapsed"
            @mouseenter="openCollapsed"
            @mouseleave="closeCollapsed"
        >
            <a-button class="sidebar-btn" @click="fixedCollapsed">
                <a-icon :type="collapsed ? 'right' : 'left'" />
            </a-button>
            <a-menu-item key="1">
                <a-icon type="pie-chart" />
                <span>{{ $t('dashboard') }}</span>
            </a-menu-item>
            <a-menu-item key="2">
                <a-icon type="desktop" />
                <span>Option 2</span>
            </a-menu-item>
            <a-menu-item key="3">
                <a-icon type="inbox" />
                <span>Option 3</span>
            </a-menu-item>
            <a-sub-menu key="sub1">
                <span slot="title"><a-icon type="mail" /><span>Navigation One</span></span>
                <a-menu-item key="5">
                    Option 5
                </a-menu-item>
                <a-menu-item key="6">
                    Option 6
                </a-menu-item>
                <a-menu-item key="7">
                    Option 7
                </a-menu-item>
                <a-menu-item key="8">
                    Option 8
                </a-menu-item>
            </a-sub-menu>
            <a-sub-menu key="sub2">
            <span slot="title"><a-icon type="appstore" /><span>Navigation Two</span></span>
                <a-menu-item key="9">
                    Option 9
                </a-menu-item>
                <a-menu-item key="10">
                    Option 10
                </a-menu-item>
                <a-sub-menu key="sub3" title="Submenu">
                    <a-menu-item key="11">
                        Option 11
                    </a-menu-item>
                    <a-menu-item key="12">
                        Option 12
                    </a-menu-item>
                </a-sub-menu>
            </a-sub-menu>
        </a-menu>
    </div>
</template>

<script>
export default {
    data() {
        return {
            collapsed: true,
            fixed: true,
        };
    },
    methods: {
        fixedCollapsed() {
            if(!this.fixed) {
                this.collapsed = true;
            }
            this.fixed = !this.fixed;
            this.$emit('fixed', this.fixed);
        },
        openCollapsed() {
            if(this.fixed) this.collapsed = false;
        },
        closeCollapsed() {
            if(this.fixed) this.collapsed = true;
        },
    },
};
</script>

<style>
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