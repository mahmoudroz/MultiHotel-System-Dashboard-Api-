{{ csrf_field() }}

<div class="col-md-4">
    <div class="form-group">
        <label for="exampleFormControlSelect1">@lang('site.name')</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name"   value="{{ isset($row) ? $row->name : old('name') }}">
        @error('name')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>

        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="exampleFormControlSelect1">@lang('site.phone')</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror"  name="phone"   value="{{ isset($row) ? $row->phone : old('phone') }}">
        @error('phone')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>@lang('site.password')</label>
        <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" value="">
        @error('password')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>@lang('site.password_confirmation')</label>
        <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror"
            name="password_confirmation" value="">
        @error('password_confirmation')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label>@lang('site.identity_type_id')</label>
        <select name="identity_type_id"  class='form-control'>
            <option value="">@lang('site.choose_identity_type_id')</option>
            @foreach($identitytypes as $ident)
                <option value="{{$ident->id}}" @if(isset($row) && $row->identity_type_id==$ident->id || old('identity_type_id') == $ident->id ) selected  @endif>{{$ident->name}}</option>
            @endforeach
        </select>
        @error('identity_type_id')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="exampleFormControlSelect1">@lang('site.email')</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror"  name="email"   value="{{ isset($row) ? $row->email : old('email') }}">
        @error('email')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>

        @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="exampleFormControlSelect1">@lang('site.IDNum')</label>
        <input type="text" class="form-control @error('IDNum') is-invalid @enderror"  name="IDNum"   value="{{ isset($row) ? $row->IDNum : old('IDNum') }}">
        @error('IDNum')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="block">@lang('site.ban_status')</label>
        <select class="form-control" id="block" name="block">
            <option value=" ">@lang('site.Choose Status')</option>
            <option value="unblocked" {{ ( isset($row) && $row->block=='unblocked' || old('block') == 'unblocked' ) ? 'selected' : '' }}>@lang('site.unblocked')</option>
            <option value="block" {{ ( isset($row) && $row->block=='block' || old('block') == 'block' ) ? 'selected' : '' }}>@lang('site.block')</option>
        </select>
        @error('block')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>
@if(auth()->user()->hotel_id == null)
    <div class="col-md-12">
        <div class="form-group">
            <label>@lang('site.hotel_id')</label>
            <select name="hotel_id"  class='form-control'>
                <option value="">@lang('site.choose_hotel_id')</option>
                @foreach(\App\Models\Hotel::all() as $hot)
                    <option value="{{$hot->id}}" @if(isset($row) && $row->hotel_id==$hot->id || old('hotel_id') == $hot->id ) selected  @endif>{{$hot->name}}</option>
                @endforeach
            </select>
            @error('hotel_id')
                <small class=" text text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>
@endif

<div class="col-md-6">
    <div class="form-group">
        <label>@lang('site.image')</label>
        <input type="file" name="image" class="form-control image @error('image') is-invalid @enderror">
        @error('image')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
        @enderror
    </div>
</div>

<div class="form-group col-md-6">
    <img src="{{ isset($row) ? $row->image_path : asset('uploads/supervisors/default.jpg') }}" style="width: 115px;height: 80px;position: relative;
                    top: 14px;" class="img-thumbnail image-preview">
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel bg-gray">
            <div class="panel-body">
                <div class="col-md-2">
                    <div class="form-group">
                        <span class="btn btn-success" id="add-to-responsibility"><i class="fa fa-plus"></i></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>@lang('site.category_id')</label>
                        <select id="category_id"  class='form-control'>
                            <option value="0">@lang('site.category_id')</option>
                            @foreach(\App\Models\Category::where('status','active')->get() as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>@lang('site.floor_id')</label>
                        <select id="floor_id"  class='form-control'>
                            <option value="0">@lang('site.floor_id')</option>
                            @foreach(\App\Models\Floor::where('status','active')->get() as $fl)
                                <option value="{{$fl->id}}">{{$fl->floor_num}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>@lang('site.from_room_id')</label>
                        <select id="from_room_id"  class='form-control'>

                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>@lang('site.to_room_id')</label>
                        <select id="to_room_id"  class='form-control'>

                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table table-hover" id="playlist">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 20%">@lang('site.category_id')</th>
                    <th style="width: 20%">@lang('site.floor_id')</th>
                    <th style="width: 20%">@lang('site.from_room_id')</th>
                    <th style="width: 20%">@lang('site.to_room_id')</th>
                    <th style="width: 20%">@lang('site.action')</th>

                </tr>
            </thead>
            <tbody>
                @if(isset($row) && $row->res()->count()>0)
                    @foreach ($row->res as $re)
                        <tr>
                            <td><input type='text' id='no' name='category_id[]'  value='{{ $re->category_id }}' readonly=true></td>
                            <td><input type='text' id='no' name='floor_id[]' value='{{ $re->floor_id }}' readonly=true></td>
                            <td><input type='text' id='no' name='from_room_id[]' value='{{ $re->from_room_id }}' readonly=true></td>
                            <td><input type='text' id='no' name='to_room_id[]' value='{{ $re->to_room_id }}' readonly=true></td>
                            <td><span class='btn btn-danger' id='remove-from-res'><i class='fa fa-trash'></i></span></td>
                        </tr>
                    @endforeach

                @endif
            </tbody>

        </table>
    </div>
    </div>
</div>
