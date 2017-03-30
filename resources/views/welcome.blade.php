@extends('template.template')

@section('title', 'Matches')

@section('alerts')
    @if(isset($error))
        <div class="alert alert-danger" role="alert">{{ $error }}</div>
    @endif
@endsection

@section('content')
    <div class="">
            <form action="/match" method="post">
                <label for="agent-a-zip">Agent A's Zip Code: </label>
                <input type="text" id="agent-a-zip" name="agent-a-zip" value="{{ app('request')->input('agent-a-zip') }}">
                <label for="agent-b-zip">Agent B's Zip Code: </label>
                <input type="text" id="agent-b-zip" name="agent-b-zip" value="{{ app('request')->input('agent-b-zip') }}">
                <button type="submit">Match!</button>
                {{ csrf_field() }}
            </form>
    </div>
@endsection