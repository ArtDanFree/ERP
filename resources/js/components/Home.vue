<template>
    <div class="card" v-if="user">
        <div class="card-header">Домашняя страница
        </div>
        <div class="border-bottom p-4">
            <div class="osahan-user text-center">
                <div class="osahan-user-media">
                    <img class="mb-3 rounded-pill shadow-sm mt-1" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="gurdeep singh osahan">
                    <div class="osahan-user-media-body">
                        <p><b>Роль: </b>{{ user.roles[0].name }}</p>
                        <p><b>Имя: </b>{{ user.name }}</p>
                        <template v-if="user.car">
                            <p><b>Машина: </b>{{ user.car.name }}</p>
                            <p><b>Тип машины: </b>{{ user.car.type.name }}</p>
                            <p><b>Статус машины: </b>{{ user.car.status.name }}</p>
                        </template>
                        <p v-else><b>Машина: </b>Нету</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Home",
        data: function () {
            return {
                user: null
            }
        },
        mounted() {
            let app = this;
            axios.get('api/user')
                .then(function (response) {
                    app.user = response.data;
                });
        }
    }
</script>

<style scoped>

</style>
