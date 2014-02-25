<form id="new-contrat" method="post" action="{{action}}">
    <fieldset class="general">
        <legend>{{legend}}</legend>
        <input id="name" class="textfield" type="text" value="{{labelProduit}}" />
        <select id="contrat_id" class="">
            <option value="-1">{{labelContrat}}</option>
            {{#contrats}}<option value="{{id}}">{{name}}</option>{{/contrats}}
        </select>
        <label for="prix_unitaire" class="">{{labelPrix}}</label>
        <input class="textfield" type="text" id="prix_unitaire" value="" placeholder="{{valuePrix}}"/>
    </fieldset>
    <input class="button button-validate" type="submit" id="createContract" value="{{submit}}"/>
</form>