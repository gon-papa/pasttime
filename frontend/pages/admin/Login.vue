<template>
    <div class="login">
        <div class="login-card">
            <a-card :title="$t('login')">
                <a-form-model 
                    ref="ruleForm"
                    layout="vertical"
                    :model="credentials"
                    :rules="rules"
                    @submit="onSubmit"
                    @submit.native.prevent
                    class="form"
                >
                    <a-form-model-item :label="$t('userEmail')" prop="email">
                    <a-input v-model="credentials.email" class="login-input">
                        <a-icon slot="prefix" type="mail" style="color:rgba(0,0,0,.25)" />
                    </a-input>
                    </a-form-model-item>
                    <a-form-model-item :label="$t('password')" prop="password">
                    <a-input v-model="credentials.password" type="password" class="password-input">
                        <a-icon slot="prefix" type="lock" style="color:rgba(0,0,0,.25)" />
                    </a-input>
                    </a-form-model-item>
                    <a-form-model-item style="text-align: end;">
                    <a-button
                        type="primary"
                        html-type="submit"
                        class="login-submit"
                    >
                        {{ $t('login') }}
                    </a-button>
                    </a-form-model-item>
                </a-form-model>
            </a-card>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            credentials: {
                email: "",
                password: "",
            },
            rules: {
                email: [
                    { required: true, message: this.$t('validation.required'), trigger: 'blur' }
                ],
                password: [
                    { required: true, message: this.$t('validation.required'), trigger: 'blur' },
                    { min: 6, max: 12, message: this.$t('validation.passRange'), trigger: 'blur'}
                ]
            }
        };
    },
    methods: {
        onSubmit() {
            this.$refs.ruleForm.validate(valid => {
                if (valid) {
                    this.handleSubmit();
                } else {
                    return false;
                }
            })
        },
        showErrorMessage(response) {
            if (response.message.hasOwnProperty('email')) {
                return this.$message.error(response.message.email[0], 2.5);
            }

            if (response.message.hasOwnProperty('password')) {
                return this.$message.error(response.message.password[0], 2.5);
            }

            return this.$message.error(response.message.error, 2.5);
        },
        async handleSubmit() {
            let response = await this.$store.dispatch('login', this.credentials);
            if (response.status === 200) {
                this.$router.push('/admin/bloglist');
                this.$message.success(response.message.success, 2.5);
            } else {
                this.showErrorMessage(response);
            }
        }
    },
}
</script>

<style lang="scss" scoped>
.login {
    height: 100vh;
    width: 100vw;
    background: linear-gradient(to top, rgba(217, 175, 217, 0.7) 0%, rgba(151, 217, 225, 0.7) 100%),url(~assets/admin/bg_login_min.png);
    background-size: cover;
    position: relative;
    .login-card{
        width: 50vw;
        margin: 0 auto;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%);
        @media screen and (max-width: 900px)  {
            width: 90vw;
        }
    }
}
</style>