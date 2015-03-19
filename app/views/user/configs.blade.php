@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')

    <div class="col-md-12">
        <h3 class="page-header">Configs</h3>
    </div>

    {{ Form::open(array('route' => 'configs.save')) }}
        <div class="col-md-12">
            <div class="form-group">
                <div class="checkbox">
                    <label for="notify_created">
                        <input type="checkbox" id="notify_created" name="notify_created" value="1" @if ($configs['notify_created'] == true) checked @endif>
                        Notify when delivery is created
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                <label for="notify_incoming">
                    <input type="checkbox" id="notify_incoming" name="notify_incoming" value="1" @if ($configs['notify_incoming'] == true) checked @endif>
                    Notify when delivery is incoming
                </label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    {{ Form::close() }}

@stop
