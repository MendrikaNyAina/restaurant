@extends('layouts/layout')

@section('content')
    <form class="forms-sample" action="{{ url('ingredient') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Plat</h1>
                        @if (isset($message) && !empty($message))
                            <label class="alert alert-success">{{ $message }}</label>
                        @endif
                        @if (isset($erreur) && !empty($erreur))
                            <label class="alert alert-success">{{ $erreur }}</label>
                        @endif
                        <h2 class=" card-title card-description"> Ajouter un plat</h2>

                        @csrf
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" placeholder="nom" name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Description</label>
                            <textarea class="form-control" id="name" placeholder="nom" name="name" row="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="unit">Category</label>
                            <select name="unity_id" id="unit" class="form-control">
                                @foreach ($category as $unity)
                                    <option value="{{ $unity->id }}">{{ $unity->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">image</label>
                            <input type="file" class="form-control" id="image" placeholder="..." name="image">
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">add</button>

                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <br />
                    <br />
                    <br />
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> ingredient</th>
                                    <th> quantite </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="ingredient" class="form-select">
                                            <option value=""></option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0" class="form-control" placeholder="..." name="quantity">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
