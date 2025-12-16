@extends('layouts.app')
@section('content')
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">+ Create</a>
  </div>
  <table class="table table-bordered table-striped table-hover">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Slug</th>
      <th>URL</th>
      <th>External Link</th>
      <th>Order</th>
      <th>Children</th>
      <th>Icon</th>
      <th>Target</th>
      <th>Locations</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
    @foreach($menus as $menu)
      <tr>
        <td>{{ $menu->id }}</td>
        <td>{{ $menu->name }}</td>
        <td>{{ $menu->slug }}</td>
        <td>{{ $menu->url }}</td>
        <td>{{ $menu->external_link }}</td>
        <td>{{ $menu->order }}</td>
        <td>{{ $menu->children->count() ?: 'No children' }}</td>
        <td>{{ $menu->icon }}</td>
        <td>{{ $menu->target }}</td>
        <td>
          @foreach($menu->locations as $location)
            <span class="badge bg-primary">{{ $location }}</span>
          @endforeach
        </td>
        <td>
            <span class="badge {{ $menu->is_active ? 'bg-success' : 'bg-danger' }}">
              {{ $menu->is_active ? 'Active' : 'Inactive' }}
            </span>
        </td>
        <td>
          <a href="" class="btn btn-primary btn-sm">Edit</a>
        </td>
      </tr>
    @endforeach
  </table>
@endsection
