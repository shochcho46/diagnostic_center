<label for="district_id" class="form-label">All Districts</label>
<select name="district_id" class="form-control" id="district_id" style="width: 100%;" required>
    <option value="" disabled selected>All Districts</option>
    @foreach($allDistrict as $value)
        <option value="{{ $value->id }}" {{ isset($selectedId) && $selectedId == $value->id ? 'selected' : '' }}>
            {{ $value->name }}
        </option>
    @endforeach
</select>



@push('custome-js')
<script>

        $(document).on('change', '#district_id', function () {
            var districtID = $('#district_id').val(); // Get the selected division ID
            if (districtID) {
                // Fetch districts for the selected division via AJAX
                $.ajax({
                    url: "{{ route('getUpazilas') }}", // Route to fetch districts
                    type: "GET",
                    data: { district_id: districtID },
                    success: function (response) {
                        // Replace the district dropdown with the rendered HTML
                        $('#upzila-container').html(response.html);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching districts: ", error);
                    }
                });
            } else {
                // Clear the district dropdown if no division is selected
                $('#upzila-container').html('<select id="upazila_id" name="upazila_id" class="form-control"><option value="" disabled selected>All Upazila</option>');
            }
        });
</script>
@endpush
