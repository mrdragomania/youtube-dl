<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Get me</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<form class="mt-4" id="main-form" action="url-handle.php" method="POST">
					<div class="form-group">
						<textarea class="form-control" id="textarea" name="textarea_field" id="" cols="60" rows="15" required="" placeholder="Seperate URLs with a new row"></textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-primary w-100" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>

		$("#main-form").submit(function(form) {
			form.preventDefault();

			let textarea = $("#textarea");
			let urls = [];

			urls = (textarea.prop('value')).split("\n");
			for (var i = urls.length - 1; i >= 0; i--) {
				
			}
			throw new Error;
			$.ajax({
		        type: $(form.target).attr('method'),
		        url: $(form.target).attr('action'),
		        data: {data: $(form.target).serialize()}
		    }).done(function(data) {
		        console.log(data);
		    }).fail(function(data) {
		        console.log(data);
		    }).always(function(data) {

		    });
		});
	</script>
</body>
</html>