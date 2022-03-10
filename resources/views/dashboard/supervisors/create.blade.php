@extends('dashboard.layouts.app')

@section('title', __('site.' . $module_name_plural . '.add'))

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.add')</h1>

            <ol class="breadcrumb">
                <li> <a href="#"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> <a href="{{ route('dashboard.' . $module_name_plural . '.index') }}"><i class="fa fa-user-secret"></i>
                        @lang('site.supervisors')</a></li>
                <li class="active"><i class="fa fa-plus"></i> @lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h1 class="box-title"> @lang('site.add')</h1>
                </div> {{-- end of box header --}}

                <div class="box-body">

                    {{-- @include('dashboard.partials._errors') --}}
                    <form action="{{ route('dashboard.' . $module_name_plural . '.store') }}" method="post"
                        enctype="multipart/form-data">

                        {{ method_field('post') }}

                        @include('dashboard.'.$module_name_plural.'.form')

                        <div class="form-group col-sm-12 ">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                @lang('site.add')</button>
                        </div>

                    </form> {{-- end of form --}}

                </div> {{-- end of box body --}}

            </div> {{-- end of box --}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
@section('scripts')
    <script>
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('select[id="floor_id"]').on('change',function(){
            var id = $(this).val();
            var url = "{{route('dashboard.getRoomByFloorID',':id')}}";
            url = url.replace(':id',id);
            $.ajax({
                            url: url  ,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('select[id="from_room_id"]').empty();
                                $('select[id="from_room_id"]').append("<option value=''>@lang('site.from_room_id')</option>")
                                $('select[id="to_room_id"]').empty();
                                $('select[id="to_room_id"]').append("<option value=''>@lang('site.to_room_id')</option>")

                                $.each(data, function(key, value) {

                                    $('select[id="from_room_id"]').append('<option value="' +
                                        value.code + '">' + value.code+ '</option>');

                                    $('select[id="to_room_id"]').append('<option value="' +
                                        value.code + '">' + value.code+ '</option>');
                                });
                            },
                    });
                });
        $('#add-to-responsibility').on('click',function(){
            var category_id     =$('#category_id').val();
            var floor_id        =$('#floor_id').val();
            var from_room_id    =$('#from_room_id').val();
            var to_room_id      =$('#to_room_id').val();
            if(category_id =='0' || floor_id == '0'|| from_room_id < 1 || to_room_id < 1)
            {
                alert('Please Full All Lists By Data');

            }
            else{
                var tr="<tr>"+
                            "<td><input type='text' id='no' name='category_id[]' value='"+category_id+"' readonly=true></td>"+
                            "<td><input type='text' id='no' name='floor_id[]' value='"+floor_id+"' readonly=true></td>"+
                            "<td><input type='text' id='no' name='from_room_id[]' value='"+from_room_id+"' readonly=true></td>"+
                            "<td><input type='text' id='no' name='to_room_id[]' value='"+to_room_id+"' readonly=true></td>"+
                            "<td><span class='btn btn-danger' id='remove-from-res'><i class='fa fa-trash'></i></span></td>"+
                        "</tr>";
                $('#playlist tbody').append(tr);
            }
        });
        $('#playlist tbody').on('click','#remove-from-res',function(){
            $(this).parent().parent().remove();
        });
    </script>
@endsection
