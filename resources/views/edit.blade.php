@extends('layouts.app')

@section('content')
<div class="center-container">
    <h1>Edit Data User</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('updateUser', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama :</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone :</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
        </div>

        <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir :</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $user->tgl_lahir}}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dataUser') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

<style>
    .center-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px; 
    }

    .mb-3 {
        width: 100%;
        max-width: 400px; 
        margin-bottom: 15px;
    }
</style>
