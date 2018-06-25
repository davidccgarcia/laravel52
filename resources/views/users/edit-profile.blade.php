@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profile</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/edit-profile') }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        @foreach ($user->experiences as $i => $experience) 
                        <h4>Experience #{{ $i + 1 }}</h4>
                        <div class="form-group{{ $errors->has("experience.$i.technology") ? ' has-error' : '' }}">
                            <label for="technology" class="col-md-4 control-label">Technology</label>

                            <div class="col-md-6">
                                <input id="technology" 
                                    type="text" 
                                    id="experience_$i_technology" 
                                    class="form-control" 
                                    name="experience[{{ $i }}][technology]" 
                                    value="{{ old("experience.$i.technology", $experience->name) }}">

                                @if ($errors->has("experience.$i.technology"))
                                    <span class="help-block">
                                        <strong>{{ $errors->first("experience.$i.technology") }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has("experience.$i.years") ? ' has-error' : '' }}">
                            <label for="years" class="col-md-4 control-label">Years</label>

                            <div class="col-md-6">
                            <input id="years" type="text" 
                                class="form-control" 
                                id="experience_$i_years" 
                                name="experience[{{ $i }}][years]" 
                                value="{{ old("experience.$i.years", $experience->years) }}">

                                @if ($errors->has("experience.$i.years"))
                                    <span class="help-block">
                                        <strong>{{ $errors->first("experience.$i.years") }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-pencil"></i> Edit Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
