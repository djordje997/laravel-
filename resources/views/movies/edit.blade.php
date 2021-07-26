@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $movie->name }}" />
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ $movie->description }}</textarea>
            @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            @foreach($genres as $genre)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}" id="genre{{ $genre->id }}"  @if($movie->genres->contains($genre->id)) checked @endif>
                    <label class="form-check-label" for="genre{{ $genre->id }}">
                        {{ $genre->name }}
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection