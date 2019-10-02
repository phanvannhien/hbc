@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="container">

            <div class="row">
                <div class="col-sm-3">
                    @include('partials.sidebar')
                </div>
                <div class="col-sm-9">

                    <h2>{{ $page->get_trans()->title }}</h2>
                    <div class="page-single">
                        {!! $page->get_trans()->content !!}
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
