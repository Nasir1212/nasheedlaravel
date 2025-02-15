<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <script>
        function redirectToApp() {
            var appScheme = "{{ $app_scheme }}";
            var webUrl = "{{ $web_url }}";

            // Try opening the app
            window.location = appScheme;

            // If app is not installed, redirect to web after 10 seconds
            setTimeout(function() {
                window.location = webUrl;
            }, 10000);
        }
        window.onload = redirectToApp;
    </script>
</head>
<body>
    <p>Redirecting...</p>
</body>
</html>
