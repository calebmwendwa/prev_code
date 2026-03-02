<style>
    .intervals > .nav-tabs > li.active {
        border-top-color: #8dc63f;
    }
    .intervals > .nav-tabs > li.active > a,
    .intervals > .nav-tabs > li > a:hover{
        background: #8dc63f!important;
        /* box-shadow: #5e5df0 0 1px 10px 5px !important; */
        transition-duration: 0.1s;
        color: #ffffff !important;
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @foreach($categories as $index => $category)
                        <li class="{{ $index === 0 ? 'active' : '' }}">
                            <a href="#category_tab_{{ $category->id }}" data-toggle="tab" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <br>
                <div class="tab-content">
                    @foreach($categories as $index => $category)
                        <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" id="category_tab_{{ $category->id }}">
                            <!-- Nested Tabs for Interval -->
                            <div class="nav-tabs-custom intervals">
                                <ul class="nav nav-tabs" style='padding-left: 42%;'>
                                    <li class="active">
                                        <a href="#interval_tab_months_{{ $category->id }}" data-toggle="tab" aria-expanded="true">
                                            @lang('Monthly')
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#interval_tab_years_{{ $category->id }}" data-toggle="tab" aria-expanded="false">
                                            @lang('Annually')
                                        </a>
                                    </li>
                                </ul>
                                <br>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="interval_tab_months_{{ $category->id }}">
                                        <div class="row">
                                            @foreach($category->packages->where('interval', 'months') as $package)
                                                @include('superadmin::subscription.partials.packages_by_interval', ['package' => $package])
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="interval_tab_years_{{ $category->id }}">
                                        <div class="row">
                                            @foreach($category->packages->where('interval', 'years') as $package)
                                                @include('superadmin::subscription.partials.packages_by_interval', ['package' => $package])
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Nested Tabs -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>












{{--<section class="content">--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <!-- Custom Tabs -->--}}
{{--            <div class="nav-tabs-custom">--}}
{{--                <ul class="nav nav-tabs">--}}
{{--                    @foreach($categories as $index => $category)--}}
{{--                        <li class="{{ $index === 0 ? 'active' : '' }}">--}}
{{--                            <a href="#tab_{{ $category->id }}" data-toggle="tab" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">--}}
{{--                                {{ $category->name }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--                <br>--}}
{{--                <div class="tab-content">--}}
{{--                    @foreach($categories as $index => $category)--}}
{{--                        <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" id="tab_{{ $category->id }}">--}}
{{--                            <div class="row">--}}
{{--                                @foreach($category->packages as $package)--}}
{{--                                    @if($package->is_private == 1 && !auth()->user()->can('superadmin'))--}}
{{--                                        @continue--}}
{{--                                    @endif--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <div class="box box-success hvr-grow-shadow">--}}
{{--                                            <div style="border-top: 5px solid #27aae1;">--}}
{{--                                                <div class="box-header with-border text-center">--}}
{{--                                                    <h2 class="box-title">{{ $package->name }}</h2>--}}
{{--                                                </div>--}}
{{--                                                <div class="box-body text-center">--}}
{{--                                                    <i class="fa fa-check text-success"></i>--}}
{{--                                                    {{ $package->location_count == 0 ? __('superadmin::lang.unlimited') : $package->location_count }}--}}
{{--                                                    @lang('business.business_locations')--}}
{{--                                                    <br><br>--}}
{{--                                                    <i class="fa fa-check text-success"></i>--}}
{{--                                                    @if($package->user_count == 0)--}}
{{--                                                        @lang('superadmin::lang.unlimited')--}}
{{--                                                    @else--}}
{{--                                                        {{$package->user_count}}--}}
{{--                                                    @endif--}}

{{--                                                    @lang('superadmin::lang.users')--}}
{{--                                                    <br/><br/>--}}

{{--                                                    <i class="fa fa-check text-success"></i>--}}
{{--                                                    @if($package->product_count == 0)--}}
{{--                                                        @lang('superadmin::lang.unlimited')--}}
{{--                                                    @else--}}
{{--                                                        {{$package->product_count}}--}}
{{--                                                    @endif--}}

{{--                                                    @lang('superadmin::lang.products')--}}
{{--                                                    <br/><br/>--}}

{{--                                                    <i class="fa fa-check text-success"></i>--}}
{{--                                                    @if($package->invoice_count == 0)--}}
{{--                                                        @lang('superadmin::lang.unlimited')--}}
{{--                                                    @else--}}
{{--                                                        {{$package->invoice_count}}--}}
{{--                                                    @endif--}}

{{--                                                    @lang('superadmin::lang.invoices')--}}
{{--                                                    <br/><br/>--}}

{{--                                                    @if(!empty($package->custom_permissions))--}}
{{--                                                        @foreach($package->custom_permissions as $permission => $value)--}}
{{--                                                            @isset($permission_formatted[$permission])--}}
{{--                                                                <i class="fa fa-check text-success"></i>--}}
{{--                                                                {{$permission_formatted[$permission]}}--}}
{{--                                                                <br/><br/>--}}
{{--                                                            @endisset--}}
{{--                                                        @endforeach--}}
{{--                                                    @endif--}}

{{--                                                    @if($package->trial_days != 0)--}}
{{--                                                        <i class="fa fa-check text-success"></i>--}}
{{--                                                        {{$package->trial_days}} @lang('superadmin::lang.trial_days')--}}
{{--                                                        <br/><br/>--}}
{{--                                                    @endif--}}


{{--                                                    <h3 class="text-center">--}}
{{--                                                        @php--}}
{{--                                                            $interval_type = !empty($intervals[$package->interval]) ? $intervals[$package->interval] : __('lang_v1.' . $package->interval);--}}
{{--                                                        @endphp--}}
{{--                                                        @if($package->price != 0)--}}
{{--                                                            <span class="display_currency" data-currency_symbol="true">{{ $package->price }}</span>--}}
{{--                                                            <small>/ {{ $package->interval_count }} {{ $interval_type }}</small>--}}
{{--                                                        @else--}}
{{--                                                            @lang('superadmin::lang.free_for_duration', ['duration' => $package->interval_count . ' ' . $interval_type])--}}
{{--                                                        @endif--}}
{{--                                                    </h3>--}}
{{--                                                </div>--}}
{{--                                                <div class="box-footer bg-gray disabled text-center">--}}
{{--                                                    @if($package->enable_custom_link == 1)--}}
{{--                                                        <a href="{{$package->custom_link}}" class="btn btn-block btn-success">{{$package->custom_link_text}}</a>--}}
{{--                                                    @else--}}
{{--                                                        @if(isset($action_type) && $action_type == 'register')--}}
{{--                                                            <a href="{{ route('business.getRegister') }}?package={{$package->id}}"--}}
{{--                                                               class="btn btn-block btn-success">--}}
{{--                                                                @if($package->price != 0)--}}
{{--                                                                    @lang('superadmin::lang.register_subscribe')--}}
{{--                                                                @else--}}
{{--                                                                    @lang('superadmin::lang.register_free')--}}
{{--                                                                @endif--}}
{{--                                                            </a>--}}
{{--                                                        @else--}}
{{--                                                            <a href="{{action('\Modules\Superadmin\Http\Controllers\SubscriptionController@pay', [$package->id])}}"--}}
{{--                                                               class="btn btn-block btn-success">--}}
{{--                                                                @if($package->price != 0)--}}
{{--                                                                    @lang('superadmin::lang.pay_and_subscribe')--}}
{{--                                                                @else--}}
{{--                                                                    @lang('superadmin::lang.subscribe')--}}
{{--                                                                @endif--}}
{{--                                                            </a>--}}
{{--                                                        @endif--}}
{{--                                                    @endif--}}

{{--                                                    {{ $package->description }}--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
