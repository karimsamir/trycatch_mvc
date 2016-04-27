{% extends "base.twig.html" %}

{% block title %} 
All Contacts
{% endblock %}

{% block body %} 
<div class="col-md-9">
<h1>Contacts</h1>

<a href="/contacts/create">Add new contact</a>

<table class="table table-striped table-bordered table-hover ">
    <thead><th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th></th>
    </thead>
    {% for contact in contacts %}
    <tr>
        <td>
            <a href="/contacts/{{contact.id}}"> 
                {{contact.name}}
            </a>
        </td>
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
</div>

{% endblock %}
