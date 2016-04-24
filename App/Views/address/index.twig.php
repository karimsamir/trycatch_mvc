{% extends "base.html" %}

    {% block title %} 
        Posts
    {% endblock %}

{% block body %} 
    <h1>Contacts</h1>

    <ul>
        {% for contact in contacts %}
        <li>
            <h2>{{ contact.name }}</h2>
            <p>{{ contact.phone }}</p>
            <p>{{ contact.address }}</p>
        </li>
        {% endfor %}
    </ul>
    
{% endblock %}
