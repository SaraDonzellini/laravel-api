@extends('layouts.app')
@section('content')

<section class="container">
    <div class="row">
        <div class="col-12">
            <h1>
                Projects I've Worked on
            </h1>
        </div>
    </div>
    <div class="row">
    @foreach ($projects as $project )
        <div class="col-5">
            <div class="card mb-5 d-flex">
                <div class="card-header">
                    {{ $project->author }}
                </div>
                <img src="{{ $project->image }}" class="card-img-top img-fluid" alt="{{ $project->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    <p class="card-text">{{ $project->content }}</p>
                </div>
                <div class="card-header">
                    {{ $project->date }} - {{ $project->type->type }}
                </div>
            </div>

        </div>
        
        @endforeach
    </div>
    {{ $projects->links() }}
</section>

@endsection