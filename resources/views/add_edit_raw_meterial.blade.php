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
                    <a href="{{ route('rawMeterial_List') }}">
                        <button type="button" class="btn btn-primary" id="add_btn" style="float:right;"> &nbsp; Raw Meterial List &nbsp;
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
                    <form action="{{ route('add_edit_raw_meterial') }}" method="POST" id="add_unit_form">
                        @csrf

                        <div class="card-body">
                            <input type="hidden" name="raw_meterial_code" id="raw_meterial_code" value="{{$data ? $data->code : 0}}">

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
                                    <select name="sub_category_id" id="sub_category_id"  data-control="select2"
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
                                    <label for="name" class="form-label required">Raw Meterial:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="name" name="name" value="{{ old('name', isset($data) ? $data->name : '') }}" class="form-control" autocomplete="off" style="border-radius: 0.65rem; margin:6px;">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
							<div class="form-group row">
                                <div class="col-md-5">
                                    <label for="category" class="form-label required">Unit:</label>
                                </div>
                                <div class="col-md-7">
									<select name="unit" id="unit" data-control="select2"
											data-placeholder="Select Unit..." class="form-control form-select-solid">
										<option value="" disabled selected>---Select---</option>
										@foreach ($units as $unit)
										<option value="{{ $unit->code }}"
												{{ old('unit', isset($data) ? $data->unit_id : '') == $unit->code ? 'selected' : '' }}>
											{{ $unit->unit }}
										</option>
										@endforeach
									</select>

                                    @error('unit')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="rate" class="form-label required">Rate per unit(Rs.):</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="rate"  name="rate" value="{{ old('rate', isset($data) ? $data->rate : '') }}" class="form-control" autocomplete="off" onkeypress="return isNumberKey(event)" style="border-radius: 0.65rem; margin:6px;">
                                    @error('rate')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="details" class="form-label ">Details:</label>
                                </div>
                                <div class="col-md-7">
                                    <textarea type="text" rows="5" id="details" name="details" value="{{ old('details', isset($data) ? $data->details : '') }}" class="form-control"  autocomplete="off" style="border-radius: 0.65rem; margin:6px;"></textarea>
                                    @error('details')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
							<!-- <div class="form-group row">
								<div class="col-md-5">
									<label for="total_stock" class="form-label required">Total Stock:</label>
								</div>
								<div class="col-md-7">
									<input type="text" id="total_stock" readonly minlength="10" maxlength="10" name="total_stock" value="{{ old('total_stock', isset($data) ? $data->total_stock : '') }}" class="form-control" autocomplete="off" onkeypress="return isNumberKey(event)" style="border-radius: 0.65rem; margin:6px;">
									@error('total_stock')
									<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div> -->

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

$(document).ready(function () {
	 let categoryId = "{{ old('category_id', $data ? $data->category_id : 0) }}";
        let subCategoryId = "{{ old('sub_category_id', $data ? $data->sub_category_id : 0) }}";

        // Call function if category is set
        if (categoryId != 0) {
            get_subcategory(categoryId, subCategoryId);
        }
	
    $("#category_id").change(function () {
        let categoryId = $("#category_id").val();
		get_subcategory(categoryId);

           
       
    });
});
	
	function get_subcategory(category_id,sub_category_id=""){
	 $.ajax({
                url: "{{ route('get_subcategory') }}", // Define this route
                type: "POST",
                data: { 
						category_id: category_id,
					   sub_category_id: sub_category_id,
					    '_token': "{{ csrf_token() }}",
				},
                success: function (response) {
                  $("#sub_category_id").html("");
                  $("#sub_category_id").html(response);

                },
                error: function () {
                    alert("Something went wrong! Please try again.");
                }
            });
	}

</script>
@endsection