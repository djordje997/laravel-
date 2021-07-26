@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $movie->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($movie->genres as $genre)
                        {{ $genre->name }}
                    @endforeach

                    <br /><br />
                    <strong>Description:</strong><br />
                    {{ $movie->description }}
                    <br /><br />
                    @if (auth()->user())
                        <form method="POST" action="{{ route('movies.mark', $movie->id) }}" class="form-inline">
                            @csrf
                            <select name="mark" class="form-control">
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <button class="btn btn-success">submit</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection