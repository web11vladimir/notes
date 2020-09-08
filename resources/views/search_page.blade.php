@extends('layouts.app')

@section('content')

@include('messages')

@include('search-form')

@if($notes->isEmpty())
	<h3 class="mb-4 mt-4">Нет результатов поиска</h3>
@else
	<h3 class="mb-4 mt-4">Результаты поиска: {{ $query }}</h3>

	<div class="notes-block card mb-4">
		@include('note_loop')
	</div>

	{{ $notes->appends(request()->except('page'))->links() }}

	@include('modal')
@endif

@endsection

@push('scripts')
	
@endpush