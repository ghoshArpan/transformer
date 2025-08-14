<option value="" >--Select--</option>
@foreach($data as $k => $sub)
    <option value="{{ $sub->code }}" 
        {{ old('sub_category_id', isset($subId) ? $subId : '') == $sub->code ? 'selected' : '' }}>
        {{ $sub->sub_category }}
    </option>
@endforeach
