@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar foto seleccionada</div>

                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <img src="/images/photos/{{ $photo->file_name }}" alt="Foto selecionada" class="img-responsive">

                        <form action="/photos/{{ $photo->id }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">Nombre de la foto</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $photo->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description', $photo->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Guardar cambios</button>
                                <a class="btn btn-default" href="/galleries/{{ $photo->gallery_id }}">
                                    Volver sin guardar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection