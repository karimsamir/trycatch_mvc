{% extends "base.twig.html" %}

{% block title %} 
Contact - Add new contact
{% endblock %}

{% block body %} 
<h1>Add new contact</h1>
    
        {% include 'forms/contact.twig.php' 
     with {'action': '/contacts/store'} %}

{% endblock %}
