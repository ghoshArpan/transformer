@extends('master.master')
@section('title', 'Attendance Sheet')
@section('content')
<style>
.dataTables_info,
.dataTables_length,
.dataTables_filter,
.dataTables_paginate {
    display: none
}

.extra-input {
    pointer-events: auto;
    z-index: 1;
}

.attendance-input {
    width: 50px !important;
    /* Adjust this value as needed */
    max-width: 100%;
    padding: 0 5px;
    text-align: center;
}

th {
    font-size: 10px
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
            </div>
            <div class="col-sm-4" style="font-size:20px">
                <button class="btn btn-success">
                    Date :{{date('Y-m-d')}}
                </button>
            </div>
        </div>
    </div>
</div>

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
                    <h2>Employee Wages</h2>
                    <form method="POST" action="{{ route('attendance_page_save') }}" id="attendanceForm">
                        @csrf
                        <input type="hidden" name="days_in_month" value="{{ $daysInMonth }}">
                        <input type="hidden" name="month" value="{{ $currentMonth }}">
                        <input type="hidden" name="year" value="{{ $currentYear }}">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="attendanceTable">
                                <thead class="sticky-header">
                                    <tr>
                                        <th class="employee-name">Employee Name</th>
                                        <th class="daily-wage">Daily Wage(Rs.)</th>
                                        @for($day = 1; $day <= $daysInMonth; $day++) <th>{{ $day }}</th>
                                            @endfor
                                            <th>Total Days</th>
                                            <th>Total Payable(Rs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employeeData as $empData)
                                    @php $employee = $empData['employee']; @endphp
                                    <tr data-employee-id="{{ $employee->code }}"
                                        data-daily-wage="{{ $employee->per_day_wages }}">
                                        <td class="employee-name">{{ $employee->name }}</td>
                                        <td class="daily-wage">{{ number_format($employee->per_day_wages, 2) }}</td>

                                        <input type="hidden" name="employee_id[]" value="{{ $employee->code }}">

                                        @for($day = 1; $day <= $daysInMonth; $day++) <td>
                                            <input type="number" name="attendance_{{ $employee->code }}_{{ $day }}"
                                                class="attendance-input form-control" min="0" max="1" step="0.01"
                                                value="{{ $empData['attendance_data'][$day] ?? 0 }}"
                                                oninput="calculateTotals(this)">
                                            </td>
                                            @endfor

                                            <td class="total-days fw-bold">
                                                {{ number_format($empData['total_days'], 2) }}</td>
                                            <td class="total-payable fw-bold">
                                                {{ number_format($empData['total_payable'], 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        <div class="row mt-3">

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script>
function calculateTotals(input) {
    const row = input.closest('tr');
    const dailyWage = parseFloat(row.dataset.dailyWage);
    const inputs = row.querySelectorAll('.attendance-input');
    const totalDaysCell = row.querySelector('.total-days');
    const totalPayableCell = row.querySelector('.total-payable');

    let totalDays = 0;

    inputs.forEach(input => {
        const days = parseFloat(input.value) || 0;
        totalDays += days;
    });

    const totalPayable = totalDays * dailyWage;

    totalDaysCell.textContent = totalDays.toFixed(2);
    totalPayableCell.textContent = totalPayable.toFixed(2);
    saveAttendance();
}

function saveAttendance() {
    let formData = $("#attendanceForm").serialize();

    $.ajax({
        url: $("#attendanceForm").attr("action"),
        method: "POST",
        data: formData,
        success: function(response) {
            console.log("Attendance saved successfully", response);
        },
        error: function(xhr) {
            console.error("Error saving attendance:", xhr.responseText);
        }
    });
}
$(document).ready(function() {
    // $('.attendance-input').each(function() {
    //     calculateTotals(this);
    // });
});
</script>
@endsection