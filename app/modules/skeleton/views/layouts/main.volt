
<div class="container">

{{ form(null, "name":"phpform", "method":"post", "autocomplete" : "off", "class" : "form-horizontal", "role" : "form") }}

<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />

<script type="text/javascript">
    //<![CDATA[
    var theForm = document.forms['phpform'];
    if (!theForm) {
        theForm = document.phpform;
    }
    function __doPostBack(eventTarget, eventArgument) {
        if (!theForm.onsubmit || (theForm.onsubmit() !== false)) {
            theForm.__EVENTTARGET.value = eventTarget;
            theForm.__EVENTARGUMENT.value = eventArgument;
            theForm.submit();
        }
    }
    //]]>
</script>

{% block formcontent %}
{% endblock %}

</form>

</div>