@extends('layouts.app')
@section('content')

  <div class="container py-5" style="max-width: 1200px">
    <div class="row row-gap-4">
      @foreach($videos as $video)
        <div class="col-md-3">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title text-center">{{ $video->title }}</h4>
            </div>
            <div class="card-body">
              <img src="{{ asset($video->cover) }}" alt="" class="img-fluid" width="100%" height="120">
              <p class="text-truncate pt-2">{{ $video->description }}</p>
              <a href="{{ route('videos.show', $video->slug) }}" class="btn btn-primary float-end">Read more</a>
            </div>
          </div>
        </div>
      @endforeach
      <div class="mt-3">
        {{ $videos->links() }}
      </div>
    </div>
  </div>

@endsection
