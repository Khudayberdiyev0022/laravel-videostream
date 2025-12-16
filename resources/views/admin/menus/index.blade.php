@extends('layouts.app')
@section('content')

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Slug</th>
      <th>Status</th>
    </tr>
   @foreach($menus as $menu)
      <tr>
        <td>{{ $menu->id }}</td>
        <td>{{ $menu->name }}</td>
        <td>{{ $menu->slug }}</td>
        <td>{{ $menu->is_active ? 'Active' : 'Inactive' }}</td>
      </tr>
   @endforeach
  </table>
@endsection
