@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Отправка Оборудования  на другой склад </h2>
            </div>

        </div>

    </div>
    <form action="/equipment/send" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Склад</th>
                <th>Серийный номер</th>
                <th>Инвентарынй номер</th>
                <th width="280px">Действие</th>
            </tr>
            @foreach ($equipment as $item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->store_name }}</td>
                    <td>{{ $item->serial_number }}</td>
                    <td>{{ $item->inventory_number }}</td>
                <td>
                    <div>
                        <input class="form-check-input" type="checkbox" style="margin-left: 20px" name="id[]" value={{$item->id}} aria-label="...">
                    </div>
                </td>
            </tr>
        @endforeach
            </table>
            <div class="pull-right">
                <button type="submit"  style="margin-left: 1300px" class="btn btn-primary" >Отправить</button>
            </div>
        </div>
    </form>
@endsection
