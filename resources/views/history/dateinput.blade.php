@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Введите период за который хотите получить отчет</h2>
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
    <form action="/history/movereport" method="GET" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="margin-left:30%">Начало периода:</strong>
                    <input style="margin-left:30%; width: 300px" type="date" name="date_from" class="form-control" placeholder="1990-12-21" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="margin-left:30%">Окончание периода:</strong>
                    <input type="date" style="margin-left:30%; width: 300px;" name="date_to" class="form-control" placeholder="date_from" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" style="margin-right:10%"class="btn btn-primary" >Получить</button>
            </div>
        </div>
    </form>
@endsection
