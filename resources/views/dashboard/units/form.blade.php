{{ csrf_field() }}

@foreach (config('translatable.locales') as $index => $locale)
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.' . $locale . '.name')</label>
            <input type="text" class="form-control @error($locale . ' .name') is-invalid
        @enderror " name=" {{ $locale }}[name]"
                   value="{{ isset($row) ? $row->translate($locale)->name : old($locale . '.name') }}">

            @error($locale . '.name')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
@endforeach



<div class="col-md-6">
    <div class="form-group">
        <label for="exampleFormControlSelect1">@lang('site.status')</label>
        <select class="form-control" id="exampleFormControlSelect1" name="status">
            <option value=" ">@lang('site.Choose Status')</option>
            <option value="active" {{ (isset($row) && $row->status=='active' || old('status') == 'active') ? 'selected' : '' }}>@lang('site.active')</option>
            <option value="pending" {{ (isset($row) && $row->status=='pending' || old('status') == 'pending') ? 'selected' : '' }}>@lang('site.pending')</option>
        </select>
        @error('status')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>@lang('site.category_id')</label>
        <select name="category_id"  class='form-control'>
            <option value="">@lang('site.choose_category_id')</option>
            @foreach(\App\Models\Category::where('status','active')->get() as $cat)
                <option value="{{$cat->id}}" @if(isset($row) && $row->category_id==$cat->id || old('category_id') == $cat->id) selected  @endif>{{$cat->name}}</option>
            @endforeach
        </select>
        @error('category_id')
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
                        <option value="{{$hot->id}}" @if(isset($row) && $row->hotel_id==$hot->id || old('hotel_id') == $hot->id) selected  @endif>{{$hot->name}}</option>
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
    <div class="">
        <label>@lang('site.image')</label>
        <input type="file" name="image" class="form-control image
        @error('image') is-invalid @enderror">
        @error('image')
        <small class=" text text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </small>
        @enderror
    </div>
</div>
<div class="form-group col-md-6">
    <img src="{{ isset($row) ? $row->image_path : asset('uploads/units/default.jpg') }}" style="width: 115px;height: 80px;position: relative;
                top: 14px;" class="img-thumbnail image-preview">
</div>





