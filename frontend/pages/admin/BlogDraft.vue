<template>
    <div>
        <h2>
            BlogsDraftIndex
        </h2>
        <a-list item-layout="vertical" size="large" :pagination="pagination" :data-source="blogs">
            <div slot="footer">
                <b>PAST←TIME</b> GONPAPA
            </div>
            <a-list-item slot="renderItem" key="item.title" slot-scope="item, index">
                <template v-for="{ type, text } in actions" slot="actions">
                    <span :key="type" @click="clickIcon(type, item.id)">
                        <a-icon :type="type" style="margin-right: 8px" />
                        {{ text }}
                    </span>
                </template>
                <img
                    slot="extra"
                    width="272"
                    alt="logo"
                    :src="item.thummbnail"
                />
                <nuxt-link :to="{ name: 'admin-blogs-show-id___ja', params: { id: item.id } }">
                    <a-list-item-meta :description="item.body">
                        <a slot="title" :href="item.href">{{ item.title }}</a>
                        <a-avatar slot="avatar" :src="item.avatar" />
                    </a-list-item-meta>
                </nuxt-link>
                <a-tag :color="status[item.status].color">
                    {{ status[item.status].text }}
                    <!-- ステータスによって変更 -->
                </a-tag>
                {{ item.content }}
            </a-list-item>
        </a-list>
    </div>
</template>

<script>
export default {
    name: 'BlogList',
    layout: 'Layouts',
    data() {
        return {
            blogs: [],
            pagination: {
                onChange: page => {
                console.log(page);
                },
                //ペジネーション後々追加
                pageSize: 3,
            },
            actions: [
                // 後々追加
                { type: 'star-o', text: '0' },
                { type: 'like-o', text: '0' },
                { type: 'message', text: '0' },
                { type: 'delete', text: '削除' },
                { type: 'edit', text: 'edit' },
            ],
            status: [
                {text: '公開', color:'green'},// 0
                {text: '下書き', color: 'pink'},// 1
                {text: '非公開', color: 'red'},// 2
            ],
        }
    },
    methods: {
        clickIcon(type, itemId) {
            type === 'edit'? this.editBlog(itemId) : null;
            type === 'delete'? this.deleteBlog(itemId) : null;
        },
        editBlog(id) {
            console.log(id);
            this.$router.push({ name: "admin-blogs-edit-id___ja", params: { id } })
        },
        async deleteBlog(id) {
            console.log(id);
            try {
                let response = await this.$axios.delete('/admin/blogs/delete/' + id);
                this.blogs = this.blogs.filter((blog, index) => {
                    return blog.id !== id;
                });
                return this.$message.success('削除しました', 2.5);
            } catch(err) {
                console.log(err);
            }
        },
        async init() {
            try {
                let response = await this.$axios.$get('/admin/blogs/draft-index');
                this.blogs = response.blogs;
            } catch(err) {
                console.log(err.response);
            }
        },
    },
    created() {
        this.init();
    },
}
</script>