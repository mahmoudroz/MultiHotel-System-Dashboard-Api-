@extends('dashboard.layouts.app')

@section('title', __('site.' . $module_name_plural . '.edit'))

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.'.$module_name_singular.'.edit')</h1>

            <ol class="breadcrumb">
                <li> <a href="#"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> <a href="{{ route('dashboard.' . $module_name_plural . '.index') }}"><i class="fa fa-clone"></i>
                        @lang('site.'.$module_name_plural)</a></li>
                <li class="active"><i class="fa fa-edit"></i> @lang('site.'.$module_name_singular.'.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h1 class="box-title"> @lang('site.edit')</h1>
                </div> {{-- end of box header --}}

                <div class="box-body">

                    {{-- @include('dashboard.partials._errors') --}}
                    <form action="{{ route('dashboard.' . $module_name_plural . '.update', $row->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ method_field('patch') }}


                        @include('dashboard.'.$module_name_plural.'.form')

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                @lang('site.'.$module_name_singular.'.edit')</button>
                        </div>

                    </form> {{-- end of form --}}

                </div> {{-- end of box body --}}

            </div> {{-- end of box --}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
