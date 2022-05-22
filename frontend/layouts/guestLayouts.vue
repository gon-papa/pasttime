<template>
    <div class="warapper">
        <GuestHeader />
        <div class="contents">
            <Nuxt />
        </div>
    </div>
</template>

<script>
export default {
    name: 'guestLayouts',
}
</script>

<style lang="scss">
    .warapper {
        background-color: #F3F3F3;
        padding-bottom: 60px;
        min-height: 100%;
    }
    .contents {
        width: 80%;
        margin: 0 auto;
        background-color: #fff;
    }
</style>