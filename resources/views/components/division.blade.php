<label for="division_id" class="form-label" >All Divisions</label>
<select name="division_id" class="form-control" id="division_id" style="width: 100%;" required>
    <option value="" disabled selected>All Divisions</option>
    @foreach($allDivisions as $division)
        <option value="{{ $division->id }}" {{ isset($selectedId) && $selectedId == $division->id ? 'selected' : '' }}>
            {{ $division->name }}
        </option>
    @endforeach
</select>

@push('custome-js')
<script>

    $(document).ready(function () {
        $('#division_id').change(function () {
            var divisionId = $('#division_id').val(); // Get the selected division ID

            if (divisionId) {
                // Fetch districts for the selected division via AJAX
                $.ajax({
                    url: "{{ route('getDistricts') }}", // Route to fetch districts
                    type: "GET",
                    data: { division_id: divisionId },
                    success: function (response) {
                        // Replace the district dropdown with the rendered HTML
                        $('#district-container').html(response.html);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching districts: ", error);
                    }
                });
            } else {
                // Clear the district dropdown if no division is selected
                $('#district-container').html('<select id="district_id" name="district_id" class="form-control"><option value="" disabled selected>All Districts</option>');
            }
        });



    });
</script>
@endpush
