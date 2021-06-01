@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Отчет по перемещению оборудования</h2>
            </div>

        </div>

    </div>
        <div class="row">
            <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Серийный номер</th>
                <th>Инвентарынй номер</th>
                <th>ФИО отправилетя</th>
                <th>ФИО получателя</th>
                <th>Дата отправки</th>
                <th>Дата принятия</th>
                <th>Статус</th>
            </tr>
            @foreach ($history as $item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->serial_number }}</td>
                    <td>{{ $item->inventory_number }}</td>
                    <td>{{ $item->fio_from }}</td>
                    <td>{{ $item->firstname_to . ' '. $item->lastname_to . ' '. $item->patronymic_to}}</td>
                    <td>{{ $item->send_date }}</td>
                    <td>{{ $item->received_date }}</td>
                    <td>{{ (!empty($item->received_date)) ? 'Получено' : "Отправлено" }}</td>
                    <td>
                    <div>
                        <input class="form-check-input" type="checkbox" style="margin-left: 20px" name="id[]" value={{$item->id}} aria-label="...">
                    </div>
                </td>
            </tr>
        @endforeach
            </table>
            <form action="/excel/history" method="GET"  >
                @csrf
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit"  name="data" value="{{$history}}" title="Create">Скачать<i class="fas fa-plus-circle"></i></button>
                </div>
            </form>
        </div>
@endsection
