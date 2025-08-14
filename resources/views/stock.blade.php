@extends('master.master')
@section('title', 'Raw Meterial')
@section('content')
<style>
    .content-header {
        padding: 6px 0.5rem;
    }

    .required:after {
        content: '*';
        color: red;
        font-weight: 700;
        margin-left: 4px;
    }

    .form-horizontal .has-feedback .form-control-feedback {
        top: 0;
        right: 15px;
    }

    .has-error {
        color: red;
        border-color: red;
    }

    .has-error .form-control {

        border-color: red;

    }

    .has-success .form-control {

        border-color: green;
    }

    #vehicle_user .inputGroupContainer .form-control-feedback,
    #vehicle_user .selectContainer .form-control-feedback {
        top: 0;
        right: -15px;
    }

    .has-error .form-control-feedback {
        color: #a94442;
    }

    .form-control-feedback {
        position: absolute;
        /* top: 25px;
             right: 0; */
        z-index: 2;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
        margin-left: 97%;
        margin-top: -38px;
    }

    .has-feedback .form-control-feedback {
        top: 2px;
        right: 15px;
    }

    .glyphicon {
        position: relative;
        top: 1px;
        /* display: inline-block; */
        font-family: 'Glyphicons Halflings';
        font-style: normal;
        font-weight: 400;
        /* line-height: 1; */
        -webkit-font-smoothing: antialiased;
        /* -moz-osx-font-smoothing: grayscale; */
    }

    /* .glyphicon-remove:before {
            content: "\e014";
        9 } */
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
            
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="{{ route('stockList') }}">
                        <button type="button" class="btn btn-primary" id="add_btn" style="float:right;">
                            &nbsp; Stock List &nbsp;
                        </button>
                    </a>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
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
    <div class="container-fluid" style="width:70%;">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="padding:0;">
                <div class="card card-primary shadow rounded-3" style="padding:0;">
                    <div class="add_button">
                        <p class="card-title" style="font-size: 20px; color:white; padding:7px;">Raw Meterial</p>
                    </div>

                    <!-- Normal HTML Form -->
                    <form action="{{ route('add_edit_stock') }}" method="POST" id="add_unit_form">
                        @csrf

                        <div class="card-body">
                            <input type="hidden" name="stock_code" id="stock_code" value="{{$data ? $data->code : 0}}">

                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="category" class="form-label required">Category:</label>
                                </div>
                                <div class="col-md-7">
                                    <select name="category_id" id="category_id" data-control="select2"
                                        data-placeholder="Select Category..." class="form-control form-select-solid">
                                        <option value="" disabled selected>---Select---</option>
                                        @foreach ($category as $cat)
                                        <option value="{{ $cat->code }}"
                                            {{ old('category_id', isset($data) ? $data->category_id : '') == $cat->code ? 'selected' : '' }}>
                                            {{ $cat->category }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="category" class="form-label required">Sub Category:</label>
                                </div>
                                <div class="col-md-7">
                                    <select name="sub_category_id" id="sub_category_id" data-control="select2"
                                        data-placeholder="Select Category..."
                                        class="form-control form-select-solid">
                                        <option value="" disabled>---Select---</option>


                                    </select>
                                    @error('sub_category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="raw_meterial" class="form-label required">Raw Meterial:</label>
                                </div>
                                <div class="col-md-7">
                                    <select name="raw_meterial" id="raw_meterial" data-control="select2"
                                        data-placeholder="Select Raw Meterial..."
                                        class="form-control form-select-solid">
                                        <option value="" disabled>---Select---</option>


                                    </select>
                                    @error('raw_meterial')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                               
                            </div>

                            <div class="form-group row">
                                <input type="hidden" name="stock_quantity" value="{{ old('stock_quantity', isset($data) ? $data->stock_quantity : '') }}">
                                <div class="col-md-5">
                                    <label for="quantity" class="form-label required">Quantity:</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" id="quantity"  name="quantity" value="{{ old('quantity', isset($data) ? $data->quantity : '') }}" class="form-control" autocomplete="off"  style="border-radius: 0.65rem; margin:6px;" onkeypress="return isNumberKey(event)">
                                    @error('quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <input type="text" id="raw_meterial_unit" readonly name="raw_meterial_unit" value="{{ old('raw_meterial_unit', isset($data) ? $data->raw_meterial_unit : '') }}" class="form-control" autocomplete="off"  style="border-radius: 0.65rem; margin:6px;" >
                                    
                                    @error('raw_meterial')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
 <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="amount" class="form-label required"> Amount(Rs.):</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="amount" readonly minlength="10" maxlength="10" name="amount" value="{{ old('quantity', isset($data) ? $data->amount_per_unit : '') }}"class="form-control" autocomplete="off" onkeypress="return isNumberKey(event)" style="border-radius: 0.65rem; margin:6px;" >
                                    @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="total_amount" class="form-label required">Total Amount(Rs.):</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="total_amount" readonly minlength="10" maxlength="10" name="total_amount" value="{{ old('total_amount', isset($data) ? $data->total_amount : '') }}" class="form-control" autocomplete="off" onkeypress="return isNumberKey(event)" style="border-radius: 0.65rem; margin:6px;" onkeypress="return isNumberKey(event)">
                                    @error('total_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer mt-5 text-center">
                                <button type="submit" class="btn btn-primary" style="color: white;">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')
<script>
    $(document).ready(function() {
		 $('#quantity').on('input', function () {
            calculateTotal();
        });
		
        let categoryId = "{{ old('category_id', $data ? $data->category_id : 0) }}";
        let subCategoryId = "{{ old('sub_category_id', $data ? $data->sub_category_id : 0) }}";
        let raw_meterial = "{{ old('raw_meterial', $data ? $data->raw_meterial_id : 0) }}";

        // Call function if category is set
        if (categoryId != 0) {
            get_subcategory(categoryId, subCategoryId);
			sub_category_wise_raw_meterial(categoryId, subCategoryId,raw_meterial);
        }

        $("#category_id").change(function() {
            let categoryId = $("#category_id").val();
            get_subcategory(categoryId);



        });
		fetch_raw_meterial_wise_amt(raw_meterial);
		
        $("#sub_category_id").change(function() {
            let sub_category_id = $("#sub_category_id").val();
            let categoryId = $("#category_id").val();
            sub_category_wise_raw_meterial(categoryId,sub_category_id);



        });
		 $("#raw_meterial").change(function() {
            let raw_meterial = $("#raw_meterial").val();
            fetch_raw_meterial_wise_amt(raw_meterial);



        });
		
		

    });

    function get_subcategory(category_id, sub_category_id = "") {
        $.ajax({
            url: "{{ route('get_subcategory') }}", // Define this route
            type: "POST",
            data: {
                category_id: category_id,
                sub_category_id: sub_category_id,
                '_token': "{{ csrf_token() }}",
            },
            success: function(response) {
                $("#sub_category_id").html("");
                $("#sub_category_id").html(response);

            },
            error: function() {
                alert("Something went wrong! Please try again.");
            }
        });
    }

     function sub_category_wise_raw_meterial(category_id, sub_category_id , raw_meterial="") {
        $.ajax({
            url: "{{ route('get_raw_meterial') }}", // Define this route
            type: "POST",
            data: {
                category_id: category_id,
                sub_category_id: sub_category_id,
                raw_meterial: raw_meterial,
                '_token': "{{ csrf_token() }}",
            },
            success: function(response) {
                $("#raw_meterial").html("");
                $("#raw_meterial").html(response);

            },
            error: function() {
                alert("Something went wrong! Please try again.");
            }
        });
    }
	
	function fetch_raw_meterial_wise_amt(raw_meterial=""){
		  $.ajax({
            url: "{{ route('fetch_raw_meterial_wise_amt') }}", // Define this route
            type: "POST",
            data: {
                raw_meterial: raw_meterial,
                '_token': "{{ csrf_token() }}",
            },
            success: function(response) {
				$("#amount").val(response.amount);
				$("#raw_meterial_unit").val(response.unit);
                
            },
            error: function() {
              
            }
        });
	}
	function calculateTotal() {
        let quantity = parseFloat(document.getElementById('quantity').value) || 0;
        let amount = parseFloat(document.getElementById('amount').value) || 0;
        let total = quantity * amount;
        document.getElementById('total_amount').value = total.toFixed(2);
    }
</script>
@endsection