<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
<link href="css/client.css" rel="stylesheet" type="text/css">
<form method="post" action="traitement.php">
    <fieldset>
        <legend>Coordonnées</legend>
   <p>
       <label for="nom">Nom :</label>
       <input type="text" name="nom" id="nom" />
       <br />
       <label for="prenom">Prénom :</label>
       <input type="text" name="prenom" id="prenom" />
       <br />
       <label for="adresse">Adresse :</label>
       <textarea name="adresse" rows="5" id="adresse"></textarea>
       <br />
       <label for="cp">Code postal :</label>
       <input type="text" name="cp" id="cp" />
       <br />
       <label for="cp">Ville :</label>
       <input type="text" name="ville" id="ville" />
       <br />
       <label for="cp">Courriel :</label>
       <input type="email" name="email">
       <br />
       <label for="cp">Téléphone fixe :</label>
       <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
       <br />
       <label for="cp">Téléphone portable :</label>
       <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
    </fieldset>
    <input type="submit" name="envoi" value="Envoyer">
    <input type='reset' value='Annuler'>
   </p>
</form>