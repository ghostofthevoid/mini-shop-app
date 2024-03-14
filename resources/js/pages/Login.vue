<script setup>

import {ref} from "vue";
import router from "@/router/index.js";

const formData = ref({
    email: null,
    password: null
})

const login = async () => {
    await axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/login', formData.value ?? {})
            .then(res => {
                console.log(res)
                localStorage.setItem('token', res.config.headers['X-XSRF-TOKEN'])
                router.push('/home')
            }).catch(err => {
            console.log(err.response)
        })
    });
}
</script>

<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Login Form</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" v-model="formData.email"
                                           placeholder="Email" required autocomplete="email" autofocus>
                                </div>
                            </div>
                            <div class="form-group mt-3 row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="position-relative col-sm-10">
                                    <input type="password" class="form-control" v-model="formData.password"
                                           placeholder="Password" required autocomplete="current-password">
                                </div>
                            </div>
                            <div class="form-group m-3 row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button @click.prevent="login" type="submit" class="btn btn-submit ms-3">Sign in</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
