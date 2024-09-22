<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset("assets/images/favicon.ico") }}" />

        <!-- Library / Plugin Css Build -->
        <link rel="stylesheet" href="{{ asset("assets/css/core/libs.min.css") }}" />

        <!-- Aos Animation Css -->
        <link rel="stylesheet" href="{{ asset("assets/vendor/aos/dist/aos.css") }}" />

        <!-- Hope Ui Design System Css -->
        <link rel="stylesheet" href="{{ asset("assets/css/hope-ui.min.css?v=2.0.0") }}" />

        <!-- Custom Css -->
        <link rel="stylesheet" href="{{ asset("assets/css/custom.css") }}" />

        <link rel="stylesheet" href="{{ asset("assets/css/auth.css") }}" />

        <!-- Dark Css -->
        <link rel="stylesheet" href="{{ asset("assets/css/dark.min.css") }}" />

        <!-- Customizer Css -->
        <link rel="stylesheet" href="{{ asset("assets/css/customizer.min.css") }}" />

        <!-- RTL Css -->
        <link rel="stylesheet" href="{{ asset("assets/css/rtl.min.css") }}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    </head>

    <body>
        <div id="loading">
            <div class="loader simple-loader">
                <div class="loader-body"></div>
            </div>
        </div>

        <main class="main-content">
            @yield("content")
        </main>

        <!-- Library Bundle Script -->
        <script src="{{ asset("assets/js/core/libs.min.js") }}"></script>

        <!-- External Library Bundle Script -->
        <script src="{{ asset("assets/js/core/external.min.js") }}"></script>

        <!-- Widgetchart Script -->
        <script src="{{ asset("assets/js/charts/widgetcharts.js") }}"></script>

        <!-- Mapchart Script -->
        <script src="{{ asset("assets/js/charts/vectore-chart.js") }}"></script>
        <script src="{{ asset("assets/js/charts/dashboard.js") }}"></script>

        <!-- fslightbox Script -->
        <script src="{{ asset("assets/js/plugins/fslightbox.js") }}"></script>

        <!-- Settings Script -->
        <script src="{{ asset("assets/js/plugins/setting.js") }}"></script>

        <!-- Slider-tab Script -->
        <script src="{{ asset("assets/js/plugins/slider-tabs.js") }}"></script>

        <!-- Form Wizard Script -->
        <script src="{{ asset("assets/js/plugins/form-wizard.js") }}"></script>

        <!-- AOS Animation Plugin -->
        <script src="{{ asset("assets/vendor/aos/dist/aos.js") }}"></script>

        <!-- App Script -->
        <script src="{{ asset("assets/js/hope-ui.js") }}" defer></script>
    </body>

</html>
