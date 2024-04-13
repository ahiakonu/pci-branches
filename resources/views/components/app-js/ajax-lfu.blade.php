<script>
    jQuery(document).ready(function($) {
        $loadval = $("#region_id").val();
        $loadval_id = $("#old_location").val();
        if ($loadval) {
            loadLocations($loadval, $loadval_id);
        }

        $("#region_id").on('change', function() {
            var region_id = $(this).val();
            loadLocations(region_id, 0);
        });


        $("#location_id").on('change', function() {
            var location = $("#location_id option:selected").text();
            $('#seletedlocation').val(location + ' LFU');
            //console.log("seleted-location", location);

        });

    });

    function loadLocations(region_id, loadval_id) {
        $('#location_id').find('option').not(':first').remove();
        if (region_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/ajax/locations-by-regionid',
                data: {
                    region_id: '' + region_id + ''
                },
                success: function(result, status) {
                    //console.log(result.locations.length)
                    if (result.status === true) {
                        var len = 0;
                        if (result.locations != null) {
                            len = result.locations.length;
                        }

                        if (len > 0) {
                            for (var i = 0; i < len; i++) {
                                var id = result.locations[i].id;
                                var location = result.locations[i].location;
                                //console.log('id=', id, 'location=', location);
                                var option;
                                if (loadval_id > 0 && loadval_id == id) {
                                    //console.log('old-', loadval_id,'location-',location);
                                    option = "<option value='" + id + "' selected>" + location +
                                        "</option>";
                                } else
                                    option = "<option value='" + id + "'>" + location + "</option>";

                                $("#location_id").append(option);
                            }
                        }
                    } else {
                        // swal('Error',result.message,'error');
                        console.log('result', result)
                    }

                },
                error: function(xhr, desc, err) {

                    //swal('Error', err, 'error');
                }
            });
        } else {
            //clear content of Locations
        }
    }
</script>
