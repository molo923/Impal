<template>
    <div>
        <div class="sick-wrapper d-flex no-block justify-content-center align-items-center bg-light">
            <div class="auth-man bg-light">

                <div class="text-center p-t-20 p-b-20">
                <span>
                    <img style="width: 60px" :src="this.ggnIcon" alt="logo" />
                </span>
                    <span class="db">
                    <img style="width: 160px" :src="this.ggnText" alt="logo" />
                </span>
                </div>

                <div v-if="email" class="alert alert-warning">
                    <p class="mb-1">Akun anda harus diverifikasi untuk masuk.</p>
                    <p class="mb-1">Link verifikasi email telah dikirim ke {{ email }}.</p>
                    <p class="mb-1">Jika anda tidak menerima email verifikasi,<br> <a href="#" @click.prevent="resendEmail">Klik disini</a> untuk mengirim ulang.</p>
                </div>

                <div v-if="verified" class="alert alert-info">
                    <p class="mb-1">Selamat anda telah memverifikasi akun anda.</p>
                    <p class="mb-1">Akun anda belum aktif, silahkan menunggu untuk verifikasi dari Administrator.</p>
                </div>

                <div v-if="pegawai_verified" class="alert alert-info">
                    <p class="mb-1">Selamat anda telah memverifikasi akun anda.</p>
                </div>
                <form class="form-horizontal m-t-20" @submit.prevent="login">

                    <div class="row p-b-30">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="text" v-model="credentials.login" class="form-control form-control-lg" :class="[errors.username ? errorClass : errors.email ? errorClass : '']" placeholder="Username atau alamat email" aria-label="Username" aria-describedby="basic-addon1">

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors.username ? errors.username[0] : errors.email ? errors.email[0] : '' }}</strong>
                                </span>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" v-model="credentials.password" class="form-control form-control-lg" :class="[errors.password ? errorClass : '']" placeholder="Kata sandi" aria-label="Password" aria-describedby="basic-addon1">

                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ errors.password ? errors.password[0] : '' }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember">

                                    <label class="custom-control-label" style="margin-top: 1px" for="remember">
                                        Ingat saya
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <div>
                                    <a class="btn btn-secondary" :href="passwordRequestRoute"><i class="fa fa-lock m-r-5"></i> Lupa kata sandi?</a>
                                    <button class="btn btn-info float-right" :disabled="isLoading" type="submit">
                                        <template v-if="isLoading">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Masuk
                                        </template>
                                        <span v-else>Masuk</span>
                                    </button>
                                </div>
                            </div>
                            <p class="text-center">Belum memiliki akun? <a :href="registerRoute">Daftar disini</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['loginRoute', 'passwordRequestRoute', 'registerRoute', 'resendEmailRoute', 'ggnIcon', 'ggnText'],
        name: "LoginComponent.vue",
        data() {
            return {
                credentials: {
                    username: '',
                    password: ''
                },
                errors: {
                    username: null,
                    password: null,
                    email: null,
                },
                errorClass: 'is-invalid',
                isLoading: false,
                email: null,
                verified: false,
                pegawai_verified: false,
                csrf_token: null,
            }
        },
        watch: {
            credentials: {
                handler: function() {
                    this.clearError();
                },
                deep: true,
            },
        },
        methods: {
            clearError() {
                this.errors = {
                    username: null,
                    password: null,
                    email: null,
                };
            },
            resendEmail() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = this.csrf_token;
                this.isLoading = true;
                axios.post(this.resendEmailRoute, { email: this.email })
                    .then(res => {
                        this.isLoading = false;
                        console.log(res);

                        if (res.data.token) {
                            this.csrf_token = res.data.token;
                        }

                        if (res.data.status) {
                            toastr.info(res.data.status);
                        }
                        /*window.location = res.request.responseURL;*/
                    })
                    .catch(err => {
                        this.isLoading = false;
                        console.log(err.response);
                    });
            },
            login() {
                if (this.csrf_token !== null) {
                    axios.defaults.headers.common['X-CSRF-TOKEN'] = this.csrf_token;
                }
                this.isLoading = true;
                axios.post(this.loginRoute, this.credentials)
                    .then(res => {
                        this.isLoading = false;
                        console.log(res);
                        if (res.data.status) {
                            toastr.info(res.data.status);
                        }

                        if (res.data.email) {
                            this.email = res.data.email;
                        }

                        if (res.data.token) {
                            this.csrf_token = res.data.token;
                        }

                        if (res.data.url) {
                            window.location = res.data.url;
                        }
                    })
                    .catch(err => {
                        this.isLoading = false;
                        console.log(err.response);
                        this.errors = err.response.data.errors;
                    });
            }
        },
    }
</script>

<style scoped>

</style>
