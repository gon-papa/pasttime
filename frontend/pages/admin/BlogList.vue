<template>
    <div>
        <h2>
            BlogsIndex
        </h2>
        <a-list item-layout="vertical" size="large" :pagination="pagination" :data-source="blogs">
            <div slot="footer">
                <b>PAST←TIME</b> GONPAPA
            </div>
            <a-list-item slot="renderItem" key="item.title" slot-scope="item, index">
                <template v-for="{ type, text } in actions" slot="actions">
                    <span :key="type" @click="type === 'edit'? editBlog(item.id) : null">
                        <a-icon :type="type" style="margin-right: 8px" />
                        {{ text }}
                    </span>
                </template>
                <img
                    slot="extra"
                    width="272"
                    alt="logo"
                    :src="imagesUrlCreate + item.thummbnail"
                />
                <nuxt-link :to="{ name: 'admin-blogs-show-id___ja', params: { id: item.id } }">
                    <a-list-item-meta :description="item.body">
                        <a slot="title" :href="item.href">{{ item.title }}</a>
                        <a-avatar slot="avatar" :src="item.avatar" />
                    </a-list-item-meta>
                </nuxt-link>
                {{ item.content }}
            </a-list-item>
        </a-list>
        <transition>
            <div class="create-blog">
                <nuxt-link :to="{ name: 'admin-blogs-create___ja' }" class="create-link">
                    <a-icon type="select" style="{ fontSize: '24x', color: '#fff' }" />
                </nuxt-link>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
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
        }
    },
    computed: {
        imagesUrlCreate: function() {
            return this.$config.END_POINT;
        },
    },
    methods: {
        editBlog(id) {
            console.log(id);
            this.$router.push({ name: "admin-blogs-edit-id___ja", params: { id } })
        },
        hideBottom() {
            console.log('bottom');
        },
        async init() {
            try {
                let response = await this.$axios.$get('/admin/blogs/index');
                this.blogs = response.blogs;
                console.log(response.blogs);
            } catch(err) {
                console.log(err.response);
            }
            window.addEventListener("scroll", this.hideBottom);
        },
    },
    created() {
        this.init();
    },
}
</script>

<style lang="scss" scoped>
.create-blog {
    position: fixed;
    bottom: 5%;
    right: 5%;
    background-color: #ccc;
    padding: 15px;
    border-radius: 50% 50%;
    line-height: 0;
    cursor: pointer;
    .create-link {
        color : inherit;    
        font-size: 26px;
        text-decoration : none;
    }
}
</style>