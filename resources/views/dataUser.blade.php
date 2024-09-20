
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data User</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">

    <style>
        .container-custom {
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px; 
        }

        .table-container {
            margin: 0 auto;
            width: 100%;
        }

        .table {
            width: 100%;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .nav-link.active {
            color: white !important;
            background-color: #007bff;
        }

        .small-pagination .page-link {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .small-pagination .page-item {
            margin: 0;
        }

        .small-pagination .page-item .page-link {
            border-radius: 0.25rem;
        }

        .center-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="nav nav-pills mb-3 justify-content-left" style="margin-left: 350px; font-size: 1.15rem;">
        <a class="nav-link" href="{{ route('homePengguna') }}">Home</a>
        <a class="nav-link" href="{{ route('dataUser') }}">Data User</a>
        <a class="nav-link" href="{{ route('deletedUsers') }}">Sampah</a>
        <a class="nav-link" href="{{ route('logout')}}">Log Out</a>
    </nav>

    <div class="container-custom">
        <div class="card shadow-sm p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <h5 class="card-title text-center mb-3">Data User</h5>
                <div class="mb-3 d-flex justify-content-between">
                    <form action="{{ route('dataUser') }}" method="GET" class="d-flex">
                        <input type="text" placeholder="Search" name="search" value="{{ request()->get('search') }}">
                        <button type="submit" class="btn btn-primary ms-2">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMekanikModal">Tambah Pengguna</button>
                </div>
                <div class="table-responsive table-container">
                    <table class="table table-striped table-bordered" id="userTable">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Kontak</th>
                                <th>Tanggal Lahir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($d as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->tgl_lahir }}</td>
                                <td class="actions">
                                    <a href="{{ route('editUser', $user->id) }}" class="btn btn-outline-primary">Edit
                                        <i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('softDeleteUser', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin Mau Hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Delete
                                            <i class="bi bi-trash2-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $d->links('pagination::bootstrap-4', ['class' => 'small-pagination']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahMekanikModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('postTambahUser') }}" method="POST" class="form-group"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap:</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter your name" required autocomplete="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email:</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email" required autocomplete="email">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon:</label>
                            <input type="number" id="phone" name="phone" class="form-control"
                                placeholder="Enter your contact" autocomplete="tel">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi:</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Enter your password" required autocomplete="new-password">
                        </div>
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir:</label>
                            <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control"
                                placeholder="Enter your date of birth">
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/2.0.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable();
        });
    </script>
</body>

</html>

