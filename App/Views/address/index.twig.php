{% extends "base.html" %}

{% block title %} 
All Contacts
{% endblock %}

{% block body %} 
<h1>Contacts</h1>


<table class="table table-striped table-bordered">
    <tr><th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th></th>
    </tr>
    {% for contact in contacts %}
    <tr>
        <td>{{contact.name}}</td>
        <td>{{contact.phone}}</td>
        <td>{{contact.address}}</td>
        <td>
            <button class="btn btn-xs btn-primary">
                Edit
            </button>
            <button class="btn btn-xs btn-danger">
                Delete
            </button>
        </td>
    </tr>
    {% endfor %}
</table>

<!--<ul>
    {% for contact in contacts %}
    <li>
        <h2>{{ contact.name }}</h2>
        <p>Phone: {{ contact.phone }}</p>
        <p>Address: {{ contact.address }}</p>
    </li>
    {% endfor %}
</ul>-->

{% endblock %}
