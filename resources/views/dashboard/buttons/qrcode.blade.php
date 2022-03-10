@if((auth()->user()->hotel_id != null && auth()->user()->hotel->auth_code == null) || auth()->user()->hotel_id == null)
    <a href="#" class="btn btn-primary btn-inline btn-sm " data-toggle="modal" data-target="#qrcode{{ $row->id }}">
        <i class="fa fa-qrcode"></i>
    </a>
@else
    <a href="#" class="btn btn-primary btn-inline btn-sm " data-toggle="modal" data-target="#qrcode{{ $row['RoomID'] }}">
        <i class="fa fa-qrcode"></i>
    </a>
@endif
