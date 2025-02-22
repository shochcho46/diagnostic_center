<label for="upazila_id" class="form-label">All Upazilas</label>
<select name="upazila_id" class="form-control" id="upazila_id" style="width: 100%;" required>
    <option value="" disabled selected>All Upazilas</option>
    @foreach($allUpazila as $value)
        <option value="{{ $value->id }}" {{ isset($selectedId) && $selectedId == $value->id ? 'selected' : '' }}>
            {{ $value->name }}
        </option>
    @endforeach
</select>



@push('custome-js')
<script>

        $(document).on('change', '#upazila_id', function () {
            var upazilaID = $('#upazila_id').val(); // Get the selected division ID
            if (upazilaID) {
                // Fetch districts for the selected division via AJAX
                $.ajax({
                    url: "{{ route('getUnions') }}", // Route to fetch districts
                    type: "GET",
                    data: { upazila_id: upazilaID },
                    success: function (response) {
                        // Replace the district dropdown with the rendered HTML
                        $('#union-container').html(response.html);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching districts: ", error);
                    }
                });
            } else {
                // Clear the district dropdown if no division is selected
                $('#union-container').html('<select id="union_id" name="union_id" class="form-control"><option value="" disabled selected>All Union</option>');
            }
        });
</script>
@endpush
