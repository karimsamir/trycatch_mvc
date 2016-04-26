{% extends "base.twig.html" %}

    {% block title %} 
        Contact - {{ contact.name }}
    {% endblock %}

{% block body %} 
    <h1>Edit {{ contact.name }}</h1>

<form>
  <div class="form-group">
    <label for="name">Contact name</label>
    <input type="text" class="form-control" id="name" name="name" 
           placeholder="Contact name" value="{{ contact.name }}">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone" 
           placeholder="Contact phone" value="{{ contact.phone }}">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" id="address" name="address"
           placeholder="Contact address" value="{{ contact.address }}">
  </div>

  <button type="submit" class="btn btn-default">Save</button>
</form>
    
{% endblock %}
