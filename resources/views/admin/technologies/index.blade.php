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
                    <th scope="col">Name</th>
                    <th scope="col">
                        <a href="{{ route('admin.technologies.create') }}" class="btn btn-secondary">Create new tag</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technologies as $technology)
                    <tr>
                        <td>{{ $technology->id }}</td>
                        <td>{{ $technology->name }}</td>
                        <td>
                            <a href="{{ route('admin.technologies.show', $technology) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-success">Edit</a>
                            <form class="d-inline form-deleter" action="{{ route('admin.technologies.destroy', $technology->id) }}"
                                method="POST" data-element-name="{{ $technology->title }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{-- {{ $technology->links() }} --}}
    </section>
@endsection

@section('scripts')
    @vite(['resources/js/AlertFormDelete.js'])
@endsection
