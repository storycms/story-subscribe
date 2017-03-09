<form id="form" method="POST" action="/subscribe">
	{{ csrf_field() }}
	<input type="text" name="email" placeholder="Enter your email">
	<button type="submit" name="submit">Submit</button>
</form>
@if (session()->has('message'))
    <div class="alert alert-failed">
        {{ session()->get('message') }}
    </div>
@else
	<div class="alert alert-success">
        {{ session()->get('info') }}
    </div>
@endif