<template>
    <div>
        <template v-if="success">
            <div class="text-center">
                <i class="mdi mdi-check-circle-outline text-success" style="font-size: 7em"></i>
                <h2>Terima kasih telah mendaftar.</h2>
                <p>Kami telah mengirim email verifikasi untuk melanjutkan proses registrasi.</p>
                <a :href="loginRoute">Klik disini untuk masuk.</a>
            </div>
        </template>
        <template v-else>
            <form class="form-horizontal m-t-20 mb-4 shadow-none" @submit.prevent="registerAcc">

                <div v-show="step === 1">
                    <ValidationObserver v-slot="{ invalid }">
                        <ValidationProvider
                            mode="eager"
                            name="Username"
                            rules="required|min:5|uniqueUsername"
                            v-slot="{ errors, classes }"
                        >
                            <div class="form-group mb-3">
                                <input type="text" class="form-control form-control-lg" :class="classes" v-model="fields.username" placeholder="Username" aria-label="Username" autofocus>
                                <invalid-feedback :message="errors[0]"></invalid-feedback>
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            mode="eager"
                            name="Alamat email"
                            rules="required|email|uniqueEmail"
                            v-slot="{ errors, classes }"
                        >
                            <div class="form-group mb-3">
                                <input type="text" class="form-control form-control-lg" :class="classes" v-model="fields.email" placeholder="Alamat Email" aria-label="Alamat Email">
                                <invalid-feedback :message="errors[0]"></invalid-feedback>
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            mode="eager"
                            name="Kata sandi"
                            rules="required|min:8|password:confirmation"
                            v-slot="{ errors, classes }"
                        >
                            <div class="form-group mb-3">
                                <input type="password" class="form-control form-control-lg" :class="classes" v-model="fields.password" placeholder="Kata Sandi" aria-label="Kata Sandi">
                                <invalid-feedback :message="errors[0]"></invalid-feedback>
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            mode="eager"
                            vid="confirmation"
                            name="Ulangi kata sandi"
                            v-slot="{ errors, classes }"
                        >
                            <div class="form-group mb-3">
                                <input type="password" class="form-control form-control-lg" :class="classes" v-model="fields.password_confirmation" placeholder="Ulangi Kata Sandi" aria-label="Ulangi Kata Sandi">
                                <invalid-feedback :message="errors[0]"></invalid-feedback>
                            </div>
                        </ValidationProvider>

                        <div class="d-flex justify-content-between">
                            <button :disabled="invalid" class="btn ml-auto btn-info" @click.prevent="nextStep">Selanjutnya <i class="mdi mdi-arrow-right"></i></button>
                        </div>
                    </ValidationObserver>
                </div>

                <div v-if="step === 2">
                    <ValidationObserver v-slot="{ invalid }">
                        <ValidationProvider
                            mode="eager"
                            name="Nama bank sampah"
                            rules="required|min:2"
                            v-slot="{ errors, classes }"
                        >
                            <div class="form-group mb-3">
                                <input type="text" class="form-control form-control-lg" :class="classes" v-model="fields.banksampahName" placeholder="Nama Bank Sampah" aria-label="Nama Bank Sampah">

                                <invalid-feedback :message="errors[0]"></invalid-feedback>
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            mode="eager"
                            name="Nomor Telepon/HP"
                            rules="required|min:8|max:15|numeric|uniquePhone"
                            v-slot="{ errors, classes }"
                        >
                            <div class="form-group mb-3">
                                <input type="text" class="form-control form-control-lg" :class="classes" v-model="fields.phone_number" placeholder="Nomor Telepon/HP" aria-label="Nomor Telepon/HP">

                                <invalid-feedback :message="errors[0]"></invalid-feedback>
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            mode="eager"
                            name="Alamat bank sampah"
                            rules="required|min:5"
                            v-slot="{ errors, classes }"
                        >
                            <div class="form-group mb-3">
                                <input type="text" class="form-control form-control-lg" :class="classes" v-model="fields.alamat" placeholder="Alamat Bank Sampah" aria-label="Alamat Bank Sampah">

                                <invalid-feedback :message="errors[0]"></invalid-feedback>
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            mode="eager"
                            name="Kota/kabupaten"
                            rules="required"
                            v-slot="{ errors, classes }"
                        >
                            <div class="form-group mb-3">
                                <!--<select2 :options="cities" v-model="fields.city" :class="[ fields.city === '' ? 'is-invalid' : '' ]" placeholder="Pilih kota...">
                                    <option value=""></option>
                                </select2>-->
                                <select v-model="selects.city" class="custom-control custom-select custom-select-lg" :class="classes">
                                    <option value="">Pilih kota/kabupaten...</option>
                                    <template v-for="city in cities">
                                        <option :value="city.id">{{ city.text }}</option>
                                    </template>
                                </select>

                                <invalid-feedback :message="errors[0]"></invalid-feedback>
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            mode="eager"
                            name="Kecamatan"
                            rules="required"
                            v-slot="{ errors, classes }"
                        >
                            <div class="form-group mb-3">
                                <select v-model="selects.districts" class="custom-control custom-select custom-select-lg" :disabled="districts.length === 0" :class="classes">
                                    <option value="">
                                        <template v-if="loadDistrict">
                                            Memuat kecamatan...
                                        </template>
                                        <template v-else>
                                            Pilih kecamatan...
                                        </template>
                                    </option>
                                    <template v-for="district in districts">
                                        <option :value="district.id">{{ district.text }}</option>
                                    </template>
                                </select>

                                <invalid-feedback :message="errors[0]"></invalid-feedback>
                            </div>
                        </ValidationProvider>
                        <ValidationProvider
                            mode="eager"
                            name="Kelurahan"
                            rules="required"
                            v-slot="{ errors, classes }"
                        >
                            <div class="form-group mb-3">
                                <!--<select2 :options="cities" v-model="selects.city" :class="[ selects.city === '' ? 'is-invalid' : '' ]" placeholder="Pilih kota...">
                                    <option value=""></option>
                                </select2>-->
                                <select v-model="selects.urban" class="custom-control custom-select custom-select-lg" :disabled="urban.length === 0" :class="classes">
                                    <option value="">
                                        <template v-if="loadUrban">
                                            Memuat kelurahan...
                                        </template>
                                        <template v-else>
                                            Pilih kelurahan...
                                        </template>
                                    </option>
                                    <template v-for="u in urban">
                                        <option :value="u.id">{{ u.text }}</option>
                                    </template>
                                </select>

                                <invalid-feedback :message="errors[0]"></invalid-feedback>
                            </div>
                        </ValidationProvider>
                        <!--<div class="form-group mb-3">
                            <select2 :options="districts" v-model="fields.districts" placeholder="Pilih kecamatan...">
                                <option value=""></option>
                            </select2>

                            <invalid-feedback :message="''"></invalid-feedback>
                        </div>-->
                        <!--<div class="form-group mb-3">
                            <select2 :options="urban" v-model="fields.urban" placeholder="Pilih kelurahan...">
                                <option value=""></option>
                            </select2>

                            <invalid-feedback :message="''"></invalid-feedback>
                        </div>-->
                        <div class="form-group mb-3">
                            <input type="text" class="form-control form-control-lg" v-model="fields.postal_code" placeholder="Kode pos">
                        </div>

                        <p class="mb-3">Dengan mengklik "Daftar" maka saya telah menyetujui <a href="http://gonigoni.id/terms.html" target="_blank">Aturan & Kebijakan</a></p>

                        <div class="d-flex align-items-center justify-content-end">

                            <button class="btn btn-secondary mr-3" @click.prevent="previousStep"><i class="mdi mdi-arrow-left"></i> Kembali</button>
                            <button class="btn btn-info float-right" :disabled="isLoading || invalid" type="submit">
                                <template v-if="isLoading">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Daftar
                                </template>
                                <span v-else>Daftar</span>
                            </button>
                        </div>
                    </ValidationObserver>
                </div>
            </form>
            <p class="text-center">Sudah memiliki akun? <a :href="loginRoute">Masuk disini</a></p>
        </template>
    </div>
</template>

<script>
    import axios from 'axios';
    import Select2 from "./Select2";

    export default {
        components: { Select2 },
        props: ['registerRoute', 'loginRoute'],
        name: "RegisterComponent.vue",
        data() {
            return {
                step: 1,
                fields: {
                    username: '',
                    email: '',
                    password: '',
                    confirm_password: '',
                    banksampahName: '',
                    phone_number: '',
                    alamat: '',
                    postal_code: '',
                },
                selects: {
                    city: '',
                    districts: '',
                    urban: '',
                },
                errors: {
                    username: null,
                    email: null,
                    password: null,
                    confirm_password: null,
                    banksampahName: null,
                    phone_number: null,
                    alamat: null,
                    city: null,
                    districts: null,
                    urban: null,
                },
                isLoading: false,
                errorClass: 'is-invalid',
                token: '',
                cities: [],
                districts: [],
                urban: [],
                success: false,
                loadUrban: false,
                loadDistrict: false,
                redirectUrl: null,
            }
        },
        methods: {
            nextStep() {
                this.step = 2;
            },
            previousStep() {
                this.step = 1;
            },
            registerAcc() {
                this.isLoading = true;
                axios.post(this.registerRoute, {...this.fields, city: this.cities.find(obj => {
                        return obj.id === this.selects.city;
                    }).text, districts: this.districts.find(obj => {
                        return obj.id === this.selects.districts;
                    }).text, urban: this.urban.find(obj => {
                        return obj.id === this.selects.urban;
                    }).text })
                    .then(res => {
                        this.isLoading = false;
                        this.success = true;
                        if (res.data.url) {
                            this.redirectUrl = res.data.url;
                        }
                    })
                    .catch(err => {
                        this.isLoading = false;
                        this.errors = err.response.data.errors;
                    })
            },
            initRajaapi() {
                return axios.get('https://x.rajaapi.com/poe')
                    .then(res => {
                        if (res.data.code === 200) {
                            this.token = res.data.token;
                        }
                        return res;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            mapText(data) {
                return data.map(item => {
                    return {
                        id: item.id,
                        text: item.name.toLowerCase().replace(/^\w/, c => c.toUpperCase()),
                    }
                });
            },
            getCities(token) {
                this.selects.districts = '';
                let url = `https://x.rajaapi.com/MeP7c5ne${token}/m/wilayah/kabupaten?idpropinsi=32`;
                return axios.get(url)
                    .then(res => {
                        if (res.data.code === 200) {
                            this.cities = this.mapText(res.data.data);
                        } else {
                            this.cities = [];
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            getDistricts() {
                this.loadDistrict = true;
                this.selects.urban = '';
                let url = `https://x.rajaapi.com/MeP7c5ne${this.token}/m/wilayah/kecamatan?idkabupaten=${this.selects.city}`;
                return axios.get(url)
                    .then(res => {
                        if (res.data.code === 200) {
                            this.loadDistrict = false;
                            this.districts = this.mapText(res.data.data);
                        } else {
                            this.districts = [];
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            getUrban() {
                this.loadUrban = true;
                let url = `https://x.rajaapi.com/MeP7c5ne${this.token}/m/wilayah/kelurahan?idkecamatan=${this.selects.districts}`;
                return axios.get(url)
                    .then(res => {
                        if (res.data.code === 200) {
                            this.loadUrban = false;
                            this.urban = this.mapText(res.data.data);
                        } else {
                            this.urban = [];
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        },
        computed: {
            city() {
                return this.selects.city;
            },
            district() {
                return this.selects.districts;
            },
        },
        watch: {
            city(val) {
                this.getDistricts();
            },
            district(val) {
                this.getUrban();
            },
            success(val) {
                setTimeout(() => {
                    window.location = this.redirectUrl;
                }, 3000);
            }
        },
        mounted() {
            this.initRajaapi().then(res => {
                this.getCities(res.data.token);
            });
        }
    }
</script>
