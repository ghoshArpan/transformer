@extends('master.master')
@section('title', 'Group List')
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
                    {!! Form::button('<i class="fa fa-desktop "></i>&nbsp; Drdc shg<b></b>', [
                        'class' => 'btn btn-primary',
                        'style' => 'color:white;',
                    ]) !!}
                    <!-- <h1 class="m-0">scwscs</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="{{ route('group_list') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "><i
                                    class="fa fa-plus-circle"></i> &nbsp;Add &nbsp;</button>
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
    <section class="content">
        <div class="box box-warning">
            <div class="box-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table id="group_list" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">SN</th>
                                    <th width="10%">Shg Code</th>
                                    <th width="20%">Name</th>
                                    <th width="10%">Date</th>
                                    <th width="15%">Bank Name</th>
                                    <th width="10%">Branch Name</th>
                                    <th width="15%">Block</th>
                                    <th width="10%">G.P</th>
                                    <th width="5%">Action</th>
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
    <!------------------------------------------------TABLE END------------------------------------------>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            group_project();
            //$('#pLoader').show();
        });

        function group_project() {
            $('#group_list').dataTable().fnDestroy();
            $("#group_list").dataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    url: 'show_group_list',
                    type: 'post',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    dataSrc: "record_details",

                    beforeSend: function() {
                        $("#pLoader").show();      
                    },
                    complete: function() {
                        $("#pLoader").hide();
                    },
                },
                "dataType": 'json',
                "columnDefs": [
                    // {
                    // className: "table-text",
                    // "targets": "_all"
                    // },
                    {
                        "targets": 0,
                        className: "details-control",
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {
                        "targets": 1,
                        "data": "shg_code",
                        /*"defaultContent": "",
                        "searchable": false,
                        "sortable": false,*/

                    },
                    {
                        "targets": 2,
                        "data": "name",
                        /*"defaultContent": "",
                        "searchable": false,
                        "sortable": false,*/

                    },

                    {
                        // className: "text-center",
                        "targets": 3,
                        "data": "date",
                        /*"defaultContent": "",
                        "searchable": false,
                        "sortable": false,*/
                    },
                    {
                        // className: "text-center",
                        "targets": 4,
                        "data": "bank_name",
                        /* "defaultContent": "",
                         "searchable": false,
                         "sortable": false,*/
                    },

                    {
                        // className: "text-center",
                        "targets": 5,
                        "data": "branch_name",
                        /*"defaultContent": "",
                        "searchable": false,
                        "sortable": false,*/
                    },

                    {
                        // className: "text-center",
                        "targets": 6,
                        "data": "block_name",
                        /*"defaultContent": "",
                        "searchable": false,
                        "sortable": false,*/
                    },
                    {
                        // className: "text-center",
                        "targets": 7,
                        "data": "gp_name",
                        /* "defaultContent": "",
                         "searchable": false,
                         "sortable": false,*/
                    },
                    {
                        // className: "text-center align-middle",
                        "targets": -1,
                        "data": 'action',
                        /* "searchable": false,
                         "sortable": false, */
                    },
                ],
                "order": [
                    [1, 'asc']
                ]
            });


            $("#group_list").on('draw.dt', function() {
                $('#pLoader').show();
                $('.model_btn').click(function() {
                    var model_id = this.id;
                    // alert(model_id);
                    var fd = new FormData();
                    fd.append('model_id', model_id);
                    fd.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        'url': 'model_view_group_data',
                        'type': 'post',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            //console.log(data.status.name)
                            var str = '';
                            str += `<div class="container">
                               <h5 class="text-center">Group Details</h5>
                               <div class="row">
                               <div class="col-lg-6 col-md-6 col-12">
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Shg code</th>
                                   <td>${data.status.shg_code}</td>
                                  </tr>  
                                  <tr>
                                    <th>Name</th>
                                   <td>${data.status.name}</td>
                                    </tr>
                                    <tr>
                                    <th>Date</th>
                                   <td>${data.status.date}</td>
                                    </tr>
                                    <tr>
                                     <th>Village Name</th>
                                     <td>${data.status.village_name}</td>
                                     </tr>
                                     <tr>
                                    <th>Block</th>
                                     <td>${data.status.block_name}</td>
                                    </tr>
                                    <tr>
                                    <th>Gram Panchayat</th>
                                    <td>${data.status.gp_name}</td>
                                    </tr>
                                    <tr>
                                    <th>Bank Name</th>
                                     <td>${data.status.bank_name}</td>
                                    </tr>
                                    <tr>
                                    <th>Branch</th>
                                    <td>${data.status.branch_name}</td>
                                    </tr>
                                    </tr>
                                    <th>Ifsc</th> 
                                    <td>${data.status.ifsc_code}</td>
                                    </tr>  
                                </tr>
                            </thead>
                            </tbody>
                           </table>
                           </div>
                          
                           <div class="col-lg-6 col-md-6 col-12">
                           <table class="table table-bordered">
                                   <tr>
                                   <th>Nature livelyhood activities</th>
                                   <td>${data.status.nature_of_livelyhood_activities ==null ? '' : data.status.nature_of_livelyhood_activities}</td>
                                 
                                   </tr>
                                   <tr>
                                    <th>Sector</th>
                                    <td>${data.status.sector==null ? '': data.status.sector}</td>
                                   </tr>
                                   <tr>
                                     <th>Account no</th>
                                     <td>${data.status.account_no==null ? '': data.status.account_no}</td>
                                   </tr>
                                   <tr>
                                    <th>Already loan applied</th>
                                    <td>${data.status.already_applied_loan==null ? '' : data.status.already_applied_loan}</td>
                                   </tr>
                                   <tr>
                                    <th>Loan apply </th>
                                    <td>${data.status.loan_apply_or_not==null ? '':data.status.loan_apply_or_not}</td>
                                   </tr>
                                   <tr>
                                    <th>Amount</th>
                                    <td>${data.status.amount ==null ? '' : data.status.amount}</td>
                                   </tr>
                                   <tr>
                                    <th>Repayment done</th>
                                    <td>${data.status.repayment_done==null ? '' :data.status.repayment_done}</td>
                                   </tr>
                                   <tr>
                                    <th>Date submission application</th>
                                    <td>${data.status.date_of_submission_of_application==null ? '' : data.status.date_of_submission_of_application}</td>
                                   </tr>

                                   <tr>
                                    <th>Santion or not</th>
                                    <td>${data.status.santion_or_not==null ? '':data.status.santion_or_not}</td>
                                   </tr>
                                   <tr>
                                    <th>Loan apply or not</th>
                                    <td>${data.status.loan_apply_or_not==null ? '':data.status.loan_apply_or_not}</td>
                                   </tr>
                           </table>
                           </div>
                           </div>
                             <hr>
                              <h4 class="text-center">Group loan details</h4>
                           </div>`;
                            $('#model_view_table').html('');
                            $('#model_view_table').append(str);

                        }
                    });

                });


                $('.model_btn').click(function() {
                    var group_code = this.id;
                    // alert(model_id);
                    var fd = new FormData();
                    fd.append('group_code', group_code);
                    fd.append('_token', '{{ csrf_token() }}');
                    $('#pLoader').show();
                    $.ajax({
                        'url': 'loan_view_group_data',
                        'type': 'post',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function(data) {

                            // console.log(data.send_loan.group_code);
                            var group_loan = '';
                            $.each(data.send_loan, function(key, val) {
                                group_loan += `<h3 class = "accordion" >Loan ${key+1} </h3> 
                                <div class = "panel">
                                 <table class="table table-bordered">
                                                <tr>
                                                    <th>Group Code</th>
                                                    <th>Loan apply or not</th>
                                                    <th>Amount</th>
                                                    <th>Date submission application</th>
                                                    <th>Application sansantion date</th>
                                                    <th>Santion or not</th>
                                                    <th>Santion date</th>
                                                    <th>Santion amount</th>
                                                </tr>
                                                <tr>
                                                   <td>${val.group_code}</td>
                                                   <td>${val.loan_apply_or_not==null ? '' :val.loan_apply_or_not}</td>
                                                   <td>${val.amount==null ? '' :  '₹'+  val.amount}</td>
                                                   <td>${val.date_of_submission_of_application==null ? '': val.date_of_submission_of_application}</td>
                                                   <td>${val.application_sansantion_date ==null ? '': val.application_sansantion_date}</td>
                                                   <td>${val.santion_or_not==null ? '' : val.santion_or_not}</td>
                                                   <td>${val.santion_date==null ? '' : val.santion_date}</td>
                                                </tr>
                                                </table>
                                </div>`;
                            });
                            $('#group_loan_detail').html('');
                            $('#group_loan_detail').append(group_loan);
                            ///////////////////////////////////
                            var acc = document.getElementsByClassName("accordion");
                            var i;

                            for (i = 0; i < acc.length; i++) {
                                acc[i].addEventListener("click", function() {
                                    this.classList.toggle("active");
                                    var panel = this.nextElementSibling;
                                    if (panel.style.maxHeight) {
                                        panel.style.maxHeight = null;
                                    } else {
                                        panel.style.maxHeight = panel
                                            .scrollHeight + "px";
                                    }
                                });
                            }

                            ///////////////////////////////////

                            $('#pLoader').hide();
                        }
                    });
                });

                ///////////////////////////////////////
                $('.details-control').click(function() {
                    var tr = $(this).closest('tr');
                    table = $('#group_list').DataTable();
                    var row = table.row(tr);
                    console.log(row);
                    if (row.child.isShown()) {
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        row.child(format(row.data())).show();
                        tr.addClass('shown');
                    }
                });

                function format(d) {
                    // console.log(d);
                    var tbl = '';
                    tbl += `<div class="container-fluid">
                               <div class="row">
                               </div class="col-lg-12 col-md-12 col-12">
                                   <table class="table table-bordered table-hover">
                                        <tr>
                                         
                                            <th>Member code</th>
                                            <th>Member name</th>
                                             <th>Member age</th>
                                            <th>Insurance</th>
                                        </tr>`;
                    //  console.log(d.group_members);
                    //alert(d.group_members);
                    $.each(d.group_members, function(key, value) {
                        tbl += `
                        
            <tr>
                <td style="">${value.member_code}</td>
                <td style="">${value.member_name}</td> 
                <td style="">${value.member_age}</td>  
                <td style="">${value.insurance ==null ? '' : value.insurance}</td>             
            </tr>`;

                    });
                    tbl += "</table>"
                    tbl += "</div>"
                    tbl += "</div>"
                    tbl += "</div>";
                    return tbl;
                }

                //////////////////////////////////////////////

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
