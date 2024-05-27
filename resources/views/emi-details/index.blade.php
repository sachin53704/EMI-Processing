<x-layout>
<div class="container">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <h1>EMI Details</h1>
    <form method="POST" action="{{ route('emi-details.process') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Process Data</button>
    </form>
    @if(isset($emiDetails))
    <table class="table">
        <thead>
            <tr>
                <th>Client ID</th>
                @foreach(array_keys($emiDetails[0]) as $column)
                    @if($column != 'clientid')
                    <th>{{ $column }}</th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($emiDetails as $emiDetail)
            <tr>
                <td>{{ $emiDetail->clientid }}</td>
                @foreach(array_keys($emiDetail) as $column)
                    @if($column != 'clientid')
                    <td>{{ $emiDetail->$column }}</td>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
</x-layout>