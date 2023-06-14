<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgrey">
    <div class="container mt-5 mb5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('latihan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="" class="font-weight-bold">JUDUL</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title') }}" placeholder="Masukkan Judul">

                                    <!-- Error Message Untuk Title -->
                                    @error('title')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message}}
                                        </div>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="font-weight-bold">KONTENT</label>
                                <textarea class="form-control" @error('content') is-invalid @enderror
                                    name="content" rows="5" placeholder="Masukkan Konten">{{ (old('content')) }}</textarea>
                                <!-- Error Message Untuk Message -->
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="font-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                                <!-- Error Message Untuk Image -->
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary"> SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning"> RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
</body>
</html>