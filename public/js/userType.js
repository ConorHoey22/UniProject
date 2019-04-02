
   //Registration form 
   $("#country").hide();



$(document).ready(function(){
    $('#userType').on('change', function() {
      if ( this.value == 'Artist')
  
      {
        $("#ArtistBandRegForm").show();
        $("#BandRegForm").hide();
        $("#ListenerRegForm").hide();
        $("BandOnly").hide();

    

      }
      else if (this.value == "Band")
      {
        $("#ArtistBandRegForm").show();
        $("BandOnly").show();
        $("#ListenerRegForm").hide();

           
      }
      else if(this.value == "Listener")
      {
        $("#ArtistBandRegForm").hide();
        $("#ListenerRegForm").show();
        $("BandOnly").hide();
       


      }

      else {
        $("#ArtistBandRegForm").hide();
        $("BandOnly").hide();
        $("#ListenerRegForm").hide();
      }
    });
});


