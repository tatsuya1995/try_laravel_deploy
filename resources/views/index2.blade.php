@extends('layouts.app')

@section('content')

<div class="cards">
    @foreach ($files as $file)
        <div class="card" style="width: 24%;">
            <img class="card-img-top" src="{{ url("/images/${file}") }}" style="height: auto;">

            <div class="card-body">
                <form action="{{ url("/images/${file}") }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}

                    <button class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
