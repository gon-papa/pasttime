<template>
    <div class="wrapper">
        <a-spin size="large" tip="Loading..." v-if="isConnecting" />
        <div class="container" v-show="listDisplay">
            <div class="warpper-img">
                <img :src="blog.thummbnail" alt="サムネイル" @error="noimage">
                <h2 class="title">{{ blog.title }}</h2>
            </div>
            <div class="create-edit-date">
                <a-icon type="clock-circle" />
                <span>
                    {{ blog.created_at }}
                </span>
                <a-icon type="reload" />
                <span>
                    {{ blog.updated_at }}
                </span>
            </div>
            <mavon-editor
                v-model="blog.body"
                :subfield="false"
                defaultOpen="preview"
                :toolbarsFlag="false"
            />
            <hr style="width: 95%;}">
            <div style="text-align: right;">
                <a-button class="back" size="large" @click="backTop">TOP</a-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    layout: 'guestLayouts',
    data() {
        return {
            blog: {},
            isConnecting: false,
            listDisplay: false,
        }
    },
    methods: {
        async getBlog() {
            try {
                this.isConnecting = true;
                let response = await this.$axios.$get('/blog/show/' + this.$route.params.id);
                if(response.status === 404) {
                    this.$message.error('記事が見つかりませんでした', 2.5);
                    return this.$router.push('/');
                    
                }
                this.blog = response.blog;
            } catch(error) {
                console.log(error);
                // this.$router.push('/');
                this.$message.error('エラーが発生しました', 2.5);
            }
            this.isConnecting = false;
            this.listDisplay = true;
        },
        noimage(element) {
            element.target.src = require('@/assets/noimage.jpeg');
        },
        backTop() {
            this.$router.push('/');
        }
    },
    created() {
        this.getBlog();
    },
}
</script>

<style lang="scss" scoped>
    .wrapper {
        background-color: #fff;
        .ant-spin {
            position: absolute;
            top: 50%;
            left: 50%;
        }
        .warpper-img {
            display: flex;
            margin-bottom: 20px;
            padding: 20px;
            img {
                max-width: 300px;
            }
            .title {
                font-size: 32px;
                margin: 3% 0 0 5%;
            }
        }
        .create-edit-date {
            text-align: right;
            padding: 10px;
        }
        .back {
            background: #4322D9;
            font-weight: bold;
            margin: 30px;
            padding: 0 40px;
            color: #E8E8E8;
        }
    }
</style>

// mavon-editor
<style>
    .hljs {
        background-color: inherit!important;
    }
    pre {
        background-color: #e5eef7!important;
    }
    .markdown-body {
        box-shadow: none!important;
    }
    .scroll-style {
        background-color: #fff!important;
    }
</style>