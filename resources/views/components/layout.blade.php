<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TrashBiz</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet" />
    {{-- icon aksi read, delete, edit --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        .bg-custom-green {
            background-color: #D1E7DC; /* Warna hijau muda */
        }
    </style>
</head>

<body class="bg-gray-100 font-Quicksand leading-normal tracking-normal">
    <!-- Sidebar -->
    <x-aside></x-aside>

    <!-- Main Content -->
    <div id="mainContent" class="main-content flex-1 flex flex-col overflow-hidden ml-[16rem]">
        <!-- Header -->
        <x-navbar></x-navbar>
        <!-- Content -->
        <main class="flex-1 overflow-y-auto p-6 mt-20">
            {{ $slot }}
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("mainContent");
            const hamburgerButton = document.getElementById("hamburgerButton");

            hamburgerButton.addEventListener("click", () => {
                sidebar.classList.toggle("collapsed");
                mainContent.classList.toggle("sidebar-collapsed");
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const adminButton = document.getElementById('adminButton');
            const adminDropdown = document.getElementById('adminDropdown');

            adminButton.addEventListener('click', function() {
                adminDropdown.classList.toggle('hidden');
            });

            // Optional: Hide the dropdown when clicking outside of it
            document.addEventListener('click', function(event) {
                if (!adminButton.contains(event.target) && !adminDropdown.contains(event.target)) {
                    adminDropdown.classList.add('hidden');
                }
            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

</body>

</html>