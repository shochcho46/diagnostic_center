<label for="union_id" class="form-label">All Unions</label>
<select name="union_id" class="form-control" id="union_id" style="width: 100%;" required>
    <option value="" disabled selected>All Unions</option>
    @foreach($allUnion as $value)
        <option value="{{ $value->id }}" {{ isset($selectedId) && $selectedId == $value->id ? 'selected' : '' }}>
            {{ $value->name }}
        </option>
    @endforeach
</select>
