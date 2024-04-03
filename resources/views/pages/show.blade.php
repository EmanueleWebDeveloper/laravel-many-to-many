@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-2 fw-bold">{{ $project->title }}</h1>

        @if ($project->cover)
        <img class="img-fluid" src="{{ asset('/storage/' . $project->cover ) }}" alt="{{ $project->title }}">
        @endif

          {{-- mostrimao categoria se presente --}}
          <p>
            <strong>
                {{ $project->type ? $project->type->name : 'Non ci sono categorie' }}
            </strong>
        </p>

        @if ($project->technologies->count())
        <h4>Technologies:</h4>
        <ul>
            @foreach ( $project->technologies as $item )
                <li>{{$item->name}}</li>
            @endforeach
        </ul>
        @endif

        <p>{{ $project->content }}</p>

    </div>
@endsection
