<template>
    <div>
        <form class="form-horizontal m-t-20">

            <div class="row p-b-30">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <input type="text" name="login" class="form-control form-control-lg" placeholder="Username atau alamat email" aria-label="Username" aria-describedby="basic-addon1" required="">

                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Kata sandi" aria-label="Password" aria-describedby="basic-addon1" required="">
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
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
                            <a class="btn btn-secondary" href="#"><i class="fa fa-lock m-r-5"></i> Lupa kata sandi?</a>
                            <button class="btn btn-info float-right" type="submit">Masuk</button>
                        </div>
                    </div>
                    <p class="text-center">Belum memiliki akun? <a href="#">Daftar disini</a></p>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
