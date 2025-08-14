@extends('master.master')
@section('title', 'Digital Register List')
@section('content')

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    /* table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 4px 4px !important;
    } */


    .p {
        font-size: 10px !important;
    }

    .dataTables_empty {
        font-size: 12px !important;
    }

    .btn-sm2 {
        opacity: 0.5;
        border-radius: 20px
    }

    hr {
        margin-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .btn-container {
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .btn-bd-download {
        width: 100%;
        font-weight: 500;
        color: rgb(6, 66, 92);
        border-color: rgb(23, 83, 110);
        height: 20px !important;
        /* Set exact height */
        padding: 0 !important;
        /* Remove extra padding */
        line-height: 10px !important;
        /* Force padding to apply */
    }

    .tr {
        font-size: 7px;
        font-weight: bold;
    }

    .thead {
        font-size: 7px
    }

    .btn-bd-download:hover {
        color: rgb(0, 0, 0);
        background-color: rgb(195, 229, 240);
        border-color: rgb(25, 5, 57);
    }

    .btn-sm {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        /* Makes the buttons round */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        /* Removes extra padding */
        border: none;
        /* Removes border */
    }

    .small {
        font-size: 8px
    }

    .btn-sm i {
        font-size: 10px;
        /* Sets icon size to 10px */
    }

    td.details-control {
        background: url('images/details_open.png')no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('images/details_close.png')no-repeat center center;
    }

    span {
        font-weight: bold !important
    }

    .odd {
        /* line-height: 1rem !important; */
    }

    .even {
        /* line-height: 1rem !important; */
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

    /*  */
</style><!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Status</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_status_save') }}" method="POST" id="update">
                @csrf
                <input type="hidden" name="transformar_ids" id="transformar_ids">
                <div class="modal-body">

                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="name" class="form-label required">Status:</label>
                        </div>
                        <div class="col-md-7">
                            <select name="status" id="status" data-control="select2" data-placeholder="Select Select..."
                                class="form-control form-select-solid">

                            </select>
                        </div>
                    </div>

                    <div class="form-group row dispute">
                        <div class="col-md-5">
                            <label for="name" class="form-label required">Date:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="date" id="dis_date" name="dis_date" value="" class="form-control"
                                autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                            @error('dis_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="col-md-5">
                            <label for="name" class="form-label required">Reason:</label>
                        </div>
                        <div class="col-md-7">
                            <textarea type="text" rows="5" id="dis_reason" name="dis_reason" value=""
                                class="form-control" autocomplete="off"
                                style="border-radius: 0.65rem; margin:6px;"></textarea>

                            @error('dis_reason')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>

                    <!-- <div class="form-group row bill_processing">
                        <div class="col-md-5">
                            <label for="name" class="form-label required">Invoice:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="invoice" name="invoice" value="" class="form-control"
                                autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                            @error('invoice')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                    </div> -->

                    <!-- <div class="form-group row bill_submit">
                        <div class="col-md-5">
                            <label for="name" class="form-label required">Submit No:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="submit_no" name="submit_no" value="" class="form-control"
                                autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                            @error('submit_no')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="col-md-5">
                            <label for="name" class="form-label required">Date:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="date" id="bill_submit_date" name="bill_submit_date" value=""
                                class="form-control" autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                            @error('bill_submit_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                    </div> -->

                    <!-- <div class="form-group row bill_received">
                        <div class="col-md-5">
                            <label for="name" class="form-label required">Paid Date:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="date" id="paid_date" name="paid_date" value="" class="form-control"
                                autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                            @error('paid_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-md-5">
                            <label for="name" class="form-label required">TT:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="bill_tt" name="bill_tt" value="" class="form-control"
                                autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                            @error('bill_tt')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-md-5">
                            <label for="name" class="form-label required">Rec Value:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="rec_value" name="rec_value" value="" class="form-control"
                                autocomplete="off" style="border-radius: 0.65rem; margin:3px;">

                            @error('rec_value')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="name" class="form-label required">DDC %:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="ddc" name="ddc" value="" class="form-control" autocomplete="off"
                                style="border-radius: 0.65rem; margin:3px;">

                            @error('ddc')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="name" class="form-label required">SD AMT %:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="sd_amt" name="sd_amt" value="" class="form-control"
                                autocomplete="off" oninput="filterNumericInput(this)" style="border-radius: 0.65rem; margin:3px;">

                            @error('sd_amt')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="name" class="form-label required">SD Claimed:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="sd_claimed" name="sd_claimed" value="" class="form-control"
                                autocomplete="off" oninput="filterNumericInput(this)" style="border-radius: 0.65rem; margin:3px;">

                            @error('sd_claimed')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="name" class="form-label required">SD Paid:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" id="sd_paid" name="sd_paid" value="" class="form-control"
                                autocomplete="off" oninput="filterNumericInput(this)" style="border-radius: 0.65rem; margin:3px;">

                            @error('sd_paid')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> -->

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-4">{!! Form::button('<i class="fa fa-desktop "></i>&nbsp; Digital Register List<b></b>', [
                'class' => 'btn btn-primary',
                'style' => 'color:white;',
                ]) !!}</div>
            <div class="col-sm-1">
                <label for="name" class="form-label" style="margin-top:6px">Search:</label>

            </div>
            <div class="col-sm-3">
                <form action="{{request()->url}}" id="statusForm">


                    <select name="statusSearch" id="statusStyle" data-control="select2" data-placeholder="Status..."
                        class="form-control form-select-solid">
                        <option value="">--Status--</option>
                        @foreach($status as $k => $jobStatus)
                        <option value="{{ $jobStatus->code }}" {{$jobStatus->code==request()->statusSearch ? 'selected'
                            :''}}>
                            {{ $jobStatus->status }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="col-sm-2">
                <a href="javascript:void(0)">
                    <button type="button" class="btn btn-info d-none" id="change_status"
                        style="padding:7px">&nbsp;Status Change &nbsp;</button>
                </a>
            </div>

            <div class="col-sm-2">
                <div class="float-right">
                    <a href="{{ route('transformer') }}">
                        <button type="button" class="btn btn-primary" id="add_btn"> &nbsp;Add &nbsp;</button>
                    </a>
                </div>
            </div>
        </div>


        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!----------------------------------------------MODEL START---------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="add_trasformerData" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_trasformerDataLabel">Add Transformer</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div id="add_transformer">
                    <form action="{{ route('save_transformer_data') }}" method="POST" id="">
                        @csrf
                        <input type="hidden" name="transformer_code" id="transformer_code" value="">
                        <div class="form-group row">

                            <div class="col-md-2">
                                <label for="name" class="form-label required ">RECEIVED:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="received" name="received" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('received')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required">SSN:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="ssl" name="ssl" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('ssl')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required">WSL:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="serial_no" readonly name="serial_no" required value=""
                                    class="form-control" autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('serial_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required">KVA:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="kva" name="kva" value="" class="form-control" required
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('kva')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required">MAKE:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="make" name="make" value="" class="form-control" required
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('make')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required">SERIAL NO:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="serial_no_no" name="serial_no_no" required value=""
                                    class="form-control" autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('serial_no_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required">DTR NO:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="dtr_no" name="dtr_no" required value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('dtr_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required">OIL:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="oil" name="oil" required value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('oil')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required">MFG:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="mfg" name="mfg" required value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('mfg')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required">REPAIR:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="repair" name="repair" value="" required class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('repair')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required">DOT:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="dot" name="dot" required value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('dot')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label required ">DELIVERED:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="delivered" name="delivered" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('delivered')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer  text-center">
                            <button type="submit" class="btn btn-primary" id="submitBtn"
                                style="color: white;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="updateTag" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTagLabel">Update Tag Data</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div id="updateTag">
                    <form action="{{ route('update_tag_other_data') }}" method="POST" id="">
                        @csrf
                        <input type="hidden" name="transformerCode" id="transformerCode" value="">
                        <div class="form-group row">

                            <div class="col-md-2">
                                <label for="name" class="form-label ">PO No:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="po_number" name="po_number" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('po_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label ">PO Value:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="po_value" name="po_value" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;"
                                    oninput="filterNumericInput(this)">
                                @error('po_value')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label ">Memo No:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="memo_no" name="memo_no" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('memo_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label ">Memo Date:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="memo_date" name="memo_date" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('memo_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="name" class="form-label required">Date:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="date" id="dis_date" name="dis_date" value="" class="form-control"
                                        autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                    @error('dis_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="col-md-5">
                                    <label for="name" class="form-label required">Reason:</label>
                                </div>
                                <div class="col-md-7">
                                    <textarea type="text" rows="5" id="dis_reason" name="dis_reason" value=""
                                        class="form-control" autocomplete="off"
                                        style="border-radius: 0.65rem; margin:6px;"></textarea>

                                    @error('dis_reason')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div> -->

                            <div class="col-md-2">
                                <label for="name" class="form-label">Invoice:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="invoice" name="invoice" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('invoice')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label">Submit No:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="submit_no" name="submit_no" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('submit_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label">Submitted Date:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="bill_submit_date" name="bill_submit_date" value=""
                                    class="form-control" autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('bill_submit_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-2">
                                <label for="name" class="form-label">Bill Received Date:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="paid_date" name="paid_date" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('paid_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label">TT:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="bill_tt" name="bill_tt" value="" readonly class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('bill_tt')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label">Rec Value:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="rec_value" name="rec_value" value="" class="form-control"
                                    autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                @error('rec_value')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label ">DDC %:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="ddc" name="ddc" value="" class="form-control" autocomplete="off"
                                    style="border-radius: 0.65rem; margin:3px;">
                                @error('ddc')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label ">SD AMT %:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="sd_amt" name="sd_amt" value="" class="form-control"
                                    autocomplete="off" oninput="filterNumericInput(this)" style="border-radius: 0.65rem; margin:3px;">
                                @error('sd_amt')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label ">SD Claimed:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="sd_claimed" name="sd_claimed" value="" class="form-control"
                                    autocomplete="off" oninput="filterNumericInput(this)" style="border-radius: 0.65rem; margin:3px;">
                                @error('sd_claimed')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="name" class="form-label ">SD Paid:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="sd_paid" name="sd_paid" value="" class="form-control"
                                    autocomplete="off" oninput="filterNumericInput(this)" style="border-radius: 0.65rem; margin:3px;">
                                @error('sd_paid')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <!-- <div class="col-md-3">
                                <label for="name" class="form-label ">SSN:</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="ssn" name="ssn" value="" class="form-control" autocomplete="off"
                                    style="border-radius: 0.65rem; margin:3px;">
                                @error('ssn')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> -->
                        </div>
                        <div class="card-footer  text-center">
                            <button type="submit" class="btn btn-primary" id="submitBtn"
                                style="color: white;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@if(session('success'))
<div class="row">
    <div class="col-sm-12  alert alert-success alert-dismissible fade show" role="alert">
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
                    <table id="group_list" class=" table  tabledata table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" id="selectAll" />
                                </th>
                                <th width="5%">Tag</th>
                                <th width="10%">Office</th>
                                <th width="39%">Work</th>
                                <!-- <th width="60%">Transformer Details</th> -->
                                <!-- <th width="5%">Costing(Rs.)</th> -->
                                <th width="9%">PO</th>
                                <!-- <th width="9%">Invoice</th> -->
                                <th width="10%">Amount(Rs.)</th>
                                <th width="9%">Status</th>
                                <th width="18%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $key=>$transformar)
                            <tr>
                                <td>
                                    <input type="checkbox" class="selectRow" value="{{ $transformar->code }}" />
                                </td>
                                <td>{{ $transformar->unique_code }}</td>
                                <td>{{ $transformar->office_name }}</td>
                                <td>{{ $transformar->work_name }}</td>
                                <td>
                                    @php
                                    $totalcosting=App\Models\Transformer::get_total_costing($transformar->code);
                                    $marginCost=App\Models\Transformer::get_margin($totalcosting,$transformar->po_value);
                                    @endphp
                                    {{ $transformar->po_no }}
                                </td>
                                <!--<td>{{ $transformar->invoice }}</td>
                                 <td>
                                    @php
                                    $TransformarData =
                                    App\Models\SubTransformer::fetch_tag_wise_trasnformer($transformar->code);

                                    @endphp
                                    @php
                                    $totalcosting=App\Models\Transformer::get_total_costing($transformar->code);

                                    $marginCost=App\Models\Transformer::get_margin($totalcosting,$transformar->po_value);
                                    @endphp

                                    <table class="table_inside table-striped table-bordered">
                                        <thead class="thead">
                                            <tr>
                                                <th width="15%">Serial&nbsp;No&nbsp;&nbsp;</th>
                                                <th width="10%">KVA</th>
                                                <th width="10%">MAKE</th>
                                                <th width="10%">REPAIR</th>
                                                <th width="10%">OIL</th>
                                                <th width="12%">DTR&nbsp;NO</th>
                                                <th width="10%">MFG</th>
                                                <th width="18%">DOT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($TransformarData as $item)

                                            <tr class="tr">
                                                <td>{{$item->serial_no}}</td>
                                                <td>{{$item->kva}}</td>
                                                <td>{{$item->make}}</td>
                                                <td>{{$item->repair}}</td>
                                                <td>{{$item->oil}}</td>
                                                <td>{{$item->dtr_no}}</td>
                                                <td>{{$item->mfg}}</td>
                                                <td>{{date('d-m-Y',strtotime($item->dot))}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                </td> -->
                                <td>
                                    <p class="p">
                                        <b>PO Value(₹) :</b> {{$transformar->po_value}}
                                    </p>
                                    <p class="p">
                                        <b>Total Costing(₹) :</b> {{$totalcosting}}
                                    </p>
                                    <p class="p"> <b>Margin(₹) : </b>{{$marginCost}}</p>

                                </td>
                                <!-- <td></td> -->
                                <td>
                                    <button class="badge p-1"
                                        style="background-color: {{ $transformar->jobStatus() ? ($transformar->jobStatus()->first()->color_code ?? '') : '' }};border:0 ;padding:2px;color:white">
                                        {{ $transformar->jobStatus() ? $transformar->jobStatus()->first()->status ?? ""
                                        : "" }}
                                    </button>
                                </td>
                                <td>
                                    <div class="btn-container">
                                        <a href="javascript:void(0)" class="update_tag_data"
                                            dataId="{{$transformar->code}}" po_no="{{$transformar->po_no}}"
                                            memo_no="{{$transformar->memo_no}}" po_value="{{$transformar->po_value}}"
                                            memo_date="{{$transformar->memo_date}}"

                                            invoice="{{$transformar->invoice}}" submit_no="{{$transformar->submit_no}}"
                                            bill_submit_date="{{$transformar->bill_submit_date}}" paid_date="{{$transformar->paid_date}}"
                                            bill_tt="{{$transformar->bill_tt}}"
                                            rec_value="{{$transformar->rec_value}}"
                                            ddc="{{$transformar->ddc}}" sd_amt="{{$transformar->sd_amt}}" sd_claimed="{{$transformar->sd_claimed}}"
                                            sd_paid="{{$transformar->sd_paid}}" data-bs-toggle="tooltip"
                                            title="Update Tag Data">
                                            <button class="btn btn-info btn-sm btn-icon edit_btn"
                                                style="margin-bottom:2px">
                                                <i class="fa fa-pencil-square-o"></i> </button>
                                        </a>
                                        <a href="javascript:void(0)" class="add_transformar"
                                            dataId="{{$transformar->code}}" data-bs-toggle="tooltip"
                                            title="Add Transformer Details">
                                            <button class="btn btn-info btn-sm btn-icon edit_btn">
                                                <i class="fa fa-plus"></i> </button>
                                        </a>
                                        <a href="{{route('transformer', encrypt($transformar->code))}}"
                                            data-bs-toggle="tooltip" title="Edit">
                                            <button class="btn btn-primary btn-sm btn-icon edit_btn">
                                                <i class="fa fa-edit"></i> </button>
                                        </a>
                                        <a href="{{route('transformer_view', encrypt($transformar->code))}}"
                                            data-bs-toggle="tooltip" title="View">
                                            <button style="margin-top:2px"
                                                class="btn btn-warning btn-sm btn-icon edit_btn">
                                                <i class="fa fa-eye"></i> </button>
                                        </a>

                                        <a href="{{route('status_history_view', encrypt($transformar->code))}}"
                                            data-bs-toggle="tooltip" title=" History">
                                            <button style="margin-top:2px"
                                                class="btn btn-success btn-sm btn-icon edit_btn">
                                                <i class="fa fa-history"></i> </button>
                                        </a>

                                    </div>

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

@section('script')
<script>
    $(document).ready(function() {
        function calculateTT() {
            var submitDate = new Date($('#bill_submit_date').val());
            var paidDate = new Date($('#paid_date').val());

            if (!isNaN(submitDate.getTime()) && !isNaN(paidDate.getTime())) {
                var timeDiff = Math.abs(paidDate - submitDate);
                var dayDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

                if (dayDiff <= 60) {
                    $('#bill_tt').val(dayDiff);
                } else {
                    var months = Math.floor(dayDiff / 30);
                    var remainingDays = dayDiff % 30;

                    var result = months + ' Month' + (months > 1 ? 's' : '');


                    $('#bill_tt').val(result);
                }
            } else {
                $('#bill_tt').val('');
            }
        }

        $('#bill_submit_date, #paid_date').on('change', calculateTT);
    });
</script>

<script>
    $(document).ready(function() {
        $('#statusStyle').change(function() {
            $('#statusForm').submit();
        });
    });
    $(document).ready(function() {
        $("#loader").fadeOut();
        $("#add_trasformerData").submit(function(event) {
            $("#loader").fadeIn(); // Show loader
            $("#submitBtn").prop("disabled", true); // Disable button
        });
    });

    $(document).ready(function() {
        var selectedIds = [];

        $('#selectAll').change(function() {
            if (this.checked) {

                $('.selectRow').each(function() {
                    let id = $(this).val();
                    if (!selectedIds.includes(id)) {
                        selectedIds.push(id);
                    }
                });
                $('.selectRow').prop('checked', true);
                $("#change_status").removeClass("d-none");
            } else {

                selectedIds = [];
                $('.selectRow').prop('checked', false);
                $("#change_status").addClass("d-none");
            }
        });


        $('.selectRow').change(function() {
            let id = $(this).val();
            if (this.checked) {
                if (!selectedIds.includes(id)) {
                    selectedIds.push(id);
                }
            } else {

                selectedIds = selectedIds.filter(function(item) {
                    return item !== id;
                });
            }

            if ($('.selectRow:checked').length == $('.selectRow').length) {


                $('#selectAll').prop('checked', true);
                $("#change_status").removeClass("d-none");


            } else if ($('.selectRow:checked').length > 0) {
                $("#change_status").removeClass("d-none");
            } else {
                $('#selectAll').prop('checked', false);
                $("#change_status").addClass("d-none");

            }
        });

        $('.add_transformar').click(function() {

            var dataId = $(this).attr('dataId');
            $.ajax({
                url: '{{route("create_unique_no")}}',
                type: 'POST',
                data: {
                    code: dataId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    //         
                    // 
                    $("#serial_no").val(response.serialNo);
                    $("#transformer_code").val(dataId);
                    $('#add_trasformerData').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });

        });

        $('.update_tag_data').click(function() {
            var dataId = $(this).attr('dataId');
            var po_no = $(this).attr('po_no');
            var memo_no = $(this).attr('memo_no');
            var po_value = $(this).attr('po_value');
            var memo_date = $(this).attr('memo_date');
            var invoice = $(this).attr('invoice');
            var submit_no = $(this).attr('submit_no');
            var bill_submit_date = $(this).attr('bill_submit_date');
            var paid_date = $(this).attr('paid_date');
            var bill_tt = $(this).attr('bill_tt');
            var rec_value = $(this).attr('rec_value');
            var ddc = $(this).attr('ddc');
            var sd_amt = $(this).attr('sd_amt');
            var sd_claimed = $(this).attr('sd_claimed');
            var sd_paid = $(this).attr('sd_paid');


            $("#transformerCode").val(dataId);
            $("#memo_no").val(memo_no);
            $("#po_value").val(po_value);
            $("#memo_date").val(memo_date);
            $("#po_number").val(po_no);
            $("#invoice").val(invoice);
            $("#submit_no").val(submit_no);
            $("#bill_submit_date").val(bill_submit_date);
            $("#paid_date").val(paid_date);
            $("#bill_tt").val(bill_tt);
            $("#rec_value").val(rec_value);
            $("#ddc").val(ddc);
            $("#sd_amt").val(sd_amt);
            $("#sd_claimed").val(sd_claimed);
            $("#sd_paid").val(sd_paid);
            $('#updateTag').modal('show');


        });
        $('.close_updateTag').click(function() {
            $('#updateTag').modal('hide');

        });

        $(".dispute").addClass("d-none");
        $(".bill_processing").addClass("d-none");
        $(".bill_submit").addClass("d-none");
        $(".bill_received").addClass("d-none");
        $("#dis_date, #dis_reason").removeAttr("required", "required");
        $("#invoice").removeAttr("required", "required");
        $("#submit_no, #bill_submit_date").removeAttr("required", "required");
        $("#paid_date, #bill_tt, #rec_value, #ddc, #sd_amt, #sd_claimed, #sd_paid").removeAttr("required", "required");

        $('#status').change(function() {
            var status = $("#status").val();
            status_change_data(status)

        });

        $('#change_status').click(function() {

            $.ajax({
                url: '{{route("show_status")}}',
                type: 'POST',
                data: {

                    selectedIds: selectedIds,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $("#status").html("");

                    $("#status").html(response);
                    $("#transformar_ids").val(selectedIds.join(','));
                    $('#staticBackdrop').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

    });




    function status_change_data(status) {

        if (status == 2) {

            $(".dispute").removeClass("d-none");
            $(".bill_processing").addClass("d-none");
            $(".bill_submit").addClass("d-none");
            $(".bill_received").addClass("d-none");
            $("#dis_date, #dis_reason").attr("required", "required");
            $("#invoice").removeAttr("required", "required");
            $("#submit_no, #bill_submit_date").removeAttr("required", "required");
            $("#paid_date, #bill_tt, #rec_value, #ddc, #sd_amt, #sd_claimed, #sd_paid").removeAttr("required", "required");

        } else if (status == 6) {

            $(".dispute").addClass("d-none");
            $(".bill_processing").removeClass("d-none");
            $(".bill_submit").addClass("d-none");
            $(".bill_received").addClass("d-none");
            $("#invoice").attr("required", "required");
            $("#dis_date, #dis_reason").removeAttr("required", "required");
            $("#submit_no, #bill_submit_date").removeAttr("required", "required");
            $("#paid_date, #bill_tt, #rec_value, #ddc, #sd_amt, #sd_claimed, #sd_paid").removeAttr("required", "required");

        } else if (status == 7) {

            $(".dispute").addClass("d-none");
            $(".bill_processing").addClass("d-none");
            $(".bill_submit").removeClass("d-none");
            $(".bill_received").addClass("d-none");
            $("#submit_no, #bill_submit_date").attr("required", "required");

            $("#invoice").removeAttr("required", "required");
            $("#dis_date, #dis_reason").removeAttr("required", "required");
            $("#paid_date, #bill_tt, #rec_value, #ddc, #sd_amt, #sd_claimed, #sd_paid").removeAttr("required", "required");
        } else if (status == 8) {

            $(".dispute").addClass("d-none");
            $(".bill_processing").addClass("d-none");
            $(".bill_submit").addClass("d-none");
            $(".bill_received").removeClass("d-none");
            $("#paid_date, #bill_tt, #rec_value, #ddc, #sd_amt, #sd_claimed, #sd_paid").attr("required", "required");

            $("#submit_no, #bill_submit_date").removeAttr("required", "required");

            $("#invoice").removeAttr("required", "required");
            $("#dis_date, #dis_reason").removeAttr("required", "required");


        } else {
            $(".dispute").addClass("d-none");
            $(".bill_processing").addClass("d-none");
            $(".bill_submit").addClass("d-none");
            $(".bill_received").addClass("d-none");

            $("#dis_date, #dis_reason").removeAttr("required", "required");
            $("#invoice").removeAttr("required", "required");
            $("#submit_no, #bill_submit_date").removeAttr("required", "required");
            $("#paid_date, #bill_tt, #rec_value, #ddc, #sd_amt, #sd_claimed, #sd_paid").removeAttr("required", "required");
        }
    }

    function filterNumericInput(input) {
        let value = input.value;
        let validValue = value.replace(/[^0-9.]/g, ''); // Remove non-numeric except '.'

        // Ensure only one decimal point
        let parts = validValue.split('.');
        if (parts.length > 2) {
            validValue = parts[0] + '.' + parts.slice(1).join('');
        }

        input.value = validValue;
    }
</script>
@endsection