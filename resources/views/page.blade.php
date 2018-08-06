@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @if( have_rows( 'sections' ) )
	    @include('partials.content-builder')
	  @else
	    @include('partials.page-header')
      @include('partials.content-page')
	  @endif
  @endwhile
@endsection
