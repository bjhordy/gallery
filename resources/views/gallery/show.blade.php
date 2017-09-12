@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Subir nuevas fotos a la galería "{{ $gallery->name }}"</div>

                    <div class="panel-body">
                        @if (session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <a href="/galleries/{{ $gallery->id }}" style="display: none;"
                               class="btn btn-success btn-block" id="refreshPage">
                                Actualizar página para ver las nuevas fotos
                            </a>
                        </div>

                        <form action="/photos" method="post"
                              class="dropzone"
                              id="my-awesome-dropzone">

                            {{ csrf_field() }}
                            <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Fotos de la galería "{{ $gallery->name }}"</div>

                    <div class="panel-body">
                        @foreach ($gallery->photos as $photo)
                            <div class="col-md-4">

                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ $photo->name }}</div>

                                    <div class="panel-body">
                                        <img src="/images/photos/{{ $photo->file_name }}"
                                             alt="Foto {{ $photo->name }}" class="img-responsive">
                                    </div>

                                    <div class="panel-footer">
                                        <a href="/photos/{{ $photo->id }}/edit" class="btn btn-primary btn-sm">Editar</a>
                                        <a href="/photos/{{ $photo->id }}/delete" class="btn btn-danger btn-sm">Eliminar</a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // Las imágenes se van a usar bajo este nombre de parámetro
            maxFilesize: 7, // Tamaño máximo en MB
            success: function (file, response) {
                $('#refreshPage').show();
            }
        };
    </script>
@endsection
