@extends('master.master')
@section('title', 'Sdem List')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                  
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="{{ route('user_list') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "> &nbsp;Add &nbsp;</button>
                        </a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!------------------------------------------------TABLE START------------------------------------------>
    <section class="content">
        <div class="box box-warning">
            <div class="box-body">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table id="user_list" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">SN</th>
                                    <th width="15%">Name</th>
                                    <th width="20%">User Name</th>
                                    <th width="15%">Mobile No.</th>
                                    
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
    <!------------------------------------------------TABLE END------------------------------------------>

@endsection

@section('script')
    <script>
       
       $(document).ready(function(){
         
          user_project();
        
       });

        function user_project() {
            
            $('#user_list').dataTable().fnDestroy();
            $("#user_list").dataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    url: 'show_user_detail_list',
                    type: 'post',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    dataSrc: "record_details"
                },
                "dataType": 'json',
                "columnDefs": [
                    // {
                    // className: "table-text",
                    // "targets": "_all"
                    // },
                    {
                        // className: "text-center",
                        "targets": 0,
                        "data": "id",
                       /* "defaultContent": "",
                        "searchable": false,
                        "sortable": false,*/
                    },
                      
                    {
                        // className: "text-center",
                        "targets": 1,
                        "data": "name",
                        /* "defaultContent": "",
                        "searchable": false,
                        "sortable": false,*/
                    },
                   
                    {
                        // className: "text-center",
                        "targets": 2,
                        "data": "username",
                        /* "defaultContent": "",
                        "searchable": false,
                        "sortable": false,*/
                    },

                    {
                        // className: "text-center",
                        "targets": 3,
                        "data": "mobile_no",
                         /* "defaultContent": "",
                        "searchable": false,
                        "sortable": false,*/
                    },
                     

                    {
                        // className: "text-center",
                        "targets": -1,
                        "data": "action",
                        /* "defaultContent": "",
                        "searchable": false,
                        "sortable": false,*/
                    },
                   
                ],
                "order": [
                    [1, 'asc']
                ]
            });
            $("#user_list").on('draw.dt', function() {
                $(".edit_btn").click(function() {
                    var edit_code = this.id;
                    //alert(edit_code);
                    let datas = {
                        'code': edit_code,
                        '_token': "{{ csrf_token() }}"
                    };
                    redirectPost("{{ url('edit_user_detail') }}", datas);
                });
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
