@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-5">
                    <div class="card-header">
                        {{ $technology->name }}
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $technology->name  }}</h5>
                        <p class="card-text"></p>
                        <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-success">Edit</a>
                        <form class="d-inline form-deleter" action="{{ route('admin.technologies.destroy', $technology->id) }}"
                            method="POST" data-element-name="{{ $technology->title }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @vite(['resources/js/AlertFormDelete.js'])
@endsection
