{% extends "base.html" %}

    {% block title %} 
        All Contacts
    {% endblock %}

{% block body %} 
    <h1>Contacts</h1>

    <ul>
        {% for contact in contacts %}
        <li>
            <h2>{{ contact.name }}</h2>
            <p>Phone: {{ contact.phone }}</p>
            <p>Address: {{ contact.address }}</p>
        </li>
        {% endfor %}
    </ul>
    
{% endblock %}