@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- <div class="card-box pd-20 height-100-p mb-30">
        <div class="row align-items-center">
            <div class="col-md-4">
                <img src="{{ asset('assets/vendors/images/banner-img.png') }}" alt="">
            </div>
            <div class="col-md-8">
                <h4 class="font-20 weight-500 mb-10 text-capitalize">
                    Welcome back <div class="weight-600 font-30 text-blue">{{ Auth::user()->name }}!</div>
                </h4>
                <p class="font-18 max-width-600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde hic non repellendus debitis iure, doloremque assumenda. Autem modi, corrupti, nobis ea iure fugiat, veniam non quaerat mollitia animi error corporis.</p>
            </div>
        </div>
    </div> --}}

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">524</div>
                        <div class="weight-600 font-14">Orders</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart2"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">351</div>
                        <div class="weight-600 font-14">Packages</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart3"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">95</div>
                        <div class="weight-600 font-14">Partners</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart4"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">15</div>
                        <div class="weight-600 font-14">Active packages</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-xl-8 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20">Activity</h2>
                <div id="chart5"></div>
            </div>
        </div>
        <div class="col-xl-4 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20">Lead Target</h2>
                <div id="chart6"></div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card-box mb-30">
        <h2 class="h4 pd-20">Best Selling Products</h2>
        <table class="data-table table nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort">Product</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Oty</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($products as $product)
                <tr>
                    <td class="table-plus">
                        <img src="{{ asset('assets/vendors/images/product-' . $loop->iteration . '.jpg') }}" width="70" height="70" alt="">
                    </td>
                    <td>
                        <h5 class="font-16">{{ $product->name }}</h5>
                        by {{ $product->author }}
                    </td>
                    <td>{{ $product->color }}</td>
                    <td>{{ $product->size }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>

@endsection

@push('scripts')
<script>
    // Dashboard specific scripts can go here
</script>
@endpush
