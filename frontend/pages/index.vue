<template>
    <div class="wrapper">
        <a-spin size="large" tip="Loading..." v-if="isConnecting" />
        <div class="container" v-show="listDisplay">
            <div v-for="blog in blogs" :key="blog.title">
                <nuxt-link :to="{ name: 'guest-blogs-show-id___ja', params: { id: blog.id } }">
                    <div class="row">
                        <div class="thummbnail">
                            <img :src="blog.thummbnail" alt="サムネイル" @error="noimage">
                        </div>
                        <div class="blog-info">
                            <h2>{{ blog.title }}</h2>
                            <p>
                                {{ htmlEscape(blog.body) }}
                            </p>
                        </div>
                    </div>
                    <div class="blog-date">
                        <span>作成日: {{ blog.created_at }}</span>
                        <span>更新日: {{ blog.updated_at }}</span>
                    </div>
                </nuxt-link> 
                <hr>
            </div>
            <a-pagination v-model="current" :total="total" :page-size="limit" show-less-items @change="init()" />
        </div>
    </div>
</template>

<script>
export default {
    layout: 'guestLayouts',
    data() {
        return {
            blogs:[],
            current: 1,
            total: 0,
            limit: 10,
            isConnecting: false,
            listDisplay: false,
        }
    },
    methods: {
        htmlEscape(text) {
            return text.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'');
        },
        noimage(element){
            element.target.src = require('@/assets/noimage.jpeg');
        },
        async init() {
            try {
                this.isConnecting = true;
                let response = await this.$axios.get('blogs/index', {
                    params: {
                        page: this.current,
                        limit: this.limit,
                    }
                });
                let res = await this.$axios.get('blog/active-count');
                this.blogs = response.data.blogs.data;
                this.total = res.data.total;
            } catch(error) {
                console.log(error);
                this.$message.error('読み込みに失敗しました', 2.5);
            }
            this.isConnecting = false;
            this.listDisplay = true;
        }
    },
    created() {
        this.init();
    },
}
</script>

<style lang="scss" scoped>

.warapper {
    .ant-spin {
        position: absolute;
        top: 50%;
        left: 50%;
    }

    .container {
        padding: 30px;
        a {
            color : #000;
            text-decoration : none;
        }
        .row {
            display: flex;
            justify-content: start;
            .thummbnail {
                width: 280px;
                height: 150px;
                img {
                    height: 100%;
                }
            }
            .blog-info {
                padding: 0 15px;
                min-width: 0;
                p {
                    overflow-wrap: break-word;
                }
            }
        }
        .blog-date {
            width: 100%;
            text-align: right;
        }
        .ant-pagination {
            text-align: right;
            padding: 15px;
        }
    }
}
</style>

