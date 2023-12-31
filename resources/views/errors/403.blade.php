<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Error page</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
        *,
        ::after,
        ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after,
        ::before {
            --tw-content: ''
        }

        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, sans-serif;
            font-feature-settings: normal
        }

        body {
            margin: 0;
            line-height: inherit
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        pre,
        samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dd,
        dl,
        figure,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0;
            padding: 0
        }

        legend {
            padding: 0
        }

        menu,
        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        [role=button],
        button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio,
        canvas,
        embed,
        iframe,
        img,
        object,
        svg,
        video {
            display: block;
            vertical-align: middle
        }

        img,
        video {
            max-width: 100%;
            height: auto
        }

        [hidden] {
            display: none
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::-webkit-backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        .relative {
            position: relative
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .mx-6 {
            margin-left: 1.5rem;
            margin-right: 1.5rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-16 {
            margin-top: 4rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .mr-1 {
            margin-right: 0.25rem
        }

        .flex {
            display: flex
        }

        .inline-flex {
            display: inline-flex
        }

        .grid {
            display: grid
        }

        .h-16 {
            height: 4rem
        }

        .h-7 {
            height: 1.75rem
        }

        .h-6 {
            height: 1.5rem
        }

        .h-5 {
            height: 1.25rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-auto {
            width: auto
        }

        .w-16 {
            width: 4rem
        }

        .w-7 {
            width: 1.75rem
        }

        .w-6 {
            width: 1.5rem
        }

        .w-5 {
            width: 1.25rem
        }

        .max-w-7xl {
            max-width: 80rem
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .scale-100 {
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .gap-6 {
            gap: 1.5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .self-center {
            align-self: center
        }

        .rounded-lg {
            border-radius: 0.5rem
        }

        .rounded-full {
            border-radius: 9999px
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity))
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-red-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(254 242 242 / var(--tw-bg-opacity))
        }

        .bg-dots-darker {
            background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")
        }

        .from-gray-700\/50 {
            --tw-gradient-from: rgb(55 65 81 / 0.5);
            --tw-gradient-to: rgb(55 65 81 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-transparent {
            --tw-gradient-to: rgb(0 0 0 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), transparent, var(--tw-gradient-to)
        }

        .bg-center {
            background-position: center
        }

        .stroke-red-500 {
            stroke: #ef4444
        }

        .stroke-gray-400 {
            stroke: #9ca3af
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem
        }

        .font-semibold {
            font-weight: 600
        }

        .leading-relaxed {
            line-height: 1.625
        }

        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99 / var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity))
        }

        .underline {
            -webkit-text-decoration-line: underline;
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-2xl {
            --tw-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .shadow-gray-500\/20 {
            --tw-shadow-color: rgb(107 114 128 / 0.2);
            --tw-shadow: var(--tw-shadow-colored)
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms
        }

        .selection\:bg-red-500 *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:bg-red-500::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .hover\:text-gray-900:hover {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .hover\:text-gray-700:hover {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity))
        }

        .focus\:rounded-sm:focus {
            border-radius: 0.125rem
        }

        .focus\:outline:focus {
            outline-style: solid
        }

        .focus\:outline-2:focus {
            outline-width: 2px
        }

        .focus\:outline-red-500:focus {
            outline-color: #ef4444
        }

        .group:hover .group-hover\:stroke-gray-600 {
            stroke: #4b5563
        }

        .z-10 {
            z-index: 10
        }

        @media (prefers-reduced-motion: no-preference) {
            .motion-safe\:hover\:scale-\[1\.01\]:hover {
                --tw-scale-x: 1.01;
                --tw-scale-y: 1.01;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(17 24 39 / var(--tw-bg-opacity))
            }

            .dark\:bg-gray-800\/50 {
                background-color: rgb(31 41 55 / 0.5)
            }

            .dark\:bg-red-800\/20 {
                background-color: rgb(153 27 27 / 0.2)
            }

            .dark\:bg-dots-lighter {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")
            }

            .dark\:bg-gradient-to-bl {
                background-image: linear-gradient(to bottom left, var(--tw-gradient-stops))
            }

            .dark\:stroke-gray-600 {
                stroke: #4b5563
            }

            .dark\:text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity))
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:shadow-none {
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .dark\:ring-1 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .dark\:ring-inset {
                --tw-ring-inset: inset
            }

            .dark\:ring-white\/5 {
                --tw-ring-color: rgb(255 255 255 / 0.05)
            }

            .dark\:hover\:text-white:hover {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .group:hover .dark\:group-hover\:stroke-gray-400 {
                stroke: #9ca3af
            }
        }

        @media (min-width: 640px) {
            .sm\:fixed {
                position: fixed
            }

            .sm\:top-0 {
                top: 0px
            }

            .sm\:right-0 {
                right: 0px
            }

            .sm\:ml-0 {
                margin-left: 0px
            }

            .sm\:flex {
                display: flex
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-center {
                justify-content: center
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-8 {
                padding: 2rem
            }
        }
    </style>
</head>

<body class="antialiased">
    <div
        class="relative min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">


        <div class="p-6 mx-auto max-w-7xl lg:p-8">
            <div class="flex justify-center">
                <svg width="450" height="338" viewBox="0 0 450 338" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                        <path
                            d="M321.749 231.118C321.749 261.706 304.982 272.387 284.299 272.387C263.616 272.387 246.849 261.706 246.849 231.118C246.849 200.529 284.299 161.616 284.299 161.616C284.299 161.616 321.749 200.529 321.749 231.118Z"
                            fill="#E7D040" />
                        <path
                            d="M283.318 242.108L299.28 210.437L283.378 238.092L283.55 226.581L294.552 203.668L283.596 223.535L283.906 202.832L295.687 184.591L283.955 199.577L284.149 161.616L282.983 209.717L271.054 189.914L282.839 213.776L281.723 236.897L281.69 236.283L267.883 215.36L281.648 238.452L281.508 241.343L281.483 241.387L281.495 241.624L278.664 272.478H282.446L282.9 269.985L296.632 246.95L282.935 267.707L283.318 242.108Z"
                            fill="#3F3D56" />
                        <path
                            d="M450 132.766C450 191.197 417.971 211.599 378.462 211.599C338.952 211.599 306.923 191.197 306.923 132.766C306.923 74.3342 378.462 0 378.462 0C378.462 0 450 74.3342 450 132.766Z"
                            fill="#F2F2F2" />
                        <path
                            d="M375.855 202.661L376.587 153.759L407.079 93.2606L376.702 146.088L377.032 124.099L398.046 80.3294L377.119 118.281V118.281L377.712 78.7339L400.214 43.8875L377.804 72.5153L378.175 0L375.849 95.9971L376.04 92.0369L353.161 54.0563L375.673 99.6388L373.541 143.806L373.478 142.634L347.103 102.665L373.398 146.775L373.131 152.299L373.083 152.382L373.106 152.835L367.697 264.891H374.923L375.79 207.012L402.021 163.01L375.855 202.661Z"
                            fill="#3F3D56" />
                        <path
                            d="M447.063 255.107C447.063 272.547 342.747 338 220.802 338C98.8564 338 0 304.126 0 286.685C0 269.245 96.43 289.975 218.375 289.975C340.321 289.975 447.063 237.667 447.063 255.107Z"
                            fill="#3F3D56" />
                        <path opacity="0.1"
                            d="M447.063 255.107C447.063 272.547 342.747 338 220.802 338C98.8564 338 0 304.126 0 286.685C0 269.245 96.43 289.975 218.375 289.975C340.321 289.975 447.063 237.667 447.063 255.107Z"
                            fill="black" />
                        <path
                            d="M447.063 255.107C447.063 272.547 342.747 318.264 220.802 318.264C98.8564 318.264 0 304.126 0 286.685C0 269.245 96.43 270.238 218.375 270.238C340.321 270.238 447.063 237.667 447.063 255.107Z"
                            fill="#3F3D56" />
                        <path opacity="0.1"
                            d="M223.273 297.864C275.057 297.864 317.037 294.343 317.037 289.999C317.037 285.655 275.057 282.133 223.273 282.133C171.488 282.133 129.509 285.655 129.509 289.999C129.509 294.343 171.488 297.864 223.273 297.864Z"
                            fill="black" />
                        <path
                            d="M148.992 132.382C148.992 132.382 176.442 132.934 171.359 138.171C166.276 143.409 147.213 138.171 147.213 138.171L148.992 132.382Z"
                            fill="#A0616A" />
                        <path
                            d="M91.7996 68.7669C91.7996 68.7669 102.883 66.6204 106.736 76.3238C110.59 86.0273 118.504 113.701 118.504 113.701C118.504 113.701 139.683 128.905 143.536 128.406C147.388 127.906 153.973 128.925 152.765 133.483C151.557 138.041 152.094 143.21 149.313 143.843C146.532 144.477 142.109 138.43 138.724 141.342C135.339 144.255 105.171 133.617 103.234 131.413C101.297 129.209 85.2021 81.4807 85.2021 81.4807C85.2021 81.4807 85.846 68.6114 91.7996 68.7669Z"
                            fill="#E7D040" />
                        <path d="M115.57 273.656L116.84 285.233L106.166 288.266L100.065 285.233V275.034L115.57 273.656Z"
                            fill="#A0616A" />
                        <path
                            d="M86.8481 281.099L88.1188 292.676L77.4439 295.708L71.3438 292.676V282.477L86.8481 281.099Z"
                            fill="#A0616A" />
                        <path
                            d="M116.586 147.13L121.415 166.15L128.532 204.742C128.532 204.742 130.565 214.114 126.499 225.416C122.432 236.718 115.061 273.656 116.586 275.861C118.111 278.066 99.3028 279.72 99.5569 277.515C99.8111 275.31 102.353 244.988 102.353 244.988C102.353 244.988 105.911 218.249 107.69 214.941C109.469 211.633 99.5569 203.364 99.5569 203.364C99.5569 203.364 97.0153 235.064 93.2027 237.821C89.3902 240.577 89.8985 283.304 88.1193 283.855C86.3402 284.406 73.3776 286.612 71.8526 283.855C70.3276 281.099 71.8526 235.064 71.8526 235.064C71.8526 235.064 80.4943 200.056 78.7151 195.094C76.9359 190.132 77.9526 168.907 77.9526 168.907C77.9526 168.907 71.3442 152.643 74.9026 144.098L116.586 147.13Z"
                            fill="#2F2E41" />
                        <path
                            d="M115.824 41.2784C115.824 41.2784 105.149 55.6125 105.657 61.9525C106.165 68.2926 88.8818 50.375 88.8818 50.375C88.8818 50.375 101.336 32.1818 101.336 28.3226C101.336 24.4634 115.824 41.2784 115.824 41.2784Z"
                            fill="#A0616A" />
                        <path
                            d="M115.696 46.6537C124.961 46.6537 132.471 38.5083 132.471 28.4604C132.471 18.4126 124.961 10.2672 115.696 10.2672C106.431 10.2672 98.9209 18.4126 98.9209 28.4604C98.9209 38.5083 106.431 46.6537 115.696 46.6537Z"
                            fill="#A0616A" />
                        <path
                            d="M73.421 136.818C72.6611 139.889 71.7181 143.37 71.8528 146.303C71.9393 148.202 76.588 149.448 83.0159 150.264C88.9762 151.022 96.4665 151.408 103.276 151.607C110.425 151.816 116.818 151.816 119.891 151.816C129.041 151.816 121.67 145.476 118.111 142.444C114.553 139.412 115.316 96.4095 115.57 90.8964C115.824 85.3832 113.282 69.3952 113.282 66.363C113.282 63.3308 107.302 55.4167 107.302 55.4167C107.302 55.4167 105.911 59.7473 100.32 53.9586C94.728 48.1698 87.3571 46.5159 87.3571 46.5159C81.7654 48.7211 72.3612 72.9788 71.8528 77.1136C71.6469 78.7923 71.8172 87.39 72.1629 97.2061C72.6636 111.554 73.538 128.515 74.1403 130.315C74.6156 131.735 74.0895 134.116 73.421 136.818Z"
                            fill="#E7D040" />
                        <path d="M100.573 152.919L102.352 159.81L95.4895 167.529L93.2021 156.778L100.573 152.919Z"
                            fill="#A0616A" />
                        <path
                            d="M102.861 282.201C102.861 282.201 108.198 288.817 112.265 284.406C116.332 279.996 116.078 277.239 116.84 277.239C117.603 277.239 129.04 288.266 129.04 288.266C129.04 288.266 148.611 293.227 137.936 296.811C127.261 300.394 97.0149 297.914 97.0149 296.811C97.0149 295.708 96.2524 281.099 99.0483 281.099L102.861 282.201Z"
                            fill="#2F2E41" />
                        <path
                            d="M74.1401 289.644C74.1401 289.644 79.4776 296.26 83.5443 291.849C87.611 287.439 87.3568 284.682 88.1193 284.682C88.8819 284.682 100.319 295.708 100.319 295.708C100.319 295.708 119.89 300.67 109.215 304.254C98.5402 307.837 68.2942 305.356 68.2942 304.254C68.2942 303.151 67.5317 288.541 70.3275 288.541L74.1401 289.644Z"
                            fill="#2F2E41" />
                        <path
                            d="M96.8624 42.9832C96.3205 43.3629 95.615 43.7477 95.0724 43.3691C93.055 37.9126 91.5471 32.2505 90.5713 26.4677C90.2287 24.4365 89.9909 22.1784 91.0314 20.449C91.4418 19.767 92.0325 19.2092 92.3331 18.4629C92.7883 17.3327 92.4887 16.0244 92.6399 14.802C92.9567 12.2411 95.1889 10.4549 97.4334 9.58867C99.678 8.7224 102.116 8.45368 104.255 7.31697C106.287 6.23763 107.914 4.44759 109.798 3.08922C111.682 1.73085 114.095 0.802081 116.193 1.71997C118.049 2.53199 119.205 4.58363 120.959 5.62826C122.149 6.33715 123.531 6.53441 124.859 6.83871C128.552 7.6885 132.02 9.43558 135 11.9485C135.726 12.5096 136.351 13.2087 136.846 14.0119C139.097 18.0314 135.067 23.4962 136.845 27.7854L133.001 24.4956C131.974 23.5217 130.816 22.7237 129.567 22.1291C128.294 21.606 126.786 21.5429 125.629 22.3221C124.006 23.4156 123.566 25.7002 122.999 27.6793C122.432 29.6584 121.178 31.8531 119.267 31.8024C116.669 31.7335 115.761 27.8012 113.429 26.5563C111.909 25.7447 109.996 26.2792 108.7 27.4628C107.405 28.6464 106.627 30.3637 106.057 32.0937C105.701 33.1748 105.366 34.3935 104.734 35.3307C104.035 36.3642 103.143 36.4474 102.397 37.2192C100.456 39.2284 99.2631 41.3011 96.8624 42.9832Z"
                            fill="#2F2E41" />
                        <path opacity="0.1"
                            d="M73.4202 136.818C76.5796 141.788 80.1405 146.915 83.0151 150.264C88.9754 151.022 96.4657 151.408 103.275 151.607C102.058 149.818 100.537 148.298 98.7939 147.13C95.4897 144.925 87.6105 118.738 87.6105 118.738C87.6105 118.738 97.2689 91.7233 99.8106 81.5241C102.352 71.3248 92.4397 65.5361 92.4397 65.5361C87.8647 61.4012 79.9854 71.0492 79.9854 71.0492C79.9854 71.0492 75.9645 84.2034 72.1621 97.2061C72.6628 111.554 73.5372 128.515 74.1395 130.315C74.6148 131.735 74.0887 134.116 73.4202 136.818Z"
                            fill="black" />
                        <path
                            d="M91.6775 63.3308C91.6775 63.3308 101.59 69.1196 99.0484 79.3188C96.5067 89.5181 86.8483 116.532 86.8483 116.532C86.8483 116.532 94.7276 142.72 98.0317 144.925C101.336 147.13 105.911 152.367 102.353 155.124C98.7943 157.881 96.2526 162.291 93.7109 160.913C91.1692 159.535 91.1692 151.816 86.8483 151.816C82.5275 151.816 64.9898 123.148 64.7357 120.116C64.4815 117.084 79.2233 68.8439 79.2233 68.8439C79.2233 68.8439 87.1025 59.196 91.6775 63.3308Z"
                            fill="#E7D040" />
                        <path
                            d="M297.797 138.675L294.938 135.574C293.27 133.766 291.008 132.749 288.649 132.749C286.291 132.749 284.029 133.766 282.361 135.574L226.899 195.725L171.437 135.574C169.769 133.766 167.507 132.749 165.148 132.749C162.79 132.749 160.527 133.766 158.86 135.574L156 138.675C155.174 139.571 154.519 140.634 154.072 141.805C153.626 142.975 153.396 144.229 153.396 145.496C153.396 146.762 153.626 148.016 154.072 149.187C154.519 150.357 155.174 151.42 156 152.316L211.462 212.466L156 272.617C155.174 273.513 154.519 274.576 154.072 275.746C153.626 276.917 153.396 278.171 153.396 279.437C153.396 280.704 153.626 281.958 154.072 283.128C154.519 284.299 155.174 285.362 156 286.257L158.86 289.359C160.527 291.167 162.79 292.184 165.148 292.184C167.507 292.184 169.769 291.167 171.437 289.359L226.899 229.208L282.361 289.359C284.029 291.167 286.291 292.184 288.649 292.184C291.008 292.184 293.27 291.167 294.938 289.359L297.797 286.257C299.465 284.449 300.402 281.995 300.402 279.437C300.402 276.879 299.465 274.426 297.797 272.617L242.335 212.466L297.797 152.316C299.465 150.507 300.402 148.054 300.402 145.496C300.402 142.937 299.465 140.484 297.797 138.675Z"
                            fill="#FF6584" />
                        <path opacity="0.1"
                            d="M154.021 275.887L207.837 217.523L207.319 216.961L156.001 272.617C155.141 273.549 154.467 274.662 154.021 275.887Z"
                            fill="black" />
                        <path opacity="0.1"
                            d="M155.234 140.631C156.902 138.822 159.164 137.806 161.522 137.806C163.881 137.806 166.143 138.822 167.811 140.631L223.273 200.782L278.735 140.631C280.403 138.822 282.665 137.806 285.024 137.806C287.382 137.806 289.644 138.822 291.312 140.631L294.172 143.732C295.398 145.063 296.239 146.753 296.591 148.596C296.943 150.438 296.79 152.352 296.151 154.102L297.798 152.316C298.624 151.42 299.279 150.357 299.726 149.187C300.173 148.016 300.403 146.762 300.403 145.496C300.403 144.229 300.173 142.975 299.726 141.804C299.279 140.634 298.624 139.571 297.798 138.675L294.938 135.574C293.271 133.765 291.009 132.749 288.65 132.749C286.291 132.749 284.029 133.765 282.361 135.574L226.899 195.725L171.437 135.574C169.769 133.765 167.507 132.749 165.149 132.749C162.79 132.749 160.528 133.765 158.86 135.574L156.001 138.675C155.141 139.607 154.467 140.72 154.021 141.946L155.234 140.631Z"
                            fill="black" />
                        <path opacity="0.1"
                            d="M242.853 213.028L238.709 217.523L294.171 277.674C295.398 279.004 296.239 280.695 296.59 282.538C296.942 284.38 296.789 286.294 296.15 288.044L297.797 286.257C298.623 285.362 299.278 284.299 299.725 283.128C300.172 281.958 300.402 280.704 300.402 279.437C300.402 278.171 300.172 276.917 299.725 275.746C299.278 274.576 298.623 273.513 297.797 272.617L242.853 213.028Z"
                            fill="black" />
                        <path
                            d="M64.5802 253.134C64.5802 278.539 50.6547 287.41 33.4766 287.41C16.2986 287.41 2.37305 278.539 2.37305 253.134C2.37305 227.729 33.4766 195.41 33.4766 195.41C33.4766 195.41 64.5802 227.729 64.5802 253.134Z"
                            fill="#E7D040" />
                        <path
                            d="M32.6622 262.262L45.9195 235.958L32.7122 258.927L32.8555 249.366L41.9922 230.336L32.8934 246.836L33.1509 229.642L42.9346 214.492L33.1913 226.939L33.3522 195.41L32.3843 235.36L22.4768 218.913L32.2643 238.731L31.3377 257.934L31.3102 257.425L19.8428 240.047L31.2752 259.225L31.1593 261.627L31.1385 261.663L31.1481 261.86L28.7965 287.485H31.9385L32.3155 285.415L43.72 266.284L32.3439 283.523L32.6622 262.262Z"
                            fill="#3F3D56" />
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect width="450" height="338" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </div>

            <div class="flex flex-col justify-center mt-6">
                {{-- <p class="p-2 mx-auto mb-4 text-sm text-black md:text-base">Impossible de se connecter a cette page</p> --}}
                <p class="text-xl font-semibold tracking-widest uppercase text-g">Impossible de se connecter a cette page</p>

                <a href="/" target="_blank"
                    class="flex items-center justify-start gap-4 px-4 py-1 mx-auto mt-5 font-mono font-semibold duration-500 ease-in-out transform bg-yellow-400 rounded-lg shadow animate-bounce hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-inherit">
                        <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z"></path>
                        <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z"></path>
                      </svg>
                   Revenir sur la page d'accueil
                </a>
            </div>

        </div>

    </div>
</body>

</html>
