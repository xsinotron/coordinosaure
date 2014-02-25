<h3>{{title}}</h3>
<form method="POST" action="{{action}}">
    <fieldset>
        <legend>{{coord}}</legend>
        <input id="name"         {{disabled}} class="textfield" type="text" value="{{name}}" placeholder="{{name}}"/>
        <input id="surname"      {{disabled}} class="textfield" type="text" value="{{surname}}" placeholder="{{surname}}"/>
        <input id="email1"       {{disabled}} class="emailValue textfield before"  type="text" value="{{email1}}" placeholder="{{email}}"/>
        <input id="email2"       {{disabled}} class="emailValue textfield before hidden"  type="text" value="{{email2}}" placeholder="{{email}}"/>
        <input id="email3"       {{disabled}} class="emailValue textfield before hidden"  type="text" value="{{email3}}" placeholder="{{email}}"/>
        <a id="addEmail-amapien" {{disabled}} class="button" title="{{addTitle}}">{{add}}</a>
        <input id="address"      {{disabled}} class="textfield clear" type="text" placeholder="{{address}}" value="{{address}}"/>
        <input id="zipcode"      {{disabled}} class="textfield"       type="text" placeholder="{{zipcode}}" value="{{zipcode}}"/>
        <input id="city"         {{disabled}} class="textfield"       type="text" placeholder="{{city}}" value="{{city}}"/>
        <input id="phone"        {{disabled}} class="textfield"       type="text" placeholder="{{phone}}" value="{{phone}}" />
        <input id="arrived"      {{disabled}} class="textfield datepick" type="text" placeholder="{{arrived}}" value="{{arrived}}" />
    </fieldset>
    <fieldset class="clear">
        <legend>{{infos}}</legend>
        <textarea id="infos" rows="6" cols="40">{{infosContent}}</textarea>
        <label for="updated" class="clear">{{update}}</label>
        <input  id="updated" class="checkbox" type="checkbox" checked="checked" />
        <label for="active" class="clear">{{active}}</label>
        <input  id="active" class="checkbox" type="checkbox" checked="checked" />
    </fieldset>
    <input class="button button-validate" type="submit" id="createAmapien" title="{{submitTitle}}" value="{{submit}}" />
</form>