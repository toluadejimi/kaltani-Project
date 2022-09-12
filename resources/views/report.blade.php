@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<div class="main-content">
    <div class="card mt-4">
<div class="row">
    <div class="col-md-12 shadow-sm ">
        <div class="col-md-12 shadow-sm p-2">
            <h5>Report</h5>
            <table id="report" class=" table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Center Name</th>
                        <th>Center Address</th>
                        <th>Center City</th>
                        <th>Collected</th>
                        <th>Sorted</th>
                        <th>Bailed</th>
                        <th>Transfered</th>
                        <th>Recycled</th>
                        <th>Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($report as $item)
                    <tr>
                        <td>{{$item->location->name}}</td>
                        <td>{{$item->location->address}}</td>
                        <td>{{$item->location->city}}</td>
                        <td>{{$item->collected ?? "0"}}kg</td>
                        <td>{{$item->sorted ?? "0"}}kg</td>
                        <td>{{$item->bailed ?? "0"}}kg</td>
                        <td>{{$item->transfered ?? "0"}}kg</td>
                        <td>{{$item->recycled ?? "0" }}kg</td>
                        <td>₦{{number_format($item->sales ?? "0", 2)}}</td>
                    </tr>
                    @empty
                        <tr colspan="20" class="text-center">
                            <td colspan="20">No Record Found</td>
                        </tr>
                    @endforelse
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
    $('#report').DataTable();
});
</script>
@endsection