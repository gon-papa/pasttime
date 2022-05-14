<template>
    <div>
        <!-- 画像アップモーダル追加 -->
        <!-- 画像アップロード機能追加 -->
        <!-- クリップボードコピー作成 -->
        <!-- ブログ作成、編集で画像一覧が出るように変更 -->
        <a-card title="アップロード画像一覧">
            <a-card-grid style="width:25%;height:250px;text-align:center;position:relative;" v-for="url in imagesUrl" :key="url" >
                <a-button type="danger" class="delete-img" @click.prevent="imageDelete(url)">
                    <a-icon type="delete" theme="filled" />
                </a-button>
                <img :src="url">
            </a-card-grid>
        </a-card>
    </div>
</template>

<script>
export default {
    layout: 'Layouts',
    data() {
        return {
            imagesUrl: [],
        }
    },
    methods: {
        async init() {
            let response = await this.$axios.$get('/admin/images');
            this.imagesUrl = response.allUrl
        },
        async imageDelete(imageUrl) {
            try {
                let response = await this.$axios.$delete('admin/blog/image' + `?url=${imageUrl}`);
                this.imagesUrl = this.imagesUrl.filter(function(url){
                    return url !== imageUrl;
                });
                this.$message.success('画像を削除しました', 2.5);
            } catch(err) {
                console.log(err);
                this.$message.error('通信に失敗しました', 2.5);
            }
        }
    },
    created() {
        this.init();

    }
}
</script>

<style scoped lang="scss">
.delete-img{
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 0 8px;
}
img{
    width: 100%;
    height: 100%;
    object-fit: contain;
}
</style>