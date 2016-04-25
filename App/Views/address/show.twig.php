{% extends "base.html" %}

    {% block title %} 
        Contact - {{ contact.name }}
    {% endblock %}

{% block body %} 
    <h1>{{ contact.name }}</h1>

    <ul>

        <li>
            <h2>{{ contact.name }}</h2>
            <p>Phone: {{ contact.phone }}</p>
            <p>Address: {{ contact.address }}</p>
        </li>
    </ul>
    
{% endblock %}
