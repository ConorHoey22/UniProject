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

                    $('#recommendationAgeRange').append('<option value="">Please select an age range value</option>');
                        $.each(data.values, function(key, values){
                        $('#recommendationAgeRange').append('<option>' + values+ '</option>'); });

                  
        }
});