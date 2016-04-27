{% extends "base.twig.html" %}

{% block title %} 
Contact - {{ contact.name }}
{% endblock %}

{% block body %} 
<h1>Edit {{ contact.name }}</h1>

    {% include 'forms/contact.twig.php' 
     with {'contact': contact, 'action': '/contacts/update'} %}

{% endblock %}
