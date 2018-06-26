@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar usuario</div>

                    @include('partials/errors')

                    <div class="panel-body" id="content">
                        <form class="form form-inline" action="{{ route('admin.users.index') }}" method="GET">
                            <input type="email" placeholder="Search users by email" name="search" class="form-control">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        <br>
                        <table class="table table-striped">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->experiences_count }}</td>
                                <td><a href="#">Editar</a></td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection