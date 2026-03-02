@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.packages'))

@section('content')

    @include('superadmin::layouts.nav')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('superadmin::lang.packages') <small>@lang('superadmin::lang.all_packages')</small></h1>
        <!-- <ol class="breadcrumb">
            <a href="#"><i class="fa fa-dashboard"></i> Level</a><br/>
            <li class="active">Here<br/>
        </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        @include('superadmin::layouts.partials.currency')
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">@lang('superadmin::lang.all_packages')</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">@lang('Package Categories')</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="box-header">
                                    <h3 class="box-title">&nbsp;</h3>
                                    <div class="box-tools">
                                        <a href="{{action('\Modules\Superadmin\Http\Controllers\PackagesController@create')}}"
                                           class="btn btn-block btn-primary">
                                            <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                                    </div>
                                </div>
                                {{--                                <div class="col-md-12">--}}
                                {{--                                    <h4>@lang( 'receipt.receipt_settings')--}}
                                {{--                                        <small>@lang( 'receipt.receipt_settings_mgs')</small>--}}
                                {{--                                    </h4>--}}
                                {{--                                </div>--}}
                            </div>
                            <br>
                            <div class="row">
                                <div class="box-body">
                                    @foreach ($packages as $package)
                                        <div class="col-md-4">

                                            <div class="box box-success hvr-grow-shadow">
                                                <div class="box-header with-border text-center">
                                                    <h2 class="box-title">{{$package->name}}</h2>

                                                    @if ($package->mark_package_as_popular == 1)
                                                        <div class="pull-right">
                                                    <span class="badge bg-green">
                                                        @lang('superadmin::lang.popular')
                                                    </span>
                                                        </div>
                                                    @endif

                                                    <div class="row">
                                                        @if($package->is_private)
                                                            <a href="#!" class="btn btn-box-tool">
                                                                <i class="fas fa-lock fa-lg text-warning" data-toggle="tooltip"
                                                                   title="@lang('superadmin::lang.private_superadmin_only')"></i>
                                                            </a>
                                                        @endif

                                                        @if($package->is_one_time)
                                                            <a href="#!" class="btn btn-box-tool">
                                                                <i class="fas fa-dot-circle fa-lg text-info" data-toggle="tooltip"
                                                                   title="@lang('superadmin::lang.one_time_only_subscription')"></i>
                                                            </a>
                                                        @endif

                                                        @if($package->is_active == 1)
                                                            <span class="badge bg-green">
										@lang('superadmin::lang.active')
									</span>
                                                        @else
                                                            <span class="badge bg-red">
									@lang('superadmin::lang.inactive')
									</span>
                                                        @endif

                                                        <a href="{{action('\Modules\Superadmin\Http\Controllers\PackagesController@edit', [$package->id])}}" class="btn btn-box-tool" title="edit"><i class="fa fa-edit"></i></a>
                                                        <a href="{{action('\Modules\Superadmin\Http\Controllers\PackagesController@destroy', [$package->id])}}" class="btn btn-box-tool link_confirmation" title="delete"><i class="fa fa-trash"></i></a>

                                                    </div>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body text-center">

                                                    @if($package->location_count == 0)
                                                        @lang('superadmin::lang.unlimited')
                                                    @else
                                                        {{$package->location_count}}
                                                    @endif

                                                    @lang('business.business_locations')
                                                    <br/>

                                                    @if($package->user_count == 0)
                                                        @lang('superadmin::lang.unlimited')
                                                    @else
                                                        {{$package->user_count}}
                                                    @endif

                                                    @lang('superadmin::lang.users')
                                                    <br/>

                                                    @if($package->product_count == 0)
                                                        @lang('superadmin::lang.unlimited')
                                                    @else
                                                        {{$package->product_count}}
                                                    @endif

                                                    @lang('superadmin::lang.products')
                                                    <br/>

                                                    @if($package->invoice_count == 0)
                                                        @lang('superadmin::lang.unlimited')
                                                    @else
                                                        {{$package->invoice_count}}
                                                    @endif

                                                    @lang('superadmin::lang.invoices')
                                                    <br/>

                                                    @if($package->trial_days != 0)
                                                        {{$package->trial_days}} @lang('superadmin::lang.trial_days')
                                                        <br/>
                                                    @endif

                                                    @if(!empty($package->custom_permissions))
                                                        @foreach($package->custom_permissions as $permission => $value)
                                                            @isset($permission_formatted[$permission])
                                                                {{$permission_formatted[$permission]}}
                                                                <br/>
                                                            @endisset
                                                        @endforeach
                                                    @endif

                                                    <h3 class="text-center">
                                                        @if($package->price != 0)
                                                            <span class="display_currency" data-currency_symbol="true">
										{{$package->price}}
									</span>

                                                            <small>
                                                                / {{$package->interval_count}} {{__('lang_v1.' . $package->interval)}}
                                                            </small>
                                                        @else
                                                            @lang('superadmin::lang.free_for_duration', ['duration' => $package->interval_count . ' ' . __('lang_v1.' . $package->interval)])
                                                        @endif
                                                    </h3>

                                                </div>
                                                <!-- /.box-body -->

                                                <div class="box-footer text-center">
                                                    {{$package->description}}
                                                </div>
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                        @if($loop->iteration%3 == 0)
                                            <div class="clearfix"></div>
                                        @endif
                                    @endforeach

                                    <div class="col-md-12">
                                        {{ $packages->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane active" id="tab_2">

                            @component('components.widget', ['class' => 'box-primary'])
                                    @slot('tool')
                                        <div class="box-tools">
                                            <button type="button" class="btn btn-block btn-primary btn-modal"
                                                    data-href="{{action([\Modules\Superadmin\Http\Controllers\PackagesCategoryController::class, 'create'])}}"
                                                    data-container=".package_category_modal">
                                                <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
                                        </div>
                                    @endslot



                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="package_category">
                                        <thead>
                                        <tr>
                                            <th>@lang( 'category.category' )</th>
                                            <th>@lang( 'lang_v1.description' )</th>
                                            <th>@lang( 'lang_v1.sort_order' )</th>
                                            <th>@lang( 'messages.actions' )</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>

                            @endcomponent


                        </div>
                    </div>



                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
        <div class="modal fade package_category_modal" tabindex="-1" role="dialog"
             aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->
@endsection

@section('javascript')

<script type="text/javascript">
    $(document).ready(function() {
        package_category_table = $('#package_category').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ action([\Modules\Superadmin\Http\Controllers\PackagesCategoryController::class, 'index']) }}",
            },
            columns: [{
                data: 'name',
                name: 'category.name'
            },
                {
                    data: 'description',
                    name: 'category.description'
                },
                {
                    data: 'priority',
                    name: 'category.priority'
                },
                {
                    data: 'action',
                    name: 'category.action'
                },
            ]
        });
    });

    $(document).on('submit', 'form#package_category_add_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function(xhr) {
                __disable_submit_button(form.find('button[type="submit"]'));
            },
            success: function(result) {
                if (result.success == true) {
                    $('div.package_category_modal').modal('hide');
                    toastr.success(result.msg);
                    package_category_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.edit_package_category_button', function() {
        $('div.package_category_modal').load($(this).data('href'), function() {
            $(this).modal('show');

            $('form#package_category_edit_form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var data = form.serialize();

                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    beforeSend: function(xhr) {
                        __disable_submit_button(form.find('button[type="submit"]'));
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('div.package_category_modal').modal('hide');
                            toastr.success(result.msg);
                            package_category_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });
        });
    });

    $(document).on('click', 'button.delete_package_category_button', function() {
        swal({
            title: LANG.sure,
            text: 'Confirm Delete Package Category',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            package_category_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

</script>

@endsection