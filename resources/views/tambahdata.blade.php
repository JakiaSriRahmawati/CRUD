<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Document</title>
</head>
<body>
    @include('template.navbar')
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <h2 class="text-center mt-3">Tambah User</h2>
                <form action="{{ route('postTambahUser') }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <label for="name" class="form-label">Nama Lengkap:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                    <label for="email" class="form-label">Alamat Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                    <label for="phone" class="form-label">Nomor Telepon:</label>
                    <input type="number" id="phone" name="phone" class="form-control" placeholder="Enter your contact">
                    <label for="password" class="form-label">Kata Sandi:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir:</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Enter your date of birth">
                    
                    <button class="btn btn-success mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
