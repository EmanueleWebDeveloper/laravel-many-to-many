@extends('layouts.app')

@section('content')
    <style>

    </style>

    <div class="container">
        <div class="jumbotron bg-light p-4 p-md-5 rounded-3">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="display-4">Emanuele Luca Cali Portfolio</h1>
                    <p class="lead">Benvenuto nel mio portfolio. Qui puoi trovare i miei progetti più recenti.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-primary btn-lg mt-3 mt-md-0" href="{{ route('dashboard.project.create') }}">Aggiungi
                        nuovo progetto</a>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($project as $item)
                <div class="col-md-4 mb-4">

                    <div class="card">
                        <img
                        src="{{ $item->cover }}"
                        class="card-img-top"
                        alt="{{ $item->title }}">

                        <div class="card-body">

                            <a href="{{ route('dashboard.project.show', $item->id) }}">
                                {{ $item->title }}
                            </a>

                            <div class="accordion" id="accordion{{ $item->id }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-white" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $item->id }}" aria-expanded="true"
                                            aria-controls="collapse{{ $item->id }}">
                                            Dettagli del progetto
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $item->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordion{{ $item->id }}">
                                        <div class="accordion-body">
                                            <p>{{ $item->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-3">

                                <a href="{{ route('dashboard.project.edit', $item->id) }}" class="btn btn-warning">Modifica
                                </a>


                                <form method="POST" action="{{ route('dashboard.project.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Elimina
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
