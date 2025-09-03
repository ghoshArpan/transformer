@extends('master.master')
@section('title', 'Quotation')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body {
        background: #f8f9fa;
        font-family: system-ui, sans-serif;
    }

    .nav-pills .nav-link {
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #495057;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        color: #fff;
    }

    .tab-content {
        background: #fff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        min-height: 250px;
        transition: all 0.3s ease;
    }

    .tab-pane {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .tab-pane.active.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<!-- Nav Tabs -->
<div class="content-header">
    <div class="row">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
            <div class="float-right">

                <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "> &nbsp;Add &nbsp;</button>

            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-left: 5px;margin-right: 5px">
    <!-- Left side tabs -->
    <div class="col-md-2 mb-2">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            @foreach($datas['quotation_table'] as $key=>$s)
            <button class="nav-link {{ $key==0?'active':''}}" id="v-home-tab" data-bs-toggle="pill" data-bs-target="#{{$s['quotation_no']}}" type="button" role="tab">{{$s['quotation_no']}}</button>
            @endforeach
        </div>
    </div>

    <!-- Right side content -->
    <div class="col-md-10">
        <div class="tab-content" id="v-pills-tabContent">
            @foreach($datas['quotation_table'] as $key=>$s)
            <div class="tab-pane fade {{ $key==0?'show active':''}}" id="{{$s['quotation_no']}}" role="tabpanel">
                <h4> Quotation No : {{$s['quotation_no']}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date : {{$s['quotation_date']}}</h4>
                <table class="table" style="margin-top: 30px;">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Specefication</th>
                            <th scope="col">Description</th>
                            <th scope="col">Make</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Total Amt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($s['quotation_wise_rawmaterial_table'] as $key1=>$s1)
                        <tr>
                            <th scope="row">{{++$key1}}</th>
                            <td>{{$s1['category_table']['category'] ?? ''}}</td>
                            <td>{{$s1['subcategory_table']['sub_category'] ?? ''}}</td>
                            <td>{{$s1['rawmaterial_table']['name']?? ''}}</td>
                            <td>{{$s1['make_table']['make_name']?? ''}}</td>
                            <td>{{$s1['quantity']}}</td>
                            <td>{{$s1['amount_per_unit']}}</td>
                            <td>{{$s1['total_amount']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="add_quotationData" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_quotationDataLabel">Add Quotation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div id="add_quotation">
                        <form method="POST" id="">
                            @csrf
                            <input type="hidden" name="quotation_code" id="transformer_code" value="">
                            <div class="form-group row">

                                <div class="col-md-2">
                                    <label for="name" class="form-label required">Quotation No:</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="quotation_no" name="quotation_no" value="" class="form-control"
                                        autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                    @error('quotation_no')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="name" class="form-label required ">Date:</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" id="quotation_date" name="quotation_date" value="" class="form-control"
                                        autocomplete="off" style="border-radius: 0.65rem; margin:3px;">
                                    @error('quotation_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="name" class="form-label required">Dealer:</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="dealer" id="sub_category_id" data-control="select2"
                                        data-placeholder="Select Dealer..."
                                        class="form-control form-select-solid">
                                        <option value="" disabled>---Select---</option>
                                        @foreach ($dealer_data as $d)
                                        <option value="{{ $d->code }}">
                                            {{ $d->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('dealer')
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
</div>



@endsection
@section('script')
<script>
    $("#add_btn").click(function() {
        $('#add_quotationData').modal('show');
    })
</script>
@endsection