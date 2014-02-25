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
            <th class="header">address</th>
            <th class="header">Téléphone</th>
            <th class="header">Date d'arrivée</th>
            <th class="header">Contrats en cours</th>
            <th class="header">À jour</th>
            <th class="header">Email</th>
            <th class="header">Email alt</th>
            <th class="header">Email alt 2</th>
            <th class="header">Plus d'infos</th>
            <th class="header">Actions</th>
        </tr>
    </thead>
    <tbody>
        {{#entries}}
        <tr>
            <td class="header">{{name}}, {{surname}}</td>
            <td class="header">{{address}} {{zipcode}} {{city}}</td>
            <td class="header">{{phone}}</td>
            <td class="header">{{arrived}}</td>
            <td class="header">{{address}}</td>
            <td class="header">{{updated}}</td>
            <td class="header">{{email1}}</td>
            <td class="header">{{email2}}</td>
            <td class="header">{{email3}}</td>
            <td class="header">{{infos}}</td>
            <td class="header">
                <a href="core.php?edit=amapien">Modifier</a>
                <a href="core.php?copy=amapien">Dupliquer</a>
                <a href="core.php?dele=amapien">Supprimer</a>
            </td>
        </tr>
        {{/entries}}
    </tbody>
</table>
