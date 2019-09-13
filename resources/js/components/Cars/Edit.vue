<template>
    <div class="card" v-if="data.car !== undefined">
        <div class="card-header">Редактирование</div>
        <div class="card card-primary">
            <form @submit="update()">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Название машины</label>
                        <input type="text" class="form-control" id="name" v-model="form.name">
                    </div>
                    <div class="form-group">
                        <label for="status_id">Статус</label>
                        <select class="form-control" id="status_id" v-model="form.status_id">
                            <option v-for="status in data.statuses" :value="status.id" :selected="data.car.status.id === status.id">
                                {{ status.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type_id">Тип машины</label>
                        <select class="form-control" id="type_id" v-model="form.type_id">
                            <option v-for="type in data.types" :value="type.id" :selected="data.car.type.id === type.id">
                                {{ type.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="driver_id">Водитель</label>
                        <select class="form-control" id="driver_id" v-model="form.driver_id">
                            <option v-if="data.car.driver !== null" :value="data.car.driver.id" selected>{{ data.car.driver.name }}</option>
                            <option v-if="data.car.driver !== null" value="" selected>Убрать водителя</option>
                            <option v-for="driver in data.drivers" :value="driver.id">
                                {{ driver.name }}
                            </option>
                        </select>
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
        name: "Edit",
        data: function () {
            return {
                data: Object,
                form: {
                    name: '',
                    status_id: '',
                    type_id: '',
                    driver_id: '',
                }
            }
        },
        props: {
            id: String
        },
        mounted() {
            this.getCar(this.id)
        },
        methods: {
            getCar: function (id) {
                let app = this;
                axios.get('api/car/' + id + '/edit')
                    .then(function (response) {
                        app.data = response.data;
                        app.form.name = response.data.car.name;
                        app.form.status_id = response.data.car.status_id;
                        app.form.type_id = response.data.car.type_id;
                        app.form.driver_id = response.data.car.driver_id;
                    });
            },
            update: function (form) {
                let app = this;
                axios.put('api/car/' + app.id, app.form)
                    .then(function (response) {
                        app.getCar(app.id);
                        window.Swal.fire({
                            position: 'top-end',
                            text: response.data.message,
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    });
            }
        }
    }
</script>

<style scoped>

</style>
