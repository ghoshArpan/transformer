@extends('master.master')
@section('title', 'Attendance Sheet')
@section('content')
<style>
   
        .dataTables_info , .dataTables_length,.dataTables_filter,.dataTables_paginate {
            display:none
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    {!! Form::button('<i class="fa fa-desktop "></i>&nbsp;Daily Attendance<b></b>', [
                        'class' => 'btn btn-primary',
                        'style' => 'color:white;',
                    ]) !!}
                    <!-- <h1 class="m-0">scwscs</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-4" style="font-size:20px">
               <!-- <h3>Date: {{date('Y-m-d')}}</h3> -->
                        <button class="btn btn-success">
                        Date :{{date('Y-m-d')}}   
                        </button>
               

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
		<div class="col-sm-12 alert alert-success alert-dismissible fade show" role="alert">
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
                <div class="container-fluid bg-light">
                    <div class="table-responsive">
          <form action="{{route('attendance_submit')}}" method="POST">
			  @csrf
        
                        <!-- <table id="group_list" class=" table-striped table-bordered" style="width:100%">
                            <thead> -->
                            <table class="table table-bordered text-center">
                            <thead>
                           
                <tr>
                 
                    <th>SL</th>
                    <!-- <th>Date</th> -->
                    <th>Name</th>
					<th>Attendance</th>
                    
                </tr>
            </thead>
            <tbody>
				
              @foreach($datas as $key => $emp)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <!-- <td>{{ date('d-m-Y') }}</td> -->
                    <td>
                        <input type="hidden" name="employee_id[{{ $key }}]" value="{{ $emp->code }}">
                        {{ $emp->name }}
                    </td>
                    <td>
                        <input type="checkbox" name="attendance[{{ $key }}]" class="custom-checkbox" value="1"
                            {{ in_array($emp->code, $attendance) ? 'checked' : '' }}>
                    </td>
                </tr>
            @endforeach
                
            </tbody>
        </table>
       <div  style="float:right;margin:10px">
       <button type="submit" class="submit-btn btn btn-success">Mark Attendance</button>

       </div>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------------------------------------------TABLE END------------------------------------------>

@endsection

