@extends('backend.master')
@section('title', 'Sdem List')
@section('content')
    {{-- <script src="http://excavatorproject.test/bootstrap_date/date_picker.min.js"></script> --}}

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::button('<i class="fa fa-desktop "></i> Dash Board / SDEM Court<b></b>', [
                        'class' => 'btn btn-primary',
                        'style' => 'color:white;',
                    ]) !!}
                    <!-- <h1 class="m-0">scwscs</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="{{ route('add_sdem') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "><i
                                    class="fa fa-plus-circle"></i> &nbsp;Add &nbsp;</button>
                        </a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid"style="width:90%">
            <!-- content -->
            <div class="mb-2">
                <div class=" items-center mb-4">
                    {{-- <h1 class="text-lg font-medium truncate mr-5"><i class="fa-solid fa-tags"></i>/pppp
                    </h1> --}}
                </div>
                <div class="container-fluid fs-6 mb-4">
                    {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'search_by', 'class' => 'form-group']) !!}
                    <div class="row">



                        <div class="form-group col-xxl-1 col-xl-1 col-md-1 col-sm-1 mb-3"></div>

                        {{-- <div class="form-group col-xxl-2 col-xl-3 col-md-4 col-sm-5 mb-3">
                            {!! Form::label('Date', 'Date : ', ['class' => 'form-label fw-bold']) !!}
                         
                            {!! form::select('status_type', ['date_putup' => 'put up Date', 'hearing_date' => 'Hearing Date'], null, [
                                'placeholder' => '--Select Type --',
                                'class' => 'form-control',
                                'id' => 'status_type',
                            ]) !!}
                        </div> --}}

                        <div class="form-group col-xxl-2 col-xl-3 col-md-4 col-sm-5 mb-3">
                            {{-- {!! Form::label('from_date', 'From Date :', ['class' => 'form-label fw-bold']) !!}
                            <div class="input-group">

                                {!! Form::text('from_date', null, [
                                    'id' => 'from_date',
                                    'class' => 'form-control form-control-sm bg-white',
                                    'autocomplete' => 'off',
                                    'readonly',
                                    'style' => 'padding: 18px',
                                ]) !!}
                                <label class="input-group-text bg-white" for="from_date"><i class="fa fa-calendar"
                                        aria-hidden="true"></i></label>
                            </div> --}}
                        </div>

                        <div class="form-group col-xxl-2 col-xl-3 col-md-4 col-sm-5 mb-3">
                            {!! Form::label('', '', ['class' => 'form-label fw-bold']) !!}
                            <div class="input-group">

                                {!! Form::text('all_search', null, [
                                    'id' => 'all_search',
                                    'class' => 'form-control form-control-sm bg-white',
                                    'autocomplete' => 'off',
                                    // 'readonly',
                                    'style' => 'padding: 18px',
                                ]) !!}
                             
                            </div>
                        </div>

                        {{-- <div class="form-group col-xxl-2 col-xl-3 col-md-4 col-sm-5 mb-3">
                            {!! Form::label('from_date', 'To Date :', ['class' => 'form-label fw-bold']) !!}
                            <div class="input-group">
                                {!! Form::text('to_date', null, [
                                    'id' => 'to_date',
                                    'class' => 'form-control form-control-sm bg-white',
                                    'autocomplete' => 'off',
                                    'readonly',
                                    'style' => 'padding: 18px',
                                ]) !!}
                                <label class="input-group-text bg-white" for="from_date">
                                    <i class="fa fa-calendar" aria-hidden="true"></i></label>
                            </div>
                        </div> --}}



                        <div class="form-group col-md-2 col-sm-2 mb-3" style="margin-top: 24px;">
                            {{-- {!! Form::label('search', 'Search', ['class' => 'form-label fw-bold']) !!}<br> --}}
                            <button type="button" id="custom_search" class="btn btn-sm btn-bass-green bg-primary"
                                style="padding: 7px;width: 35px"> <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- content -->
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="box box-warning">
            <div class="box-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table id="sdem_list" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">SN</th>
                                    {{-- <th width="15%">Case NO. </th>
                                    <th width="15%">Year </th>
                                    <th width="15%">Section </th>
                                    <th width="15%">khatain No.</th> --}}
                                    {{-- <th width="15%">LR </th>
                                    <th width="15%">RS </th>

                                     <th width="15%"> Area </th>
                                     <th width="15%"> Remark </th> --}}

                                    <th width="15%">Name Of Applicant </th>
                                    <th width="15%">Name Of Respondent</th>
                                    <th width="15%">Date Of Putup</th>
                                    <th width="15%">Hearing Date</th>
                                    <th width="15%">Dag/RR No.</th>
                                    <th width="15%">Report Pending.</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
       
        $("#from_date").datepicker({
            // defaultDate: new Date(),
            format: "dd/mm/yyyy",
            // endDate: '0d',
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            toggleActive: true,
        });

        $("#to_date").datepicker({
            // defaultDate: new Date(),
            format: "dd/mm/yyyy",
            // endDate: '0d',
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            toggleActive: true,
        });

        $("#custom_search").click(function() {
            show_project();
        });
        $(document).ready(function() {
            show_project();
            // $('#custom_search').attr('disabled', true);
        });

        function show_project() {

            var all_search = $("#all_search").val();
             
            //   alert(status_type);  
            
            $('#sdem_list').dataTable().fnDestroy();
            $("#sdem_list").dataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    url: 'show_sdem_detail_list',
                    type: 'post',
                    data: {
                        'all_search': all_search,
                        '_token': '{{ csrf_token() }}',
                    },
                    dataSrc: "record_details"
                },
                "dataType": 'json',
                "columnDefs": [{
                        className: "table-text",
                        "targets": "_all"
                    },
                    {
                        "targets": 0,
                        "data": "code",
                        "defaultContent": "",
                        // "searchable": false, 
                        // "sortable": false,
                    },

                    // {
                    //     "targets": 1,
                    //     "data": "case_no",
                    //     // "searchable": false,
                    //     // "sortable": false,
                    // },

                    // {
                    //     "targets": 2,
                    //     "data": "year",
                    //     // "searchable": false,
                    //     // "sortable": false,
                    // },
                    // {
                    //     "targets": 3,
                    //     "data": "section",
                    //     // "searchable": false,
                    //     // "sortable": false,
                    // },
                    
                    // {
                    //     "targets": 4,
                    //     "data": "khatain_no",
                    //     // "searchable": false,
                    //     // "sortable": false,
                    // },
                    // {
                    //     "targets": 5,
                    //     "data": "lr",
                    //     // "searchable": false,
                    //     // "sortable": false,
                    // },
                    // {
                    //     "targets": 6,
                    //     "data": "rs",
                    //     // "searchable": false,
                    //     // "sortable": false,
                    // },
                    // {
                    //     "targets": 7,
                    //     "data": "area",
                    //     // "searchable": false,
                    //     // "sortable": false,
                    // },

                    // {
                    //     "targets": 8,
                    //     "data": "remark",
                    //     // "searchable": false,
                    //     // "sortable": false,
                    // },
                    {
                        "targets": 1,
                        "data": "applicant_name",
                        // "searchable": false,
                        // "sortable": false,
                    },
                    {
                        "targets": 2,
                        "data": "respondent_name",
                        // "searchable": false,
                        // "sortable": false,
                    },

                    {
                        "targets": 3,
                        "data": "date_putup",
                        // "searchable": false,
                        // "sortable": false,
                    },
                    {
                        "targets": 4,
                        "data": "hearing_date",
                        // "searchable": false,
                        // "sortable": false,
                    },
                    {
                        "targets": 5,
                        "data": "dag_rr",
                        // "searchable": false,
                        // "sortable": false,
                    },
                    {
                        "targets": 6,
                        "data": "report_pending",
                        // "searchable": false,
                        // "sortable": false,
                    },
                    
                    {
                        "targets": -1,
                        "data": "action",
                        // "searchable": false,
                        // "sortable": false,
                    },
                ]
            });
            $("#sdem_list").on('draw.dt', function() {
                $(".edit_btn").click(function() {
                    var edit_code = this.id;
                    //  alert(edit_code);
                    let datas = {
                        'code': edit_code,
                        '_token': "{{ csrf_token() }}"
                    };
                    redirectPost("{{ url('edit_sdem_detail') }}", datas);

                });

                $(".delete_btn").click(function() {
                    var code = this.id;
                    //  console.log(code);
                    //alert(code);
                    var msg = "<strong>Are You Sure To Delete </strong>";
                    $.alert({
                        title: 'Confirm!',
                        type: 'red',
                        icon: 'fa fa-exclamation-triangle',
                        content: msg,
                        buttons: {
                            yes: function() {
                                delete_data(code);
                                // location.reload();
                            },
                            cancel: function() {
                                location.reload();
                            }
                        }
                    });
                });

                function delete_data(code) {
                    let fd = new FormData();
                    fd.append('code', code);
                    fd.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        type: 'post',
                        url: "delete_sdem_detail",
                        data: fd,
                        processData: false,
                        contentType: false,
                        dataType: "json",

                        success: function(data) {

                            if (data.status == 3) {
                                var msg =
                                    "<strong>Success:</strong>Sdem details deleted Successfully";
                                $.confirm({
                                    title: 'Success !',
                                    type: 'green',
                                    icon: 'fa fa-check',
                                    content: msg,
                                    buttons: {
                                        ok: function() {
                                            location.reload();
                                        }
                                    }
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            var msg = "";
                            if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                                msg += "<strong>" + jqXHR.status + ": " +
                                    errorThrown +
                                    "</strong>";
                            } else {
                                if (jqXHR.responseJSON.hasOwnProperty(
                                        'exception')) {
                                    if (jqXHR.responseJSON.exception_code ==
                                        23000) {
                                        msg += "Some Sql Exception Occured";
                                    } else {
                                        msg += "Exception: <strong>" + jqXHR
                                            .responseJSON
                                            .exception_message +
                                            "</strong>";
                                    }
                                } else {
                                    msg += "Error(s):<strong><ul>";
                                    $.each(jqXHR.responseJSON['errors'], function(
                                        key, value) {
                                        msg += "<li>" + value + "</li>";
                                    });
                                    msg += "</ul></strong>";
                                }
                                $.alert({
                                    title: 'Error!!',
                                    type: 'red',
                                    icon: 'fa fa-warning',
                                    content: msg,
                                });
                            }
                        },
                    });
                }
            });
        };

        function redirectPost(url, data1) {
            var $form = $("<form />");
            $form.attr("action", url);
            $form.attr("method", "post");
            for (var data in data1) {
                $form.append('<input type="hidden" name="' + data + '" value="' + data1[data] + '" />');
                // console.log(data1[data]);
            }
            $("body").append($form);
            $form.submit();
        }
    </script>
@endsection
