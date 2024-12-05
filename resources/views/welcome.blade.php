{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */
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

        :host,
        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            font-feature-settings: normal;
            font-variation-settings: normal;
            -webkit-tap-highlight-color: transparent
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
            font-feature-settings: normal;
            font-variation-settings: normal;
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
            font-feature-settings: inherit;
            font-variation-settings: inherit;
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

        dialog {
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
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
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
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
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

        .absolute {
            position: absolute
        }

        .relative {
            position: relative
        }

        .-left-20 {
            left: -5rem
        }

        .top-0 {
            top: 0px
        }

        .-bottom-16 {
            bottom: -4rem
        }

        .-left-16 {
            left: -4rem
        }

        .-mx-3 {
            margin-left: -0.75rem;
            margin-right: -0.75rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .aspect-video {
            aspect-ratio: 16 / 9
        }

        .size-12 {
            width: 3rem;
            height: 3rem
        }

        .size-5 {
            width: 1.25rem;
            height: 1.25rem
        }

        .size-6 {
            width: 1.5rem;
            height: 1.5rem
        }

        .h-12 {
            height: 3rem
        }

        .h-40 {
            height: 10rem
        }

        .h-full {
            height: 100%
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-full {
            width: 100%
        }

        .w-\[calc\(100\%\+8rem\)\] {
            width: calc(100% + 8rem)
        }

        .w-auto {
            width: auto
        }

        .max-w-\[877px\] {
            max-width: 877px
        }

        .max-w-2xl {
            max-width: 42rem
        }

        .flex-1 {
            flex: 1 1 0%
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }

        .flex-col {
            flex-direction: column
        }

        .items-start {
            align-items: flex-start
        }

        .items-center {
            align-items: center
        }

        .items-stretch {
            align-items: stretch
        }

        .justify-end {
            justify-content: flex-end
        }

        .justify-center {
            justify-content: center
        }

        .gap-2 {
            gap: 0.5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .gap-6 {
            gap: 1.5rem
        }

        .self-center {
            align-self: center
        }

        .overflow-hidden {
            overflow: hidden
        }

        .rounded-\[10px\] {
            border-radius: 10px
        }

        .rounded-full {
            border-radius: 9999px
        }

        .rounded-lg {
            border-radius: 0.5rem
        }

        .rounded-md {
            border-radius: 0.375rem
        }

        .rounded-sm {
            border-radius: 0.125rem
        }

        .bg-\[\#FF2D20\]\/10 {
            background-color: rgb(255 45 32 / 0.1)
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-gradient-to-b {
            background-image: linear-gradient(to bottom, var(--tw-gradient-stops))
        }

        .from-transparent {
            --tw-gradient-from: transparent var(--tw-gradient-from-position);
            --tw-gradient-to: rgb(0 0 0 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-white {
            --tw-gradient-to: rgb(255 255 255 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)
        }

        .to-white {
            --tw-gradient-to: #fff var(--tw-gradient-to-position)
        }

        .stroke-\[\#FF2D20\] {
            stroke: #FF2D20
        }

        .object-cover {
            object-fit: cover
        }

        .object-top {
            object-position: top
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .py-10 {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem
        }

        .px-3 {
            padding-left: 0.75rem;
            padding-right: 0.75rem
        }

        .py-16 {
            padding-top: 4rem;
            padding-bottom: 4rem
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem
        }

        .pt-3 {
            padding-top: 0.75rem
        }

        .text-center {
            text-align: center
        }

        .font-sans {
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem
        }

        .text-sm\/relaxed {
            font-size: 0.875rem;
            line-height: 1.625
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .font-semibold {
            font-weight: 600
        }

        .text-black {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity))
        }

        .text-white {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .underline {
            -webkit-text-decoration-line: underline;
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\] {
            --tw-shadow: 0px 14px 34px 0px rgba(0, 0, 0, 0.08);
            --tw-shadow-colored: 0px 14px 34px 0px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .ring-1 {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .ring-transparent {
            --tw-ring-color: transparent
        }

        .ring-white\/\[0\.05\] {
            --tw-ring-color: rgb(255 255 255 / 0.05)
        }

        .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\] {
            --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.06));
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\] {
            --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.25));
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .transition {
            transition-property: color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms
        }

        .duration-300 {
            transition-duration: 300ms
        }

        .selection\:bg-\[\#FF2D20\] *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(255 45 32 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:bg-\[\#FF2D20\]::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(255 45 32 / var(--tw-bg-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .hover\:text-black:hover {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity))
        }

        .hover\:text-black\/70:hover {
            color: rgb(0 0 0 / 0.7)
        }

        .hover\:ring-black\/20:hover {
            --tw-ring-color: rgb(0 0 0 / 0.2)
        }

        .focus\:outline-none:focus {
            outline: 2px solid transparent;
            outline-offset: 2px
        }

        .focus-visible\:ring-1:focus-visible {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .focus-visible\:ring-\[\#FF2D20\]:focus-visible {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity))
        }

        @media (min-width: 640px) {
            .sm\:size-16 {
                width: 4rem;
                height: 4rem
            }

            .sm\:size-6 {
                width: 1.5rem;
                height: 1.5rem
            }

            .sm\:pt-5 {
                padding-top: 1.25rem
            }
        }

        @media (min-width: 768px) {
            .md\:row-span-3 {
                grid-row: span 3 / span 3
            }
        }

        @media (min-width: 1024px) {
            .lg\:col-start-2 {
                grid-column-start: 2
            }

            .lg\:h-16 {
                height: 4rem
            }

            .lg\:max-w-7xl {
                max-width: 80rem
            }

            .lg\:grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr))
            }

            .lg\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .lg\:flex-col {
                flex-direction: column
            }

            .lg\:items-end {
                align-items: flex-end
            }

            .lg\:justify-center {
                justify-content: center
            }

            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-10 {
                padding: 2.5rem
            }

            .lg\:pb-10 {
                padding-bottom: 2.5rem
            }

            .lg\:pt-0 {
                padding-top: 0px
            }

            .lg\:text-\[\#FF2D20\] {
                --tw-text-opacity: 1;
                color: rgb(255 45 32 / var(--tw-text-opacity))
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:block {
                display: block
            }

            .dark\:hidden {
                display: none
            }

            .dark\:bg-black {
                --tw-bg-opacity: 1;
                background-color: rgb(0 0 0 / var(--tw-bg-opacity))
            }

            .dark\:bg-zinc-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(24 24 27 / var(--tw-bg-opacity))
            }

            .dark\:via-zinc-900 {
                --tw-gradient-to: rgb(24 24 27 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)
            }

            .dark\:to-zinc-900 {
                --tw-gradient-to: #18181b var(--tw-gradient-to-position)
            }

            .dark\:text-white\/50 {
                color: rgb(255 255 255 / 0.5)
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:text-white\/70 {
                color: rgb(255 255 255 / 0.7)
            }

            .dark\:ring-zinc-800 {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(39 39 42 / var(--tw-ring-opacity))
            }

            .dark\:hover\:text-white:hover {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:hover\:text-white\/70:hover {
                color: rgb(255 255 255 / 0.7)
            }

            .dark\:hover\:text-white\/80:hover {
                color: rgb(255 255 255 / 0.8)
            }

            .dark\:hover\:ring-zinc-700:hover {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(63 63 70 / var(--tw-ring-opacity))
            }

            .dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity))
            }

            .dark\:focus-visible\:ring-white:focus-visible {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity))
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-[#F6F6F6]">
    <div class="w-svh h-svh flex flex-col items-center pt-[100px]">
        <div class="flex flex-col items-center w-3/4 gap-[60px]">

            <svg xmlns="http://www.w3.org/2000/svg" width="117" height="160" fill="none" viewBox="0 0 117 160">
                <path fill="#2B2464"
                    d="M58.5 0c-24.3 0-44 19.7-44 44s19.7 44 44 44c21.802 0 39.9-15.857 43.392-36.667h-.316c-3.256 12.652-14.741 22-28.41 22-16.2 0-29.333-13.133-29.333-29.333s13.133-29.333 29.334-29.333c13.668 0 25.153 9.348 28.409 22h.316C98.4 15.857 80.302 0 58.5 0Z" />
                <path fill="#C7CFFE"
                    d="M14.5 44c0 24.3 19.7 44 44 44 21.802 0 39.9-15.857 43.392-36.667h-29.65c-3.256 12.652-14.74 22-28.409 22C27.633 73.333 14.5 60.2 14.5 44Z" />
                <path fill="#2B2464"
                    d="M13.567 114.384H10.27v5.93H7.66v-17.031h5.907c3.82 0 6.286 1.945 6.286 5.503 0 3.582-2.467 5.598-6.286 5.598Zm-.023-8.895H10.27v6.689h3.274c2.3 0 3.7-1.257 3.7-3.368 0-2.111-1.4-3.321-3.7-3.321Zm10.65 8.397v6.428H21.8v-12.572h2.23v2.657c.877-1.731 2.775-2.823 4.838-2.823v2.491c-2.704-.142-4.672 1.044-4.672 3.819Zm11.22 6.665c-3.63 0-6.073-2.633-6.073-6.594 0-3.724 2.538-6.452 6.002-6.452 3.747 0 6.238 3.036 5.811 7.116h-9.37c.19 2.562 1.471 4.057 3.582 4.057 1.78 0 3.013-.973 3.416-2.61h2.372c-.617 2.799-2.775 4.483-5.74 4.483Zm-.119-11.243c-1.921 0-3.226 1.376-3.487 3.724h6.808c-.119-2.325-1.376-3.724-3.32-3.724Zm17.894 7.258c0 2.467-1.921 3.985-5.266 3.985-3.32 0-5.29-1.636-5.526-4.34h2.3c.095 1.565 1.352 2.538 3.274 2.538 1.684 0 2.799-.593 2.799-1.779 0-1.044-.64-1.495-2.206-1.803l-2.04-.38c-2.325-.45-3.63-1.636-3.63-3.534 0-2.206 1.922-3.748 4.84-3.748 3.012 0 5.052 1.613 5.266 4.199h-2.301c-.143-1.518-1.258-2.396-2.942-2.396-1.518 0-2.538.64-2.538 1.732 0 1.02.64 1.494 2.159 1.779l2.135.403c2.49.451 3.676 1.542 3.676 3.344Zm5.06-11.741c0 .901-.712 1.589-1.732 1.589s-1.756-.688-1.756-1.589c0-.925.736-1.589 1.756-1.589s1.731.664 1.731 1.589Zm-.523 15.489h-2.395v-12.572h2.395v12.572Zm8.023.237c-3.63 0-6.072-2.633-6.072-6.594 0-3.724 2.538-6.452 6-6.452 3.748 0 6.24 3.036 5.812 7.116h-9.37c.19 2.562 1.471 4.057 3.582 4.057 1.78 0 3.013-.973 3.416-2.61h2.372c-.617 2.799-2.775 4.483-5.74 4.483Zm-.119-11.243c-1.921 0-3.226 1.376-3.487 3.724h6.808c-.118-2.325-1.376-3.724-3.32-3.724Zm10.328 3.914v7.092h-2.396v-12.572h2.23v2.088c.854-1.4 2.277-2.325 4.008-2.325 2.586 0 4.294 1.661 4.294 4.673v8.136h-2.396v-7.329c0-2.159-.949-3.369-2.728-3.369-1.636 0-3.012 1.376-3.012 3.606Zm15.8 7.353c-3.439 0-5.858-2.704-5.858-6.547 0-3.795 2.466-6.523 5.858-6.523 3.108 0 5.361 2.064 5.812 5.337h-2.514c-.261-2.016-1.519-3.226-3.274-3.226-2.063 0-3.416 1.756-3.416 4.412 0 2.681 1.353 4.412 3.416 4.412 1.78 0 3.013-1.186 3.297-3.226h2.49c-.426 3.321-2.656 5.361-5.81 5.361Zm12.804-.024c-3.629 0-6.072-2.633-6.072-6.594 0-3.724 2.538-6.452 6.001-6.452 3.748 0 6.238 3.036 5.812 7.116h-9.37c.19 2.562 1.471 4.057 3.582 4.057 1.779 0 3.012-.973 3.415-2.61h2.373c-.617 2.799-2.776 4.483-5.741 4.483Zm-.118-11.243c-1.922 0-3.226 1.376-3.487 3.724h6.807c-.118-2.325-1.375-3.724-3.32-3.724ZM7.509 152.314H2.125v-17.031h5.384c5.432 0 8.563 3.463 8.563 8.444 0 4.911-3.25 8.587-8.563 8.587Zm-2.775-14.778v12.525H7.39c3.913 0 6.024-2.42 6.024-6.334 0-3.842-2.087-6.191-6.024-6.191H4.734Zm21.02 14.778v-1.945c-.784 1.4-2.183 2.182-4.033 2.182-2.61 0-4.317-1.494-4.317-3.795 0-2.467 1.968-3.748 5.716-3.748.735 0 1.328.024 2.348.143v-.925c0-1.803-.972-2.823-2.633-2.823-1.755 0-2.822 1.044-2.893 2.799h-2.183c.119-2.823 2.135-4.697 5.076-4.697 3.108 0 4.91 1.756 4.91 4.744v8.065h-1.992Zm-6.073-3.629c0 1.305.972 2.159 2.514 2.159 2.016 0 3.273-1.258 3.273-3.179v-1.02a16.293 16.293 0 0 0-2.206-.142c-2.395 0-3.581.711-3.581 2.182Zm20.756-.119c0 2.467-1.921 3.985-5.266 3.985-3.32 0-5.29-1.636-5.527-4.34h2.301c.095 1.565 1.352 2.538 3.273 2.538 1.684 0 2.8-.593 2.8-1.779 0-1.044-.641-1.495-2.207-1.803l-2.04-.38c-2.324-.45-3.629-1.636-3.629-3.534 0-2.206 1.922-3.748 4.84-3.748 3.012 0 5.052 1.613 5.265 4.199h-2.3c-.143-1.518-1.258-2.396-2.942-2.396-1.518 0-2.538.64-2.538 1.732 0 1.02.64 1.494 2.158 1.779l2.135.403c2.49.451 3.677 1.542 3.677 3.344Zm4.537-3.344v7.092h-2.396v-17.031h2.396v6.476c.83-1.352 2.111-2.254 3.843-2.254 2.585 0 4.293 1.661 4.293 4.673v8.136h-2.396v-7.329c0-2.159-.949-3.369-2.728-3.369-1.636 0-3.012 1.376-3.012 3.606Zm22.846.806c0 3.772-2.183 6.523-5.575 6.523-1.779 0-3.297-.901-4.198-2.49v2.253h-2.23v-17.031h2.396v6.618c.877-1.542 2.324-2.396 4.032-2.396 3.369 0 5.575 2.704 5.575 6.523Zm-2.491 0c0-2.846-1.494-4.412-3.558-4.412-1.993 0-3.558 1.542-3.558 4.365 0 2.775 1.518 4.436 3.558 4.436 2.064 0 3.558-1.59 3.558-4.389Zm9.711 6.523c-3.558 0-6.167-2.799-6.167-6.523 0-3.724 2.609-6.523 6.167-6.523s6.167 2.799 6.167 6.523c0 3.724-2.609 6.523-6.167 6.523Zm0-2.111c2.064 0 3.7-1.66 3.7-4.412 0-2.751-1.636-4.388-3.7-4.388s-3.677 1.637-3.677 4.388c0 2.752 1.613 4.412 3.677 4.412Zm15.75 1.874v-1.945c-.783 1.4-2.183 2.182-4.033 2.182-2.61 0-4.317-1.494-4.317-3.795 0-2.467 1.969-3.748 5.716-3.748.736 0 1.329.024 2.349.143v-.925c0-1.803-.973-2.823-2.633-2.823-1.755 0-2.823 1.044-2.894 2.799h-2.182c.118-2.823 2.134-4.697 5.076-4.697 3.107 0 4.91 1.756 4.91 4.744v8.065h-1.993Zm-6.073-3.629c0 1.305.972 2.159 2.514 2.159 2.017 0 3.274-1.258 3.274-3.179v-1.02a16.293 16.293 0 0 0-2.206-.142c-2.396 0-3.582.711-3.582 2.182Zm13.19-2.799v6.428H95.51v-12.572h2.23v2.657c.877-1.731 2.775-2.823 4.838-2.823v2.491c-2.704-.142-4.673 1.044-4.673 3.819Zm5.146.142c0-3.819 2.182-6.523 5.574-6.523 1.685 0 3.155.854 4.033 2.396v-6.618h2.396v17.031h-2.23v-2.253c-.901 1.589-2.42 2.49-4.199 2.49-3.392 0-5.574-2.751-5.574-6.523Zm2.491 0c0 2.799 1.47 4.389 3.558 4.389 2.04 0 3.558-1.661 3.558-4.436 0-2.823-1.566-4.365-3.558-4.365-2.088 0-3.558 1.566-3.558 4.412Z" />
            </svg>
            <div class="w-full flex gap-4 items-center">
                <a href="/admin"
                    class="p-6 bg-white hover:bg-amber-50 rounded-[16px] flex flex-col flex-1 gap-10 border border-neutral-200 hover:border-amber-600 group transition duration-200">
                    <div
                        class="flex p-3 rounded-[12px] items-center bg-neutral-200 w-fit group-hover:bg-amber-100 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" fill="none"
                            class="fill-black group-hover:fill-amber-600 transition duration-200" viewBox="0 0 24 25">
                            <path
                                d="M12 2.314a5 5 0 1 1-5 5l.005-.217A5 5 0 0 1 12 2.314Zm2 12a5 5 0 0 1 5 5v1a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-1a5 5 0 0 1 5-5h4Z" />

                        </svg>

                    </div>
                    <div class="flex justify-between items-end">
                        <div class="flex flex-col gap-1">
                            <h1
                                class="font-sans text-2xl font-semibold group-hover:text-amber-600 transition duration-200">
                                Dasboard Admin</h1>
                            <p class="font-sans text-neutral-600 group-hover:text-amber-600 transition duration-200">
                                Mengelola data dosen dan mahasiswa</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none"
                            viewBox="0 0 25 25"
                            class="stroke-black group-hover:stroke-amber-600 transition duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5.5 12.314h14m-6 6 6-6m-6-6 6 6" />
                        </svg>

                    </div>
                </a>
                <a href="/lecturer"
                    class="p-6 bg-white hover:bg-indigo-50 rounded-[16px] flex flex-col flex-1 gap-10 border border-neutral-200 hover:border-indigo-700 group transition duration-200">
                    <div
                        class="flex p-3 rounded-[12px] items-center bg-neutral-200 w-fit group-hover:bg-indigo-100 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" fill="none"
                            class="fill-black group-hover:fill-indigo-700 transition duration-200" viewBox="0 0 24 25">
                            <path
                                d="m19.996 14.298 1.966 3.406a1 1 0 0 1-.705 1.488l-.113.01h-.112l-2.933-.19-1.303 2.636a1.001 1.001 0 0 1-1.608.26l-.082-.094-.072-.11-1.968-3.407a8.995 8.995 0 0 0 6.93-4Zm-8.066 3.999-1.965 3.408a1 1 0 0 1-1.622.157l-.076-.1-.064-.114-1.304-2.635-2.931.19a1.001 1.001 0 0 1-1.022-1.29l.04-.107.05-.1 1.968-3.41a8.994 8.994 0 0 0 6.927 4Zm.57-15.983.24.004a7 7 0 0 1 6.76 6.996l-.003.193-.007.192-.018.245-.026.242-.024.178a6.98 6.98 0 0 1-.317 1.268l-.116.308-.153.348a7.001 7.001 0 0 1-12.688-.028l-.13-.297-.052-.133-.08-.217-.095-.294a6.929 6.929 0 0 1-.093-.344l-.06-.27-.049-.272-.02-.139-.039-.323-.024-.365-.006-.292a7 7 0 0 1 6.76-6.996l.24-.004Z" />
                        </svg>

                    </div>
                    <div class="flex justify-between items-end">
                        <div class="flex flex-col gap-1">
                            <h1
                                class="font-sans text-2xl font-semibold group-hover:text-indigo-700 transition duration-200">
                                Dasboard Dosen</h1>
                            <p class="font-sans text-neutral-600 group-hover:text-indigo-700 transition duration-200">
                                Mengelola data presensi dan izin mahasiswa</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none"
                            viewBox="0 0 25 25"
                            class="stroke-black group-hover:stroke-indigo-700 transition duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5.5 12.314h14m-6 6 6-6m-6-6 6 6" />
                        </svg>

                    </div>
                </a>
            </div>
        </div>

    </div>
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="./assets/images/app_icon.png" type="image/png">
    <title>Presience</title>
    @vite('resources/css/app.css')
</head>



<body class="font-sans antialiased bg-[#ffff]">

    <!-- Navbar -->
    <nav class="bg-[#f9f9f9] border-gray-200 z-50 fixed top-0 left-0 w-full shadow">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 md:p-0">
            <div class="flex items-center">
                <!-- Logo -->
                <svg xmlns="http://www.w3.org/2000/svg" width="143" height="32" fill="none"
                    viewBox="0 0 143 32">
                    <path fill="#2B2464"
                        d="M14.629 1.371C6.549 1.371 0 7.921 0 16c0 8.08 6.55 14.629 14.629 14.629 7.248 0 13.265-5.272 14.426-12.19h-.105c-1.083 4.205-4.901 7.313-9.445 7.313-5.386 0-9.753-4.366-9.753-9.752 0-5.386 4.367-9.752 9.753-9.752 4.544 0 8.362 3.108 9.445 7.314h.105c-1.16-6.919-7.178-12.19-14.426-12.19Z" />
                    <path fill="#C7CFFE"
                        d="M0 16c0 8.08 6.55 14.628 14.629 14.628 7.248 0 13.265-5.271 14.426-12.19h-9.857c-1.083 4.206-4.901 7.314-9.446 7.314C4.366 25.752 0 21.386 0 16Z" />
                    <path fill="#2B2464"
                        d="M44.328 19.07h-3.297V25h-2.61V7.969h5.907c3.819 0 6.286 1.945 6.286 5.503 0 3.582-2.467 5.598-6.286 5.598Zm-.024-8.895h-3.273v6.689h3.273c2.301 0 3.7-1.257 3.7-3.368 0-2.112-1.399-3.321-3.7-3.321Zm10.651 8.397V25H52.56V12.428h2.23v2.657c.877-1.732 2.775-2.823 4.838-2.823v2.49c-2.704-.142-4.673 1.044-4.673 3.82Zm11.22 6.665c-3.63 0-6.073-2.633-6.073-6.594 0-3.724 2.538-6.452 6.001-6.452 3.748 0 6.239 3.036 5.812 7.116h-9.37c.19 2.562 1.47 4.056 3.582 4.056 1.779 0 3.013-.972 3.416-2.609h2.372c-.617 2.8-2.776 4.483-5.74 4.483Zm-.12-11.243c-1.92 0-3.225 1.376-3.486 3.724h6.808c-.119-2.325-1.376-3.724-3.321-3.724Zm17.895 7.258c0 2.467-1.921 3.985-5.266 3.985-3.32 0-5.29-1.636-5.527-4.34h2.301c.095 1.565 1.352 2.538 3.274 2.538 1.684 0 2.799-.594 2.799-1.78 0-1.043-.64-1.494-2.206-1.802l-2.04-.38c-2.325-.45-3.63-1.636-3.63-3.534 0-2.206 1.922-3.748 4.84-3.748 3.012 0 5.052 1.613 5.265 4.199h-2.3c-.143-1.519-1.258-2.396-2.942-2.396-1.518 0-2.538.64-2.538 1.731 0 1.02.64 1.495 2.159 1.78l2.134.403c2.491.45 3.677 1.541 3.677 3.344Zm5.06-11.741c0 .901-.712 1.589-1.732 1.589s-1.755-.688-1.755-1.59c0-.924.735-1.589 1.755-1.589s1.732.665 1.732 1.59ZM88.487 25h-2.396V12.428h2.396V25Zm8.023.237c-3.63 0-6.073-2.633-6.073-6.594 0-3.724 2.538-6.452 6.001-6.452 3.748 0 6.239 3.036 5.812 7.116h-9.37c.19 2.562 1.471 4.056 3.582 4.056 1.78 0 3.013-.972 3.416-2.609h2.372c-.617 2.8-2.775 4.483-5.74 4.483Zm-.119-11.243c-1.921 0-3.226 1.376-3.487 3.724h6.808c-.119-2.325-1.376-3.724-3.321-3.724Zm10.327 3.914V25h-2.395V12.428h2.229v2.088c.854-1.4 2.278-2.325 4.009-2.325 2.586 0 4.294 1.66 4.294 4.673V25h-2.396v-7.33c0-2.158-.949-3.368-2.728-3.368-1.637 0-3.013 1.376-3.013 3.606Zm15.801 7.353c-3.439 0-5.859-2.704-5.859-6.547 0-3.795 2.467-6.523 5.859-6.523 3.108 0 5.361 2.064 5.812 5.337h-2.515c-.261-2.016-1.518-3.226-3.273-3.226-2.064 0-3.416 1.755-3.416 4.412 0 2.68 1.352 4.412 3.416 4.412 1.779 0 3.012-1.186 3.297-3.226h2.491c-.427 3.321-2.657 5.36-5.812 5.36Zm12.804-.024c-3.629 0-6.072-2.633-6.072-6.594 0-3.724 2.538-6.452 6.001-6.452 3.748 0 6.238 3.036 5.811 7.116h-9.369c.189 2.562 1.47 4.056 3.581 4.056 1.78 0 3.013-.972 3.416-2.609h2.372c-.616 2.8-2.775 4.483-5.74 4.483Zm-.119-11.243c-1.921 0-3.226 1.376-3.487 3.724h6.808c-.118-2.325-1.376-3.724-3.321-3.724Z" />
                </svg>

            </div>
            <button data-collapse-toggle="navbar-menu" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-black rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div id="navbar-menu" class="hidden w-full md:block md:w-auto">
                <ul
                    class="font-medium flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-[#f9f9f9]">
                    <li><a href="#home" class="nav-link block py-2 px-3 text-gray-500 hover:text-purple-950"
                            aria-current="page">Home</a></li>
                    <li><a href="#product"
                            class="nav-link block py-2 px-3 text-gray-500 hover:text-purple-950 ">Product</a></li>
                    <li><a href="#features"
                            class="nav-link block py-2 px-3 text-gray-500 hover:text-purple-950">Features</a></li>
                    <li><a href="#tech" class="nav-link block py-2 px-3 text-gray-500 hover:text-purple-950">Tech</a>
                    </li>
                    <li><a href="#team" class="nav-link block py-2 px-3 text-gray-500 hover:text-purple-950">Team</a>
                    </li>
                    <li><a href="#download"
                            class="nav-link block py-2 px-3 text-gray-500 hover:text-purple-950">Download</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Sections -->
    <section id="home" class="bg-[#f9f9f9] w-full h-screen flex justify-center p-30 items-center">
        <div class="w-full h-full bg-slate-300  justify-center items-center">
            <div class="flex p-4 bg-purple-100 w-fit rounded-2xl gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-purple-950" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-target-arrow">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    <path d="M12 7a5 5 0 1 0 5 5" />
                    <path d="M13 3.055a9 9 0 1 0 7.941 7.945" />
                    <path d="M15 6v3h3l3 -3h-3v-3z" />
                    <path d="M15 9l-3 3" />
                </svg>
                <div class="text-purple-950 font-semibold font-interTight">
                    Project-Based Learning
                </div>
            </div>
            <div class="text-6xl font-interTight  pt-7 font-medium">
                Modern Attendance <br> Solution with Face <br> Recognition
            </div>
        </div>
    </section>

    <section id="product" class="bg-white h-screen flex items-center justify-center">
        <h1 class="text-4xl">About Section</h1>
    </section>
    <section id="features" class="bg-yellow-100 h-screen flex items-center justify-center">
        <h1 class="text-4xl">Services Section</h1>
    </section>
    <section id="tech" class="bg-red-100 h-screen flex items-center justify-center">
        <h1 class="text-4xl">Contact Section</h1>
    </section>
    <section id="team" class="bg-red-200 h-screen flex items-center justify-center">
        <h1 class="text-4xl">Contact Section</h1>
    </section>
    <section id="download" class="bg-red-300 h-screen flex items-center justify-center">
        <h1 class="text-4xl">Contact Section</h1>
    </section>

</body>
<!-- JavaScript -->
{{-- navbar --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbar = document.querySelector("nav");
        let lastScrollY = window.scrollY;

        window.addEventListener("scroll", function() {
            if (window.scrollY > lastScrollY) {
                // Scroll ke bawah, sembunyikan navbar
                navbar.style.transform = "translateY(-100%)";
            } else {
                // Scroll ke atas, tampilkan navbar
                navbar.style.transform = "translateY(0)";
            }
            lastScrollY = window.scrollY;
        });
    });
</script>
{{-- navbar responsive --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.querySelector('[data-collapse-toggle]');
        const navbarMenu = document.querySelector('#navbar-menu');

        if (toggleButton && navbarMenu) {
            toggleButton.addEventListener('click', () => {
                navbarMenu.classList.toggle('hidden');
            });
        }
    });
</script>

<!-- Smooth Scroll -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil semua link navbar
        const navLinks = document.querySelectorAll(".nav-link");

        // Set link "Home" sebagai default active saat pertama kali load
        navLinks.forEach(link => link.classList.remove("text-purple-950"));
        const defaultLink = document.querySelector('.nav-link[href="#home"]');
        defaultLink.classList.add("text-purple-950");

        // Tambahkan event listener untuk click pada setiap link
        navLinks.forEach(link => {
            link.addEventListener("click", function(e) {
                e.preventDefault(); // Mencegah aksi default
                const targetId = this.getAttribute("href").slice(1); // Ambil ID target
                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    // Smooth scroll ke section
                    window.scrollTo({
                        top: targetSection.offsetTop -
                            60, // Sesuaikan dengan tinggi navbar
                        behavior: "smooth" // Animasi smooth scroll
                    });

                    // Tambah class active pada link yang diklik, reset link lainnya
                    navLinks.forEach(nav => {
                        nav.classList.remove("text-purple-950");
                        nav.classList.add("text-gray-500"); // Kembalikan warna default
                    });
                    this.classList.add("text-purple-950"); // Beri warna active
                    this.classList.remove("text-gray-500");
                }
            });
        });
    });
</script>

</html>
