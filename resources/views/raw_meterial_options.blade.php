<option value="" >--Select--</option>
@foreach($data as $k => $sub)
    <option value="{{ $sub->code }}" 
        {{ old('raw_meterial', isset($raw_id) ? $raw_id : '') == $sub->code ? 'selected' : '' }}>
        {{ $sub->name }}
    </option>
@endforeach
