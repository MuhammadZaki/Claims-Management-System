<!DOCTYPE html>
<html lang="en">
@include('backend.common.partials._head')
<body class="">
<div class="container-scroller">
@include('backend.common.partials._navbar')

<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        @include('backend.common.partials._sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">{{ trans('common.copyright-admin') }}</span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('backend.common.partials._scripts')
</body>
</html>
