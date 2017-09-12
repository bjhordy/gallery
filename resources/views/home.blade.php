@extends('layouts.app')

@section('content')
<div class="container" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('notification'))
                    <div class="alert alert-success">
                        {{ session('notification') }}
                    </div>
                    @endif

                    <p>Bienvenido {{ auth()->user()->name }} :)</p>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default" id="panel-galleries">
                <div class="panel-heading">Galerías</div>

                <div class="panel-body">
                    <a href="/galleries/create" class="btn btn-primary">Nueva galería</a>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="gallery in galleries">
                                <td>@{{ gallery.name }}</td>
                                <td>
                                    <a v-bind:href="'galleries/'+gallery.id" class="btn btn-sm btn-primary">
                                        Ver
                                    </a>
                                    <a v-bind:href="'galleries/'+gallery.id+'/edit'" class="btn btn-sm btn-success">
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $.get('/galleries', function (data) {
                // console.log(data);
                v.galleries = data;
            });
        });
        const v = new window.Vue({
            el: '#panel-galleries',
            data: {
                galleries: []
            }
        });
    </script>
@endsection
