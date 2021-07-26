<ul>
@foreach ($movies as $movie)
<li>
    <a href="{{ route('movies.show', $movie->id) }}">
        {{ $movie->name }}
    </a>
</li>
@endforeach
</ul>