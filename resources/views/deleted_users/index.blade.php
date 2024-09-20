@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <div class="center-container">
        <h1>Daftar User yang Dihapus</h1>

        @if(isset($deletedUsers) && $deletedUsers->isEmpty())
            <p>Tidak ada pengguna yang dihapus.</p>
        @else
            <div class="table-wrapper">
                <table border="1" cellpadding="10" cellspacing="0" class="center-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Dihapus oleh</th>
                            <th>Tanggal Dihapus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deletedUsers as $user)
                            <tr>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->phone }}</td>
                                <td class="text-center">
                                    @if($user->deletedByUser)
                                        {{ $user->deletedByUser->name }}
                                    @else
                                        Tidak diketahui
                                    @endif
                                </td>
                                <td class="text-center">{{ $user->deleted_at ? $user->deleted_at->format('d-m-Y H:i:s') : 'Tidak diketahui' }}</td>
                                <td class="text-center actions">
                                    <form action="{{ route('restoreUser', $user->id) }}" method="POST" onsubmit="return confirm('Yakin Mau dipulihkan?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-arrow-counterclockwise" style="font-size: 1.20rem;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <br>
        <button class="btn btn-secondary" onclick="window.history.back();" style="font-size: 1.15rem;">Close</button>
    </div>
@endsection

<style>
    body {
        margin: 0;
        padding: 0;
    }

    .center-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px; 
    }

    .table-wrapper {
        width: 100%;
        max-width: 1200px; 
        padding: 0 20px; 
        box-sizing: border-box; 
    }

    .center-table {
        width: 100%;
        border-collapse: collapse;
    }

    .center-table th, .center-table td {
        border: 1px solid #ddd; 
        padding: 3px;
        text-align: center;
    }

    .center-table thead {
        background-color: #f2f2f2;
    }

    .center-container h1 {
        margin-bottom: 20px; 
    }

    .center-container button {
        margin-top: 20px; 
    }

    .btn-success:hover {
        background-color: #a0bba6;
        border-color: #79bd87;
    }
</style>
