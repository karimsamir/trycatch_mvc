{% extends "base.twig.html" %}

{% block title %} 
All Contacts
{% endblock %}

{% block body %} 
<h1>Contacts</h1>


<table class="table table-striped table-bordered table-hover">
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
            <a href="/contacts/{{contact.id}}/edit">
                <button class="btn btn-xs btn-primary">
                    Edit
                </button>
            </a>
            <button class="btn btn-xs btn-danger">
                Delete
            </button>
        </td>
    </tr>
    {% endfor %}
</table>


{% endblock %}
