@extends('layouts.app')

@if (Auth::user()->rules_id ===1)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Панель - Администратора</div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            <a href="/history/eqreport">Просмотреть отчет оборудований на складах</a>
                        </div>
                        <div class="alert alert-success" role="alert">
                            <a href="/history/dateinput" >Просмотреть отчет перемещений оборудований</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endif
@if (Auth::user()->rules_id ===2)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Панель - Управляющего </div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            <a href="/equipment">Просмотреть оборудование на складе</a>
                        </div>
                        <div class="alert alert-success" role="alert">
                            <a href="{{ route('equipment.create') }}" >Добавить оборудование на склад</a>
                        </div>
                        <div class="alert alert-success" role="alert">
                            <a href="/equipment/sendshow" >Отправить оборудование</a>
                        </div>
                        <div class="alert alert-success" role="alert">
                            <a href="/equipment/takeshow" >Принять оборудование</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endif

