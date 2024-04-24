<script>
    jQuery(document).ready(function($) {
        //report_year|report_year|branch_id

        $("#report_year").on('change', function() {
            var report_year = $(this).val();
            console.log('report year onchange', report_year);

            $report_month = $("#report_month").val();
            $branch_id = $("#branch_id").val();
            loadLocations(report_year, $report_month, $branch_id);
        });

        $("#report_month").on('change', function() {
            var report_month = $(this).val();
            console.log('report month onchange', report_month);

            // $report_year = $("#report_year").find(":selected").text();
            $report_year = $("#report_year").val();
            $branch_id = $("#branch_id").val();
            loadLocations(report_year, $report_month, $branch_id);
        });

        $("#branch_id").on('change', function() {
            var branch_id = $(this).val();
            console.log('branch  onchange', report_year);

            $report_year = $("#report_year").val();
            $report_month = $("#report_month").val();
            loadLocations(report_year, $report_month, $branch_id);
        });
    });

    function loadLocations(year, month, branch) {
        console.log('year', year,'---month', month,'---branch', branch);
        // $('#zone_id').find('option').not(':first').remove();
        // if (division_id) {
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         type: 'POST',
        //         url: '/ajax/zone-by-divid',
        //         data: {
        //             division_id: '' + division_id + ''
        //         },
        //         success: function(result, status) {
        //             //console.log('result-',result.zones);
        //             //console.log('status-',status);

        //             if (result.status === true) {
        //                 var len = 0;
        //                 if (result.zones != null) {
        //                     len = result.zones.length;
        //                 }
        //                 if (len > 0) {
        //                     for (var i = 0; i < len; i++) {
        //                         var id = result.zones[i].id;
        //                         var zone = result.zones[i].zone_name;

        //                         var option;
        //                         if (loadval_id.length > 0 && loadval_id == id) {
        //                             console.log('old-', loadval_id, 'zone-', location);
        //                             option = "<option value='" + id + "' selected>" + zone +
        //                                 "</option>";
        //                         } else
        //                             option = "<option value='" + id + "'>" + zone + "</option>";
        //                         $("#zone_id").append(option);
        //                     }
        //                 }
        //             } else {
        //                 // swal('Error',result.message,'error');
        //                 console.log('result', result)
        //             }

        //         },
        //         error: function(xhr, desc, err) {
        //             //swal('Error', err, 'error');
        //         }
        //     });
        // } else {
        //     //clear content of Locations
        // }
    }
</script>
