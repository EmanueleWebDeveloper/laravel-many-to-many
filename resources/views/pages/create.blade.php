@extends('layouts.app')
@section('content')
    <div class="jumbotron p-5 mb-4 bg-light rounded-3">
        <div class="container py-5 ">
            <h1>Crea un nuovo Progetto:</h1>

            <form action="{{ route('dashboard.project.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="my-3">
                    <label for="title" class="form-label">Insert The Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        aria-describedby="title" name="title" value='{{ old('title') }}' required>

                    @error('title')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="file" name="cover" id="cover"
                        class="form-control
                            @error('cover') is-invalid @enderror">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Insert The content</label>

                    <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
                </div>

                {{-- <div class="mb-3">
                    <label for="cover" class="form-label">Insert The Cover</label>

                    <input type="text" class="form-control" id="cover" aria-describedby="cover" name="cover"
                        value='{{ old('cover') }}'>
                </div> --}}

                <div class="mb-3">

                    <label for="type_id" class="form-label">Insert The Type
                    </label>
                    <select name="type_id" id="type_id"
                        class="form-select form-select-lg @error('type_id') is-invalid @enderror">

                        <option value="">Select One</option>

                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
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

                <button type="submit" class="btn btn-primary d-block ms-auto">ADD
                </button>

            </form>

        </div>
    </div>
    </div>
@endsection
