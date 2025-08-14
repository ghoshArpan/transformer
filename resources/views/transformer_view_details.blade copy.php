@extends('master.master')
@section('title', 'Transformer List')
@section('content')

<style>
/* Base styles for the tabs block */
.tabs {
    width: 100%;
    max-width: 980px;
    margin: 0 auto;
    border: 1px solid #ddd;
    overflow: hidden;
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
    padding: 1rem;
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
#tab-1:checked~.tabs__labels label[for="tab-1"],
#tab-2:checked~.tabs__labels label[for="tab-2"],
#tab-3:checked~.tabs__labels label[for="tab-3"] {
    background-color: #fff;
    border-bottom: 2px solid #111;
}

/* Content container */
.tabs__content {
    padding: 3rem 2rem;
    background-color: #fff;
    width: 100%:
}

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
    margin-bottom: 2rem;
}

/* Show the active tab's content */
#tab-1:checked~.tabs__content #tab-panel-1,
#tab-2:checked~.tabs__content #tab-panel-2,
#tab-3:checked~.tabs__content #tab-panel-3 {
    display: block;
}
</style>
<!-- Button trigger modal -->


<!-- Modal -->

<div class="content-header">
    <div class="container-fluid">



        <div class="row">
            <div class="col-sm-6">
               
            </div><!-- /.col -->

            <div class="col-sm-4">

            </div>


            <div class="col-sm-2">
                <a href="{{route('transformer_List')}}">
                    <button type="button" class="btn btn-primary" id="add_cost" style="padding:7px">&nbsp;Tranformar List
                        &nbsp;</button>
                </a>
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

                    <div class="tabs__labels">
                        <label for="tab-1" class="tabs__label">Raw Meterials <span></span></label>
                        <label for="tab-2" class="tabs__label">Labour Cost <span></span></label>
                        <label for="tab-3" class="tabs__label">Logistic Data <span></span></label>
                    </div>

                    <div class="tabs__content">
                        <div class="tabs__panel" id="tab-panel-1">
                            <div class="form-group row">
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
                                                        <label for="name" class="form-label required">Price(Rs.):</label>
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
                                                        <div class="text-danger availableQ  d-none">Enter quantity not greater
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

                            <div class="table-responsive" style="">
                                <table id="group_list" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th width="5%">SN</th>
                                            <th width="20%">Raw Meterials</th>
                                            <th width="15%">Date</th>
                                            <th width="20%">Cost Per Unit(Rs.)</th>
                                            <th width="10%">Quantity</th>
                                            <th width="10%">Total Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $k=>$v)
                                        <tr>
                                            <td>{{$k+1}}</td>
                                            <td>{{ $v->rawMeterials()->first() ? $v->rawMeterials()->first()->name : "" }}
                                            </td>
                                            <td>{{date('Y-m-d',strtotime($v->created_at))}}</td>
                                            <td>{{$v->per_cost}} / {{$v->unit}}</td>
                                            <td>{{$v->quantity}}</td>
                                            <td>{{$v->cost}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="tabs__panel" id="tab-panel-2">
                            <div class="table-responsive" style="">
                                <table id="group_list" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th width="5%">SN</th>
                                            <th width="85%">Date</th>
                                            <th width="10%">Amount(Rs.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($labourCostHistory as $k=>$v)
                                        <tr>
                                            <td>{{$k+1}}</td>
                                            <td>{{ $v->date}}
                                            </td>
                                            <td>{{$v->cost}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>


                        </div>
                        <div class="tabs__panel" id="tab-panel-3">


                            <div class="table-responsive" style="">
                                <table id="group_list" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th width="5%">SN</th>
                                            <th width="85%">Amount(Rs.)</th>
                                            <th width="10%">Date</th>
                                            <th width="10%">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logisticCost as $k=>$v)
                                        <tr>
                                            <td>{{$k+1}}</td>

                                            <td>{{ $v->amount}}</td>
                                            <td>{{ $v->date}}
                                            </td>
                                            <td>{{ $v->remarks}}
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