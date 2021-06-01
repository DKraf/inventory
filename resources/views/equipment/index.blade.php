@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Оборудование на складе </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('equipment.create') }}" title="Create">Добавить<i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
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
                    <a href="{{ route('equipment.edit', $item->id) }}">
                        <i class="fas fa-edit  fa-lg"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            </div>
    </table>


@endsection
