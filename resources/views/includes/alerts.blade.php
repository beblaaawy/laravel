<?php
$errors = session()->get('errors');
$error = session()->get('error');
$success = session()->get('success');
?>
@if (!empty($error))
	<div class="alert alert-danger">{{ $error }}</div>
@endif
@if (!empty($success))
	<div class="alert alert-success">{{ $success }}</div>
@endif
@if (!empty($errors))
<div class="alert alert-danger">
	@foreach ($errors as $name => $error)
		@foreach ($error as $text)
			<div>{{ $text }}</div>
		@endforeach
	@endforeach
</div>
@endif