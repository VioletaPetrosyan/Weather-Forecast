<template>
    <div class="container">
        <div class="post">
            <div class="postinfotop">
                <h2>Create New Account</h2>
                <p id="text" style="color:green; margin-left:100px;"></p>
            </div>
            <form action="#" class="form newtopic" @submit.prevent="register">
                <div class="accsection">
                    <div class="topwrap">
                        <div class="userinfo pull-left">
                        </div>
                        <div class="posttext pull-left">
                            <div>
                                <input v-model="form.name" type="text" placeholder="Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" name="name">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="mt-2">
                                <input v-model="form.email" type="email" placeholder="Email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" name="email">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-6 col-md-6">
                                    <input v-model="form.password" type="password" placeholder="Password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" name="password">
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <input v-model="form.password_confirmation" type="password" placeholder="Confirm password" class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" name="password_confirmation">
                                    <has-error :form="form" field="password_confirmation"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Sign Up</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "RegisterComponent",
    data () {
        return {
            form: new Form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            })
        }
    },
    methods: {
        register () {
            this.form.post('/register')
                .then(( response ) => {
                    if (response.status) {
                        window.location.href = '/login';
                    }
                    var attr = document.getElementById("text");
                    attr.innerHTML = response.data.message;
                    this.form.reset();
                })
        },
    },
}
</script>

<style scoped>

</style>
