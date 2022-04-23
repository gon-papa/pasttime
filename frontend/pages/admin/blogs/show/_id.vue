<template>
    <div>
        <h2><a-icon type="file-text" />ブログ詳細</h2>
        <div class="warpper-img">
            <a-space size="large">
                <img :src="blog.thummbnail" alt="サムネイル">
                <h2>{{ blog.title }}</h2>
            </a-space>
        </div>
        <mavon-editor
            v-model="blog.body"
            :subfield="false"
            defaultOpen="preview"
            :toolbarsFlag="false"
        />
        <div v-html="blog.body">

        </div>
    </div>
</template>
<script>
export default {
    layout: 'Layouts',
    data() {
        return {
            blog: {},
        }
    },
    methods: {
        async getBlog() {
            let response = await this.$axios.$get('/admin/blogs/show/' + this.$route.params.id);
            console.log(response);
            this.blog = response.blog;
        },
    },
    created() {
        this.getBlog();
    },
}

</script>
<style lang="scss" scoped>
.warpper-img {
    display: flex;
    margin-bottom: 10px;
    img {
        max-width: 200px;
    }
}

</style>