@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Отчет по оборудованию на всех складах </h2>
                <div class="pull-right">
                    <a class="btn btn-primary"  style="margin-left: 80rem" href="{{ route('equipment.index') }}" title="Go back"> <i class="fas fa-backward"></i> </a>
                </div>
            </div>

        </div>
    </div>

        <div class="row">
            <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Склад</th>
                <th>Адрес</th>
                <th>Серийный номер</th>
                <th>Инвентарынй номер</th>
            </tr>
            @foreach ($equipment as $item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->store_name }}</td>
                    <td>{{ $item->store_address }}</td>
                    <td>{{ $item->serial_number }}</td>
                    <td>{{ $item->inventory_number }}</td>
            </tr>
        @endforeach
            </table>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-success" href="/excel/equip" title="Create">Скачать<i class="fas fa-plus-circle"></i></a>
            </div>
        </div>
    </form>
@endsection
