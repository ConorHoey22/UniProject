function UserInput1() 
{
  //Recommendation System Selection / Input Boxes

  //This will allow the user to enter a value into the input box by making it appear , if the user selects "Enter a word"
  //Within the blade file , where the data is then stored is handled.

    //Recommendation Word1
    if(document.getElementById('recommendationWord1').value == 'Enter a word') 
    {

      document.getElementById('recommendationWord1input').style.display='block';
   
    }
    else
    {
      document.getElementById('recommendationWord1input').style.display='none';
    }


    // Recommendation Word2
    if(document.getElementById('recommendationWord2').value == 'Enter a word') 
    {

      document.getElementById('recommendationWord2input').style.display='block';
   
    }
    else
    {
      document.getElementById('recommendationWord2input').style.display='none';
    }



    // Recommendation Word3
    if(document.getElementById('recommendationWord3').value == 'Enter a word') 
    {

      document.getElementById('recommendationWord3input').style.display='block';
   
    }
    else
    {
      document.getElementById('recommendationWord3input').style.display='none';
    }


    // Recommendation Word4
    if(document.getElementById('recommendationWord4').value == 'Enter a word') 
    {

      document.getElementById('recommendationWord4input').style.display='block';

    }
    else
    {

       document.getElementById('recommendationWord4input').style.display='none';

    }


    // Recommendation Word5
    if(document.getElementById('recommendationWord5').value == 'Enter a word') 
    {

      document.getElementById('recommendationWord5input').style.display='block';
   
    }
    else
    {
      document.getElementById('recommendationWord5input').style.display='none';
    }

};


 