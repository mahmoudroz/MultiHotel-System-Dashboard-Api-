<form action="{{route('dashboard.'.$module_name_plural.'.destroy', $row)}}" method="POST" style="display: inline-block">
    {{csrf_field()}}
    {{method_field('DELETE')}}
    <button type="submit" style="color:#fff!important;" rel="tooltip" title="" class="btn btn-danger  btn-sm delete" data-original-title="@lang('site.delete')">
        <i class="fa fa-1x fa-trash"> @lang('site.delete')</i>
    </button> 
    
</form>
    {{-- <button type="submit" rel="tooltip" title="" class="btn btn-white btn-link btn-sm delete" data-original-title="@lang('site.delete') @lang('site.'.$module_name_singular)"> --}}
