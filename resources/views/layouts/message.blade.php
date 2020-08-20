
@if($message = Session::pull('ok_message'))
    <div class="alert alert-success alert-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-check fa-lg"></i> {{ $message }}
    </div>
@endif
@if($message = Session::pull('info_message'))
    <div class="alert alert-warning alert-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-info" aria-hidden="true"></i> {{ $message }}
    </div>
@endif
@if($message = Session::pull('error_message'))
    <div class="alert alert-danger alert-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $message }}
    </div>
@endif
@if ($errors->has('search'))
    <div class="alert alert-danger alert-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $errors->first('search') }}
    </div>
@endif
