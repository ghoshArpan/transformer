@extends('master.master')
@section('title', 'Buy List')
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
                {!! Form::button('<i class="fa fa-desktop "></i>&nbsp; Buy List <b></b>', [
                'class' => 'btn btn-primary',
                'style' => 'color:white;',
                ]) !!}
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="{{ route('buy') }}">
                        <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "> &nbsp;Add &nbsp;</button>
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
    <div class="col-sm-10 offset-1 alert alert-success alert-dismissible fade show" role="alert">
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
                    <table id="unittable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5%">SN</th>
                                <th width="10%">Buy Name</th>
                                <th width="10%">Buy Date</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($datas as $key=>$s)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $s->buy_name }}</td>
                                <td>{{date("d-m-Y", strtotime($s->buy_date)) }}</td>
                                <td>
                                    <a href="{{route('buy',encrypt($s->code))}}" data-bs-toggle="tooltip" title="Edit">
                                        <button class="btn btn-primary btn-sm btn-icon edit_btn m-0">
                                            <i class="fa fa-edit"></i> </button></a>
                                    <a href="{{route('quotation',encrypt($s->code))}}" data-bs-toggle="tooltip" title="Add Quotation">
                                        <button class="btn btn-warning btn-sm btn-icon edit_btn m-0">
                                            <i class="fa fa-plus"></i> </button></a>


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