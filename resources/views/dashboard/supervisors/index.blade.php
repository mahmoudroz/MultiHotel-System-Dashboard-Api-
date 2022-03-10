@extends('dashboard.layouts.app')

@section('title', __('site.'.$module_name_plural))


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.'.$module_name_plural)</h1>

            <ol class="breadcrumb">
                <li> <a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active"><i class="fa fa-user-secret"></i> @lang('site.'.$module_name_plural)</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h1 class="box-title"> @lang('site.'.$module_name_plural) <small>{{count($rows)}}</small></h1>

                    <form action="{{route('dashboard.'.$module_name_plural.'.index')}}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" value="{{request()->search}}" class="form-control"
                                       placeholder="@lang('site.search')">
                            </div>

                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                                <a href="{{route('dashboard.'.$module_name_plural.'.create')}}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i> @lang('site.add')</a>

                            </div>
                        </div>
                    </form>
                </div> {{--end of box header--}}

                <div class="box-body">

                    @if($rows->count() > 0)

                        <table class="table table-hover">

                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.IDNum')</th>
                                <th>@lang('site.responsibilty')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($rows as $index=>$row)
                                <tr>
                                    <td>{{++$index}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->IDNum}}</td>
                                    <td>
                                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#Modal{{ $row->id }}">
                                            @lang('site.show')
                                        </a>
                                        {{--start models --}}
                                            <div id="Modal{{ $row->id }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">{{ $row->name }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if($row->res()->count() > 0)
                                                                <table class="table table-bordered">
                                                                    <thead class="thead-dark">
                                                                        <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">@lang('site.category')</th>
                                                                        <th scope="col">@lang('site.floor_id')</th>
                                                                        <th scope="col">@lang('site.from_room_id')</th>
                                                                        <th scope="col">@lang('site.to_room_id')</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($row->res as $index=>$re )
                                                                        <tr>
                                                                            <td>{{ $index }}</td>
                                                                            <td>{{ $re->category->name}}</td>
                                                                            <td>{{ $re->floor->floor_num}}</td>
                                                                            <td>{{ $re->from_room_id}}</td>
                                                                            <td>{{ $re->to_room_id}}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            @else
                                                                <p>@lang('site.no_records')</p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site.Close') </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{-- end models --}}
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update-'.$module_name_plural))
                                            @include('dashboard.buttons.edit')
                                        @else
                                            <input type="submit" value="edit" disabled>
                                        @endif

                                        @if (auth()->user()->hasPermission('delete-'.$module_name_plural))
                                            @include('dashboard.buttons.delete')
                                        @else
                                            <input type="submit" value="delete" disabled>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table> {{--end of table--}}
                        {{$rows->appends(request()->query())->links()}}


                    @else
                        <tr>
                            <h4>@lang('site.no_records')</h4>
                        </tr>
                    @endif

                </div> {{--end of box body--}}

            </div> {{--  end of box--}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
