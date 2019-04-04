
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.2.0/dist/css/suggestions.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.2.0/dist/js/jquery.suggestions.min.js"></script>
<style>
	label, label span {
		display: block;
	}
form {
    width: 25%;
    display: block;
    margin: 0 auto;
    text-align: center;
}
form input, form textarea {
    width: 100%;
    margin: 5px 0;
}
</style>
</head>
<body>
<form id="form_callback">
	<p id="message"></p>
	<label>
		<span>ФИО</span>
		<input id="fullname" type="text" name="fio" value="" required="" />
	</label>
	<label>
		<span>Адрес</span>
		<input id="address" type="text" name="adress" value="" />
	</label>
	<label>
		<span>Email</span>
		<input type="text" name="email" value="" />
	</label>
	<label>
		<span>Мобильный телефон</span>
		<input type="text" name="phone" value="" required="" />
	</label>
	<label>
		<span>Комментарий</span>
		<textarea name="comment"></textarea>
	</label>
	<label>
		<span>Файл</span>
		<input type="file" name="file" value="" />
	</label>
	<input type="submit" value="Отправить" />
</form>
<script>
$("#form_callback").submit(function(){
	$.ajax({
	    url: "ajax.php", 
	    type: "POST",             
	    data: new FormData(this),
	    contentType: false,       
	    cache: false,             
	    processData:false, 
	    success: function(data) {
	        $("#message").html(data);
	        $("#form_callback").find("input[type=text], input[type=file], textarea").val("");
	    }
	});
	return false;
});
    $("#fullname").suggestions({
        token: "39b3129ff8eae7b16914f9b6f3bb9684e3796dc9",
        type: "NAME",
        onSelect: function(suggestion) {
            console.log(suggestion);
        }
    });
    $("#address").suggestions({
        token: "39b3129ff8eae7b16914f9b6f3bb9684e3796dc9",
        type: "ADDRESS",
        onSelect: function(suggestion) {
            console.log(suggestion);
        }
    });
</script>
</body>
</html>