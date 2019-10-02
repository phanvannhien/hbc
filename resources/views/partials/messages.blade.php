@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <ul style="">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        @if(  is_array( session('status') ))
            <ul style="">
                @foreach (session('status') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @else
            {!! session('status') !!}
        @endif
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        @if(  is_array( session('warning') ))
            <ul style="">
                @foreach (session('warning') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @else
            {!!  session('warning') !!}
        @endif


    </div>
@endif