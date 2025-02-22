<label for="status" class="form-label">Status</label>
<select name="status" class="form-control" id="status" style="width: 100%;" required>
    <option value="" disabled selected>Status</option>
    <option value="1" {{ isset($value->status) && $value->status == '1' ? 'selected' : '' }}>Active</option>
    <option value="0" {{ isset($value->status) && $value->status == '0' ? 'selected' : '' }}>Inactive</option>
</select>

@error('status')
<span class="text-danger">{{ $message }}</span>
@enderror
