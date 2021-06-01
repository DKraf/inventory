@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование оборудование</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary"  href="{{ route('equipment.index') }}" title="Go back"> <i class="fas fa-backward"></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Упс!</strong> Где то проблема с данными<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('equipment.update', $equipment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="margin-left: 30%">Наименование:</strong>
                    <input type="text" style="width: 500px; margin-left: 30%" name="name" value="{{$equipment->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="margin-left: 30%">Серийный номер:</strong>
                    <textarea class="form-control" style="height:50px; width: 500px; margin-left: 30%" name="serial_number"
                              placeholder="serial_number">{{ $equipment->serial_number }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="margin-left: 30%">Инвентарынй номер:</strong>
                    <input type="text" style="width: 500px; margin-left: 30%" name="inventory_number" class="form-control" placeholder="{{ $equipment->inventory_number }}"
                           value="{{ $equipment->inventory_number}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" style="margin-left: 22%">Редактировать</button>
            </div>
        </div>
    </form>
@endsection
