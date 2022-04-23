<template>
    <div>
        <h2>{{ $t('pages.create') }}</h2>
        <AdminBlogsCreateEdit @blogPost="blogCreate" />
    </div>
</template>

<script>
export default {
    name: 'createBlog',
    layout: 'Layouts',
    methods: {
        async blogCreate(blog) {
            try {
                let response = await this.$axios.$post('/admin/blogs/store', blog);

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
}
</script>