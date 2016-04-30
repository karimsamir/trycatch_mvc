{% extends "base.twig.html" %}

{% block title %} 
All Contacts
{% endblock %}

{% block scripts %} 
    <script src="/js/contacts.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            ajaxGetAllContacts();
        });
    </script>
{% endblock %}

{% block body %} 
<div class="col-md-9">
<h1>Contacts</h1>

<a href="/contacts/create">Add new contact</a>

<table id="tblContacts" class="table table-striped table-bordered table-hover ">
    <thead><th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th></th>
    </thead>
    <tbody>
        
    </tbody>
<!--    {% for contact in contacts %}
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
            <a href="/contacts/delete/{{contact.id}}">
            <button class="btn btn-xs btn-danger">
                Delete
            </button>
        </td>
    </tr>
    {% endfor %}-->
</table>
</div>

{% endblock %}
