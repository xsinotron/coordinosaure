<nav><ul class="mainMenu clearfix">
    {{#nav}}
    <li><a class="button {{selected}}" href="{{link}}" title="{{title}}">{{text}}</a></li>
    {{/nav}}
    {{#actions}}
    <li><a class="button {{class}}" href="{{action}}" id="{{id}}" title="{{title}}">{{text}}</a></li>
    {{/actions}}
</ul></nav>