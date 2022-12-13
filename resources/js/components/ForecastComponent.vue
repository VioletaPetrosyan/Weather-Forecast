<template>
<div class="container">
    <h1>Forecast</h1>
    <div class="row">
        <div class="col-md-8">
            <form>
                <div class="form-group">
                    <p><input type="text" placeholder="City" v-model="form.city" class="form-control"></p>
                    <p class="text-danger" v-if="errorMessage">{{errorMessage}}</p>
                </div> <br />
                <div>
                    <button @click="getForecast" class="btn btn-success" type="button">Forecast</button>
                </div>
            </form>

        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-8" v-if="weatherData">
            <p><img :src="weatherData.icon" /></p>
            <p>{{weatherData.text}}</p>
            <p>Celsius: {{weatherData.temp_c}}</p>
            <p>Fahrenheit: {{weatherData.temp_f}}</p>
        </div>
    </div>




</div>
</template>

<script>
export default {
    name: "ForecastComponent",
    data() {
        return {
            form: new Form({
                city: '',
            }),
            weatherData: null,
            errorMessage: null,
        }

    },
    methods: {
        getForecast() {
            this.weatherData = null;
            this.errorMessage = null;
            this.form.post('/forecast')
                .then((response) => {
                    if (response.data.success) {
                        this.weatherData = response.data
                    } else {
                        this.errorMessage = response.data.error
                    }

                })
        }
    }
}
</script>

<style scoped>

</style>
