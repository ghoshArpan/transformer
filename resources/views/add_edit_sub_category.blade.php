@extends('master.master')
@section('title', 'Sub Category')
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
					<a href="{{ route('subcategoryList') }}">
						<button type="button" class="btn btn-primary" id="add_btn" style="float:right;">&nbsp; Specification List &nbsp;
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
						<p class="card-title" style="font-size: 20px; color:white; padding:7px;">Sub Category</p>
					</div>

					<!-- Normal HTML Form -->
					<form action="{{ route('addsubcategory') }}" method="POST" id="add_category_form">
						@csrf

						<div class="card-body">
							<input type="hidden" name="subcategory_code" id="subcategory_code" value="{{$data ? $data->code : 0}}">

							<div class="form-group row">
								<div class="col-md-5">
									<label for="category" class="form-label required">Material Name:</label>
								</div>
								<div class="col-md-7">
									<select name="category_id" id="category_id" required data-control="select2"
										data-placeholder="Select Category..."
										class="form-control form-select-solid">
										<option value="">---Select---</option>
										@foreach ($category as $cat)
										<option value="{{ $cat->code }}"
											{{ isset($data) && $data->category_id == $cat->code ? 'selected' : '' }}>
											{{ $cat->category }}
										</option>
										@endforeach

									</select>
									@error('category')
									<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-5">
									<label for="category" class="form-label required">Specification:</label>
								</div>
								<div class="col-md-7">
									<input type="text" id="sub_category" name="sub_category" value="{{ old('sub_category', isset($data) ? $data->sub_category : '') }}" class="form-control" autocomplete="off" style="border-radius: 0.65rem; margin:6px;">

									@error('sub_category')
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