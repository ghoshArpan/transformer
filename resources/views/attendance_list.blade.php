@extends('master.master')
@section('title', 'Attendance List')
@section('content')
<style>
    
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::button('<i class="fa fa-desktop "></i>&nbsp; Attendance <b></b>', [
                        'class' => 'btn btn-primary',
                        'style' => 'color:white;',
                    ]) !!}
                    <!-- <h1 class="m-0">scwscs</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                  
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
        
              <table class="table table-bordered text-center">
              <thead>
                           
                <tr>
                 
                    <th>SL</th>
                    <th>Date</th>
                    <th>Total Present</th>
					<th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
				
              @foreach($datas as $key => $attendance)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ date('d-m-Y',strtotime($attendance->date)) }}</td>
                  
                    <td>
                        {{$attendance->total_present}}
                    </td>
					<td>
						<a href="{{route('view_attendance',encrypt($attendance->code))}}"><button type="button" class="btn btn-primary" ><i class="fa fa-eye"></i></button></a>
						
                    
                	</td>
                </tr>
            @endforeach
                
            </tbody>
        </table>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------------------------------------------TABLE END------------------------------------------>

@endsection

