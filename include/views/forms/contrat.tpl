<form id="new-contrat" method="post" action="{{action}}">
    <fieldset class="general">
        <legend>{{legend}}</legend>
        <input id="name" class="textfield" type="text" value="{{labelContrat}}" />
        <select id="producteur_id" class="">
            <option value="O">{{labelProducteur}}</option>
            {{#producteurs}}<option value="{{id}}">{{name}}, {{surname}}</option>{{/producteurs}}
        </select>
        <!--input type="button" value="ajouter un nouvel producteur" name="contrat_newProducteur"/--><br/>
        <!--label for="nb_produits" class="clear">{{labelProd}}</label>
        <select id="contrat_nb_produits" name="contrat_nb_produits" >
            {{#nbProd}}<option>{{.}}</option>{{/nbProd}}
        </select-->
        <label for="debut" class="">Début</label>
        <input class="textfield datepick" type="text" id="debut" value="début" placeholder="début du contrat"/>
        <label for="fin" class="">Fin</label>
        <input class="textfield datepick" type="text" id="fin" value="fin" placeholder="fin du contrat"/>
    </fieldset>
    <input class="button button-validate" type="submit" id="createContract" value="{{submit}}"/>
</form>