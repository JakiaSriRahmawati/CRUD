<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    @include('nav')
</head>
<body>
    <div class="container mt-5 py-5">
        <div class="card mx-auto mt-5" style="max-width: 500px;">
            <div class="card-header text-center">
                <h3>Register</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('postregister') }}" method="post">
                @csrf 
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Nama Lengkap:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Alamat Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone" class="form-label">Nomor Telepon:</label>
                    <input type="number" id="phone" name="phone" class="form-control" placeholder="Enter your contact">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Kata Sandi:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>              
                <div class="form-group mb-4">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir:</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Enter your date of birth">
                </div>                
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-success mt-1">Register</button>
                    <button class="btn btn-secondary" onclick="window.location.href='{{ route('login') }}';" style="margin-left: 10px; font-size: 1.15rem;">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
