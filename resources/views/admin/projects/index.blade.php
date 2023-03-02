@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-{{ session('alert-type') }}">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Type</th>
                    <th scope="col">Technologies</th>
                    <th scope="col">Date</th>
                    <th scope="col">
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-secondary">Create new project</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->author }}</td>
                        <td>{{ $project->type->type }}</td>
                        <td>
                            @forelse ($project->technologies as $tech)
                                #{{$tech->name}}
                            @empty
                                No technologies to show
                            @endforelse
                        </td>
                        <td>{{ $project->date }}</td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-success">Edit</a>
                            <form class="d-inline form-deleter" action="{{ route('admin.projects.destroy', $project->id) }}"
                                method="POST" data-element-name="{{ $project->title }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{ $projects->links() }}
    </section>
@endsection

@section('scripts')
    @vite(['resources/js/AlertFormDelete.js'])
@endsection
