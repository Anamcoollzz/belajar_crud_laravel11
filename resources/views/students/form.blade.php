<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Belajar CRUD Laravel 11</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <a href="{{ route('students.index') }}" class="btn btn-primary">Lihat Data</a>

    <form @isset($d) action="{{ route('students.update', [$d->id]) }}" @else
        action="{{ route('students.store') }}"
    @endisset method="POST" enctype="multipart/form-data">
      @csrf
      @isset($d)
        @method('PUT')
      @endisset
      <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? ($d->name ?? '') }}">
        @error('name')
          <div id="invalidFeedbackName" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') ?? ($d->nim ?? '') }}" required>
        @error('nim')
          <div id="invalidFeedbackNim" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="dob" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob') ?? ($d->dob ?? '') }}" required>
        @error('dob')
          <div id="invalidFeedbackDob" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="gender" class="form-label">Jenis Kelamin</label>
        <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender" required>
          @isset($d)
            <option value="">Pilih salah satu</option>
            <option value="Laki-laki" @if ((old('gender') ?? $d->gender) === 'Laki-laki') selected @endif>Laki-laki</option>
            <option value="Perempuan" @if ((old('gender') ?? $d->gender) === 'Perempuan') selected @endif>Perempuan</option>
          @else
            <option value="">Pilih salah satu</option>
            <option @if (old('gender') === 'Laki-laki') selected @endif value="Laki-laki">Laki-laki</option>
            <option @if (old('gender') === 'Perempuan') selected @endif value="Perempuan">Perempuan</option>
          @endisset
        </select>
        @error('gender')
          <div id="invalidFeedbackGender" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="avatar" class="form-label">Avatar</label>
        <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*" required>
        @error('avatar')
          <div id="invalidFeedbackAvatar" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
