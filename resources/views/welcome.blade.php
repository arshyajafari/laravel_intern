<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        *, :after, :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5;
            -webkit-text-size-adjust: 100%
        }

        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .flex {
            display: flex;
            flex-direction: column;
        }

        .justify-center {
            justify-content: center
        }

        .min-h-screen {
            min-height: 100vh
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .relative {
            position: relative
        }

        a {
            text-decoration: none;
        }

        @media (min-width: 640px) {
            .sm\:items-center {
                align-items: center
            }

            .sm\:pt-0 {
                padding-top: 0
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }
        }
    </style>
</head>
<body class="antialiased">
<div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <p class="dark:text-white">Welcome</p>
    <a href="./index" class="dark:text-white">Go to -></a>
</div>
</body>
</html>
