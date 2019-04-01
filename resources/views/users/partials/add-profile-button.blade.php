<a href="#" id="add-profile-button" class="btn btn-primary pull-right" onclick="f_add()")>Adicionar ></a>
<script>
    function f_add(){
        //noinspection JSJQueryEfficiency
        $("#assigned-roles").append('<option value='+$("#all-roles").children("option:selected").val()+'>'+$("#all-roles").children("option:selected").text()+'</option>');
    }
</script>
