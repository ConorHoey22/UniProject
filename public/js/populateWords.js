//Populate dropdowns with locally stored JSON file 
var List;
            jQuery.ajax({
                url: "/json/words.json",
                type: "POST",
                dataType: "json",
                async: true,
                success: function (data) 
                {
                List = data.words
                //populate words dropdown
                    $('#word1').append('<option value="">Select a word</option>');
                            $.each(data.words, function(key, words){
                            $('#word1').append('<option>' + words + '</option>');
                    });

                //populate words dropdown
                    $('#word2').append('<option value="">Select a word</option>');
                            $.each(data.words, function(key, words){
                            $('#word2').append('<option>' + words + '</option>');
                    });


                    //populate words dropdown
                    $('#word3').append('<option value="">Select a word</option>');
                            $.each(data.words, function(key, words){
                            $('#word3').append('<option>' + words + '</option>');
                    });

                //populate words dropdown
                    $('#word4').append('<option value="">Select a word</option>');
                            $.each(data.words, function(key, words){
                            $('#word4').append('<option>' + words + '</option>');
                    });

                //populate words dropdown
                     $('#word5').append('<option value="">Select a word</option>');
                            $.each(data.words, function(key, words){
                            $('#word5').append('<option>' + words + '</option>');
                     });

//Recommendation

        //populate words dropdown
           $('#recommendationWord1').append('<option value="">Select a word</option>');
                $.each(data.words, function(key, words){
                $('#recommendationWord1').append('<option>' + words + '</option>');
           });


       //populate words dropdown
           $('#recommendationWord2').append('<option value="">Select a word</option>');
                   $.each(data.words, function(key, words){
                   $('#recommendationWord2').append('<option>' + words + '</option>');
           });


           //populate words dropdown
           $('#recommendationWord3').append('<option value="">Select a word</option>');
                   $.each(data.words, function(key, words){
                   $('#recommendationWord3').append('<option>' + words + '</option>');
           });

       //populate words dropdown
           $('#recommendationWord4').append('<option value="">Select a word</option>');
                   $.each(data.words, function(key, words){
                   $('#recommendationWord4').append('<option>' + words + '</option>');
           });

       //populate words dropdown
            $('#recommendationWord5').append('<option value="">Select a word</option>');
                   $.each(data.words, function(key, words){
                   $('#recommendationWord5').append('<option>' + words + '</option>');
            });


        }
    });
                    