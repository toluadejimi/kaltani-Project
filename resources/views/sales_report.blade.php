@extends('layouts.main')
@section('content')
<div class="main-content">
    <div class="card mt-4">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="row">

            <div class="card-header">
                <h4> Sales Report</h4>
            </div>
            <div class="col-md-12 ">
                <form action="/salesFilter" method="get" class="mb-4 p-2">
                    
                    
                    <div class="row d-flex p-2">
                        
                        <div class="col">
                            <div class="form-group">
                                <label for="">Date From</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Date To</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Select Factory</label>
                                <select name="factory" id="" class="form-control">
                                    <option value="">Any</option>
                                    @forelse ($factory as $items)
    
                                    <option value="{{$items->id}}">{{$items->name}}</option>
                                    @empty
                                    <option value="">No Record Found </option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <div class="form-group">
                            <input type="submit" value="Search" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12 shadow-sm">
               
                <div id="report">
                <div class="card">
                        <div class="card-header">
                            KALTANI MIS REPORT
                        </div>
                    
                    <div class="card-body">
                    <h6>SALES REPORT</h6>
                    <div class="col shadow-sm table-responsive">
                <table id="example" class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Factory</th>
                                <th>Customer</th>
                                <th>Price/Ton</th>
                                <th>Weight</th>
                                <th>Freight(₦)</th>
                                <th>Amount(USD)</th>
                                <th>Amount(NGN)</th>
                                <th>Date</th>
                                <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sales as $item)
                        <tr>
                            <td>{{ $item->location->name }}</td>
                                    <td>{{$item->customer_name}}</td>
                                    <td>{{$item->price_per_ton}}</td>
                                    <td>{{ $item->item_weight }}kg</td>
                                    <td>{{number_format( $item->freight) }}</td>
                                    <td>{{ number_format($item->amount_usd) }}</td>
                                    <td>{{ number_format($item->amount_ngn) }}</td>
                                    <td>{{$item->created_at->format('D, d M Y ')}}</td>
                                    <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>
                        </tr>
                        @empty
                            <tr colspan="20" class="text-center">
                                <td colspan="20">No Record Found</td>
                            </tr>
                        @endforelse
                        
                        
                    </tbody>
                    <tr>
                 
                            <td colspan="3">Total</td>
                             <td>{{ number_format($sales->sum('item_weight'),2) }}Kg</td>
                            <td>₦{{ number_format($sales->sum('freight'),2) }}</td>
                            <td>${{ number_format($sales->sum('amount_usd'),2) }}</td>
                            <td>₦{{ number_format($sales->sum('amount_ngn'),2) }}</td>
                          </tr>
                </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    Date: {{\Carbon\Carbon::now()}}
                </div>
                <div class="d-flex justify-content-center">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        function Export() {
            html2canvas(document.getElementById('report'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("report.pdf");
                }
            });
        }

    </script>
    <script type="text/javascript">
        function tableToCSV() {
 
            // Variable to store the final csv data
            var csv_data = [];
 
            // Get each row data
            var rows = document.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
 
                // Get each column data
                var cols = rows[i].querySelectorAll('td,th');
 
                // Stores each csv row data
                var csvrow = [];
                for (var j = 0; j < cols.length; j++) {
 
                    // Get the text data of each cell
                    // of a row and push it to csvrow
                    csvrow.push(cols[j].innerHTML);
                }
 
                // Combine each column value with comma
                csv_data.push(csvrow.join(","));
            }
 
            // Combine each row data with new line character
            csv_data = csv_data.join('\n');
 
            // Call this function to download csv file 
            downloadCSVFile(csv_data);
 
        }
 
        function downloadCSVFile(csv_data) {
 
            // Create CSV file object and feed
            // our csv_data into it
            CSVFile = new Blob([csv_data], {
                type: "text/csv"
            });
 
            // Create to temporary link to initiate
            // download process
            var temp_link = document.createElement('a');
 
            // Download csv file
            temp_link.download = "report.csv";
            var url = window.URL.createObjectURL(CSVFile);
            temp_link.href = url;
 
            // This link should not be displayed
            temp_link.style.display = "none";
            document.body.appendChild(temp_link);
 
            // Automatically click the link to
            // trigger download
            temp_link.click();
            document.body.removeChild(temp_link);
        }
    </script>
@endsection