<option value="" >--Select--</option>
@foreach($datas as $k => $jobStatus)
    <option value="{{ $jobStatus->code }}" 
        >
        {{ $jobStatus->status }}
    </option>
@endforeach
