@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <?php $user = Auth::user() ?>
                <div class="col-sm-3">
                    @include('product::myaccounts.nav')
                </div>
                <div class="col-sm-9">
                    @include('partials.messages')
                    <div class="row">
                    @foreach( $address as $add )
                        <div class="col-sm-6">
                            <div class="card border mb-3">
                                <div class="card-body">
                                    <p class="float-right">
                                        <a href="{{ route('user.address_book_detail', $add->id) }}"><i class="fa fa-edit"></i> </a>
                                        <a onclick="confirm('Are you sure?')" href="{{ route('user.address_book_delete', $add->id) }}"><i class="fa fa-trash"></i> </a>
                                    </p>
                                    <i class="fa fa-map-marker text-grey"></i> <strong>{{ $add->address }}</strong> <br>
                                    <i class="fa fa-user text-grey"></i> {{ $add->full_name }} <br>
                                    <i class="fa fa-phone text-grey"></i> {{ $add->phone }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop