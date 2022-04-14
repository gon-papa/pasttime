<template>
    <div>
        画像一覧
        <div v-for="url in imagesUrl" :key="url">
            <img :src="url">
        </div>
    </div>
</template>

<script>
export default {
    layout: 'Layouts',
    data() {
        return {
            imagesUrl: ''
        }
    },
    methods: {
        async fetch() {
            let response = await this.$axios.$get('/admin/images');
            this.imagesUrl = response.allUrl
            console.log(response);
        }
    },
    created() {
        this.fetch();

    }
}
</script>

<style scoped>

</style>