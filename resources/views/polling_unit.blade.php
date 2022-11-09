@extends('layouts.app')

@section('content')
    <div class="bg-dark text-white" >
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Polling Unit ID</th>
                    <th scope="col">Polling Unit Name</th>
                    <th scope="col">Total Votes</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($pollingUnitResults as $i)
                    <tr>

                        <td>{{ $i->polling_unit_uniqueid }}</td>
                        <td>{{ $i->polling_unit_name }}</td>
                        <td>{{ $i->sum_party_score }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
        <center><a href="/q2"><button class="btn btn-primary btn-lg m-4">Go to Question 2</button></a></center>


    </div>
@endsection
