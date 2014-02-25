<table class="tablesorter" id="mainListe">
    <colgroup>
        <col style="width: auto"/>
        <col style="width: auto"/>
        <col style="width: auto"/>
        <col style="width: auto"/>
        <col style="width: auto"/>
        <col style="width: auto"/>
        <col style="width: auto"/>
        <col style="width: auto"/>
        <col style="width: auto"/>
    <colgroup>
    <thead>
        <tr>
            <th class="header">Amapien</th>
            <th class="header">addresse</th>
            <th class="header">Téléphone</th>
            <th class="header">Arrivée</th>
            <th class="header">À jour</th>
            <th class="header">Email</th>
            <th class="header">Email 2</th>
            <th class="header">Email 3</th>
            <th class="header">+ d'infos</th>
            <th class="header">Contrats</th>
            <th class="header">Actions</th>
        </tr>
    </thead>
    <tbody>
        {{#list}}
        <tr amapien-id="{{id}}">
            <td class="">{{name}}, {{surname}}</td>
            <td class="">{{address}} {{zipcode}} {{city}}</td>
            <td class="">{{phone}}</td>
            <td class="">{{arrived}}</td>
            <td class="">{{updated}}</td>
            <td class="">{{email1}}</td>
            <td class="">{{email2}}</td>
            <td class="">{{email3}}</td>
            <td class="">{{infos}}</td>
            <td class="">
                {{#contratsAmapien}}<span class="{{contratId}}">{{contratName}}</span>{{/contratsAmapien}}
            </td>
            <td class="actions">
                <a class="modiAct" href="core.php?amapien=edit&for={{id}}">Modifier</a>
                <a class="editAct" href="core.php?amapien=copy&for={{id}}">Dupliquer</a>
                <a class="deleAct" href="core.php?amapien=delete&for={{id}}">Supprimer</a>
            </td>
        </tr>
        {{/list}}
    </tbody>
</table>
