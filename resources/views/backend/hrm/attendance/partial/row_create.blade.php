@php use Carbon\Carbon; @endphp
@if($attendance)
   <tr data-user_id="{{ $attendance->emp_id }}">
    <td>
        <p class="m-0 mt-2 text-navy-blue">
            {{ $attendance->name.'-'.$attendance->employee_id }}
        </p>
        <input type="hidden" name="user_ids[{{ $attendance->emp_id }}]" value="{{ $attendance->emp_id }}">
    </td>
    <td>
        <input type="time" class="form-control form-control-sm" name="clock_ins[{{ $attendance->emp_id }}]" value="{{ $attendance->clock_in }}">
    </td>
    <td>
        <input type="time" class="form-control form-control-sm" name="clock_outs[{{ $attendance->emp_id }}]" value="{{ $attendance->clock_out }}">
    </td>
    <td>
        <input type="text" class="form-control form-control-sm" name="clock_in_notes[{{ $attendance->emp_id }}]" value="{{ $attendance->clock_in_note }}" placeholder="clock in note">
    </td>
    <td>
        <input type="text" class="form-control form-control-sm" name="clock_out_notes[{{ $attendance->emp_id }}]" value="{{ $attendance->clock_out_note }}" placeholder="clock out note">
    </td>
    <td>
        <button name="remove" class="btn btn-sm btn-danger btn_remove mt-1">X</button>
    </td>
   </tr>
@else
<tr data-user_id="{{ $employee->id }}">
    <td>
        <p class="m-0 mt-2">
            {{ $employee->name.'-'.$employee->employee_id }}
        </p>
        <input type="hidden" name="user_ids[{{ $employee->id }}]" value="{{ $employee->id }}">
    </td>
    <td>
        <input type="time" class="form-control form-control-sm" name="clock_ins[{{ $employee->id }}]"">
    </td>
    <td>
        <input type="time" class="form-control form-control-sm" name="clock_outs[{{ $employee->id }}]"">
    </td>
    <td>
        <input type="text" class="form-control form-control-sm" name="clock_in_notes[{{ $employee->id }}]" placeholder="clock in note">
    </td>
    <td>
        <input type="text" class="form-control form-control-sm" name="clock_out_notes[{{ $employee->id }}]" placeholder="clock out note">
    </td>
    <td>
        <button name="remove" class="btn btn-sm btn-danger btn_remove mt-1">X</button>
    </td>
   </tr>
@endif