@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Movies</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (auth()->user() && auth()->user()->admin)
                        <a class="float-right btn btn-primary mb-3" href="{{ route('movies.create') }}">
                            Add new Movie
                        </a>
                    @endif
                    <table class="table">
                        @foreach($movies as $movie)
                            <tr>
                                <td>
                                    <a href="{{ route('movies.show', $movie->id) }}">
                                        {{ $movie->name }}
                                    </a>
                                </td>
                                @if (auth()->user() && auth()->user()->admin)
                                    <td class="text-right">
                                        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="post" action="{{ route('movies.delete', $movie->id) }}" onSubmit="return confirm('Are you sure?')">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
