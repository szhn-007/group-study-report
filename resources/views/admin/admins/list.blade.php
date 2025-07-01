@extends('admin.layouts.app')

@section('title', 'Admins')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admins</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Simple Datatable start -->
<div class="card-box mb-30">
    <div class="pt-10 pb-10">
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus">Full Name</th>
                    <th>Image</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td class="table-plus">
                        {{ $admin['name'] }}
                        {{ $admin['surname'] ?? '' }}
                    </td>
                    <td>
                        <img src="{{ $admin['image'] ?? asset('assets/vendors/images/default-user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                    </td>
                    <td>{{ $admin['email'] }}</td>
                    <td>{{ $admin['role'] }}</td>
                    {{-- <td>
                        <span class="badge badge-{{ $admin['is_blocked'] ? 'danger' : 'success' }}">
                            {{ $admin['is_blocked'] ? 'Blocked' : 'Active' }}
                        </span>
                    </td> --}}
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href=""><i class="dw dw-eye"></i> View</a>
                                {{-- <form class="toggle-block-form" action="{{ route('admin.userToggleBlock', $admin['id']) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="dw dw-{{ $admin['is_blocked'] ? 'unlock' : 'lock' }}"></i>
                                        {{ $admin['is_blocked'] ? 'Unblock' : 'Block' }}
                                    </button>
                                </form> --}}
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Simple Datatable End -->
@endsection

@section('scripts')
<!-- js -->
<script src="{{ asset('assets/vendors/scripts/core.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/script.min.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/process.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/layout-settings.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
<!-- buttons for Export datatable -->
<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
<!-- Datatable Setting js -->
<script src="{{ asset('assets/vendors/scripts/datatable-setting.js') }}"></script>
@endsection
