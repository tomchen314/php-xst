{% extends "layouts/main.volt" %}

{% block formcontent %}

    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("product/productList", "&larr; Go Back") }}
        </li>
        <li class="pull-right">
            {# submit_button("Save", "class": "btn btn-success", "onclick":"__doPostBack('save', '');return false;") #}
        </li>
    </ul>

    <fieldset style="border:1px;">
        <div>
            {% for element in form %}
                {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
                    {{ element }}
                {% else %}
                    <div class="form-group">
                        {{ element.label(["class" : "control-label col-sm-2"]) }}
                        <div class="col-sm-10">
                            {{ element.render() }}
                        </div>
                    </div>
                {% endif %}
            {% endfor %}
        </div>
    </fieldset>

    {% endblock %}