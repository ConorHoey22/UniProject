var List;
            jQuery.ajax({
                url: "/json/ageRanges.json",
                type: "POST",
                dataType: "json",
                async: true,
                success: function (data) {
                List = data.values
                
                    $('#ageRange').append('<option value="">Please select an age range value</option>');
                        $.each(data.values, function(key, values){
                        $('#ageRange').append('<option>' + values+ '</option>'); });

                    $('#recommendationAge').append('<option value="">Please select an age range value</option>');
                        $.each(data.values, function(key, values){
                        $('#recommendationAge').append('<option>' + values+ '</option>'); });

                  
        }
});