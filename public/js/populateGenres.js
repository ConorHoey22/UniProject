
//Populate dropdowns with locally stored JSON file 
var List;
            jQuery.ajax({
                url: "/json/SpotifyGenres.json",
                type: "POST",
                dataType: "json",
                async: true,
                success: function (data) 
                {
                List = data.genres
                //populate genre dropdown
                    $('#genreList').append('<option value="">Select a genre</option>');
                            $.each(data.genres, function(key, genres){
                            $('#genreList').append('<option>' + genres + '</option>');
                    });
                //populate other genre dropdown
                    $('#advancedGenreList').append('<option value="">Select a genre</option>');
                            $.each(data.genres, function(key, genres){
                            $('#advancedGenreList').append('<option>' + genres + '</option>');
                    });
                }
            });
                    