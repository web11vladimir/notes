@extends('layouts.app')

@section('content')

@include('messages')

@include('category')

<div class="d-flex justify-content-between mb-4">
	<a href="#" class="new-note btn btn-outline-primary">+ новая запись</a>

	@include('search-form')
</div>

<div class="notes-block card mb-4">
	@include('note_loop')
</div>

{{ $notes->appends(request()->except('page'))->links() }}

@include('modal')

@endsection