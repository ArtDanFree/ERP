<template>
    <div v-if="cars.length" class="card">
        <div class="card-header">Транспорт
            <router-link to="car/create"><button type="button" class="btn btn-outline-info">Добавить</button></router-link>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Водитель</th>
                <th scope="col">Тип</th>
                <th scope="col">Статус</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="car in cars">
                <td>{{ car.name }}</td>
                <td>{{ car.driver_name }}</td>
                <td>{{ car.type }}</td>
                <td>{{ car.status }}</td>
                <td>
                    <router-link :to="'/car/' + car.id + '/edit' "><button type="button" class="btn btn-outline-success">Редактировать</button></router-link>
                    
                    <button @click="destroy(car.id)" type="button" class="btn btn-outline-danger">Удалить</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "Index",
        data: function () {
            return {
                cars: Object
            }
        },
        mounted() {
            this.getCars()
        },
        methods: {
            getCars: function () {
                let app = this;
                axios.get('api/car')
                    .then(function (response) {
                        app.cars = response.data.data
                    })
            },
            destroy: function (id) {
                let app = this;
                app.$swal({
                    title: "Удалить транспорт ?",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: 'Отмена',
                    confirmButtonText: "Удалить",
                    
                })
                    .then(function (result) {
                        if (result.value) {
                            axios.delete('api/car/' + id)
                                .then(function (response) {
                                    app.getCars();
                                    app.$swal({
                                        position: 'top-end',
                                        text: response.data.message,
                                        type: 'success',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    
                                });
                        }
                    });
            }
        }
    }
</script>

<style scoped>

</style>
