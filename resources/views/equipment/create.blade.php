@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавление нового оборудования</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('equipment.index') }}" title="Назад" > <i class="fas fa-backward "></i> </a>
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
    <form action="{{ route('equipment.store') }}" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="margin-left:30%">Наименование:</strong>
                    <input style="margin-left:30%; width: 500px" type="text" name="name" class="form-control" placeholder="Name" style="width: 500px">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="margin-left:30%">Серийный номер:</strong>
                    <input type="text" style="margin-left:30%; width: 500px;" name="serial_number" class="form-control" placeholder="serial_number" style="width: 500px">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="margin-left:30%">Инвентарный номер:</strong>
                    <input type="text" style="margin-left:30%; width: 500px;" name="inventory_number" class="form-control" placeholder="inventory_number" style="width: 500px">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" style="margin-left:25%" class="btn btn-primary" style="margin-right: 70%">Добавить</button>
            </div>
        </div>
    </form>
@endsection
