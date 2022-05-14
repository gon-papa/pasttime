<template>
    <div>
        <a-form-model
            ref="form"
            :model="blog"
            :rules="rules"
        >
            <a-form-model-item prop="title">
                <a-input v-model="blog.title" size="large" :placeholder="$t('title')" />
            </a-form-model-item>
            <a-form-model-item prop="thummbnail">
                <div class="thummbnail">
                    <input
                        type="file"
                        ref="thummbnailInput"
                        accept="image/*"
                        @change.prevent="thummbnailAdd"
                        :disabled="existThummbnail"
                        class="hidden"
                    />
                    <div class="thummbnailUpload" :class="{ disabled:existThummbnail }" @click="thummbnailUpload" >{{ $t('thummbnailUpdate') }}</div>
                    <div class="preview" v-show="existThummbnail">
                        <a-button type="danger" class="delete-preview" @click.prevent="thummbnailDel">
                            <a-icon type="delete" theme="filled" />
                        </a-button>
                        <img :src="blog.thummbnail">
                    </div>
                </div>
            </a-form-model-item>
            <div class="imageList">
                <a-button type="primary" @click="showModal">
                    画像一覧
                </a-button>
                <a-modal v-model="modalVisible" :footer="null" :width="1000">
                    <ImageUpload />
                </a-modal>
            </div>
            <mavon-editor ref="editor" language="ja" v-model="blog.body" @imgAdd="$imgAdd" @imgDel="$imgDel" style="z-index: 0;" :htmlCode="true" />
            <a-form-model-item prop="status" style="marginTop: 15px">
                <a-row type="flex" justify="end">
                    <a-space>
                        <a-select :default-value="blog.status" style="width: 120px" v-model="blog.status">
                            <a-select-option :value="0">
                                {{ $t('visible') }}
                            </a-select-option>
                            <a-select-option :value="1">
                                {{ $t('draft') }}
                            </a-select-option>
                            <a-select-option :value="2">
                                {{ $t('invisible') }}
                            </a-select-option>
                        </a-select>
                        <a-popconfirm
                            placement="topRight"
                            ok-text="Yes"
                            cancel-text="No"
                            @confirm="onSubmit"
                            @visibleChange="handleVisibleChange"
                            :visible="createConfirm"
                        >
                            <template slot="title">
                            <p>この記事は公開されますがよろしいですか？</p>
                            </template>
                            <a-button type="primary" :disabled="this.$app.isProcessing()">
                                {{ $t('create') }}
                            </a-button>
                        </a-popconfirm>
                        <a-button>
                            {{ $t('preview') }}
                        </a-button>
                    </a-space>
                </a-row>
            </a-form-model-item>
        </a-form-model>
    </div>
</template>

<script>
import ImageUpload from "../../../pages/admin/ImageUpload.vue";
const VISIBLE = 0;
const DRAFT = 1;
const INVISIBLE = 2;

export default {
    name: "CreateEdit",
    layout: "Layouts",
    props: {
        blog: {
            type: Object,
            default: () => ({
                title: "",
                body: "",
                status: 1,
                thummbnail: "",
            }),
        },
    },
    data() {
        return {
            createConfirm: false,
            modalVisible: false,
            rules: {
                title: [
                    { required: true, message: this.$t("validation.required"), trigger: "blur" },
                    { max: 30, message: this.$t("validation.max30"), trigger: "blur" },
                ],
                status: [
                    { required: true, message: this.$t("validation.required"), trigger: "change" },
                ]
            }
        };
    },
    computed: {
        existThummbnail() {
            return this.blog.thummbnail ? true : false;
        }
    },
    methods: {
        async thummbnailAdd(event) {
            let formData = this.createImageForm(event.target.files[0]);
            let response = await this.imageUpload(formData);
            if (response.status === 200) {
                this.blog.thummbnail = response.url;
                this.$message.success(response.message.success, 2.5);
            }
        },
        async thummbnailDel() {
            await this.deleteImage(this.blog.thummbnail);
            this.blog.thummbnail = "";
        },
        async $imgAdd(pos, $file) {
            let formData = this.createImageForm($file);
            let response = await this.imageUpload(formData);
            if (response.status === 200) {
                return this.$refs.editor.$img2Url(pos, response.url);
            }
        },
        async $imgDel(fileName) {
            this.deleteImage(fileName[0]);
        },
        async imageUpload(data) {
            try {
                this.$store.dispatch("process/isProcessing");
                return await this.$axios.$post("admin/blog/image", data);
            }
            catch (err) {
                this.showErrorMessage(err.response.data);
                console.log(err.response);
                return err.response.data;
            }
        },
        async deleteImage(imageUrl) {
            try {
                await this.$axios.$delete("admin/blog/image" + `?url=${imageUrl}`);
            }
            catch (err) {
                console.log(err);
            }
        },
        createImageForm(data) {
            let formData = new FormData();
            formData.append("image", data);
            return formData;
        },
        thummbnailUpload() {
            this.$refs.thummbnailInput.click();
        },
        handleVisibleChange(visible) {
            if (!visible) {
                this.createConfirm = false;
                return;
            }
            if (this.blog.status === VISIBLE) {
                return this.createConfirm = true;
            }
            this.onSubmit();
        },
        showModal() {
            this.modalVisible = true;
        },
        onSubmit() {
            this.$store.dispatch("process/isProcessing");
            this.$refs.form.validate(async (valid) => {
                if (valid) {
                    this.$emit("blogPost", this.blog);
                }
                else {
                    console.log("validateError");
                    return false;
                }
            });
        }
    },
    components: { ImageUpload }
}
</script>

<style lang="scss" scoped>
.thummbnail {
    display: flex;
    .hidden {
        display: none;
    }
    .thummbnailUpload {
        cursor: pointer;
        background-color: #4169e1;
        padding: 0px 15px;
        font-size: 12px;
        font-weight: bold;
        color: #fff;
        border-radius: 100vh;
        margin-right: 15px;
        height: 40px;
        &:hover {
            background-color: #4169e1c6;
        }
    }
    .disabled {
        background-color: #c7cddcc6;
        pointer-events: none;
    }
    .preview {
        width: auto;
        height: 50px;
        position: relative;
        .delete-preview {
            width: 22px;
            height: 22px;
            padding: 0;
            background-color: transparent;
            border: none;
            color: red;
            position: absolute;
            top: 0;
            right: 0;
        }
        img {
            height: 100%;
        }
    }
    .status {
        width: 100px;
    }
}

.imageList {
    margin-bottom: 10px;
    button {
        padding: 0 20px;
        border-radius: 100vh;
        background-color: #4169e1;
        font-size: 13px;
    }
}
</style>