@extends('admin.layouts.app')

@section('title', 'User Details')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.usersList') }}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <div class="btn-group">
                <form id="blockForm" action="{{ route('admin.userToggleBlock', $user['id']) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-{{ $user['is_blocked'] ? 'success' : 'danger' }} ml-2">
                        <i class="dw dw-{{ $user['is_blocked'] ? 'unlock' : 'lock' }}"></i>
                        {{ $user['is_blocked'] ? 'Unblock User' : 'Block User' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- User Profile Section -->
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="card-box height-100-p pd-20">
            <div class="profile-photo">
                <img src="{{ $user['image'] ?? asset('assets/vendors/images/default-user.jpg') }}" alt="" class="avatar-photo w-100">
            </div>
            <h5 class="text-center h5 mb-0">{{ $user['name'] }} {{ $user['surname'] }}</h5>
            <p class="text-center text-muted font-14">{{ $user['email'] }}</p>

            <div class="profile-info">
                <h4 class="mb-3 h4 text-blue">Basic Information</h4>
                <ul>
                    <li>
                        <span>Client ID:</span>
                        {{ $user['client_id'] }}
                    </li>
                    <li>
                        <span>Email Verified:</span>
                        {!! $user['is_email_verified'] ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>' !!}
                    </li>
                    <li>
                        <span>KYC Verified:</span>
                        {!! $user['is_kyc_verified'] ? '<span class="badge badge-success">Verified</span>' : '<span class="badge badge-warning">Pending</span>' !!}
                    </li>
                    <li>
                        <span>Email Subscribed:</span>
                        {!! $user['is_email_subscribed'] ? '<span class="badge badge-primary">Yes</span>' : '<span class="badge badge-secondary">No</span>' !!}
                    </li>
                    <li>
                        <span>Language:</span>
                        {{ $user['language'] ?? 'Not specified' }}
                    </li>
                    <li>
                        <span>Phone:</span>
                        {{ $user['phone_number'] ?? 'Not provided' }}
                    </li>
                </ul>

                <!-- Favorite Countries Section -->
                <div class="mt-4">
                    <h4 class="mb-3 h4 text-blue">Favorite Countries</h4>
                    @if(count($user['favorite_countries']) > 0)
                        <div class="favorite-countries">
                            @foreach($user['favorite_countries'] as $country)
                                <div class="country-item d-flex align-items-center mb-2">
                                    <img src="{{ $country['flag'] }}" alt="{{ $country['name'] }}" class="country-flag mr-2" style="width: 30px; height: 20px; object-fit: cover;">
                                    <span>{{ $country['name'] }} ({{ $country['country_code'] }})</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No favorite countries selected</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
        <!-- KYC Verification Section -->
        <div class="card-box height-100-p pd-20">
            <div class="d-flex justify-content-between align-items-center mb-30">
                <h4 class="h4 text-blue">KYC Verification Details</h4>
                @if($user['is_kyc_verified'])
                    <span class="badge badge-success">Verified</span>
                @else
                    <span class="badge badge-warning">Pending Verification</span>
                @endif
            </div>

            @if(isset($user['kyc_details']))
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" value="{{ $user['kyc_details']['document_data'][0]['full_name'] }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Document Type</label>
                        <input type="text" class="form-control" value="{{ $user['kyc_details']['document_data'][0]['document_type_full'] }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Document Number</label>
                        <input type="text" class="form-control" value="{{ $user['kyc_details']['document_data'][0]['document_number'] }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="text" class="form-control" value="{{ $user['kyc_details']['document_data'][0]['date_of_birth'] }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Issuing Country</label>
                        <input type="text" class="form-control" value="{{ $user['kyc_details']['document_data'][0]['issuer'] }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input type="text" class="form-control" value="{{ $user['kyc_details']['document_data'][0]['expiry'] }}" readonly>
                    </div>
                </div>
            </div>

            <!-- Verification Summary -->
            <div class="mt-4">
                <h5 class="h5 text-blue mb-3">Verification Summary</h5>
                <div class="row">
                    <div class="col-md-4 col-6 mb-3">
                        <div class="verification-badge {{ $user['kyc_details']['verification_summary']['face_verified'] ? 'verified' : 'not-verified' }}">
                            <i class="dw dw-{{ $user['kyc_details']['verification_summary']['face_verified'] ? 'check' : 'close' }}-circle"></i>
                            <span>Face Verified</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-6 mb-3">
                        <div class="verification-badge {{ $user['kyc_details']['verification_summary']['document_verified'] ? 'verified' : 'not-verified' }}">
                            <i class="dw dw-{{ $user['kyc_details']['verification_summary']['document_verified'] ? 'check' : 'close' }}-circle"></i>
                            <span>Document Verified</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-6 mb-3">
                        <div class="verification-badge {{ $user['kyc_details']['verification_summary']['selfie_liveness_verified'] ? 'verified' : 'not-verified' }}">
                            <i class="dw dw-{{ $user['kyc_details']['verification_summary']['selfie_liveness_verified'] ? 'check' : 'close' }}-circle"></i>
                            <span>Liveness Verified</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AML Check Results -->
            @if(!empty($user['kyc_details']['aml']))
            <div class="mt-4">
                <h5 class="h5 text-blue mb-3">AML Check Results</h5>
                <div class="alert alert-warning">
                    <i class="dw dw-warning-1"></i>
                    <strong>Potential Match Found</strong> - This user matched {{ count($user['kyc_details']['aml']) }} records in screening databases
                </div>

                <div class="table-responsive">
                    <table class="data-table table hover nowrap">
                        <thead>
                            <tr>
                                <th>List</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Match Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user['kyc_details']['aml'] as $aml)
                            <tr>
                                <td>{{ $aml['list_name'] }}</td>
                                <td><span class="badge badge-{{ $aml['type'] == 'SANCTION' ? 'danger' : 'warning' }}">{{ $aml['type'] }}</span></td>
                                <td>{{ $aml['name'] }}</td>
                                <td>{{ round($aml['fuzz'], 2) }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @else
            <div class="alert alert-info">
                <i class="dw dw-information"></i>
                No KYC details submitted yet
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Orders Section -->
<div class="card-box mb-30">
    <div class="pd-20">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="h4 text-blue">eSIM Orders</h4>
        </div>
    </div>
    <div class="pb-20">
        @if(count($user['orders']) > 0)
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>eSIM ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user['orders'] as $order)
                <tr>
                    <td>{{ $order['esim_order_id'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($order['order_date'])->format('M d, Y H:i') }}</td>
                    <td>{{ $order['esim_id'] ?? 'Not assigned' }}</td>
                    <td>
                        @switch($order['payment_status'])
                            @case('accepted')
                                <span class="badge badge-success">Accepted</span>
                                @break
                            @case('waiting')
                                <span class="badge badge-warning">Pending</span>
                                @break
                            @default
                                <span class="badge badge-secondary">{{ ucfirst($order['payment_status']) }}</span>
                        @endswitch
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-info m-3">
            <i class="dw dw-information"></i>
            No orders found for this user
        </div>
        @endif
    </div>
</div>

<!-- eSIM QR Code Section -->
@if($user['esim_qr_code'])
<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="h4 text-blue">eSIM QR Code</h4>
    </div>
    <div class="pb-20 text-center">
        <img src="{{ $user['esim_qr_code'] }}" alt="eSIM QR Code" style="max-width: 300px;">
        <div class="mt-3">
            <a href="{{ route('admin.userQrDownload', $user['id']) }}" class="btn btn-primary download-btn" id="downloadQrBtn">
                <i class="dw dw-download"></i> Download QR Code
            </a>
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
    .profile-photo {
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
        border-radius: 50%;
        overflow: hidden;
        border: 5px solid #f5f5f5;
    }

    .profile-info ul {
        list-style: none;
        padding: 0;
    }

    .profile-info ul li {
        padding: 8px 0;
        border-bottom: 1px solid #f1f1f1;
    }

    .profile-info ul li span {
        font-weight: 600;
        color: #333;
        min-width: 120px;
        display: inline-block;
        padding-top: 7px;
        padding-bottom: 7px;
    }

    .verification-badge {
        text-align: center;
        padding: 10px;
        border-radius: 5px;
    }

    .verification-badge.verified {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .verification-badge.not-verified {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .verification-badge i {
        font-size: 24px;
        display: block;
    }

    .page-header {
        padding: 12px 20px 12px;
    }
</style>
@endpush
