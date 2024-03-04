<!DOCTYPE html>
<html lang="en">

@include('.layoutadmin.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('.layoutadmin.nav')
        <!-- End of Topbar -->
        <div class="container-fluid">

            @yield('content')
            <!-- Page Heading -->
            <!-- Footer -->
            @include('.layoutadmin.footer')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('.layoutadmin.logout')
    @include('.layoutadmin.script')
</body>

</html>
