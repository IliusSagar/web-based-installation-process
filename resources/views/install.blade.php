<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laravel Installation</title>
	<style>
    	body { font-family: Arial, sans-serif; margin: 20px; }
    	.container { max-width: 600px; margin: 0 auto; }
    	.form-group { margin-bottom: 15px; }
    	.form-group label { display: block; font-weight: bold; }
    	.form-group input { width: 100%; padding: 10px; }
    	.alert { padding: 10px; margin-bottom: 15px; color: #fff; }
    	.alert-success { background-color: #4caf50; }
    	.alert-error { background-color: #f44336; }
	</style>
</head>
<body>
	<div class="container">
    	<h1>Laravel Installation</h1>

    	@if(session('success'))
        	<div class="alert alert-success">{{ session('success') }}</div>
    	@endif

    	@if(session('error'))
        	<div class="alert alert-error">{{ session('error') }}</div>
    	@endif

    	<form action="{{ route('install.run') }}" method="POST">
        	@csrf
        	<div class="form-group">
            	<label for="db_host">Database Host</label>
            	<input type="text" id="db_host" name="db_host" value="{{ old('db_host', '127.0.0.1') }}" required>
        	</div>
        	<div class="form-group">
            	<label for="db_port">Database Port</label>
            	<input type="text" id="db_port" name="db_port" value="{{ old('db_port', '3306') }}" required>
        	</div>
        	<div class="form-group">
            	<label for="db_database">Database Name</label>
            	<input type="text" id="db_database" name="db_database" value="{{ old('db_database') }}" required>
        	</div>
        	<div class="form-group">
            	<label for="db_username">Database Username</label>
            	<input type="text" id="db_username" name="db_username" value="{{ old('db_username') }}" required>
        	</div>
        	<div class="form-group">
            	<label for="db_password">Database Password</label>
            	<input type="password" id="db_password" name="db_password">
        	</div>
        	<button type="submit">Run Installation</button>
    	</form>
	</div>
</body>
</html>
