@extends('layouts/layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Liste des ingredients</h1>
            <h2 class=" card-title card-description"> Filtre</h2>
            <form action="{{ url('ingredients') }}" method="GET">
                <div class="row">
                    @csrf
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" placeholder="nom" name="name">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label for="prix_min">Prix min</label>
                            <input type="number" step="0.01" class="form-control" id="prix_min" placeholder="0"
                                name="prix_min">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label for="prix_max">Prix max</label>
                            <input type="number" step="0.01" class="form-control" id="prix_max" placeholder="0"
                                name="prix_max">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label for="stock_min">Stock min</label>
                            <input type="number" step="0.01" class="form-control" id="stock_min" placeholder="nom"
                                name="stock_min">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="form-group">
                            <label for="stock_max">Stock max</label>
                            <input type="number" step="0.01" class="form-control" id="stock_max" placeholder="nom"
                                name="stock_max">
                        </div>
                    </div>
                    <div>
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <button type="submit" class="btn btn-gradient-primary">rechercher</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--table-->
            <br />
            <br />
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> ingredient</th>
                        <th> unite </th>
                        <th> prix unitaire </th>
                        <th> stock </th>
                        <th> valeur stock </th>
                        <th> voir </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredient as $in)
                        <tr>
                            <td> {{ $in->name }} </td>
                            <td> {{ $in->unity->name }} </td>
                            <td> {{ $in->unit_price }} </td>
                            <td> {{ $in->stock }} </td>
                            <td> {{ $in->stock * $in->unit_price }} </td>
                            <td> <a href="{{ url('ingredient/' . $in->id) }}" class="btn btn-gradient-primary">voir</a> </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br />
            {{ $ingredient->appends($filters)->onEachSide(2)->links('components.pagination') }}
        </div>
    </div>
@endsection
