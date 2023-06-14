@extends('layouts/layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Ingredient: {{ $ingredient->name }}</h1>
            <ul>
                <li>Unite: {{ $ingredient->unity->name }}</li>
                <li>Prix unitaire: {{ $ingredient->unit_price }}</li>
                <li>Stock: {{ $ingredient->stock }}</li>
            </ul>
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active btn-gradient-light" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Entree de stock</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn-gradient-light" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">Utilisation stock</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn-gradient-light" id="pills-contact-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                        aria-selected="false">Mise a jour de stock</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <h2 class="card-title">Entrée de stock</h2>
                    <form action="{{ url('ingredient/' . $ingredient->id . '/entry') }}" method="GET">
                        @csrf
                        <div class="col-lg-6 col-md-6 col-sm-8">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="week" class="form-control" aria-label=""
                                        aria-describedby="basic-addon2" name="week_entre">
                                    <div class="input-group-append">
                                        <button class="btn btn-gradient-primary me-2" type="submit">ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br />
                    <br />
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> date</th>
                                <th> quantite </th>
                                <th> prix unitaire </th>
                                <th>montant total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($entry))
                                @foreach ($entry as $in)
                                    <tr>
                                        <td> {{ $in->date_movement }} </td>
                                        <td> {{ $in->quantity }} </td>
                                        <td> {{ $in->unit_price }} </td>
                                        <td> {{ $in->quantity * $in->unit_price }} </td>
                                    </tr>
                                @endforeach
                            @endif
                            <form method="post" action="{{ url('ingredient/'.$ingredient->id.'/entry') }}">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="date_entre">Date</label>
                                            <input type="date" class="form-control" id="date_entre" placeholder="..."
                                                name="date_entre">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="quantite_entre">Quantite</label>
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                id="quantite_entre" placeholder="..." name="quantite_entre">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="unit_price_entre">Prix unitaire</label>
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                id="unit_price_entre" placeholder="..." name="unit_price_entre">
                                        </div>
                                    </td>
                                    <td><button class="btn btn-gradient-primary" type="submit">Ajouter</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <h2 class="card-title">Utilisation du stock</h2>
                    <form action="{{ url('ingredient/'.$ingredient->id.'/output') }}" method="GET">
                        @csrf
                        <div class="col-lg-6 col-md-6 col-sm-8">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="week" class="form-control" aria-label=""
                                        aria-describedby="basic-addon2" name="week_sortie">
                                    <div class="input-group-append">
                                        <button class="btn btn-gradient-primary me-2" type="submit">ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br />
                    <br />
                    <table class="table table-bordered">
                        <thead>
                            @if (isset($output))
                                @foreach ($output as $in)
                                    <tr>
                                        <td> {{ $in->date_movement }} </td>
                                        <td> {{ $in->quantity }} </td>
                                        <td> {{ $in->unit_price }} </td>
                                        <td> {{ $in->quantity * $in->unit_price }} </td>
                                    </tr>
                                @endforeach
                            @endif
                        </thead>
                        <tbody>
                            <tr>
                                <th> date</th>
                                <th> quantite </th>
                                <th> prix unitaire </th>
                                <th>montant total</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <h2 class="card-title">Rappel de stock</h2>
                    <form action="{{ url('ingredient/'.$ingredient->id.'/update') }}" method="GET">
                        @csrf
                        <div class="col-lg-6 col-md-6 col-sm-8">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="week" class="form-control" aria-label=""
                                        aria-describedby="basic-addon2" name="week_rappel">
                                    <div class="input-group-append">
                                        <button class="btn btn-gradient-primary me-2" type="submit">ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br />
                    <br />
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> date</th>
                                <th> quantite </th>
                                <th> prix unitaire </th>
                                <th>montant total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($update))
                                @foreach ($update as $in)
                                    <tr>
                                        <td> {{ $in->date_update }} </td>
                                        <td> {{ $in->quantity }} </td>
                                        <td> {{ $in->unit_price }} </td>
                                        <td> {{ $in->quantity * $in->unit_price }} </td>
                                    </tr>
                                @endforeach
                            @endif
                            <form method="post" action="{{ url('ingredient/'.$ingredient->id.'/update') }}">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="date_rappel">Date</label>
                                            <input type="date" class="form-control" id="date_rappel"
                                                placeholder="..." name="date_rappel">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="quantite_rappel">Quantite</label>
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                id="quantite_rappel" placeholder="..." name="quantite_rappel">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="unit_price_rappel">Prix unitaire</label>
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                id="unit_price_rappel" placeholder="..." name="unit_price_rappel">
                                        </div>
                                    </td>
                                    <td><button class="btn btn-gradient-primary" type="submit">redefinir</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
