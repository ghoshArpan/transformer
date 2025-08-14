@extends('master.master')
@section('title', 'Labour List')
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
                {!! Form::button('<i class="fa fa-desktop "></i>&nbsp; Labour <b></b>', [
                        'class' => 'btn btn-primary',
                        'style' => 'color:white;',
                    ]) !!}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="{{ route('labour') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; ">&nbsp;Add &nbsp;</button>
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
		<div class="col-sm-11 offset-1 alert alert-success alert-dismissible fade show" role="alert">
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
                                    <th width="10%">Name</th>
                                    <th width="10%">Phone No</th>
                                    <th width="10%">Per Day Wages(Rs.)</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
								
            @foreach($datas as $key=>$labour)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $labour->name }}</td>
                    <td>{{ $labour->phone_no }}</td>
                    <td>{{ $labour->per_day_wages }}</td>
                    <td>
                                            <a href="{{route('labour',encrypt($labour->code))}}" data-bs-toggle="tooltip" title="Edit">
                                    <button class="btn btn-primary btn-sm btn-icon edit_btn m-0">
                                    <i class="fa fa-edit"></i> </button></a>
						<a href="javascript:void(0);" data-id="{{ encrypt($labour->code) }}" 
   class="toggle-status" data-status="{{ $labour->status }}" 
   data-bs-toggle="tooltip" title="Change Status">
    <button class="btn {{ $labour->status == '1' ? 'btn-success' : 'btn-danger' }} btn-sm btn-icon m-0">
        <i class="fa {{ $labour->status == '1' ? 'fa-thumbs-up' : 'fa-thumbs-down' }}"></i>
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

@section('script')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    $(".toggle-status").click(function () {
        let labourId = $(this).data("id");
        let currentStatus = $(this).data("status");
        let newStatus = currentStatus == '1' ? '0' : '1'; // Toggle status

        Swal.fire({
            title: "Are you sure?",
            text: "You want to " + (newStatus == '1' ? 'Activate' : 'Deactivate') + " this user?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('labour_status_update') }}", // Update this route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: labourId,
                        status: newStatus
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire("Success!", response.message, "success").then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Error!", response.message, "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Error!", "Something went wrong.", "error");
                    }
                });
            }
        });
    });
});
</script>

@endsection