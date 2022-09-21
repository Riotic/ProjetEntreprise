<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <style>
        :root {
        --close-button: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M18.984 6.422L13.406 12l5.578 5.578-1.406 1.406L12 13.406l-5.578 5.578-1.406-1.406L10.594 12 5.016 6.422l1.406-1.406L12 10.594l5.578-5.578z'/%3E%3C/svg%3E%0A");
        --loupe-icon: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"%3E%3Cpath fill="%23929292" d="M16.041 15.856a.995.995 0 00-.186.186A6.97 6.97 0 0111 18c-1.933 0-3.682-.782-4.95-2.05S4 12.933 4 11s.782-3.682 2.05-4.95S9.067 4 11 4s3.682.782 4.95 2.05S18 9.067 18 11a6.971 6.971 0 01-1.959 4.856zm5.666 4.437l-3.675-3.675A8.967 8.967 0 0020 11c0-2.485-1.008-4.736-2.636-6.364S13.485 2 11 2 6.264 3.008 4.636 4.636 2 8.515 2 11s1.008 4.736 2.636 6.364S8.515 20 11 20a8.967 8.967 0 005.618-1.968l3.675 3.675a.999.999 0 101.414-1.414z"/%3E%3C/svg%3E');
        }
        .leaflet-pane, .leaflet-tile, .leaflet-marker-icon, .leaflet-marker-shadow, .leaflet-tile-container, .leaflet-pane > svg, .leaflet-pane > canvas, .leaflet-zoom-box, .leaflet-image-layer, .leaflet-layer{
            position: relative !important;
        }
        .auto-search-wrapper {
        position: relative;
        display: block;
        width: 100%;
        }

        .auto-search-wrapper input {
        font-size: 16px;
        width: 100%;
        box-shadow: none;
        box-sizing: border-box;
        padding-right: 25px;
        }

        .auto-search-wrapper input:focus {
        border: 1px solid #858585;
        outline: none;
        }

        .auto-search-wrapper input::-ms-clear {
        display: none;
        }

        .auto-search-wrapper ul {
        list-style: none;
        padding: 0;
        margin: 0;
        overflow: auto;
        }

        .auto-search-wrapper ul li {
        position: relative;
        cursor: pointer;
        margin: 0;
        padding: 10px;
        overflow: hidden;
        }

        .auto-search-wrapper ul li:not(:last-child) {
        border-top: none;
        }

        .auto-search-wrapper ul li[disabled] {
        pointer-events: none;
        opacity: 0.5;
        background: #ececec;
        }

        .auto-search-wrapper .auto-expanded {
        border: 1px solid #858585;
        outline: none;
        }

        .auto-search-wrapper.loupe:before {
        filter: invert(60%);
        }

        .auto-is-loading:after {
        content: "";
        box-sizing: border-box;
        position: absolute;
        top: 0px;
        bottom: 0;
        margin: auto;
        right: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #808080;
        border-left-color: #d9d9d9;
        border-top-color: #d9d9d9;
        animation: auto-spinner 0.6s linear infinite;
        }

        .auto-is-loading .auto-clear {
        display: none;
        }

        @keyframes auto-spinner {
        to {
            transform: rotate(1turn);
        }
        }

        li.loupe:before {
        top: 15px;
        bottom: auto;
        }

        .loupe input {
        padding: 12px 45px 12px 40px;
        }

        .loupe:before {
        position: absolute;
        content: "";
        width: 17px;
        height: 17px;
        top: 0;
        bottom: 0;
        left: 10px;
        margin: auto;
        background-image: var(--loupe-icon);
        }

        .auto-selected:before {
        opacity: 1;
        }

        .auto-clear {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 0;
        bottom: 0;
        right: -10px;
        margin: auto;
        width: 40px;
        height: auto;
        cursor: pointer;
        background-color: transparent;
        border: none;
        }

        .auto-clear:before {
        content: var(--close-button);
        line-height: 100%;
        height: 24px;
        width: 24px;
        }

        .auto-clear span {
        display: none;
        }

        .auto-results-wrapper {
        display: none;
        border: 1px solid #858585;
        border-top: none;
        overflow: hidden;
        box-sizing: border-box;
        background-color: #fff;
        }

        .auto-results-wrapper ul > .loupe {
        padding-left: 40px;
        }

        .auto-results-wrapper.auto-is-active {
        display: block;
        position: absolute;
        width: 100%;
        z-index: 99999;
        }

        .auto-selected {
        background-color: #e6e6e6;
        }

        .auto-selected + li:before {
        border-top: none;
        }

        .auto-error {
        border: 1px solid #ff3838;
        }

        .auto-error::placeholder {
        color: #ff6666;
        opacity: 1;
        }

        .hidden {
        display: none;
        }

        .leaflet-search {
        width: 17px;
        height: 17px;
        }

        .leaflet-autocomplete {
        background: #fff;
        padding: 5px;
        width: 26px;
        height: 26px;
        border: 1px solid #ccc;
        display: flex;
        cursor: pointer;
        justify-content: center;
        align-items: center;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);
        border-radius: 4px;
        transition: width 200ms ease-in;
        }

        .leaflet-autocomplete svg {
        width: 17px;
        left: 3px;
        }

        .leaflet-autocomplete .auto-search-wrapper {
        display: none;
        padding-left: 5px;
        }

        .leaflet-autocomplete .loupe:before {
        left: 0;
        top: 4px;
        width: 15px;
        background-repeat: no-repeat;
        }

        .leaflet-autocomplete .auto-search-wrapper ul li {
        padding: 5px;
        border-top: 1px solid rgb(240, 240, 240);
        font-size: 14px;
        }

        .leaflet-autocomplete.active-autocomplete {
        width: 295px;
        }

        .leaflet-autocomplete.active-autocomplete .auto-results-wrapper.auto-is-active {
        margin-top: 9px;
        border-top: 1px solid #858585;
        border-radius: 0 0 5px 5px;
        }

        .leaflet-autocomplete.active-autocomplete .auto-search-wrapper {
        display: block;
        }

        .leaflet-touch .leaflet-autocomplete {
        padding: 15px;
        }

        .leaflet-touch .leaflet-autocomplete svg {
        width: 20px;
        left: 5px;
        top: 5px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/tomik23/autocomplete@1.7.5/dist/js/autocomplete.min.js"></script>
