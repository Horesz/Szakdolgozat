@extends('admin.layouts.admin')

@section('title', 'Felhasználók kezelése')

@section('content')
    <h1>Felhasználók kezelése</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Név</th>
                <th>Email</th>
                <th>Telefonszám</th>
                <th>Akciók</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? 'Nincs megadva' }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Szerkesztés</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Törlés</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
