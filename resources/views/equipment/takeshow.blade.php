@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Принять Оборудование на свой склад </h2>
            </div>

        </div>

    </div>
    <form action="/equipment/take" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Серийный номер</th>
                <th>Инвентарынй номер</th>
                <th>Дата отправки</th>
                <th width="280px">Выбрать</th>
            </tr>
            @foreach ($equipment as $item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->serial_number }}</td>
                    <td>{{ $item->inventory_number }}</td>
                    <td>{{ $item->send_date }}</td>
                    <td>
                    <div>
                        <input class="form-check-input" type="checkbox" style="margin-left: 20px" name="id[]" value={{$item->id}} aria-label="...">
                    </div>
                </td>
            </tr>
        @endforeach
            </table>
            <div class="pull-right">
                <button type="submit"  style="margin-left: 1300px" class="btn btn-primary" >Принять</button>
            </div>
        </div>
    </form>
@endsection
