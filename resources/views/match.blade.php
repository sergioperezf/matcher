@extends('template.template')

@section('title', 'Matches')

@section('content')
    <div class="row">
        <form action="/match" method="post">
            <label for="agent-a-zip">Agent A's Zip Code: </label>
            <input type="text" id="agent-a-zip" name="agent-a-zip" value="{{ app('request')->input('agent-a-zip') }}">
            <label for="agent-b-zip">Agent B's Zip Code: </label>
            <input type="text" id="agent-b-zip" name="agent-b-zip" value="{{ app('request')->input('agent-b-zip') }}">
            <button type="submit">Match!</button>
            {{ csrf_field() }}
        </form>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <h2>Match results</h2>
                <table class=" table table-bordered table-hover">
                    <tr>
                        <th>Agent Id</th>
                        <th>Contact Name</th>
                        <th>Contact Zip Code</th>
                    </tr>
                    <tbody>
                    @foreach ($clusteredData as $cluster)
                        <tr>
                            <th class="agent-info" data-lat="{{ $cluster->getAgent()->getCoordinates()[0] }}" data-lng="{{ $cluster->getAgent()->getCoordinates()[1] }}" colspan="3">{{ $cluster->getAgent()->getName() }}</th>
                        </tr>
                        @foreach ($cluster as $key => $point)
                            <tr>
                                <td>{{ $cluster->getAgent()->getName() }}</td>
                                <td class="contact-info" data-agent="{{ $cluster->getAgent()->getName() }}" data-lat="{{ $cluster->getSpace()[$point]->getCoordinates()[0] }}"  data-lng="{{ $cluster->getSpace()[$point]->getCoordinates()[1] }}" >{{ $cluster->getSpace()[$point]->getName() }}</td>
                                <td>{{ $cluster->getSpace()[$point]->getZip() }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h2>Map</h2>
    <div id="map"></div>

@endsection
