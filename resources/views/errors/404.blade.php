@extends('layouts.app')
@section('content')
        <div class="container">
            @if(Session::has('404message'))
                <div class="alert alert-danger">
                    {!! session('404message') !!}
                </div>
            @endif
            <div class="content">
                <div class="h1" style="padding: 200px 0;">Странице не найдена!!! Проверьте правильность линка.</div>
            </div>
        </div>
@endsection
