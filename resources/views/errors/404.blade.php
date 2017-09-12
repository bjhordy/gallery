@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Error 404</div>

                <div class="panel-body">
                    <p>La página a la que estás intentando acceder no existe.</p>
                    <p>Haz <a href="/">clic aquí</a> para ir al inicio de la aplicación.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
