@extends('layouts.app')

@section('content')
<div class="container">
  <h5>User List</h5>
  <table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created At</th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user['id'] }}</td>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['created_at'] }}</td>
        </tr>
    @endforeach
  </table>
</div>
@endsection