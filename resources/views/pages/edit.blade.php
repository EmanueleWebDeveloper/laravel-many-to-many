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

            <button type="submit" class="btn btn-primary d-block ms-auto">ADD</button>
        </form>

    </div>
@endsection
