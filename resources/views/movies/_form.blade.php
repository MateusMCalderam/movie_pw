@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Filme</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Corrija os erros abaixo:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('movies.store') }}" method="POST">
        @include('movies._form', ['submitButtonText' => 'Salvar'])
    </form>
</div>
@endsection
