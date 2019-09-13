<template>
    <div class="card">
        <div class="card-header">Редактирование</div>
        <div class="card card-primary">
            <form @submit="create()">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Название машины</label>
                        <input type="text" class="form-control" v-bind:class="{ 'is-invalid': errors.name }" id="name" v-model="form.name">
                        <div class="invalid-feedback">
                            <ul v-if="errors.name">
                                <li v-for="error in errors.name">{{ error }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_id">Статус</label>
                        <select class="form-control" id="status_id" v-model="form.status_id" v-bind:class="{ 'is-invalid': errors.status_id }">
                            <option v-for="status in data.statuses" :value="status.id" >
                                {{ status.name }}
                            </option>
                        </select>
                        <div class="invalid-feedback">
                            <ul v-if="errors.status_id">
                                <li v-for="error in errors.status_id">{{ error }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type_id">Тип машины</label>
                        <select class="form-control" id="type_id" v-model="form.type_id" v-bind:class="{ 'is-invalid': errors.type_id }">
                            <option v-for="type in data.types" :value="type.id" >
                                {{ type.name }}
                            </option>
                        </select>
                        <div class="invalid-feedback">
                            <ul v-if="errors.type_id">
                                <li v-for="error in errors.type_id">{{ error }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="driver_id">Водитель</label>
                        <select class="form-control" id="driver_id" v-model="form.driver_id" v-bind:class="{ 'is-invalid': errors.driver_id }">
                            <option v-for="driver in data.drivers" :value="driver.id">
                                {{ driver.name }}
                            </option>
                        </select>
                        <div class="invalid-feedback">
                            <ul v-if="errors.driver_id">
                                <li v-for="error in errors.driver_id">{{ error }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Create",
        data: function () {
            return {
                data: {},
                form: {
                    name: '',
                    status_id: '',
                    type_id: '',
                    driver_id: '',
                },
                errors: {}
            }
        },
        mounted() {
            this.getData()
        },
        methods: {
            getData: function (id) {
                let app = this;
                axios.get('api/car/create')
                    .then(function (response) {
                        app.data = response.data;
                    });
            },
            create: function (form) {
                let app = this;
                axios.post('api/car', app.form)
                    .then(function (response) {
                        app.$router.replace({path: "/car/"+ response.data.id +"/edit"});
                        window.Swal.fire({
                            position: 'top-end',
                            text: response.data.message,
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(function (error) {
                        app.errors = error.response.data.errors;
                    })
            }
        }
    }
</script>

<style scoped>

</style>
