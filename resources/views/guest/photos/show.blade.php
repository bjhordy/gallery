@extends('layouts.app')

@section('content')
    <div class="container" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $photo->name }}</div>

                    <div class="panel-body">
                        <img src="/images/photos/{{ $photo->file_name }}"
                             alt="Foto {{ $photo->name }}" class="img-responsive">
                        <p>{{ $photo->description }}</p>
                        <p>
                            <em>
                                Esta foto le pertenece a
                                <a href="/{{ '@' . $user->username }}">
                                    {{ $user->username }}
                                </a>
                            </em>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default" id="panel-photo-comments">
                    <div class="panel-heading">Comentarios de la foto</div>

                    <div class="panel-body">
                        <ul class="list-group">
                            <li v-for="comment in comments" class="list-group-item">
                                <img v-bind:src="comment.user.social_image" alt="Imagen de perfil" class="img-sm img-circle">
                                <p>@{{ comment.user.name }}</p>
                                <p>@{{ comment.content }}</p>
                            </li>

                            <li class="list-group-item" id="item-new-comment">
                                <form method="post" v-on:submit.prevent="onSubmit">
                                    {{ csrf_field() }}
                                    <div class="input-group">
                                        <input v-model="content" type="text" name="content" class="form-control" placeholder="Escribe un mensaje ..." aria-describedby="basic-button">
                                        <span class="input-group-btn" id="basic-button">
                                            <button class="btn btn-primary">Enviar</button>
                                        </span>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $.get('/photos/{{ $photo->id }}/comments', function (data) {
                // console.log(data);
                v.comments = data;
            });
        });

        const v = new window.Vue({
            el: '#panel-photo-comments',
            data: {
                comments: [],
                content: ''
            },
            methods: {
                onSubmit: function (event) {
                    axios.post('/photos/{{ $photo->id }}/comments', {
                        content: v.content
                    }).then(function (response) {
                        if (response.data.success) {
                            v.content = '';
                        } else {
                            alert('Hubo un error');
                        }
                    });
                }
            }
        });

        window.Echo.channel('comments').listen('CommentCreated', function (data) {
            // console.log(data);
            let comment = data.comment;
            comment.user = data.user;
            v.comments.push(comment);
        });
    </script>
@endsection
