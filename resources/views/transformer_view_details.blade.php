@extends('master.master')
@section('title', 'Digital Register List')
@section('content')
@php
$fields = [
'dis_date' => 'Dispute Date',
'dis_reason' => 'Dispute Reason',
'invoice' => 'Invoice',
'submit_no' => 'Submit Number',
'bill_submit_date' => 'Bill Submit Date',
'paid_date' => 'Paid Date',
'bill_tt' => 'TT',
'rec_value' => 'Rec Value',
'ddc' => 'DDC',
'sd_amt' => 'SD Amount',
'sd_claimed' => 'SD Claimed',
'sd_paid' => 'SD Paid'
];
@endphp
@php
$hasValue = false;
foreach ($fields as $field => $label) {
if (!empty($tagDetails[0]->$field)) {
$hasValue = true;
break;
}
}
@endphp
<style>
/* Base styles for the tabs block */
.tabs {
    width: 100%;
    max-width: 980px;
    margin: 0 auto;
    border: 1px solid #ddd;
    overflow: hidden;
}

tr {
    font-size: 12px !important
}

.border-radius {
    border-radius: 5px;
    margin: 6px;
    border: 1.5px solid lightgrey;
}

td {
    font-size: 12px !important
}

.tabs__labels {
    display: flex;
    width: 100%;
    justify-content: space-between;

}

/* Hide radio inputs */
.tabs__input {
    display: none;
}

/* Style labels (tab buttons) */
.tabs__label {
    display: block;
    flex-grow: 1;
    padding: 6px;
    font-size: 1.2rem;
    background-color: #f9f9f9;
    border-bottom: 1px solid #ddd;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease;
}

.tabs__label span {
    display: block;
    font-size: .65em;
    text-transform: uppercase;
    margin-top: .25rem;
}

.tabs__label:hover {
    background-color: #f1f1f1;
}

/* Highlight active tab */
/* Highlight active tab */
/* Highlight active tab */
#tab-1:checked~.tabs__labels label[for="tab-1"],
#tab-2:checked~.tabs__labels label[for="tab-2"],
#tab-3:checked~.tabs__labels label[for="tab-3"],
#tab-4:checked~.tabs__labels label[for="tab-4"],
#tab-5:checked~.tabs__labels label[for="tab-5"] {
    /* Add missing selector for tab-5 */
    background-color: rgb(2, 108, 122);
    color: white;
    border-bottom: 2px solid #111;
}

/* Show the active tab's content */
#tab-1:checked~.tabs__content #tab-panel-1,
#tab-2:checked~.tabs__content #tab-panel-2,
#tab-3:checked~.tabs__content #tab-panel-3,
#tab-4:checked~.tabs__content #tab-panel-4,
#tab-5:checked~.tabs__content #tab-panel-5 {
    /* Add selector for tab-5 content */
    display: block;
}

/* Make sure panels are initially hidden */
/* .tabs__panel {
    display: none;
    animation: fadeIn 0.3s ease;
} */


/* Make sure panels are initially hidden */


/* Panels (content for each tab) */
.tabs__panel {
    display: none;
    animation: fadeIn 0.3s ease;
    /* column-width: 300px;
        column-gap: 2rem; */
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.tabs__panel-image {
    /* margin-bottom: 2rem; */
}

/* Show the active tab's content
#tab-1:checked~.tabs__content #tab-panel-1,
#tab-2:checked~.tabs__content #tab-panel-2,
#tab-3:checked~.tabs__content #tab-panel-3 {
    display: block;
} */
</style>
<!-- Button trigger modal -->


<!-- Modal -->

<div class="content-header">
    <div class="container-fluid">



        <div class="row">
            <div class="col-sm-9">

            </div>


            <div class="col-sm-3">
                <div class="float-right">

                    <a href="{{route('transformer_List')}}">
                        <button type="button" class="btn btn-primary" id="add_cost" style="padding:7px">&nbsp;Digital
                            Register List
                            &nbsp;</button>
                    </a>
                </div><!-- /.col -->
            </div><!-- /.col -->
        </div>


        <!-- /.row -->
    </div><!-- /.container-fluid -->
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
                <div class="tabs">

                    <input type="radio" id="tab-1" name="tabs" class="tabs__input" checked>
                    <input type="radio" id="tab-2" name="tabs" class="tabs__input">
                    <input type="radio" id="tab-3" name="tabs" class="tabs__input">
                    <input type="radio" id="tab-4" name="tabs" class="tabs__input">
                    <input type="radio" id="tab-5" name="tabs" class="tabs__input">

                    <div class="tabs__labels">
                        <label for="tab-1" class="tabs__label">Tag <span></span></label>
                        <label for="tab-2" class="tabs__label">Raw Meterials<span></span></label>
                        <label for="tab-3" class="tabs__label">Labour Cost <span></span></label>
                        <label for="tab-4" class="tabs__label">Logistic Cost <span></span></label>
                        <label for="tab-5" class="tabs__label">Misclenious Cost <span></span></label>
                    </div>

                    <div class="tabs__content">
                        <div class="tabs__panel" id="tab-panel-1">
                            <div class="table-responsive p-3" style="">
                                <div class="row  p-2 border-radius">
                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b>Tag : </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{$tagDetails[0]->unique_code}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b>Office : </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{$tagDetails[0]->office_name}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b>Work : </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{$tagDetails[0]->work_name}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b>Financial Year: </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{ $tagDetails[0]->financiarYear() ? $tagDetails[0]->financiarYear()->first()->financial_year ?? "" : "" }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($tagDetails[0]->po_no || $tagDetails[0]->po_value)
                                <div class="row p-2 m-2 border-radius">

                                    @if($tagDetails[0]->po_no)
                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b>PO Number : </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{ $tagDetails[0]->po_no ? $tagDetails[0]->po_no ?? "" : "" }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($tagDetails[0]->po_value)
                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b> PO Value: </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{ $tagDetails[0]->po_value ? $tagDetails[0]->po_value ?? "" : "" }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                @if($tagDetails[0]->memo_no || $tagDetails[0]->memo_date)

                                <div class="row p-2 border-radius">

                                    @if($tagDetails[0]->memo_no)
                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b>Memo No : </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{ $tagDetails[0]->memo_no ? $tagDetails[0]->memo_no ?? "" : "" }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(!empty($tagDetails[0]->memo_date))
                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b>Memo Date : </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{ $tagDetails[0]->memo_date ? date('d-m-y',strtotime($tagDetails[0]->memo_date)) ?? "" : "" }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif
                                @if(!empty($tagDetails[0]->ssn) || !empty($tagDetails[0]->received) ||
                                !empty($tagDetails[0]->delivered))

                                <div class="row p-2 border-radius">

                                    @if($tagDetails[0]->ssn)
                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b>SSN : </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{ $tagDetails[0]->ssn ? $tagDetails[0]->ssn ?? "" : "" }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($tagDetails[0]->received)

                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b>Received : </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{ $tagDetails[0]->received ? $tagDetails[0]->received ?? "" : "" }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($tagDetails[0]->delivered)

                                    <div class="col-sm-6">
                                        <div class="row"
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-4">
                                                <h7><b>Delivered : </b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                {{ $tagDetails[0]->delivered ? $tagDetails[0]->delivered ?? "" : "" }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                @if($fields)
                                <div class="row p-2  {{ $hasValue ? 'border-radius' : '' }}">

                                    @foreach ($fields as $field => $label)
                                    @php
                                    $value = $tagDetails[0]->$field;

                                    
                                    @endphp




                                    @if(!empty($tagDetails[0]->$field))
                                    <div class="col-sm-6">
                                        <div class="row "
                                            style="padding:3px;background-color:#ddf4f7;margin:2px;border-radius:10px">
                                            <div class="col-sm-5">
                                                <h7><b>{{ $label }} :</b></h7>
                                            </div>
                                            <div class="col-sm-7" style="font-size:17px;font-style:italic">
                                                @if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value))
                                                {{ \Carbon\Carbon::parse($value)->format('d-m-Y') }}
                                                @else
                                                {{ $value }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @endif

                                <h5 style="padding:10px">Transformer Details</h5>
                                <table class="table_inside table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>RECEIVED</th>
                                            <th>SSL</th>
                                            <th>WSL</th>
                                            <th>KVA</th>
                                            <th>MAKE</th>
                                            <th>SERIAL NO</th>
                                            <th>DTR NO</th>
                                            <th>OIL</th>
                                            <th>MFG</th>
                                            <th>REPAIR</th>
                                            <th>DOT</th>
                                            <th>DELIVERED</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transformerSub as $index => $item)
                                        <tr>
                                            <td>{{date('d-m-Y', strtotime($item->received_date))}}</td>
                                            <td>{{$item->ssl}}</td>
                                            <td>{{$item->wsl}}</td>
                                            <td>{{$item->kva}}</td>
                                            <td>{{$item->make}}</td>
                                            <td>{{$item->serial_no}}</td>
                                            <td>{{$item->dtr_no}}</td>
                                            <td>{{$item->oil}}</td>
                                            <td>{{$item->mfg}}</td>
                                            <td>{{$item->repair}}</td>
                                            <td>{{$item->dot}}</td>
                                            <td>{{date('d-m-Y', strtotime($item->delivered_date))}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div>
                        </div>
                        <div class="tabs__panel" id="tab-panel-2">
                            <div class="form-group row p-3">
                                <div class="col-md-10">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info" id="add_raw_meterial"
                                        data-bs-toggle="modal">
                                        Add&nbsp;Raw&nbsp;Meterials
                                    </button>
                                </div>
                            </div>



                            <div class="modal fade" id="raw_meterial" data-backdrop="static" tabindex="-1" role="dialog"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Add Raw Meterial</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('add_transformer_raw_meterial') }}" method="POST"
                                            id="update">
                                            @csrf
                                            <input type="hidden" name="transformar_ids" id="transformar_ids"
                                                value="{{$trans_code}}">
                                            <div class="modal-body">

                                                <div class="form-group row">
                                                    <div class="col-md-5">
                                                        <label for="name" class="form-label required">Raw
                                                            Meterial:</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select name="raw_meterial_value" id="raw_meterial_value"
                                                            data-control="select2"
                                                            data-placeholder="Select Financial Year..."
                                                            class="form-control form-select-solid">
                                                            <option value="" disabled selected>---Select---</option>
                                                            @foreach ($raw_meterials as $raw)
                                                            <option value="{{ $raw->code }}">
                                                                {{ $raw->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-5">
                                                        <label for="name" class="form-label required">Available
                                                            Quantity:</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" id="available_quantity" readonly
                                                            name="available_quantity"
                                                            value="{{ old('available_quantity') }}" class="form-control"
                                                            autocomplete="off"
                                                            style="border-radius: 0.65rem; margin:6px;">
                                                        @error('available_quantity')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-5">
                                                        <label for="name"
                                                            class="form-label required">Price(Rs.):</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" id="price" name="price" readonly
                                                            value="{{ old('price') }}" class="form-control"
                                                            autocomplete="off"
                                                            style="border-radius: 0.65rem; margin:6px;">
                                                        @error('price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-5">
                                                        <label for="name" class="form-label required">Unit:</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" id="unit" name="unit" readonly
                                                            value="{{ old('unit') }}" class="form-control"
                                                            autocomplete="off"
                                                            style="border-radius: 0.65rem; margin:6px;">
                                                        @error('unit')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-5">
                                                        <label for="name" class="form-label required">Quantity:</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" id="quantity" name="quantity"
                                                            value="{{ old('quantity') }}" class="form-control"
                                                            autocomplete="off"
                                                            style="border-radius: 0.65rem; margin:6px;">
                                                        <div class="text-danger availableQ  d-none">Enter quantity not
                                                            greater
                                                            than available quantity</div>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-5">
                                                        <label for="name" class="form-label required">Total
                                                            Price(Rs.):</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" id="total_price" name="total_price" readonly
                                                            value="{{ old('total_price') }}" class="form-control"
                                                            autocomplete="off"
                                                            style="border-radius: 0.65rem; margin:6px;">
                                                        @error('total_price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>




                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive p-3 " style="">
                                <table id="group_lists" class="table_inside table-striped table-bordered"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="15%">Date</th>

                                            <th width="20%">Raw Meterials</th>
                                            <th width="20%">Cost Per Unit(Rs.)</th>
                                            <th width="10%">Quantity</th>
                                            <th width="10%">Total Cost(Rs.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $k=>$v)
                                        <tr>
                                            <td>{{date('d-m-Y',strtotime($v->created_at))}}</td>

                                            <td>{{ $v->rawMeterials()->first() ? $v->rawMeterials()->first()->name : "" }}
                                            </td>
                                            <td>{{$v->per_cost}} / {{$v->unit}}</td>
                                            <td>{{$v->quantity}}</td>
                                            <td>{{$v->cost}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="tabs__panel" id="tab-panel-3">
                            <div class="table-responsive p-3" style="">
                                <table id="group_list3" class="table_inside table-striped table-bordered"
                                    style="width:100%">
                                    <thead>
                                        <tr>

                                            <th width="85%">Date</th>
                                            <th width="10%">Amount(Rs.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($labourCostHistory as $k=>$v)
                                        <tr>
                                            <td>{{ date('d-m-Y',strtotime($v->date))}}
                                            </td>
                                            <td>{{$v->cost}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>


                        </div>
                        <div class="tabs__panel" id="tab-panel-4">


                            <div class="table-responsive p-3" style="">
                                <table id="group_list6" class="table_inside table-striped table-bordered"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">Date</th>

                                            <th width="85%">Amount(Rs.)</th>
                                            <th width="10%">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logisticCost as $k=>$v)
                                        <tr>
                                            <td>{{ date('d-m-Y',strtotime($v->date))}}
                                            </td>
                                            <td>{{ $v->amount}}</td>

                                            <td>{{ $v->remarks}}
                                            </td>


                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="tabs__panel" id="tab-panel-5">


                            <div class="table-responsive p-3" style="">
                                <table id="group_list8" class="table_inside table-striped table-bordered"
                                    style="width:100%">
                                    <thead>
                                        <tr>

                                            <th width="10%">Date</th>
                                            <th width="85%">Amount(Rs.)</th>

                                            <th width="10%">Purpose</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($miscCost as $k=>$v)
                                        <tr>
                                            <td>{{ date('d-m-Y',strtotime($v->created_at))}}
                                            </td>
                                            <td>{{ $v->amount}}</td>

                                            <td>{{ $v->purpose}}
                                            </td>


                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
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
// $('#quantity').on('input', function() {
//     var quantity = $("#available_quantity").val();
//     $('#quantity').on('input', function() {
//         var quantity = parseInt($("#quantity").val()); // Get the input quantity
//         var availableQuantity = parseInt($("#available_quantity").val()); // Get the available quantity

//         // Check if the entered quantity is greater than the available quantity
//         if (quantity > availableQuantity) {
//             $(".availableQ").removeClass('d-none');
//             $("#quantity").val(availableQuantity);
//         } else {
//             $(".availableQ").addClass('d-none');

//             calculateTotal(); // Call the function to calculate total if the quantity is valid
//         }
//     });

// });
$('#quantity').on('input', function() {
    var quantity = parseInt($(this).val()); // Get the input quantity
    var availableQuantity = parseInt($("#available_quantity").val()); // Get the available quantity

    // Check if the entered quantity is greater than the available quantity
    if (quantity > availableQuantity) {
        $(".availableQ").removeClass('d-none');
        $(this).val(availableQuantity); // Set the max value if exceeded
    } else {
        $(".availableQ").addClass('d-none');
        calculateTotal(); // Call the function to calculate total if the quantity is valid
    }
});

// 
$('#add_raw_meterial').click(function() {
    // Ensure that the modal opens with the appropriate dropdown and selected checkboxes' IDs
    // console.log('Selected IDs:', selectedIds); // Log selected IDs for debugging
    $('#raw_meterial').modal('show');
});
$("#raw_meterial_value").change(function() {

    var raw_meterial = $("#raw_meterial_value").val();

    fetch_raw_meterial_wise_amt(raw_meterial);

});

function fetch_raw_meterial_wise_amt(raw_meterial) {

    $.ajax({
        url: "{{ route('fetch_raw_meterial_wise_amt_stock_wise') }}", // Define this route
        type: "POST",
        data: {
            raw_meterial: raw_meterial,
            '_token': "{{ csrf_token() }}",
        },
        success: function(response) {


            $("#price").val(response.amount);
            $("#unit").val(response.unit);
            $("#available_quantity").val(response.total_stock);

        },
        error: function() {

        }
    });
}

function calculateTotal() {
    let quantity = parseFloat(document.getElementById('quantity').value) || 0;
    let amount = parseFloat(document.getElementById('price').value) || 0;
    let total = quantity * amount;
    document.getElementById('total_price').value = total.toFixed(2);
}
</script>
@endsection