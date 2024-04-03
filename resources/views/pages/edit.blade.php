@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mt-2 fw-bold">Edit the project:</h1>

        <form action="{{ route('dashboard.project.update', $project->id) }}" method="post" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="my-3">
                <label for="title" class="form-label">Insert The Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    aria-describedby="title" name="title" value='{{ old('title') ?? $project->title }}' required>

                @error('title')
                    <div class="alert alert-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                {{-- mostro la precedente immagine del project se esiste --}}
                @if ($project->cover)
                    <img class="img-fluid" src="{{ asset('/storage/' . $project->cover) }}" alt="{{ $project->title }}">
                @endif

                <div class="mt-3">
                    <label for="cover">Carica una nuova immagine</label>
                    <input type="file" name="cover" id="cover"
                        class="form-control
                        @error('cover') is-invalid @enderror">
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Insert The content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content') ?? $project->content }}</textarea>
            </div>

            {{-- <div class="mb-3">
                <label for="cover" class="form-label">Insert The Cover</label>
                <input type="text" class="form-control" id="cover" aria-describedby="cover" name="cover"
                    value='{{ old('cover') ?? $project->cover }}'>
            </div> --}}

            <div class="mb-3">

                <label for="type_id" class="form-label">Insert The Type
                </label>
                <select name="type_id" id="type_id"
                    class="form-select form-select-lg @error('type_id') is-invalid @enderror">

                    <option value="">Select One</option>

                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ $type->id == old('type_id', $project->type ? $project->type->id : '') ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach

                </select>

                @error('type_id')
                    <div class="alert alert-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Aggiungiamo i technologies --}}
            <div class="mb-3">
                <label for="technologies" class="form-label">Select technologies</label>

                <select
                    multiple

                    class="form-select form-select-lg"
                    name="technologies[]"
                    id="technologies"
                >
                    <option value="">Select one</option>

                    @forelse ($technologies as $element)

                        {{-- controllo di validazione --}}

                        @if ( $errors->any() )
                            <option
                                value="{{ $element->id }}"
                                {{ in_array($element->id, old( 'technologies', [] )) ? 'selected' : '' }}
                                >
                                {{ $element->name }}
                            </option>

                            @else

                            <option
                                value="{{ $element->id }}"
                                {{ $project->technologies->contains( $element->id ) ? 'selected' : '' }}
                                >
                                {{$element->name}}
                            </option>

                        @endif
                    @empty

                        <option value="">Non ci sono technologies</option>

                    @endforelse

                </select>
            </div>


            <button type="submit" class="btn btn-primary d-block ms-auto">ADD</button>
        </form>

    </div>
@endsection
