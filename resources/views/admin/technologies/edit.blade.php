@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-12">
                <h1>
                    {{$technology->name}}

                </h1>
            </div>
            <div class="col-12">
                <form action="{{ route('admin.technologies.update', $technology) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $technology->name) }}">
                    </div>
                    <button type="submit" class="btn btn-secondary">Edit tag</button>
                </form>

            </div>
        </div>
    </section>
@endsection
