{% extends "layouts/main.volt" %}

{% block formcontent %}
    <div align="right">
        {{ link_to("product/NewProduct", "Create products") }}
    </div>

    <div align="center">
        <h1>Search products back</h1>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="id">Id</label>
        <div class="col-sm-10">
            {{ text_field("id", "type" : "numeric", "class" : "form-control") }}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="product_types_id">product_types_id</label>
        <div class="col-sm-10">
            {{ text_field("product_types_id", "type" : "numeric", "class" : "form-control") }}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">name</label>
        <div class="col-sm-10">
            {{ text_field("name", "size" : 30, "class" : "form-control") }}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="price">price</label>
        <div class="col-sm-10">
            {{ text_field("price", "type" : "numeric", "class" : "form-control") }}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="active">active</label>
        <div class="col-sm-10">
            {{ text_field("active", "class" : "form-control") }}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ submit_button("Search", "onclick": "__doPostBack('search','');return false;", "class" : "btn btn-default") }}
        </div>
    </div>

    {% if page %}
        <table class="table table-hover table-striped">
            <thead>
            <tr class="info">
                <th>Id</th>
                <th>Product Of Types</th>
                <th>Name</th>
                <th>Price</th>
                <th>Active</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            {% if page.items is defined %}
                {% for product in page.items %}
                    <tr>
                        <td>{{ product.getId() }}</td>
                        <td>{{ product.getProductTypesId() }}</td>
                        <td>{{ product.getName() }}</td>
                        <td>{{ product.getPrice() }}</td>
                        <td>{{ product.getActive() }}</td>
                        <td>{{ link_to("Product/NewProduct/"~product.getId(), "Edit") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
            </tbody>
            <tfoot>
            <tr>
                <th colspan="6">
                    <ul class="pager pull-right">
                        <li>{{ link_to(null, "First", "onclick":"javascript:__doPostBack('chngPage','1');return false;") }}</li>
                        <li>{{ link_to(null, "Previous", "onclick":"javascript:__doPostBack('chngPage','"~page.before~"');return false;") }}</li>
                        <li>{{ link_to(null, "Next", "onclick":"javascript:__doPostBack('chngPage','"~page.next~"');return false;") }}</li>
                        <li>{{ link_to(null, "Last", "onclick":"javascript:__doPostBack('chngPage','"~page.last~"');return false;") }}</li>
                        <li>
                            <div class="btn-group">
                                <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    {{ page.current~"/"~page.total_pages }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    {% for pageIndex in pageList %}
                                        <li>{{ link_to(null, pageIndex, "onclick" : "javascript:__doPostBack('chngPage','"~pageIndex~"');return false;") }}</li>
                                    {% endfor %}
                                </ul>
                            </div>
                        </li>
                    </ul>
                </th>
            </tr>
            </tfoot>
        </table>
    {% endif %}
{% endblock %}