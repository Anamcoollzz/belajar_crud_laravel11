<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Belajar CRUD Laravel 11</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css">
</head>

<body>
  <center>
    <h1>CRUD Laravel 11</h1>
  </center>

  <div class="container">

    @if (session('successMessage'))
      <div class="alert alert-info">
        {{ session('successMessage') }}
      </div>
    @endif

    <a href="{{ route('students.create') }}" class="btn btn-primary mb-2">Tambah</a>

    <table class="table table-bordered table-striped " id="myTable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">NIM</th>
          <th scope="col">Tanggal Lahir</th>
          <th scope="col">Jenis Kelamin</th>
          <th scope="col">Avatar</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($students as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->nim }}</td>
            <td>{{ $item->dob }}</td>
            <td>{{ $item->gender }}</td>
            <td>
              <a href="{{ $item->avatar }}" target="_blank">
                <img style="max-width: 100px;" class="img-thumbnail" src="{{ $item->avatar }}" />
              </a>
            </td>
            <td>
              <a href="{{ route('students.edit', [$item->id]) }}" class="btn btn-primary">Edit</a>
              <a href="#" onclick="hapus(event, '{{ route('students.destroy', [$item->id]) }}')" class="btn btn-danger">Hapus</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <form action="" method="POST" id="formHapus">
    @csrf
    @method('DELETE')
  </form>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>

  <script>
    let table = new DataTable('#myTable');

    function hapus(e, url) {
      if (confirm('Apakah anda akan menghapus data ini?')) {
        document.getElementById('formHapus').action = url;
        document.getElementById('formHapus').submit();
      } else {
        e.preventDefault();
      }
    }
  </script>
</body>

</html>
