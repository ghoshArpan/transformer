@extends('master.master')
@section('title', 'Raw Meterial Category List')
@section('content')
    <style>
		 body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        table {
            margin-top: 20px;
        }
        .submit-btn {
            margin-top: 15px;
        }
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
                    {!! Form::button('<i class="fa fa-desktop "></i>&nbsp; Drdc shg<b></b>', [
                        'class' => 'btn btn-primary',
                        'style' => 'color:white;',
                    ]) !!}
                    <!-- <h1 class="m-0">scwscs</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <div class="float-right">
                        <a href="{{ route('attendance_list') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "><i
                                    class="fa fa-arrow-left"></i> &nbsp;Back &nbsp;</button>
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
        
              <table id="group_list" class="table table-striped table-bordered" style="width:100%">
              <thead>
                           
                <tr>
                 
                    <th>SL</th>
                    <th>Date</th>
                    <th>Name</th>
					<th>Attendance</th>
                    
                </tr>
            </thead>
            <tbody>
				
              @foreach($datas  as $key => $att)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ date('d-m-Y',strtotime($att->date)) }}</td>
                    <td>
                       {{$att->labourData()->first()->name}}
                    </td>
                    <td>
                        <input type="checkbox" checked disabled value="1">
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

