<template>
    <div>
        <h2>{{ $t('pages.edit') }}</h2>
        <AdminBlogsCreateEdit :blog="blog" @blogPost="blogUpdate" />
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
        async init() {
            try {
                let response = await this.$axios.$get('/admin/blogs/edit/' + this.$route.params.id);
                this.blog = response.blog;
                console.log(this.blog)
            } catch(err) {

            }
        },
        async blogUpdate(blog) {
            try {
                let response = await this.$axios.$post('/admin/blogs/update/' + this.$route.params.id, blog);

                this.$router.push('/admin/bloglist');
                this.$message.success(response.message.success, 2.5);
            } catch(err) {
                this.showErrorMessage(err.response.data);
            }
        },
        showErrorMessage(response) {
            let arr = Object.keys(response.message);
            if (response.message.hasOwnProperty(arr[0])) {
                return this.$message.error(response.message[arr[0]], 2.5);
            }
            return this.$message.error('ServerError', 2.5);
        },
    },
    created() {
        this.init();
    },
}

</script>
<style>

</style>