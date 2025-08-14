@extends('master.master')
@section('title', 'User Add')
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
                        <a href="{{ route('user') }}">
                            <button type="button" class="btn btn-primary" id="add_btn" style="float:right ; "> &nbsp; User List &nbsp;</button>
                        </a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid " style="width:70%;">
            <div class="row ">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="  padding:0;">

                    <div class="card card-primary shadow   rounded-3" style="  padding:0;">
                        <div class="add_button">
                            <p class="card-title " style="font-size: 20px; color:white;  padding:7px; ">Drdc Details
                            </p>
                        </div>
                        {!! Form::open(['url' => '', 'method' => 'post', 'name' => '', 'id' => 'add_user_form']) !!}
                        <div class="card-body">
                            <div class="form-group ">
                                {{ Form::hidden('code', '', ['id' => 'edit_user_code']) }}
                                {{-- {{ Form::hidden('old_pdf_name', '', ['id' => 'old_pdf_name']) }} --}}
                            </div>


                            <!-- <div class="form-group row">
                                <div class="col-md-5">
                                    {!! Form::label('block code', 'Block:', ['class' => 'required form-label']) !!}
                                </div>
                                <div class="col-md-7">
                                    {{ form::select('block_code', ['' => '--select--'], null, [
                                        'class' => 'form-control',
                                        'id' => 'block_code',
                                        'autocomplete' => 'off',
                                        'style' => 'border-radius: 0.65rem; margin:6px',
                                    ]) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-5">
                                    {!! Form::label('grampanchayat', 'Gram Panchayat:', ['class' => 'required form-label']) !!}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::select('grampanchayat_code', ['' => '--select--'], null, [
                                        'class' => 'form-control',
                                        'id' => 'grampanchayat',
                                        'autocomplete' => 'off',
                                        'style' => 'border-radius: 0.65rem; margin:6px',
                                    ]) }}

                                </div>
                            </div> -->

                            <div class="form-group  row">
                                <div class="col-md-5">
                                    {{ Form::label('name', 'Name:', ['class' => 'form-label required']) }}
                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>


                            <div class="form-group  row  edit_hide">
                                <div class="col-md-5">
                                    {{ Form::label('user name', 'User Name', ['class' => 'form-label required']) }}

                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('user_name', null, ['id' => 'user_name', 'class' => 'form-control', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row ">
                                <div class="col-md-5">
                                    {{ Form::label('mobile', 'Mobile No.', ['class' => 'form-label required']) }}

                                </div>
                                <div class="col-md-7">
                                    {{ Form::text('mobile_no', null, ['maxlength' => '10', 'id' => 'mobile_no', 'class' => 'form-control', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row edit_hide">
                                <div class="col-md-5">
                                    {{ Form::label('Password', 'Password.', ['class' => 'form-label required']) }}

                                </div>
                                <div class="col-md-7">
                                    {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="form-group  row edit_hide">
                                <div class="col-md-5">
                                    {{ Form::label('cPassword', 'Confirm Password.', ['class' => 'form-label required']) }}

                                </div>
                                <div class="col-md-7">
                                    {{ Form::password('cpassword', ['id' => 'cpassword', 'class' => 'form-control', 'autocomplete' => 'off', 'style' => 'border-radius: 0.65rem; margin:6px']) }}
                                </div>
                            </div>

                            <div class="card-footer mt-5" style="text-align:center; padding:0;">
                                <!-- <button type="submit" class="btn btn-primary" id="submit_btn"><i class="fas fa-plus-circle"></i> &nbsp;Add &nbsp;</button> -->
                                {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'style' => ' color: white;']) }}
                            </div>
                            <!-- </form> -->
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('script')

    <script>
        var block_edit = '';
        var grampanchayat_edit = '';
        $(document).ready(function() {
           
            $('#add_user_form').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            },
                            stringLength: {
                                min: 3,
                                max: 50,
                                message: 'Name must be more than 3 and less than 50 characters long'
                            },
                            regexp: {
                                regexp: /^[A-Za-z\s/-]+$/i,
                                message: 'Only alphabetical and Space  Allowed Here'
                            },
                        }
                    },
                    user_name: {
                        message: 'Username is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Username is required'
                            },
                            stringLength: {
                                min: 6,
                                max: 50,
                                message: 'Username must be more than 6 and less than 50 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9@.]+$/,
                                message: 'Username can only consist of alphabetical, number @  and dot allowed Here'
                            }
                        }
                    },

                    password: {
                        message: 'Password is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Password is required'
                            },
                            identical: {
                                field: 'password',
                                message: 'Passwords must match. '
                            },
                            stringLength: {
                                min: 8,
                                max: 20,
                                message: 'Password must be more than 8 and less than 20 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9@.]+$/,
                                // regexp: /^[@A-Za-z0-9\s/-]+$/i,
                                message: 'Password can only consist of alphabetical, number  @ and dot allowed Here'
                            }
                        }
                    },
                    cpassword: {
                        message: 'Confirm password is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Confirm password is required'
                            },
                            identical: {
                                field: 'Password',
                                message: 'Password and Confirm password must be same'
                            },
                            stringLength: {
                                min: 8,
                                max: 20,
                                message: 'Confirm password must be more than 8 and less than 20 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9@.]+$/,
                                //regexp: /^[@A-Za-z0-9\s/-]+$/i,
                                message: 'Confirm password can only consist of alphabetical, number @ and dot allowed Here'
                            }
                        }
                    },
                    mobile_no: {
                        validators: {
                            notEmpty: {
                                message: 'Mobile No. is required'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/i,
                                message: 'Mobile No  Only numeric value  allowed Here'
                            },
                            stringLength: {
                                min: 10,
                                max: 10,
                                message: 'Mobile No. must be minimum & maximum 10 digits long.'
                            },

                        }
                    },

                    
                }

            }).on('success.form.bv', function(e) {
                // alert('kjhg');
                e.preventDefault();
                add_document();
            });
        });

        var action_url = "save_user_data";

        function add_document() {
            var edit_user_code = $("#edit_user_code").val();
            var name = $('#name').val();
            var user_name = $('#user_name').val();
            var mobile_no = $('#mobile_no').val();
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();
            //alert(name);
            var fn = new FormData();
            fn.append('edit_user_code', edit_user_code);
            fn.append('name', name);
            fn.append('username', user_name);
            fn.append('password', password);
            fn.append('cpassword', cpassword);
            fn.append('mobile_no', mobile_no);

            fn.append('_token', "{{ csrf_token() }}");
              $('#pLoader').show();
            $.ajax({
                type: "post",
                url: action_url,
                data: fn,
                // dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 1) {
                        $('#pLoader').hide();
                        var msg = "<strong>Success: </strong> User Details Save Successfully";
                        $.confirm({
                            icon: 'glyphicon glyphicon-heart',
                            title: "Success !",
                            // theme: 'my-theme',
                            type: 'green',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    window.location.href = "user_detail_list";
                                }
                            }
                        });
                    } else if (data.status == 2) {
                         $('#pLoader').hide();
                        var msg = "<strong>Success:</strong> User Details Update Successfully";
                        $.confirm({
                            title: "Success !",
                            type: 'green',
                            content: msg,
                            buttons: {
                                ok: function() {
                                    location.reload();
                                    window.location.href = "user_detail_list";
                                }
                            }
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // $(".se-pre-con").fadeOut("slow");
                    var msg = "";
                    if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                        msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
                    } else {
                        if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                            msg += "Exception: <strong>" + jqXHR.responseJSON.exception_message + "</strong>";
                        } else {
                            msg += "Error(s):<strong><ul>";
                            $.each(jqXHR.responseJSON['errors'], function(key, value) {
                                msg += "<li>" + value + "</li>";
                            });
                            msg += "</ul></strong>";
                        }
                    }
                    $.alert({
                        title: 'Error!!',
                        type: 'red',
                        icon: 'fa fa-warning',
                        content: msg,
                    });
                }
            });
        }

       
    </script>
    @isset($send_data)
        <script>
            var action_url = "update_user_detail";
            $('.edit_hide').hide();
            $("#edit_user_code").val("{{ $send_data['id'] }}");
            $('#name').val("{{ $send_data['name'] }}");
            $('#mobile_no').val("{{ $send_data['mobile_no'] }}");
            
        </script>
    @endisset


@endsection
