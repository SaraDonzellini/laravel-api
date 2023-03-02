@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-5">
                    <div class="card-header">
                        {{ $project->author }}
                    </div>
                    <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top img-fluid" alt="{{ $project->title }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ $project->content }}</p>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-success">Edit</a>
                        <form class="d-inline form-deleter" action="{{ route('admin.projects.destroy', $project->id) }}"
                            method="POST" data-element-name="{{ $project->title }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                    </div>
                    <div class="card-header">
                        {{ $project->date }} - {{$project->type->type}}
                    </div>
                    <div class="card-footer">
                        @foreach ($project->technologies as $technology)
                            #{{$technology->name}}
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @vite(['resources/js/AlertFormDelete.js'])
@endsection
