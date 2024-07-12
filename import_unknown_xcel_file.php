<!-- Main row -->
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<div class="row">
			
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="alert alert-info">Read and follow instructions carefully before proceed.</div>
				<div class="box box-primary">
					<div class="box-header with-border">
						
						
						
					</div><!-- /.box-header -->
					<!-- form start -->
					<form method="post" id="add_form" action="operation.php" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<label for="">Type</label>
								<select name="type" id="type" class="form-control">
									<option value="">Select</option>
									<option selected value="products">Products</option>
									
								</select>
							</div>
							<div class="form-group">
								<label for="">CSV File</label>
								<input type="file" name="upload_file" class="form-control" accept=".csv" required />
							</div>
							
							
						</div><!-- /.box-body -->
						
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" id="submit_btn" name="btnAdd">Upload</button>
							<input type="reset" class="btn-warning btn" value="Clear" />
							
						</div>
					</form>
				</div><!-- /.box -->
			</div>
			
		</div>
		
	</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	$('#add_form').on('submit', function(e) {
	e.preventDefault();
	var formData = new FormData(this);
	if (confirm('Are you sure?Want to upload')) 
	{
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: formData,
			beforeSend: function() {
				$('#submit_btn').html('Please wait..').attr('disabled', 'true');
			},
			cache: false,
			contentType: false,
			processData: false,
			success: function(result) {
				$('#submit_btn').html('Upload').removeAttr('disabled');
				$('#add_form')[0].reset();
			}
		});
	}
	
});
</script> 