@extends('layouts/layout')

@section('content')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Ingredient</h1>
                @if(isset($message) && !empty($message))
                    <label class="alert alert-success">{{$message}}</label>
                @endif
                @if(isset($erreur) && !empty($erreur))
                    <label class="alert alert-success">{{$erreur}}</label>
                @endif
                <h2 class=" card-title card-description"> Ajouter un ingredient</h2>
                <form class="forms-sample" action="{{ url('ingredient') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">nom</label>
                        <input type="text" class="form-control" id="name" placeholder="nom" name="name">
                    </div>
                    <div class="form-group">
                        <label for="unit">Unite</label>
                        <select name="unity_id" id="unit" class="form-control">
                            @foreach($unities as $unity)
                            <option value="{{ $unity->id }}">{{ $unity->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">image</label>
                        <input type="file" class="form-control" id="image" placeholder="..." name="image">
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
