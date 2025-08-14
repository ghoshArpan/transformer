@extends('master.master')
@section('title', 'Raw Meterial Category List')
@section('content')
<style>
td.details-control {
    background: url('images/details_open.png')no-repeat center center;
    cursor: pointer;
}

tr.shown td.details-control {
    background: url('images/details_close.png')no-repeat center center;
}

.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

.active,
.accordion:hover {
    background-color: #ccc;
}

.accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
}

.active:after {
    content: "\2212";
}

.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                {!! Form::button('<i class="fa fa-desktop "></i>&nbsp; Drdc shg<b></b>', [
                'class' => 'btn btn-primary',
                'style' => 'color:white;',
                ]) !!}
                <!-- <h1 class="m-0">scwscs</h1> -->
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="{{ route('rawMeterial_List') }}">
                        <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "> &nbsp;Back &nbsp;</button>
                    </a>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!----------------------------------------------MODEL START---------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="model_view_table"></div>
                <div id="group_loan_detail"></div>
            </div>

        </div>
    </div>
</div>
<!----------------------------------------------MODEL END---------------------------------------------------------------->

<!------------------------------------------------TABLE START------------------------------------------>
@if(session('success'))
<div class="row">
    <div class="col-sm-12 alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

@endif
<section class="content">
    <div class="box box-warning">
        <div class="box-body">
            <div class="container-fluid">
                <div class="table-responsive">
                    <table id="group_list" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5%">SN</th>
                                <th width="10%">Date</th>
                                <th width="10%">Raw Meterial</th>
                                <th width="10%">Quantity</th>
                                <th width="10%">Amount(Rs.)</th>
                                <th width="10%">Total Amount(Rs.)</th>
                                <th width="5%">Type</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($datas as $key=>$stock)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $stock->stock_date }}</td>
                                <td>{{ $stock->raw_meterial() ? $stock->raw_meterial()->first()->name :"" }}</td>
                                <td>{{ $stock->type == '1' ? $stock->stock_quantity : $stock->quantity }}</td>
                                <td>{{ $stock->amount_per_unit }} / {{$stock->raw_meterial_unit}}</td>
                                <td>{{ $stock->type == '1' ? $stock->stock_quantity * $stock->amount_per_unit   : $stock->total_amount }} </td>

                                <td>
                                <a href="javascript:void(0);" >
    <button class="badge {{ $stock->type == '1' ? 'badge-success' : 'badge-danger' }} badge-sm btn-icon m-0" style="border:0">
     {{$stock->type == '1' ? "Add": "Deduct"}}
    </button>
</a>


                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $datas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------------------------------------TABLE END------------------------------------------>

@endsection