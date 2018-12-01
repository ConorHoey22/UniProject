var List;
            jQuery.ajax({
                url: "/json/searchValues.json",
                type: "POST",
                dataType: "json",
                async: true,
                success: function (data) {
                List = data.values
                
                    $('#instrumentalnessMin').append('<option value="">Select the minimum instrumentalness value</option>');
                        $.each(data.values, function(key, values){
                        $('#instrumentalnessMin').append('<option>' + values+ '</option>'); });

                    $('#instrumentalnessMax').append('<option value="">Select the maximum instrumentalness value </option>');
                        $.each(data.values, function(key, values){
                        $('#instrumentalnessMax').append('<option>' + values + '</option>'); });

                    $('#livenessMin').append('<option value="">Select the minimum liveness value </option>');
                        $.each(data.values, function(key, values){
                        $('#livenessMin').append('<option>' + values + '</option>'); });

                    $('#livenessMax').append('<option value="">Select the maximum liveness value </option>');
                        $.each(data.values, function(key, values){
                        $('#livenessMax').append('<option>' + values + '</option>');
            });
        }
});
                    






