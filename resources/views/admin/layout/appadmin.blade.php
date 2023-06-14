@include('admin.layout.top')
@include('admin.layout.menu')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
           @include('sweetalert::alert')
           @yield('content')
           <!--- yield ini adalah mengdklarasikan yang akan diisi konten ketika yield nya dipanggil
            di dalam konten masing - masing, contoh yield yang di atas menggunakan value content-->
        </div>
    </main>
</div>

@include('admin.layout.bottom')