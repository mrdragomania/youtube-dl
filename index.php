<?php session_start(); ?>
<?php $_SESSION['files'] = array(); ?>
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
						<label for="">Auto-download upon conversion?</label>
						<input type="checkbox" id="autoDownload" name="autoDownload" checked="">
					</div>
					<div class="form-group">
						<button class="btn btn-primary w-100" type="submit">Submit</button>
					</div>
				</form>
				<div class="col-md-12 mt-4" id="converted-files-container"></div>
				<div class="col-md-12 mt-4">
					<button type="button" class="btn btn-success w-100" id="downloadAllButton">Download All</button>
				</div>
			</div>
		</div>
	</div>
	<script>

		$("#downloadAllButton").on('click', () => {
			window.location = 'download.php?type=all';
		})

		$("#main-form").submit(function(form) {
			form.preventDefault();

			let textarea = $("#textarea");
			let urls = [];

			urls = (textarea.prop('value')).split("\n");

			let counter = 0;
			let btnCounter = 0;

			ajaxRequest();

			function ajaxRequest(e = null) {
				e = urls[counter];
				if(e === null) {
					throw new Error('Invalid parameter given to ajaxRequest().');
				}
				++counter;
				$.ajax({
			        type: $(form.target).attr('method'),
			        url: $(form.target).attr('action'),
			        data: {url: e}
			    }).done(function(data) {
			    	console.log(data);
			    	
			    	data = JSON.parse(data);
			    	if(data['header']['status_code'] === 200) {
			    		element = $('#converted-files-container');
			    		let appendDiv = '<a id="file-' + btnCounter + '" style="display: none;" href="./download.php?type=single&filename=' + data['payload']['stream']['filename'] + '"><div class="btn btn-primary w-100 no-radius mt-2">' + data['payload']['stream']['filename'] + '</div></a>';
			    		element.append(appendDiv);
			    		button = $('#file-' + btnCounter);
			    		button.fadeIn("slow");
			    		++btnCounter;
			    	}
			    	if(counter < urls.length) {
			    		ajaxRequest();
			    	}
			    }).fail(function(data) {
			        // console.log(JSON.parse(data));
			    }).always(function(data) {
			    	console.log(data);
			    	// console.log(data);
			    	
			    });
			}
		});	
	</script>
</body>
</html>