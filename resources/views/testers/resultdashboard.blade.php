@extends ('menubar.admin')

@section ('title','Dashboard')

@section ('headerTitle','Result Dashboard')

@section ('tabname','Result')

@section ('pagename','Result Dashboard')

@section ('content')

<section class="content">
	@foreach($servgroup as $sg)
		<a class="btn btn-lg btn-default" href="/result_trans?id={{ $sg->servgroup_id }}">{{ $sg->servgroup_name }}</a>
		@endforeach
</section>
@endsection
