function UserInput() 
{
   //Recommendation System Selection / Input Boxes - Artist/Band Only

  //This will allow the user to enter a value into the input box by making it appear , if the user selects "Enter a word"
  //Within the blade file , where the data is then stored is handled.


    //Word1
    if(document.getElementById('word1').value == 'Enter a word') 
    {

      document.getElementById('word1input').style.display='block';
   
    }
    else
    {
      document.getElementById('word1input').style.display='none';
    }


    // Word2
    if(document.getElementById('word2').value == 'Enter a word') 
    {

      document.getElementById('word2input').style.display='block';
   
    }
    else
    {
      document.getElementById('word2input').style.display='none';
    }



    // Word3
    if(document.getElementById('word3').value == 'Enter a word') 
    {

      document.getElementById('word3input').style.display='block';
   
    }
    else
    {
      document.getElementById('word3input').style.display='none';
    }


    // Word4
    if(document.getElementById('word4').value == 'Enter a word') 
    {

      document.getElementById('word4input').style.display='block';

    }
    else
    {

       document.getElementById('word4input').style.display='none';

    }


    // Word5
    if(document.getElementById('word5').value == 'Enter a word') 
    {

      document.getElementById('word5input').style.display='block';
   
    }
    else
    {
      document.getElementById('word5input').style.display='none';
    }

};


 