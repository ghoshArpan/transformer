@extends('master.master')
@section('title', 'Labour Cost ')
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
<!-- Button trigger modal -->


<!-- Modal -->

<div class="content-header">


    <div class="container-fluid">



        <div class="row">
            <div class="col-sm-10">
            {!! Form::button('<i class="fa fa-desktop "></i>&nbsp; Labour Cost<b></b>', [
                        'class' => 'btn btn-primary',
                        'style' => 'color:white;',
                    ]) !!}
            </div>
            <div class="col-sm-2">
            <div class="float-right">

                <a href="javascript:void(0)">
                    <button type="button" class="btn btn-info d-none" id="add_cost" style="padding:7px">&nbsp;Add Cost
                        &nbsp;</button>
                </a>
            </div>
            </div>
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
                <div class="table-responsive">
                    <table id="group_list" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" id="selectllTrans" />
                                </th>
                                <th width="10%">Tag</th>
                                <th width="20%">Office Name</th>
                                <th width="50%">Work Name</th>
                                <th width="10%">Status</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $key=>$transformar)
                            <tr>
                                <td>
                                    <!-- Individual Checkbox -->
                                    <input type="checkbox" class="selectRow" value="{{ $transformar->code }}" />
                                </td>
                                <!-- <td>{{ ++$key }}</td> -->
                                <td>{{ $transformar->unique_code }}</td>
                                <td>{{ $transformar->office_name }}</td>
                                <!-- <td>{{ $transformar->financiarYear() ? $transformar->financiarYear()->first()->financial_year ?? "" : "" }} -->
                                </td>
                                <td>{{ $transformar->work_name }}</td>
                                <td>
                                    <button class="badge p-1"
                                        style="background-color: {{ $transformar->jobStatus() ? ($transformar->jobStatus()->first()->color_code ?? '') : '' }};border:0 ;padding:2px;color:white">
                                        {{ $transformar->jobStatus() ? $transformar->jobStatus()->first()->status ?? "" : "" }}
                                    </button>
                                </td>
                                <td>
                                <a href="{{route('transformer_view', encrypt($transformar->code))}}" data-bs-toggle="tooltip" title="View">
                                        <button class="btn btn-warning btn-sm btn-icon edit_btn m-0">
                                            <i class="fa fa-eye"></i> </button>
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

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    var selectedIds = [];

    // Handle "Select All" checkbox
    $('#selectllTrans').change(function() {
        if (this.checked) {
            $('.selectRow').each(function() {
                let id = $(this).val(); // assuming 'value' contains the ID
                if (!selectedIds.includes(id)) {
                    selectedIds.push(id); // Add the ID
                }
            });
            $('.selectRow').prop('checked', true);
            $("#add_cost").removeClass("d-none");
            $("#add_logistics").removeClass("d-none");
        } else {
            selectedIds = [];
            $('.selectRow').prop('checked', false);
            $("#add_cost").addClass("d-none");
            $("#add_logistics").addClass("d-none");
        }
    });

    $('.selectRow').change(function() {
        let id = $(this).val(); // assuming 'value' contains the ID
        if (this.checked) {
            if (!selectedIds.includes(id)) {
                selectedIds.push(id); // Add ID if checked
            }
        } else {
            selectedIds = selectedIds.filter(function(item) {
                return item !== id; // Remove ID if unchecked
            });
        }

        if ($('.selectRow:checked').length == $('.selectRow').length) {
            $('#selectllTrans').prop('checked', true);
            $("#add_cost").removeClass("d-none");
            $("#add_logistics").removeClass("d-none");

        } else if ($('.selectRow:checked').length > 0) {
            $("#add_cost").removeClass("d-none");
            $("#add_logistics").removeClass("d-none");
        } else {
            $('#selectllTrans').prop('checked', false);
            $("#add_cost").addClass("d-none");
            $("#add_logistics").addClass("d-none");
        }
    });

    // Handle "Update Status" button click
    $('#add_cost').click(function() {


        Swal.fire({
            title: "",
            text: "Add Labour Cost, please mark labour attendance before add",
            icon: "",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Add!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('add_labour_cost') }}", // Update this route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        selectedIds: selectedIds

                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire("Success!", response.message, "success").then(
                                () => {
                                    location.reload();
                                });
                        } else {
                            Swal.fire("Error!", "Please Mark Labour Attendance First", "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", "Something went wrong.", "error");
                    }
                });
            }
        });
    });



    $('#add_logistics').click(function() {
 

       


        Swal.fire({
    title: "Are you sure?",
    text: "Add Logistic Data",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#28a745",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Add it!",
    html: `
        <input id="amount" class="swal2-input" placeholder="Enter Logistic Amount" type="number" min="0">
        <input id="remarks" class="swal2-input" placeholder="Enter Logistic Remarks" type="text">
    `,
    preConfirm: () => {
        
        const amount = document.getElementById('amount').value;
        const remarks = document.getElementById('remarks').value;

        if (!amount || !remarks) {
            Swal.showValidationMessage('Please enter both amount and remarks');
            return false;
        }

        return { amount, remarks };
    }
}).then((result) => {
    if (result.isConfirmed) {
        const { amount, remarks } = result.value; 

        $.ajax({
            url: "{{ route('add_logistic_cost') }}", 
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                selectedIds: selectedIds,
                amount: amount, 
                remarks: remarks 
            },
            success: function(response) {
                if (response.status == 200) {
                    Swal.fire("Success!", response.message, "success").then(
                        () => {
                            location.reload();
                        });
                } else {
                    Swal.fire("Error!", response.message, "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "Something went wrong.", "error");
            }
        });
    }
});

    });
});
</script>
@endsection