@extends('dashboard.layouts.app')

@section('title', __('site.' . $module_name_plural . '.add'))

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.add')</h1>

            <ol class="breadcrumb">
                <li> <a href="#"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li> <a href="{{ route('dashboard.' . $module_name_plural . '.index') }}"><i class="fa fa-clone"></i>
                        @lang('site.units')</a></li>
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
