<template>
    <div class="container">
        <div class="post">
            <div class="postinfotop">
                <h2>Login</h2>
                <p id="text" style="color:green; margin-left:100px;"></p>
            </div>
            <form action="#" class="form newtopic" @submit.prevent="login">
                <div class="accsection">
                    <div class="topwrap">
                        <div class="userinfo pull-left">
                        </div>
                        <div class="posttext pull-left">
                            <div class="col-lg-6 col-md-6">
                                <input v-model="form.name" type="text" placeholder="Name" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('name') }" name="name">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-2">
                                <input v-model="form.password" type="password" placeholder="Password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"
                                       name="password">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="text-danger" v-if="loginFailed">
                    Incorrect login or password!
                </div>
                <button type="submit" class="btn btn-primary mt-2">Login</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "LoginComponent",
    data() {
        return {
            form: new Form({
                name: '',
                password: '',
            }),
            loginFailed: false
        }
    },
    methods: {
        login() {
            this.loginFailed = false;
            this.form.post('/login')
                .then((response) => {
                    if (response.data.success) {
                        window.location.href = '/forecast';
                    } else {
                        this.loginFailed = true;
                    }
                })
        },
    },
}
</script>

<style scoped>

</style>
