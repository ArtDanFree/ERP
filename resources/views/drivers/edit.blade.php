@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Редактирование</div>
                    <div class="card card-primary">
                        <form action="{{ route('driver.update', $driver) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Водитель</label>
                                    <input type="text" class="form-control" id="name" disabled value="{{ $driver->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Машина</label>
                                    <input type="text" class="form-control" id="name" disabled value="{{ $driver->car ? $driver->car->name : 'Без машины' }}">
                                </div>
                                @if(filled($driver->car))
                                    <div class="form-group">
                                        <label for="name">Тип Машины</label>
                                        <input type="text" class="form-control" id="name" disabled value="{{  $driver->car->type->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Статус машины</label>
                                        <input type="text" class="form-control" id="name" disabled value="{{  $driver->car->status->name }}">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="car_id">Сменить машину</label>
                                    <select class="form-control" id="car_id" name="car_id">
                                        @if(filled($driver->car))
                                        <option value="">Удалить машину</option>
                                        <option value="{{ $driver->car->id }}" selected>{{ $driver->car->name }}</option>
                                        @endif
                                        @foreach($cars as $car)
                                            <option value="{{ $car->id }}">{{ $car->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
