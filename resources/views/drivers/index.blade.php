@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Водители
                        <a href="{{ route('driver.create') }}" type="button" class="btn btn-outline-info">Добавить</a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Имя</th>
                            <th scope="col">Машина</th>
                            <th scope="col">Тип Машины</th>
                            <th scope="col">Статаус Машины</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($drivers as $driver)
                            <tr>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->car ? $driver->car->name : 'Без машины' }}</td>
                                <td>{{ $driver->car ? $driver->car->type->name : '-' }}</td>
                                <td>{{ $driver->car ? $driver->car->status->name : '-' }}</td>
                                <td>
                                    <a href="{{ route('driver.edit', $driver) }}" type="button" class="btn btn-outline-success">Редактировать</a>
                                    <button onclick="deleteDriver({{ $driver->id }})" type="button" class="btn btn-outline-danger">
                                        Удалить
                                    </button>
                                    <form id="delete-driver-{{ $driver->id }}" action="{{ route('driver.destroy', $driver) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function deleteDriver(id) {
            Swal.fire({
                title: "Удалить транспорт ?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonText: "Удалить",

            })
                .then(function (result) {
                    if (result.value) {
                        $('#delete-driver-' + id).submit()
                    }
                });
        }
    </script>
@endsection
