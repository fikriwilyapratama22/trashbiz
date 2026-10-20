<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
    @vite('resources/css/app.css')
    <style>
        /* Styling for demo purposes */
        .hidden {
            display: none;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="p-4 sm:p-8 w-full max-w-md bg-white shadow-lg rounded-xl overflow-hidden m-5 sm:m-0">
        <h2 class="text-2xl sm:text-3xl font-bold mt-4 sm:mt-8 mb-4 sm:mb-6 text-primary text-center">
            Lupa Password
        </h2>
        <form action="#" class="flex flex-col">
            <div class="flex flex-col mb-4 relative">
                <i class="fi fi-rr-envelope absolute top-4 right-4 text-zinc-400"></i>
                <label for="forgot-password-email" class="mb-2 text-gray-900">Email</label>
                <input type="email" id="forgot-password-email" placeholder="Enter your email"
                    class="px-4 py-2 border-2 border-slate-300 rounded-md w-full focus:border-hijau focus:outline-none" />
            </div>
            <button type="submit"
                class="my-4 sm:my-6 bg-primary hover:bg-hijau text-white font-medium text-lg px-4 py-2 rounded-md mx-auto">
                Reset Password
            </button>
        </form>
        <p class="text-gray-900 text-center">
            Remember your password?
            <a href="#" class="text-blue-500 font-bold underline" onclick="showLogin()">
                Back to Login
            </a>
        </p>
    </div>

    <!-- Script to handle showing and hiding forms -->
    <script>
        function showLogin() {
            document.getElementById("forgot-password-form").classList.add("hidden");

        }
    </script>
</body>

</html>
