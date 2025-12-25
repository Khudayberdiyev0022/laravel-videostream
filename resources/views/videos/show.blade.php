@extends('layouts.app')
@push('styles')
  <link rel="stylesheet" href="https://cdn.vidstack.io/player/theme.css" />
  <link rel="stylesheet" href="https://cdn.vidstack.io/player/video.css" />
@endpush
@section('content')

  <div class="container py-5" style="max-width: 1200px">
    <div class="row row-gap-4">
      <div class="col-md-12">
        <h3>{{ $video->title }}</h3>

        <media-player title="{{ $video->title }}" src="{{ $videoUrl }}" crossorigin playsinline>
          <media-provider>
            <media-poster src="{{ $video->cover }}" class="vds-poster"></media-poster>
          </media-provider>
          <media-video-layout></media-video-layout>
        </media-player>

        <p class="pt-2">{{ $video->description }}</p>

      </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script src="https://cdn.vidstack.io/player" type="module"></script>
@endpush
