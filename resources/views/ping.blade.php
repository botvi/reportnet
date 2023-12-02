<!-- resources/views/monitor-ping.blade.php -->

@extends('template.layout') <!-- Assuming you have a layout file, adjust this based on your actual layout structure -->

@section('content')
    <div class="container">
        <h2>Ping Results for All IPs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">IP Address</th>
                    <th scope="col">Status</th>
                    <th scope="col">Message</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pingResults['results'] as $result)
                    <tr>
                        <td>{{ $result['ip'] }}</td>
                        <td>
                            @if ($result['status'] === 'success')
                                <span class="text-success">Success</span>
                            @else
                                <span class="text-danger">Failed</span>
                            @endif
                        </td>
                        <td>{{ $result['message'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection