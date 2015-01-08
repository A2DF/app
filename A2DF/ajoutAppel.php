<?php
include ('html/head.html');
?>
<html>
    <link href="css/formulaires.css" rel="stylesheet" type="text/css">
    <body>
        <h1>Ajout d'un appel</h1>
        <form action='ajoutAppel.php' method='POST' name='formAjoutAppel'>
            
            <div class="boxGauche">
            <fieldset>
            <legend>Informations</legend>
            <table border="1">
                <tr>
                    <td>Date de l'appel</td>
                    <td><input type='text' name='personnel' maxlength='50' value=''></td>
                </tr>
                <tr>
                    <td>Client</td>
                    <td><input type='text' name='personnel' maxlength='50' value=''></td>
                </tr>
                <tr>
                    <td>Numero</td>
                    <td><input type='text' name='personnel' maxlength='50' value=''></td>
                </tr>
                <tr>
                    <td>Personnel concerne</td>
                    <td><select>
                        <option value="">Francois</option>
                        <option value="">Manon</option>
                        <option value="">Damien</option>
                        <option value="">Kevin</option>
                    </select></td>
                </tr>
            </table>
            </fieldset>
            </div>
            
            <div class="boxDroite">
            <fieldset>
            <legend>Message</legend>
            <table border="1">
                <tr>
                    <td>Message</td>
                    <td><input type='text' name='personnel' maxlength='50' value=''></td>
                </tr>
                <tr>
                    <td>Priorite</td>
                    <td><select>
                        <option value="">Non prioritaire</option>
                        <option value="">Important (-72h)</option>
                        <option value="">Urgent (-24h)</option>
                    </select></td>
                </tr>
            </table>
            </fieldset>
            </div>
            
            <div class="boutons">
            <input type='reset' value='Annuler'>
            <input type='submit' value='Valider'>
            </div>
        </form>
    </body>
</html>