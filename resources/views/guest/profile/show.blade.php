@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Información del usuario</div>

                    <div class="panel-body">
                        <ul>
                            <li>
                                Nombre: {{ $user->name }}
                            </li>
                            <li>
                                Username: {{ $user->username }}
                            </li>
                            <li>
                                Correo: {{ $user->email }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            @foreach ($galleries as $gallery)
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Fotos de la galería "{{ $gallery->name }}"</div>

                    <div class="panel-body">
                        @foreach ($gallery->photos as $photo)
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ $photo->name }}</div>
                                    <div class="panel-body">
                                        <a href="/{{ '@' . $user->username }}/photos/{{ $photo->id }}">
                                            <img src="/images/photos/{{ $photo->file_name }}"
                                             alt="Foto {{ $photo->description }}" class="img-responsive">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection
