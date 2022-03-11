@php
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts */
@endphp

@foreach($posts as $post)
    <div style="margin-bottom: 10px;">
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->description }}</p>
    </div>
@endforeach