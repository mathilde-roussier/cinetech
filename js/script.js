$(document).ready(function(){


  //Fonction pour mettre une majuscule au début de a chaîne de caractères
  function strUcFirst(a){
    return (a+'').charAt(0).toUpperCase()+a.substr(1);
  }

  //AUTOCOMPLETION BARRE RECHERCHE//
  
    //Lorsqu'une touche est pressée dans la barre de recherche
    $("#search").keydown(function(){

      $.get(
        //Page vers laquelle est envoyée la requête
        'autocomplete.php',
        {
          //Récupération des inputs du formulaires
          search : encodeURI($("#search").val()),
        },
  
        function(data){
          console.log(encodeURI($("#search").val()));
          var results = JSON.parse(data);

          //var results=results.results;
          search=strUcFirst($("#search").val());
          var propositions=[];
          
          results.forEach(result => {
            if((result.title).startsWith(search)==true)
            {
              var key=results.indexOf(result);
              propositions[key] = result.title;
            }
          });

          //Si la barre de recherche est vide
          if($("#search").val()==="")
          { 
            propositions=[];
            $('#liste').html("");
            return;
          } 
          else
          { 
            //On vide la liste des propositions précédentes
            $('#liste').html("");

            //On initialise le compteur
            i=1;

            //On parcourt toutes les propositions
            propositions.forEach(function(item)
            {
              //On limite le nombre de propositions à 5
              if(i<=5)
              {
                //On créé un nouvel élément <option>
                var option = document.createElement('option');
                option.value = item;

                //On ajoute l'option à la liste des propositions
                liste.appendChild(option);
                i++;
              }
            });
          }
      });
  });
});




