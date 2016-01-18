
<html>
    <head>
        <title>autocomplete</title>

        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
        <script src="js/jquery.ui.autocomplete.html.js"></script>

    <script>
$(document).ready(function(){
    $('#customerAutocomplete').autocomplete({
	source:'itemnameautocomplete.php', 
	minLength:1
    });
});
        </script>
        </head>
    <body>
        <br />
<form action="" method="post">
    <input type="text" placeholder="Name" id="customerAutocomplete" class="ui-autocomplete-input" autocomplete="off"/>
</form>
        </body>
    </html>