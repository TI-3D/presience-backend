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



<body class="font-interTight antialiased bg-white ">

    <!-- Navbar -->
    <nav class="z-50 fixed top-0 left-0 w-svw h-[88px] flex items-center justify-between px-5 md:px-[60px]">
        <div class="flex items-center">
            <!-- Logo -->
            <svg xmlns="http://www.w3.org/2000/svg" width="143" height="32" fill="none" viewBox="0 0 143 32">
                <path fill="#2B2464"
                    d="M14.629 1.371C6.549 1.371 0 7.921 0 16c0 8.08 6.55 14.629 14.629 14.629 7.248 0 13.265-5.272 14.426-12.19h-.105c-1.083 4.205-4.901 7.313-9.445 7.313-5.386 0-9.753-4.366-9.753-9.752 0-5.386 4.367-9.752 9.753-9.752 4.544 0 8.362 3.108 9.445 7.314h.105c-1.16-6.919-7.178-12.19-14.426-12.19Z" />
                <path fill="#C7CFFE"
                    d="M0 16c0 8.08 6.55 14.628 14.629 14.628 7.248 0 13.265-5.271 14.426-12.19h-9.857c-1.083 4.206-4.901 7.314-9.446 7.314C4.366 25.752 0 21.386 0 16Z" />
                <path fill="#2B2464"
                    d="M44.328 19.07h-3.297V25h-2.61V7.969h5.907c3.819 0 6.286 1.945 6.286 5.503 0 3.582-2.467 5.598-6.286 5.598Zm-.024-8.895h-3.273v6.689h3.273c2.301 0 3.7-1.257 3.7-3.368 0-2.112-1.399-3.321-3.7-3.321Zm10.651 8.397V25H52.56V12.428h2.23v2.657c.877-1.732 2.775-2.823 4.838-2.823v2.49c-2.704-.142-4.673 1.044-4.673 3.82Zm11.22 6.665c-3.63 0-6.073-2.633-6.073-6.594 0-3.724 2.538-6.452 6.001-6.452 3.748 0 6.239 3.036 5.812 7.116h-9.37c.19 2.562 1.47 4.056 3.582 4.056 1.779 0 3.013-.972 3.416-2.609h2.372c-.617 2.8-2.776 4.483-5.74 4.483Zm-.12-11.243c-1.92 0-3.225 1.376-3.486 3.724h6.808c-.119-2.325-1.376-3.724-3.321-3.724Zm17.895 7.258c0 2.467-1.921 3.985-5.266 3.985-3.32 0-5.29-1.636-5.527-4.34h2.301c.095 1.565 1.352 2.538 3.274 2.538 1.684 0 2.799-.594 2.799-1.78 0-1.043-.64-1.494-2.206-1.802l-2.04-.38c-2.325-.45-3.63-1.636-3.63-3.534 0-2.206 1.922-3.748 4.84-3.748 3.012 0 5.052 1.613 5.265 4.199h-2.3c-.143-1.519-1.258-2.396-2.942-2.396-1.518 0-2.538.64-2.538 1.731 0 1.02.64 1.495 2.159 1.78l2.134.403c2.491.45 3.677 1.541 3.677 3.344Zm5.06-11.741c0 .901-.712 1.589-1.732 1.589s-1.755-.688-1.755-1.59c0-.924.735-1.589 1.755-1.589s1.732.665 1.732 1.59ZM88.487 25h-2.396V12.428h2.396V25Zm8.023.237c-3.63 0-6.073-2.633-6.073-6.594 0-3.724 2.538-6.452 6.001-6.452 3.748 0 6.239 3.036 5.812 7.116h-9.37c.19 2.562 1.471 4.056 3.582 4.056 1.78 0 3.013-.972 3.416-2.609h2.372c-.617 2.8-2.775 4.483-5.74 4.483Zm-.119-11.243c-1.921 0-3.226 1.376-3.487 3.724h6.808c-.119-2.325-1.376-3.724-3.321-3.724Zm10.327 3.914V25h-2.395V12.428h2.229v2.088c.854-1.4 2.278-2.325 4.009-2.325 2.586 0 4.294 1.66 4.294 4.673V25h-2.396v-7.33c0-2.158-.949-3.368-2.728-3.368-1.637 0-3.013 1.376-3.013 3.606Zm15.801 7.353c-3.439 0-5.859-2.704-5.859-6.547 0-3.795 2.467-6.523 5.859-6.523 3.108 0 5.361 2.064 5.812 5.337h-2.515c-.261-2.016-1.518-3.226-3.273-3.226-2.064 0-3.416 1.755-3.416 4.412 0 2.68 1.352 4.412 3.416 4.412 1.779 0 3.012-1.186 3.297-3.226h2.491c-.427 3.321-2.657 5.36-5.812 5.36Zm12.804-.024c-3.629 0-6.072-2.633-6.072-6.594 0-3.724 2.538-6.452 6.001-6.452 3.748 0 6.238 3.036 5.811 7.116h-9.369c.189 2.562 1.47 4.056 3.581 4.056 1.78 0 3.013-.972 3.416-2.609h2.372c-.616 2.8-2.775 4.483-5.74 4.483Zm-.119-11.243c-1.921 0-3.226 1.376-3.487 3.724h6.808c-.118-2.325-1.376-3.724-3.321-3.724Z" />
            </svg>

        </div>
        <button data-collapse-toggle="navbar-menu" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-neutral-black rounded-lg md:hidden">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div id="navbar-menu"
            class="hidden top-[88px] md:justify-end left-0 w-full md:block bg-white md:bg-transparent pb-4 md:pb-0">
            <ul class="flex flex-col gap-6 md:flex-row md:justify-end items-center rtl:space-x-reverse">
                <li><a href="#home"
                        class="nav-link block font-interTight font-regular text-neutral-400 text-base hover:text-purple-950"
                        aria-current="page">Home</a></li>
                <li><a href="#product"
                        class="nav-link block font-interTight font-regular text-neutral-400 text-base hover:text-purple-950 ">Product</a>
                </li>
                <li><a href="#features"
                        class="nav-link block font-interTight font-regular text-neutral-400 text-base hover:text-purple-950">Features</a>
                </li>
                <li><a href="#tech"
                        class="nav-link block font-interTight font-regular text-neutral-400 text-base hover:text-purple-950">Tech</a>
                </li>
                <li><a href="#team"
                        class="nav-link block font-interTight font-regular text-neutral-400 text-base hover:text-purple-950">Team</a>
                </li>
                <li><a href="#download"
                        class="nav-link block font-interTight font-regular text-neutral-400 text-base hover:text-purple-950">Download</a>
                </li>
                <li>
                    <div class="flex gap-3">

                        <a href="/admin"
                            class="flex items-center w-fit px-5 h-[44px] rounded-xl border border-purple-950 bg-purple-white text-purple-950 hover:bg-purple-950 active:border-purple-950 hover:text-white font-interTight font-medium text-base">
                            Login Admin
                        </a>
                        <a href="/lecturer"
                            class="flex items-center w-fit px-5 h-[44px] rounded-xl border  bg-purple-950 text-white hover:bg-purple-900 active:bg-purple-950 font-interTight font-medium text-base">
                            Login Lecture
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sections -->
    <section id="home"
        class="w-svw min-h-svh bg-gradient-to-b from-neutral-50 via-white to-neutral-50 flex flex-col items-start justify-center px-5 md:px-[60px] pb-[60px] pt-[104px] md:pt-[88px] relative overflow-hidden gap-16">
        <div class="flex flex-col gap-[56px] lg:w-1/2 z-10">
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-[6px] px-2 h-8 rounded-lg bg-purple-100 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                        viewBox="0 0 20 20">
                        <g clip-path="url(#a)">
                            <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9.167 10a.833.833 0 1 0 1.667 0 .833.833 0 0 0-1.667 0Z" />
                            <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M10 5.833A4.167 4.167 0 1 0 14.167 10" />
                            <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M10.833 2.546a7.5 7.5 0 1 0 6.617 6.62" />
                            <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12.5 5v2.5H15L17.5 5H15V2.5L12.5 5Zm0 2.5L10 10" />
                        </g>
                        <defs>
                            <clipPath id="a">
                                <path fill="#fff" d="M0 0h20v20H0z" />
                            </clipPath>
                        </defs>
                    </svg>
                    <p class="font-interTight font-medium text-base text-purple-950">
                        Project-Based Learning
                    </p>
                </div>
                <div class="flex flex-col gap-5">
                    <h1
                        class="font-interTight font-medium text-[52px] md:text-[68px] text-neutral-black leading-[63px] md:leading-[82px]">
                        Modern
                        Attendance Solutions with
                        Face Recognition</h1>
                    <p class="font-interTight font-regular text-xl text-neutral-400">Presience utilizes facial
                        recognition technology to simplify and secure the attendance process</p>
                </div>
            </div>
            <div class="flex gap">
                <a href="{{ asset('apk/presience.apk') }}" download="presience.apk"
                    class="flex items-center px-5 h-[52px] rounded-xl bg-purple-950 text-white hover:bg-purple-900 active:bg-purple-950 font-interTight font-medium text-base">
                    Download App
                </a>
                <a href="#product"
                    class="flex items-center px-5 h-[52px] rounded-xl text-purple-950 hover:text-purple-900 active:text-purple-950 font-interTight font-medium text-base">
                    See Our Work
                </a>
            </div>
        </div>
        <div class="flex flex-col gap-4  z-10">
            <p class="font-interTight font-medium text-base text-neutral-400">Associated with</p>
            <div class="flex gap-5">
                <img src="{{ asset('assets/images/Logo Polinema.png') }}" alt="Polinema Logo" class="h-[48px] box">
                <svg xmlns="http://www.w3.org/2000/svg" width="46" height="48" fill="none"
                    viewBox="0 0 46 48">
                    <path fill="#0B224B"
                        d="M19.68 41.312a14.92 14.92 0 0 1-6.407 4.006 14.726 14.726 0 0 1-4.459.681c-2.255 0-4.401-.502-6.319-1.4V34.547c1.128.987 2.535 1.573 4.064 1.573.096 0 .198 0 .293-.013.019.006.039.006.051 0 .083.013.172.013.261.013 3.376 0 6.109-3.306 6.109-7.39v1.096c0 4.759 2.534 8.962 6.407 11.485Z" />
                    <path fill="#A3413E"
                        d="M23.755 4.311v26.746c0 3.961-1.548 7.573-4.076 10.254-3.873-2.522-6.408-6.726-6.408-11.483V4.31h10.484Z" />
                    <path fill="#F3612E"
                        d="M28.789 32.255v11.554c-.191.006-.376.012-.567.012a15.83 15.83 0 0 1-4.465-.636 15.132 15.132 0 0 1-4.076-1.873 14.907 14.907 0 0 0 4.076-10.255v-2.764c0 2.089 1.49 3.809 3.389 3.962h.026c.082.012.165.012.247.012.083 0 .166 0 .249-.013h1.12Zm4.133-5.522h-9.166V15.32h9.166v11.414Z" />
                    <path fill="#FAA820" d="M43.783 26.733h-10.86V15.32h10.86v11.414Z" />
                    <path fill="#FEC60F"
                        d="M43.783 43.439h-10.86V26.732h10.86v16.707Zm0-36.007a5.432 5.432 0 0 1-5.433 5.427 5.431 5.431 0 0 1-5.427-5.427c0-3 2.433-5.433 5.427-5.433 3 0 5.433 2.433 5.433 5.433Z" />
                </svg>
            </div>
        </div>
        <img src="{{ asset('assets/images/mockuuups-free-iphone-15-pro-hand-mockup 1.png') }}" alt=""
            class=" absolute top-[140px] right-[60px] hidden md:block">
    </section>

    <section id="product"
        class="w-svw bg-white flex flex-col items-center px-5 md:px-[60px] pb-[40px] pt-[80px] md:pb-[80px] overflow-hidden gap-14">
        <div class="flex flex-col gap-[56px] items-center">
            <div class="flex flex-col gap-5 items-center">
                <div class="flex items-center gap-[6px] px-2 h-8 rounded-lg bg-purple-100 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none"
                        viewBox="0 0 21 20">
                        <g clip-path="url(#a)">
                            <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M10.499 2.5A10 10 0 0 0 17.582 5 10 10 0 0 1 10.5 17.5 10 10 0 0 1 3.416 5a10 10 0 0 0 7.083-2.5Zm.001 0v15m0-8.333h7.417m-7.417-2.5h7.417m-7.417-2.5h2.583m-2.583 10h5.167m-5.167-2.5h6.667" />
                        </g>
                        <defs>
                            <clipPath id="a">
                                <path fill="#fff" d="M.5 0h20v20H.5z" />
                            </clipPath>
                        </defs>
                    </svg>
                    <p class="font-interTight font-medium text-base text-purple-950">
                        Seamless System
                    </p>
                </div>
                <div class="flex flex-col items-center justify-center gap-2 w-full md:w-[657px]">
                    <h2
                        class="font-interTight font-medium text-[28px] md:text-[44px] text-neutral-black leading-[34px] md:leading-[53px] text-center">
                        Unified Products for Streamlined Attendance Management</h2>
                    <p class="font-interTight font-regular text-base md:text-xl text-neutral-400 text-center">Presience
                        utilizes
                        facial
                        recognition technology to simplify and secure the attendance process</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 h-fit md:h-[473px] gap-5 w-full">
            <div
                class="col-span-3 md:col-span-1 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-10 w-10 rounded-lg bg-purple-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M6 5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V5Zm5-1h2m-1 13v.01" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">Mobile
                            App for Students</h3>
                        <p class="font-interTight font-regular text-xl text-neutral-400">Presience’s mobile app allows
                            students to mark their attendance effortlessly using facial recognition.</p>
                    </div>
                    <a href="{{ asset('apk/presience.apk') }}" download="presience.apk"
                        class="flex items-center w-fit px-5 h-[44px] rounded-xl border border-purple-950 bg-purple-white text-purple-950 hover:bg-purple-950 active:border-purple-950 hover:text-white font-interTight font-medium text-base">
                        Download App
                    </a>
                </div>
                <img class="w-full h-min-[266px] cover" src="{{ asset('assets/images/Feature Card-2.png') }}"></img>
            </div>
            <div
                class="col-span-3 md:col-span-1 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-10 w-10 rounded-lg bg-purple-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 19h18M5 7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7Z" />

                        </svg>
                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">
                            Attendance Monitoring for Lecturer</h3>
                        <p class="font-interTight font-regular text-xl text-neutral-400">The lecturer dashboard
                            provides an intuitive platform to monitor student attendance in real-time.</p>
                    </div>
                    <a href="/lecturer"
                        class="flex items-center w-fit px-5 h-[44px] rounded-xl border border-purple-950 bg-purple-white text-purple-950 hover:bg-purple-950 active:border-purple-950 hover:text-white font-interTight font-medium text-base">
                        Open Lecture Dashboard
                    </a>
                </div>
                <img class="w-full h-min-[266px] cover" src="{{ asset('assets/images/Feature Card-1.png') }}"></img>
            </div>
            <div
                class="col-span-3 md:col-span-1 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-10 w-10 rounded-lg bg-purple-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 19h18M5 7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7Z" />

                        </svg>
                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">
                            Admin Dashboard</h3>
                        <p class="font-interTight font-regular text-xl text-neutral-400">The admin dashboard
                            streamlines the process of managing attendance data.</p>
                    </div>
                    <a href="/admin"
                        class="flex items-center w-fit px-5 h-[44px] rounded-xl border border-purple-950 bg-purple-white text-purple-950 hover:bg-purple-950 active:border-purple-950 hover:text-white font-interTight font-medium text-base">
                        Open Admin Dashboard
                    </a>
                </div>
                <img class="w-full h-min-[266px] cover" src="{{ asset('assets/images/Feature Card.png') }}"></img>
            </div>
        </div>
    </section>

    <section id="features"
        class="w-svw bg-white flex flex-col items-center px-5 md:px-[60px] pb-[40px] pt-[80px] md:pb-[80px] overflow-hidden gap-14">
        <div class="flex flex-col gap-[56px] items-center">
            <div class="flex flex-col gap-5 items-center">
                <div class="flex items-center gap-[6px] px-2 h-8 rounded-lg bg-purple-100 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none"
                        viewBox="0 0 21 20">

                        <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.549 17.372A10 10 0 0 1 2.916 5a10 10 0 0 0 7.083-2.5A10 10 0 0 0 17.082 5a10 10 0 0 1-.075 5.883m-4.507 4.95 1.667 1.667 3.333-3.333" />
                    </svg>
                    <p class="font-interTight font-medium text-base text-purple-950">
                        Presience Features
                    </p>
                </div>
                <div class="flex flex-col items-center justify-center gap-2 w-full md:w-[657px]">
                    <h2
                        class="font-interTight font-medium text-[28px] md:text-[44px] text-neutral-black leading-[34px] md:leading-[53px] text-center">
                        Powerful Features to Elevate Your Attendance Experience</h2>
                    <p class="font-interTight font-regular text-base md:text-xl text-neutral-400 text-center">
                        Explore a range of intelligent features designed to simplify attendance</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 w-full gap-[20px]">
            <div
                class="col-span-2 w-full border-[1px] flex flex-col items-end md:flex-row md:justify-between rounded-[16px] border-neutral-200 overflow-hidden">
                <div class="md:w-[512px] w-[353px] md:flex-col md:flex md:justify-end p-[20px] h-full">
                    <h2 class="text-neutral-black font-medium  leading-[41px] font-interTight text-[34px]">
                        Effortless Attendance with Face Recognition
                    </h2>
                    <p class="pt-[12px] font-interTight text-[18px] text-neutral-400">
                        Mark your attendance in seconds with cutting-edge face recognition technology. This advanced
                        system ensures both speed and unmatched accuracy.
                    </p>
                    <div class="py-[20px]">
                        <a href="{{ asset('apk/presience.apk') }}" download="presience.apk"
                            class="px-[20px] h-[44px] flex items-center bg-purple-950 text-white hover:bg-purple-900 active:bg-purple-950 w-fit text-base rounded-[12px]">Download
                            App</a>
                    </div>
                </div>
                <span class="w-full min-h-[310px] md:min-h-[436px] bg-cover bg-bottom"
                    style="background-image: url('../assets/images/Tech Stack Card-1.png')"></span>
                {{-- <div class="md:w-[768px] min-[310px] overflow-hidden">

                    <img src="{{ asset('assets/images/Tech Stack Card-1.png') }}" alt="">
                </div> --}}
            </div>


            <div
                class="md:col-span-1 col-span-2 w-full  border-[1px] flex flex-col justify-between rounded-[16px] border-neutral-200 overflow-hidden">
                <div class="w-full p-[20px] pb-0 overflow-hidden">
                    <h2 class="font-interTight font-medium  leading-[41px] text-[34px] text-neutral-black pb-[12px]">
                        Real-Time Notifications for Every Attendance
                    </h2>
                    <p class="text-[18px] font-interTight text-neutral-400">
                        Stay instantly informed with automatic notifications sent as soon as the lecturer
                        opens attendance. This ensures you're always updated and ready to mark your
                        presence.
                    </p>
                </div>
                <span class=" min-h-[310px] bg-cover bg-top"
                    style="background-image: url('../assets/images/Tech Stack Card Content.png')"></span>
                {{-- <img src="{{ asset('assets/images/Tech Stack Card Content.png') }}" alt=""
                    class="min-h-[310px] bg-cover"> --}}
            </div>


            <div
                class="md:col-span-1 col-span-2 w-full  border-[1px] flex flex-col justify-between rounded-[16px] border-neutral-200 overflow-hidden">
                <div class="w-full p-[20px] pb-0 overflow-hidden">
                    <h2 class="font-interTight font-medium  leading-[41px] text-[34px] text-neutral-black pb-[12px]">
                        Control Attendance Access with Flexible Permissions
                    </h2>
                    <p class="text-[18px] font-interTight text-neutral-400">
                        Tailor attendance settings to fit your workflow by adjusting permissions for
                        different stages.
                    </p>
                </div>
                <span class=" min-h-[310px] bg-cover bg-top"
                    style="background-image: url('../assets/images/Tech Stack Card.png')"></span>
                {{-- <img src="{{ asset('assets/images/Tech Stack Card.png') }}" alt=""
                    class="w-full min-h-[310px] bg-cover"> --}}
            </div>
        </div>
    </section>

    <section id="tech"
        class="w-svw bg-white flex flex-col items-center px-5 md:px-[60px] pb-[80px] pt-[80px] md:pb-[80px] overflow-hidden gap-14">
        <div class="flex flex-col gap-[56px] items-center">
            <div class="flex flex-col gap-5 items-center">
                <div class="flex items-center gap-[6px] px-2 h-8 rounded-lg bg-purple-100 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none"
                        viewBox="0 0 21 20">
                        <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.104 3.598c.355-1.464 2.437-1.464 2.792 0a1.437 1.437 0 0 0 2.144.888c1.286-.783 2.758.688 1.975 1.975a1.436 1.436 0 0 0 .887 2.143c1.464.355 1.464 2.437 0 2.792a1.437 1.437 0 0 0-.888 2.144c.784 1.286-.688 2.758-1.975 1.975a1.436 1.436 0 0 0-2.143.887c-.355 1.464-2.437 1.464-2.792 0a1.437 1.437 0 0 0-2.144-.888c-1.286.784-2.758-.688-1.975-1.975a1.437 1.437 0 0 0-.888-2.143c-1.463-.355-1.463-2.437 0-2.792a1.437 1.437 0 0 0 .889-2.144c-.784-1.286.688-2.758 1.975-1.975a1.435 1.435 0 0 0 2.143-.888Z" />
                        <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 10a2.5 2.5 0 1 0 5 0 2.5 2.5 0 0 0-5 0Z" />
                    </svg>
                    <p class="font-interTight font-medium text-base text-purple-950">
                        Tech Stack
                    </p>
                </div>
                <div class="flex flex-col items-center justify-center gap-2 w-full">
                    <h2
                        class="font-interTight font-medium text-[28px] md:text-[44px] text-neutral-black leading-[34px] md:leading-[53px] text-center">
                        Built with Modern Technologies</h2>
                    <p class="font-interTight font-regular text-base md:text-xl text-neutral-400 text-center">Presience
                        leverages
                        cutting-edge tools text-base md:text-xl ensure optimal performance</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 h-fit gap-5 w-full">
            <div
                class="col-span-12 md:col-span-3 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-[52px] w-[52px] rounded-lg bg-neutral-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none"
                            viewBox="0 0 32 32">
                            <path fill="#0ACF83"
                                d="M10.708 32a5.335 5.335 0 0 0 5.334-5.333v-5.334h-5.334a5.335 5.335 0 0 0-5.333 5.334A5.335 5.335 0 0 0 10.708 32Z" />
                            <path fill="#A259FF"
                                d="M5.375 16a5.335 5.335 0 0 1 5.333-5.333h5.334v10.666h-5.334A5.335 5.335 0 0 1 5.375 16Z" />
                            <path fill="#F24E1E"
                                d="M5.375 5.333A5.335 5.335 0 0 1 10.708 0h5.334v10.667h-5.334a5.335 5.335 0 0 1-5.333-5.334Z" />
                            <path fill="#FF7262"
                                d="M16.042 0h5.333a5.335 5.335 0 0 1 5.333 5.333 5.335 5.335 0 0 1-5.333 5.334h-5.333V0Z" />
                            <path fill="#1ABCFE"
                                d="M26.708 16a5.335 5.335 0 0 1-5.333 5.333A5.335 5.335 0 0 1 16.042 16a5.335 5.335 0 0 1 5.333-5.333A5.335 5.335 0 0 1 26.708 16Z" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">Figma
                        </h3>
                        <p class="font-interTight font-regular text-lg text-neutral-400">
                            Used to design intuitive and user-friendly interfaces.</p>
                    </div>
                </div>
            </div>
            <div
                class="col-span-12 md:col-span-3 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-[52px] w-[52px] rounded-lg bg-neutral-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="32" fill="none"
                            viewBox="0 0 30 32">
                            <path fill="#47C5FB"
                                d="M16.46 0 .525 15.935l4.932 4.932L26.325 0H16.46Zm-.11 14.695-8.533 8.532 4.95 5.025 4.924-4.923 8.634-8.634h-9.976Z" />
                            <path fill="#00569E" d="M12.768 28.252 16.516 32h9.809l-8.634-8.67-4.923 4.922Z" />
                            <path fill="#00B5F8" d="m7.761 23.283 4.933-4.932 4.997 4.978-4.923 4.923-5.007-4.969Z" />
                            <path fill="url(#b)" fill-opacity=".8"
                                d="m12.768 28.252 4.1-1.36.407-3.147-4.507 4.507Z" />
                        </svg>

                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">Flutter
                        </h3>
                        <p class="font-interTight font-regular text-lg text-neutral-400">Delivering a responsive and
                            intuitive mobile app experience.</p>
                    </div>
                </div>
            </div>
            <div
                class="col-span-12 md:col-span-3 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-[52px] w-[52px] rounded-lg bg-neutral-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="31" height="32" fill="none"
                            viewBox="0 0 31 32">
                            <path fill="#FF2D20" fill-rule="evenodd"
                                d="M30.452 7.656c.011.04.017.083.017.125v6.541a.477.477 0 0 1-.24.414l-5.49 3.161v6.266c0 .17-.091.328-.239.413l-11.46 6.598c-.027.015-.056.025-.084.035-.011.003-.021.01-.032.013a.48.48 0 0 1-.245 0 .243.243 0 0 1-.037-.016c-.027-.01-.054-.017-.08-.032L1.105 24.576a.477.477 0 0 1-.24-.413V4.538c0-.043.006-.085.017-.125.004-.014.012-.027.017-.04.009-.025.017-.051.03-.074.01-.016.022-.028.033-.043.014-.019.026-.038.042-.055.014-.014.032-.024.048-.036.017-.014.032-.03.052-.041L6.833.825a.478.478 0 0 1 .477 0l5.73 3.299h.001c.019.012.035.027.052.04.016.013.033.023.047.036.017.018.029.037.043.056.01.015.024.027.032.043.014.024.021.049.031.074.005.013.013.026.017.04.01.04.016.083.016.125v12.257l4.775-2.749V7.78a.47.47 0 0 1 .017-.124c.004-.014.011-.027.016-.04.01-.026.018-.051.031-.074.01-.016.022-.029.033-.043.014-.019.026-.039.042-.055.014-.014.031-.024.047-.036.018-.014.033-.03.052-.041l5.731-3.299a.478.478 0 0 1 .477 0l5.73 3.299c.02.012.035.027.053.04.015.012.033.023.046.036.017.017.029.037.043.056.011.014.024.027.032.043.014.023.022.048.031.073.006.014.014.027.017.041Zm-.938 6.39v-5.44l-2.005 1.155-2.77 1.595v5.44l4.775-2.75Zm-5.73 9.84v-5.443L21.06 20l-7.78 4.44v5.496l10.505-6.048ZM1.82 5.365v18.523l10.504 6.047V24.44l-5.488-3.105-.002-.001-.002-.002c-.018-.01-.034-.026-.051-.039-.015-.012-.032-.021-.046-.034v-.002c-.016-.015-.027-.034-.04-.05-.012-.016-.026-.03-.036-.047v-.002c-.011-.018-.018-.039-.026-.06-.007-.017-.017-.034-.022-.053-.006-.023-.007-.047-.01-.07-.002-.018-.007-.036-.007-.054V8.113l-2.77-1.596L1.82 5.364ZM7.072 1.79 2.298 4.538l4.773 2.748 4.773-2.749L7.071 1.79h.001Zm2.483 17.15 2.77-1.595V5.364l-2.006 1.154-2.77 1.595v11.981l2.006-1.155ZM24.262 5.032 19.488 7.78l4.774 2.747 4.772-2.748-4.772-2.747Zm-.478 6.322-2.77-1.594-2.005-1.155v5.44l2.77 1.595 2.005 1.154v-5.44Zm-10.983 12.26 7.001-3.998 3.5-1.997-4.77-2.746-5.492 3.161-5.005 2.882 4.766 2.697Z"
                                clip-rule="evenodd" />

                        </svg>

                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">Laravel
                        </h3>
                        <p class="font-interTight font-regular text-lg text-neutral-400">Powering the API for secure
                            and efficient data communication.</p>
                    </div>
                </div>
            </div>
            <div
                class="col-span-12 md:col-span-3 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-[52px] w-[52px] rounded-lg bg-neutral-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="32" fill="none"
                            viewBox="0 0 26 32">
                            <path fill="#1B1B1B"
                                d="M8.324 19.779c-.948-.746-1.96-1.461-2.651-2.468-1.455-1.777-2.575-3.833-3.341-5.994-.463-1.406-.622-2.913-1.219-4.264C.49 6.072 1.221 5 2.296 4.688c.478-.092 1.32-.544.304-.22-.911.667-.999-.607-.065-.688.637-.085.872-.606.654-1.076-.685-.446 1.658-.936.48-1.602-1.228-1.325 1.717-1.58.99-.075C4.485 2.184 6.718.815 6.2 2.151c.527.642 1.972.146 1.936 1.046.767.053 1.03.698 1.75.748.746.337 2.098.602 2.352 1.443-.74.585-2.454-1.21-2.536.411.224 2.397.166 4.865 1.043 7.147.414 1.382 1.42 2.47 2.328 3.545.868 1.054 2.045 1.796 3.245 2.421 1.052.496 2.186.825 3.332 1.032.465-.356 1.286-1.678 2.011-1.121.035.627-1.439 1.31-.069 1.24.805-.242 1.363.623 2.026-.158.61.724 2.537-.461 2.103 1.017-.587.379-1.444.15-2.033.671-.97-.484-1.742.434-2.816.318-1.192.213-2.406.3-3.615.301-1.984-.156-4.01-.222-5.896-.913-1.064-.31-2.101-.915-3.036-1.52Zm1.676.726c1.038.449 2.053.922 3.19 1.065 1.806.25 3.67.637 5.481.285-.82-.37-1.668.144-2.484-.265-.98.21-2.03-.054-3.027-.184-1.132-.505-2.354-.851-3.415-1.506-1.325-.484.685.62 1.043.71.828.47-.91-.24-1.156-.436-.694-.39-.782-.308-.069.087.144.084.286.172.437.244ZM8.024 19.11c1.006.373-.004-.707-.465-.645-.204-.354-.78-.578-.374-.768-.73.254-.765-.965-1.109-.79-.773-.245-.3-1.11-1.222-1.641-.084-.56-.916-1.046-1.18-1.89-.117-.432-.94-1.673-.435-.518.43 1.112 1.187 2.065 1.816 3.016.489.905 1.066 1.852 1.956 2.417.3.288.59.729 1.013.82Zm-2.897-3.182c.183.329.034-.152 0 0Zm4.102 3.629c.223-.1-.32-.126 0 0Zm.546.199c-.056-.275-.25.154 0 0Zm.684.285c.325-.31-.502-.196 0 0Zm1.171.653c.198-.292-.633-.11 0 0Zm-2.25-1.569c.506-.326-.652-.004 0 0Zm.513.256c-.014-.172-.182.078 0 0Zm2.563 1.6c.412.26 2.406.57 1.158.107-.21.043-2.316-.596-1.158-.107ZM8.388 17.81c-.04-.173-.64-.192 0 0Zm1.193.696c.31-.217-.645-.168 0 0Zm1.003.615c.446-.168-.722-.169 0 0Zm-2.682-1.84c.483.371 1.95.048.74-.22-.55-.294-1.79-.495-.945.176l.205.044Zm3.362 2.052c.202-.343-.845-.196 0 0Zm-1.021-.811c1.181.334-.994-.748-.292-.124l.156.07.136.054Zm2.048 1.183c1.119.011-1.012-.154 0 0Zm-4.82-3.071c-.043-.209-.275.017 0 0Zm6.713 4.133c.03-.376-.365.281 0 0Zm-4.802-2.963c-.068-.199-.35-.009 0 0Zm-1.804-1.3c.642-.04-.88-.284 0 0ZM5.44 15.122c-.08-.309-.699-.554 0 0Zm5.612 3.56c-.056.03-.118-.134 0 0Zm3.492 2.144c-.01-.205-.19.078 0 0Zm-3.801-2.463c.063-.264-.549-.08 0 0ZM8.14 16.715c.478-.05-.767-.323 0 0Zm4.4 2.735c.746-.295-.725-.144 0 0Zm-2.288-1.554c.858.11-1.022-.584-.19-.062l.19.062Zm2.984 1.835c.802-.479.537 1.123 1.36.136.812-.593-.7.732.3.105.723-.484 1.792.23 2.466.462.486-.024.958.42 1.456.15.957-.258-1.874-.383-1.132-.84-.876.255-1.524-.304-1.955-.866-.983-.227-2.12-.73-2.61-1.6-.201-.326.288.047-.174-.488-.592-.526-.888-1.125-1.285-1.765-.475-.254-.531-1-.579-.025.004-.615-.574-1.03-.715-.857-.002-.593.618-.296.184-.734-.093-.614-.401-1.253-.494-1.947-.143-.334-.02-1.05-.49-.293-.172.8-.057-.982.21-.395.35-.599-.127-.528-.146-.446.228-.505.145-1.223-.06-.95.122-.535.193-1.972-.18-1.717.226-.561.429-2.566-.555-1.801-.398.005-1.088.144-1.414.306 1.022.564-.103.204-.52.114-.053.522-.465.296-.98.301.822.102-.401.842-.872.555-.614.292.528 1.024.012 1.25.063.34-.94-.123-.86.664-.596-.25-.082.934.215.533 1.012.274.713.898.738 1.491-.165.346-.814-.812-.144-.758-.529-.858-.585-.31-1.024.088-.101.029 1.12.567.353.833.675.104.694.695.832 1.068.405.422.321-.466.807.041-.308-.452-1.626-1.274-.564-1.01-.006-.455-.193-.822.133-.813.323-.583-.338 1.438.389.697.2-.088.25-.584.612.047.525.517.19.89-.55.417.132.45.99.61.828 1.313.171.618.41.39.619.355.163.6.256.159.264-.127.748.16.573.603.808.912.515.232-.739-1.578.147-.545.931.842.35 1.193-.487 1.058.53-.043.7.716 1.362.689.603.287 1.012 1.39-.028.93-.36-.325-1.639-.726-.595-.107.963.446 1.729.713 2.658 1.273.665.475.952 1.018 1.204 1.126-.559.267-1.684-.213-.849-.36-.521-.095-1.107-.359-.608.29.425.355 1.504.318 1.698.358-.164.361-.446.39.006.418-.504.269.163.31.209.464Zm-1.032-2.913c-.307-.322-.386-.923-.054-.4.17.069.545.983.054.4Zm3.36 2.134c.192-.013.006.146 0 0ZM11.72 16.03c.11.375-.012-.485 0 0Zm-.334-.449c.486.211-.387-.746 0 0Zm-4.048-2.793c.227-.06.112.388 0 0Zm3.222 1.746c.163.439.139-.524 0 0ZM8.285 12.95c.335.271-.16-.289 0 0Zm1.953.626c-.366-.82.259-.448.08.134l-.08-.134ZM6.87 11.331c-.164-.269-.434-1.057-.347-1.298.078.392.834 1.688.37.536-.512-.964.613.313.729.554.054.24-.317-.065-.066.496-.457-.639-.27.353-.686-.288Zm-1.04-.717c.237.429.042-.625 0 0Zm.467.161c.379.658.224-.472 0 0Zm-1.126-.87c-.387-.386-.668-.741.018-.24.264.01-.587-.807.064-.26.684.125.338 1.123-.082.5Zm.592-.016c.225-.223.12.22 0 0Zm.364.116c.414.269-.342-.639 0 0Zm-.724-.691c-1.126-1.003 1.415.524.184.186l-.184-.186Zm3.228 1.875c-.488-.292-.13-2.058.037-.85.474-.154-.026.623.327.616-.055.49-.214.666-.364.234Zm1.194.706c.1.364.047-.532 0 0Zm-.208-.206c.054-.227.006.268 0 0ZM5.624 8.984c-.724-.998 2.103 1.01.464.254-.172-.046-.378-.062-.464-.254Zm2.299 1.22c.153.138-.069-.842 0 0Zm1.745 1.119c.135-.479.01.317 0 0Zm-3.933-2.72c.43-.092 1.782.755.54.242-.137-.153-.432-.083-.54-.242Zm3.693 1.841c.046-.86.258-.513.002.123l-.002-.123Zm-3.373-2.14c.176-.257-.466-1.162.092-.325.241.192.698.321.295.402.634.559-.155.151-.387-.077Zm3.19 1.872c.122-.98.108.573 0 0ZM5.69 7.399c.134-.057.07.18 0 0Zm.832.496c.395.501.215-.45 0 0ZM8.87 9.2c.044.25-.002-.173 0 0Zm-.137-.3c.303.425-.326-.804 0 0Zm-.2-.528c.186.418-.055-.332 0 0Zm.326-.529c-.224-.393.282-1.736.339-.903-.236.648-.068 1.01.096.14.304-.684-.066 1.352-.435.763Zm.334-1.996c.098-.12.022.144 0 0Zm-.559 11.011c.017.073-.132-.115 0 0Zm1.151.582c.64.165.638-.1.059-.178-.311-.29-1.294-.596-.414-.035.058.147.242.143.355.213Zm-2.273-1.51c.353.264 1.329.746.503.1.278-.323-.533-.495-.264-.712-.685-.42-.541-.382-.06-.368-.824-.369.118-.34.074-.53-.318-.062-1.577-.56-.836.041-.753-.383-.18.143-.407.088-.77-.21.686.586-.122.389.441.35 1.189.896.186.37-.131.19.718.478.926.622Zm1.204.692c1.464.472-.718-.577 0 0Zm6.163 3.734c.02-.29-.2.248 0 0Zm.634.266c.337-.327.014.522.56-.08.005-.43-.017-.685-.628-.162-.168.094-.243.49.068.242ZM5.457 14.307c-.103-.407-.727-.406 0 0Zm.676.444c-.25-.417-.896-.378 0 0Zm3.849 2.32c.376.334 1.725.245.456.042-.188-.278-1.193-.212-.456-.042Zm5.29 3.268c.578-.486-.56.216 0 0Zm1.202.826c.004-.156-.249.068 0 0Zm.002-.218c.64-.678-.62.04 0 0ZM3.793 12.914c-.545-.778-.339-1.128-.865-1.764-.1-.486-.903-1.59-.415-.421.446.684.578 1.742 1.28 2.185Zm12.482 7.817c1.179-.761-.483-.331 0 0Zm.9.352c.59-.506-.374-.105 0 0ZM5.257 13.447c.169-.252-.436-.033 0 0Zm11.73 7.396c.571-.368-.132-.312-.104.034l.104-.034Zm-7.752-4.886c-.02-.25-.302.021 0 0Zm.479.276c-.153-.308-.234.048 0 0Zm8.19 4.859c.731-.528-.444-.102-.154.1l.153-.1Zm-.281-.136c.597-.5-.63.221 0 0Zm1.432.954c.4-.268-.486-.087 0 0ZM5.624 13.265c.536.12 2.144 1.321 1.196.084-.486-.144-.195-1.332-.69-1.122.332.556.273.792-.425.442-.877-.428-.493.212-.322.39-.234.053.31.202.24.206Zm-2.444-1.93c.096-.397-.885-2.185-.463-.896.152.27.136.782.463.896Zm4.486 2.766c-.013-.033-.277-.23 0 0Zm.68.159c0-.421-.752-.171 0 0Zm5.896 3.716c-.113-.288-.445-.007 0 0Zm.283.206c-.042-.16-.164.032 0 0Zm2.337 1.473c.224-.166-.28-.022 0 0ZM4.4 11.647c.643-.249-.689-.178 0 0Zm9.323 5.873c-.008-.416-.41.103 0 0Zm-9.577-6.465c.413-.14-.382-.092 0 0Zm1.199.58c-.007-.136-.127.053 0 0ZM19.964 20.6c.53-.108 1.74.27 1.936-.14-.645-.017-2.23-.456-2.305.104l.14.022.229.014ZM5.726 11.731c.01-.421-.33-.015 0 0ZM2.575 9.545c-.143-.803-.545-.121 0 0Zm.751.19c.01-.259-.688-.233 0 0Zm.43.21c-.097.127-.125-.1 0 0Zm2.702 1.734c.127-.117-.302-.087 0 0ZM3.47 9.469c-.073-.606-.871-.09 0 0Zm-1.541-1c-.022-.279-.15.106 0 0Zm.23-.172c-.038-.332-.198.042 0 0Zm1.265.755c.535-.21-.975-.435-.11-.039l.11.04ZM20.37 19.52c.343-.314-.435-.097 0 0Zm2.047 1.06c.138-.405-.346.054 0 0ZM3.554 8.39c.056-.394-.425.077 0 0ZM1.752 7.181c-.097-.555-.084-1.528.842-1.2-1.235.246.855 1.536.591.517.52.026 1.017-.307.744.198 1.024-.113 1.733-1 2.722-.876.77-.102 1.612-.18 2.442-.49.683-.049 1.34-.783.966-1.22-.93-.078-1.905.038-2.933.243-1.14.237-2.176.687-3.326.88-1.12.151.226.415-.096.474-.584.203.698.34-.075.554-.478-.09-.975-.255-.771-.759-1.074.14-2.018.586-1.17 1.678h.064ZM4.34 5.864c.251-.927 1.348.763.412.123-.111-.084-.296-.152-.412-.123Zm.049-.45c.363-.27.192.152 0 0Zm.46.008c.034-.427 1.057.226.17.153l-.17-.153Zm.632-.254c.23-.27.067.24 0 0Zm.161-.108c.384-.46 2.174-.294.864-.045-.351-.265-.62.156-.864.045Zm2.336-.36c1.16.447-.058-1.26 0 0Zm.663-.004c.242-.634.94-.255.112-.127.018.068-.025.328-.112.127ZM3.292 8.063c.724-.443-.768-.384 0 0Zm.536.149c.254-.27-.552-.11 0 0ZM2.25 7.092c.413-.317-.49-.12 0 0Zm21.375 13.373c.012-.369-.317.166 0 0Zm-2.172-1.482c.061-.425-.28.037 0 0Zm2.769 1.625c.578.002 1.752-.18.494-.18-.198.031-1.15.025-.494.18ZM4.298 7.951c.469-.031.733-.515-.09-.488-1.276-.132 1.125.437-.164.274-.173.115.244.246.254.214Zm.413.21c-.05-.301-.146.159 0 0ZM5.2 6.855c.203-.252-.282-.067 0 0ZM3.643 4.254c.835-.283 1.978-.603 2.372.14-.401-.482-.162-.958.217-.252.536.715.804-.325.456-.564.397.493.849.727.266.03.634-.762-1.27.1-1.702.092-.207.093-2.148.495-1.61.554Zm.49-.937c.476-.36 1.647.214.896-.358-.074-.064-1.646.434-.897.358Zm1.736.072c.558.014-.24-.75.424-.404-.109-.356-.773-.422-1.098-.565-.184.326.373.973.674.969ZM4.437 1.812c.193-.261-.338.133 0 0Zm.71.17c.899-.12-.23-.387-.181-.01l.18.01ZM3.82.945c-.632-.826 1.19.139.547-.726-.54-.43-1.06.485-.547.726Zm8.12 4.373c.29-.514-1.198-.693-.196-.182.092.03.071.217.195.182ZM6.049 24.461c-.064.254-.104.68-.119 1.276 0 .117-.053.176-.159.176-.105 0-.18-.051-.22-.153-.114-.276-.222-.469-.324-.579a.778.778 0 0 0-.482-.232c-.216-.034-.752-.051-1.61-.051-.197 0-.326.02-.386.063-.038.026-.057.083-.057.17v2.568c0 .087.055.129.165.125a30.48 30.48 0 0 0 1.463-.068c.124-.015.209-.056.252-.122.044-.066.086-.237.128-.513.026-.151.115-.21.266-.176.129.027.184.085.165.176-.106.514-.14 1.183-.103 2.007.004.098-.058.151-.187.16-.106.01-.172-.046-.198-.171-.098-.473-.28-.725-.547-.757-.267-.032-.7-.048-1.302-.048-.068 0-.102.024-.102.073v2.552c0 .189.07.318.21.386.11.056.346.107.709.153.185.019.266.1.244.244-.023.124-.19.174-.5.147-.895-.072-1.634-.068-2.216.012-.163.022-.244-.044-.244-.199 0-.098.08-.155.244-.17.37-.042.555-.367.555-.975V25.68c0-.249-.044-.44-.133-.575-.089-.134-.254-.256-.496-.366-.151-.068-.208-.16-.17-.278.019-.071.05-.111.09-.119.038-.011.139-.004.3.023.24.038.8.057 1.685.057 1.044 0 1.945-.023 2.705-.068.253-.016.38.005.38.062 0 .015-.002.03-.006.045Zm3.677 7.199c0 .15-.085.217-.255.198-.521-.05-1.168-.042-1.939.023-.155.015-.25.011-.286-.011-.036-.023-.054-.085-.054-.188 0-.09.103-.167.309-.23.206-.062.309-.248.309-.558v-5.132c0-.306-.045-.53-.133-.675-.09-.143-.245-.255-.468-.334-.117-.042-.176-.1-.176-.176 0-.113.085-.198.255-.255.257-.083.524-.212.8-.386.227-.136.37-.204.43-.204.14 0 .21.096.21.29l-.022.567c-.011.374-.015.742-.011 1.105l.022 5.064c0 .23.057.398.17.502.114.104.308.173.584.207.17.019.255.083.255.193Zm5.129-.335c0 .08-.145.2-.434.36-.289.16-.52.241-.694.241-.148 0-.278-.071-.392-.215-.113-.144-.193-.215-.238-.215-.034 0-.213.077-.539.232a2.259 2.259 0 0 1-.98.233c-.31 0-.57-.091-.777-.272-.227-.201-.34-.473-.34-.817 0-.654.748-1.123 2.245-1.407.257-.049.388-.153.391-.311l.012-.363c.022-.62-.252-.93-.823-.93-.162 0-.316.145-.462.436-.145.292-.354.448-.627.471-.31.03-.465-.1-.465-.391 0-.182.231-.393.692-.636.484-.253.95-.38 1.396-.38.767 0 1.147.366 1.14 1.095l-.024 2.336c-.003.246.1.369.312.369.042 0 .121-.01.238-.029a2.79 2.79 0 0 1 .205-.028c.11 0 .164.074.164.221Zm-1.746-1.292c.004-.095-.019-.158-.066-.188s-.121-.036-.223-.017c-.912.163-1.367.46-1.367.89 0 .435.236.653.709.653.188 0 .383-.036.583-.108.235-.083.352-.183.352-.3l.012-.93Zm5.961.64c0 .4-.154.72-.462.956-.308.236-.728.354-1.261.354a5.11 5.11 0 0 1-1.066-.113c-.306-.069-.484-.13-.533-.188-.03-.053-.046-.311-.046-.776 0-.2.046-.305.137-.312.09-.012.168.038.232.147.283.495.741.743 1.372.743.533 0 .8-.185.8-.556a.527.527 0 0 0-.182-.408c-.132-.125-.389-.27-.77-.437-.553-.245-.922-.46-1.107-.646-.2-.197-.3-.461-.3-.794 0-.408.157-.726.47-.953.291-.219.68-.328 1.168-.328.307 0 .586.024.84.073.272.05.414.11.425.182.03.211.093.518.187.918.012.05-.041.09-.159.12-.124.026-.207.005-.25-.063-.298-.488-.676-.732-1.133-.732-.518 0-.777.167-.777.5 0 .185.07.332.21.442.125.094.418.242.879.442.484.208.813.395.987.561.226.216.34.505.34.868Zm6.672.992c0 .133-.09.203-.267.21-.264.004-.61.023-1.037.057-.212.042-.363.015-.454-.08a11.757 11.757 0 0 1-1.52-2.018c-.034-.06-.077-.09-.13-.09-.065 0-.176.056-.335.17-.178.097-.266.237-.266.419 0 .128.003.314.011.556.008.242.068.4.181.476.08.053.263.094.55.125.178.022.267.088.267.198 0 .087-.014.141-.043.162-.028.02-.103.025-.224.014-.378-.034-1.016-.015-1.916.056-.227.02-.35-.01-.369-.085a.436.436 0 0 1-.011-.113c0-.117.115-.206.346-.266.208-.053.312-.297.312-.732v-4.956c0-.31-.03-.525-.091-.646-.083-.155-.257-.276-.522-.363-.124-.042-.187-.1-.187-.176 0-.11.09-.195.267-.255a3.56 3.56 0 0 0 .81-.392c.208-.135.337-.204.386-.204.155 0 .233.099.233.295a144.078 144.078 0 0 0-.012 1.673l.012 3.55c0 .098.026.147.079.147.057 0 .144-.049.261-.147.314-.246.7-.567 1.157-.964.09-.095.136-.17.136-.227 0-.102-.153-.174-.46-.215-.132-.016-.194-.09-.187-.222.011-.132.078-.189.199-.17.272.038.67.059 1.19.063.363.003.725.005 1.084.005.117.004.175.074.175.21 0 .128-.092.199-.277.21a2.088 2.088 0 0 0-.822.198c-.36.163-.744.448-1.152.857a.104.104 0 0 0-.045.085c0 .052.064.18.193.38.472.718.919 1.26 1.338 1.627.268.23.52.346.754.346.174 0 .282.012.323.037.042.024.063.09.063.195Z" />

                        </svg>

                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">Flask
                        </h3>
                        <p class="font-interTight font-regular text-lg text-neutral-400">Running advanced machine
                            learning algorithms for facial recognition.</p>
                    </div>
                </div>
            </div>
            <div
                class="col-span-12 md:col-span-3 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-[52px] w-[52px] rounded-lg bg-neutral-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none"
                            viewBox="0 0 32 32">
                            <path fill="#00546B"
                                d="M25.02 24.927c1.105-.467 2.422-.637 4.12-.595-.047-.317-.654-.695-1.1-.972-.148-.093-.28-.174-.365-.238a37.233 37.233 0 0 0-2.124-1.444c-.232-.142-.567-.26-.89-.375a7.917 7.917 0 0 1-.575-.22c-.17-.069-.401-.138-.651-.213-.594-.178-1.291-.386-1.515-.7-.578-.75-.98-1.659-1.383-2.565a49.534 49.534 0 0 0-.806-1.747c-.263-.552-.528-1.107-.763-1.656-.103-.223-.18-.435-.258-.643-.098-.266-.194-.527-.337-.801a18.842 18.842 0 0 0-6.626-7.263c-.913-.574-1.933-1.105-3.058-1.466-.344-.103-.725-.12-1.11-.136-.328-.015-.659-.029-.972-.097h-.446c-.257-.072-.486-.278-.699-.47a3.568 3.568 0 0 0-.299-.253c-.658-.445-1.317-.743-2.103-1.061-.275-.128-1.06-.425-1.336-.192-.17.043-.255.107-.298.277-.17.254-.02.637.085.87.21.45.477.778.75 1.115.14.172.281.347.418.542l.203.282c.314.434.65.9.86 1.353.294.635.504 1.305.713 1.974.183.584.365 1.167.603 1.722.191.446.488.955.764 1.359.087.118.2.224.314.332.194.183.392.37.472.623.207.345-.172 1.33-.403 1.93-.054.14-.1.258-.128.343-.552 1.741-.446 4.163.191 5.67l.068.162c.233.554.482 1.15 1.1 1.304.02-.02.022-.026.026-.029.005-.003.013-.002.06-.014.03-.244.057-.486.083-.725.099-.904.192-1.76.511-2.482.152-.373.403-.674.647-.967a6.35 6.35 0 0 0 .372-.477c.135.081.184.265.235.453.03.109.059.219.105.312l.06.144c.26.619.538 1.284.854 1.895.7 1.359 1.486 2.676 2.378 3.865.297.425.722.892 1.105 1.274.058.051.118.095.178.137.115.082.226.162.31.288h.043v.064c-.404-.148-.713-.466-1.015-.776a4.79 4.79 0 0 0-.536-.498c-.956-.723-2.102-1.806-2.76-2.846-.208-.447-.428-.882-.65-1.323a134.18 134.18 0 0 1-.222-.44v-.043c-.08.109-.093.217-.108.347a1.78 1.78 0 0 1-.04.248 7.166 7.166 0 0 0-.156.922c-.094.763-.18 1.46-.864 1.733-1.083.446-1.89-.723-2.23-1.253-1.083-1.763-1.38-4.736-.616-7.136.06-.185.1-.383.142-.58.077-.369.153-.736.347-1.013-.043-.255-.19-.387-.333-.517-.07-.064-.141-.127-.198-.205-.297-.404-.552-.87-.786-1.317-.34-.663-.605-1.424-.862-2.162-.081-.232-.161-.46-.242-.684a4.667 4.667 0 0 1-.166-.556 4.14 4.14 0 0 0-.174-.57c-.2-.434-.533-.87-.842-1.273a25.531 25.531 0 0 1-.241-.32c-.083-.118-.192-.255-.314-.409-.6-.752-1.5-1.884-1.024-3.03.892-2.188 4.014-.532 5.224.233.121.078.25.19.382.307.192.17.394.348.595.436.266.01.532.027.797.043.266.016.53.032.796.042l.26.06c.9.209 1.741.404 2.459.81 3.653 2.146 6.031 4.333 8.219 7.944.297.486.5.998.706 1.518.118.3.238.601.377.903a53.668 53.668 0 0 0 1.741 3.695c.078.155.15.315.223.475.186.411.373.825.648 1.16.1.142.32.217.532.29.107.036.211.072.296.114.275.142.573.27.873.4.465.2.936.404 1.336.662 1.232.765 2.421 1.678 3.504 2.612.22.196.4.436.582.675.153.202.305.404.48.578v.192c-.34.106-.68.212-1.02.297-.369.095-.717.132-1.063.17-.35.037-.697.074-1.06.17a77.33 77.33 0 0 0-.14.04c-.418.12-.906.261-1.325.3l.042.042c.205.583 1.075 1.084 1.789 1.494.248.143.478.275.654.396a10.073 10.073 0 0 1 2.208 2.145c.106.106.212.207.318.307.107.101.213.203.32.31.071.102.118.22.165.335.049.124.098.245.174.344v.063c-.186-.066-.313-.199-.44-.33a1.795 1.795 0 0 0-.24-.222c-.2-.136-.4-.284-.6-.432a13.992 13.992 0 0 0-.801-.566c-.411-.26-.855-.464-1.301-.67-.43-.197-.862-.396-1.269-.647a19.963 19.963 0 0 1-1.36-.977c-.403-.297-.849-.87-1.104-1.295-.064-.101-.104-.21-.143-.315-.051-.138-.1-.268-.196-.365.031-.301.325-.378.604-.45.094-.025.186-.049.266-.08Z" />
                            <path fill="#00546B"
                                d="M6.607 5.983a3.35 3.35 0 0 1 .87-.106c.068.067.152.124.237.182.13.089.26.178.337.306.047.066.078.132.108.199.038.082.076.165.147.247 0 .51-.148.85-.446 1.062l-.042.043c-.085-.17-.165-.34-.244-.51-.08-.17-.16-.34-.245-.51a3.87 3.87 0 0 0-.274-.328c-.15-.167-.302-.335-.405-.542h-.043v-.043Z" />

                        </svg>

                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">MySQL
                        </h3>
                        <p class="font-interTight font-regular text-lg text-neutral-400">Reliable database management
                            to store and organize attendance data.</p>
                    </div>
                </div>
            </div>
            <div
                class="col-span-12 md:col-span-3 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-[52px] w-[52px] rounded-lg bg-neutral-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="22" fill="none"
                            viewBox="0 0 32 22">
                            <path fill="#3448C5"
                                d="M9.382 9.9a.087.087 0 0 1 .063.026l2.945 2.948a.088.088 0 0 1 .018.094.088.088 0 0 1-.08.054h-.752a.09.09 0 0 0-.09.088v6.627c0 .42.167.821.464 1.118l.44.44a.088.088 0 0 1 .018.094.087.087 0 0 1-.08.055H8.857a1.59 1.59 0 0 1-1.59-1.59V13.11a.088.088 0 0 0-.088-.088h-.742a.088.088 0 0 1-.064-.148L9.32 9.926a.088.088 0 0 1 .062-.026Zm6.513 1.707a.087.087 0 0 1 .063.026l2.947 2.937a.088.088 0 0 1 .018.096.088.088 0 0 1-.081.053h-.753a.09.09 0 0 0-.088.09v4.928c0 .419.166.82.462 1.118l.442.44a.088.088 0 0 1-.063.149h-3.465a1.59 1.59 0 0 1-1.59-1.59v-5.04a.09.09 0 0 0-.088-.09h-.75a.088.088 0 0 1-.084-.104.087.087 0 0 1 .023-.044l2.945-2.943a.087.087 0 0 1 .062-.026Zm6.515 1.689c.022 0 .045.01.06.026l2.948 2.945a.088.088 0 0 1-.06.15h-.756a.087.087 0 0 0-.088.088v3.232c.001.42.168.821.464 1.118l.44.44a.088.088 0 0 1 .018.094.087.087 0 0 1-.079.055h-3.475a1.59 1.59 0 0 1-1.59-1.59v-3.349a.088.088 0 0 0-.088-.087h-.742a.088.088 0 0 1-.082-.055.088.088 0 0 1 .02-.096l2.948-2.945a.087.087 0 0 1 .062-.026ZM15.836.5c4.63.033 8.713 3.04 10.12 7.451A6.942 6.942 0 0 1 32 14.785c0 2.862-1.79 5.24-4.68 6.23l-.107.036-.133.043v-2.137c1.837-.774 2.916-2.303 2.916-4.172a4.912 4.912 0 0 0-4.723-4.89l-.088-.003h-.795l-.191-.759a8.668 8.668 0 0 0-8.363-6.626 8.522 8.522 0 0 0-7.697 4.778l-.295.608-.557.058a5.908 5.908 0 0 0-2.554 10.853l.091.058v2.253h-.013l-.199-.09A7.92 7.92 0 0 1 6.524 6.032 10.503 10.503 0 0 1 15.836.5Z" />

                        </svg>

                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">
                            Cloudinary</h3>
                        <p class="font-interTight font-regular text-lg text-neutral-400">Seamless image storage and
                            processing for facial recognition data.</p>
                    </div>
                </div>
            </div>
            <div
                class="col-span-12 md:col-span-3 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-[52px] w-[52px] rounded-lg bg-neutral-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="8" fill="none"
                            viewBox="0 0 32 8">
                            <path fill="#111827"
                                d="m1.244 6.974.182-.855.162-.764.036-.17.295-1.405h1.13l.2-.93H2.065a61.168 61.168 0 0 1 .079-.389c.044-.212.124-.37.24-.477.115-.106.275-.16.479-.16.115 0 .23.015.343.042.113.028.22.066.322.116L3.827.99a1.921 1.921 0 0 0-.308-.1A3.34 3.34 0 0 0 2.76.8c-.204 0-.4.024-.587.072a1.49 1.49 0 0 0-.513.244c-.154.115-.288.27-.403.465-.114.196-.201.44-.262.732l-.126.6.013-.063H.198L0 3.78h.686l-.01.047-.054.255-.027.125-.12.568-.087.414c-.071.341-.137.65-.196.927-.06.277-.119.563-.18.858h1.232Z" />
                            <path fill="#111827"
                                d="m1.244 6.974.182-.855.162-.764.036-.17.295-1.405h1.13l.2-.93H2.065a61.168 61.168 0 0 1 .079-.389c.044-.212.124-.37.24-.477.115-.106.275-.16.479-.16.115 0 .23.015.343.042.113.028.22.066.322.116L3.827.99a1.921 1.921 0 0 0-.308-.1A3.34 3.34 0 0 0 2.76.8c-.204 0-.4.024-.587.072a1.49 1.49 0 0 0-.513.244c-.154.115-.288.27-.403.465-.114.196-.201.44-.262.732l-.126.6.013-.063H.198L0 3.78h.686l-.01.047-.054.255-.027.125-.12.568-.087.414c-.071.341-.137.65-.196.927-.06.277-.119.563-.18.858h1.232Zm5.36 0a208.692 208.692 0 0 1 .375-1.79l.484-2.289A426.725 426.725 0 0 1 7.905.808L6.65.916l-.207.987a94.7 94.7 0 0 1-.215.996l-.479 2.29c-.074.341-.14.65-.198.927l-.182.858h1.235ZM4.762 2.842l-.118.299.552.382c.03.02.046.059.042.097l-.002.012-.037.167c-.01.043-.042.073-.08.076l-.488.032.417.286c.03.02.045.059.041.097l-.002.012-.037.168c-.01.042-.042.072-.08.075l-.488.032.417.286c.03.02.046.06.042.098l-.002.011-.038.168c-.009.042-.041.072-.08.075l-.487.032.417.286c.03.02.045.06.041.098l-.002.011-.037.168c-.01.042-.042.072-.08.075l-.488.032.417.287a.1.1 0 0 1 .041.097l-.001.011-.038.168c-.009.042-.041.073-.08.075l-.684.06-.085.359H3.21l.169-.66c.01-.043.042-.073.08-.076l.488-.032-.417-.286a.104.104 0 0 1-.042-.097l.002-.012.037-.167c.01-.043.042-.073.08-.076l.488-.032-.417-.286a.104.104 0 0 1-.041-.098l.002-.011.037-.168c.01-.042.042-.072.08-.075l.488-.032-.417-.286a.104.104 0 0 1-.042-.098l.002-.011.038-.168c.009-.042.041-.072.08-.075l.487-.032-.417-.287a.104.104 0 0 1-.041-.097l.002-.011.037-.168c.01-.042.042-.073.08-.075l.488-.032-.417-.287a.104.104 0 0 1-.041-.097l.001-.011.076-.267.603-.022Zm.42-2.005c.224 0 .39.075.497.225.108.15.14.33.098.54-.049.24-.15.401-.302.485a1.165 1.165 0 0 1-.568.126c-.222 0-.388-.065-.5-.196-.112-.13-.144-.318-.095-.56.046-.22.146-.379.301-.475.155-.097.345-.145.569-.145Zm4.858 1.901c.397 0 .723.066.98.198.255.133.433.32.532.565.1.243.112.533.037.87a31.54 31.54 0 0 1-.086.419l-.095.444-.075.347-.138.653c-.048.229-.101.475-.16.74H9.97l.053-.55h-.095a1.64 1.64 0 0 1-.337.362 1.35 1.35 0 0 1-.861.287 1.09 1.09 0 0 1-.657-.192.993.993 0 0 1-.368-.51 1.307 1.307 0 0 1-.02-.695 1.29 1.29 0 0 1 .2-.483c.092-.13.204-.236.335-.318.13-.083.275-.149.433-.197a3.55 3.55 0 0 1 .494-.11l1.294-.202a.465.465 0 0 0-.031-.324.482.482 0 0 0-.259-.215 1.261 1.261 0 0 0-.475-.076c-.099 0-.204.007-.316.022a3.59 3.59 0 0 0-.35.066 4.453 4.453 0 0 0-.768.259l.194-1.083c.1-.033.213-.065.34-.097a8.01 8.01 0 0 1 .4-.089 4.93 4.93 0 0 1 .864-.091Zm.248 2.186a.928.928 0 0 1-.14.08 1.41 1.41 0 0 1-.228.08 8.217 8.217 0 0 1-.393.092 2.33 2.33 0 0 0-.293.087.578.578 0 0 0-.219.14.464.464 0 0 0-.116.236c-.027.152-.001.27.079.353a.43.43 0 0 0 .326.126c.1 0 .2-.02.3-.064a1.1 1.1 0 0 0 .29-.184c.091-.08.176-.174.253-.285l.14-.66Zm6.007-1.45a.91.91 0 0 0-.264-.496c-.173-.16-.413-.24-.721-.24-.19 0-.373.033-.548.1a1.885 1.885 0 0 0-.857.653H13.8l.087-.703-1.041.062c-.072.344-.142.677-.211.998-.069.32-.134.63-.194.927l-.087.414c-.075.341-.14.65-.199.927-.057.277-.118.563-.181.858h1.235a142.964 142.964 0 0 1 .364-1.723l.178-.856c.088-.102.177-.193.266-.273.09-.08.183-.143.281-.19a.713.713 0 0 1 .312-.07c.193 0 .316.075.37.225.054.15.054.35.002.597l-.12.57a91.59 91.59 0 0 0-.182.869c-.055.27-.114.553-.177.85h1.231a1627.055 1627.055 0 0 0 .38-1.784 83.3 83.3 0 0 1 .182-.86l-.006.027.009-.01c.06-.064.119-.123.18-.179l.044-.04a1.3 1.3 0 0 1 .284-.193.696.696 0 0 1 .311-.072c.193 0 .317.075.37.225.054.15.055.35.002.597l-.12.57a147.278 147.278 0 0 1-.359 1.72h1.236a199.063 199.063 0 0 1 .473-2.248l.085-.397c.104-.482.071-.868-.1-1.157-.17-.29-.467-.434-.888-.434-.19 0-.373.034-.55.101a1.969 1.969 0 0 0-.876.667h-.09l-.007-.032Zm5.342-.736c.433 0 .785.079 1.058.236.273.157.457.377.554.66.096.285.098.615.004.993a5.595 5.595 0 0 1-.124.431l-.02.056h-2.53l-.001.017a.913.913 0 0 0 .07.411.78.78 0 0 0 .39.393c.182.086.405.13.67.13a2.884 2.884 0 0 0 .81-.126c.14-.043.27-.097.388-.164l-.165 1.05a1.396 1.396 0 0 1-.306.124c-.13.039-.28.07-.448.095-.17.025-.352.037-.548.037-.496 0-.91-.095-1.242-.287a1.573 1.573 0 0 1-.702-.816c-.137-.353-.155-.771-.056-1.256.082-.4.223-.748.421-1.046a2.1 2.1 0 0 1 .748-.692c.3-.164.644-.246 1.03-.246Zm.025.872a.836.836 0 0 0-.411.112 1.05 1.05 0 0 0-.358.347 1.495 1.495 0 0 0-.161.332l-.013.036 1.494-.031.005-.036a.836.836 0 0 0-.08-.487c-.094-.182-.253-.273-.476-.273Zm3.114 3.364c.06-.295.12-.578.177-.85l.186-.873.178-.856a2.67 2.67 0 0 1 .27-.273c.093-.08.19-.143.29-.19.1-.046.21-.07.328-.07.218 0 .356.075.414.225.057.15.059.35.004.597l-.12.57a225.021 225.021 0 0 1-.36 1.72h1.236l.184-.858c.059-.276.123-.586.192-.927a45.29 45.29 0 0 0 .186-.86c.102-.482.066-.868-.107-1.157-.174-.29-.484-.434-.93-.434-.196 0-.384.033-.564.1a1.863 1.863 0 0 0-.87.653h-.104l.087-.703-1.041.062-.21 1c-.07.322-.135.63-.195.925l-.087.414a861.956 861.956 0 0 1-.38 1.785h1.236Zm5.465.111c.1 0 .207-.009.323-.026.115-.018.223-.042.324-.07.1-.03.18-.063.237-.102l.133-1.012a1.094 1.094 0 0 1-.612.202c-.2 0-.338-.069-.411-.207-.073-.137-.08-.338-.023-.603l.312-1.488h1.23l.198-.93h-1.231l.008-.038.052-.242.016-.077a131 131 0 0 1 .126-.59c.041-.192.084-.395.128-.61l-1.264.219a437.022 437.022 0 0 0-.273 1.286l-.011.053h-.667l-.198.93h.669l-.005.024-.015.073a46.84 46.84 0 0 1-.127.599l-.113.537-.112.527c-.074.35-.066.64.025.868a.946.946 0 0 0 .47.51c.22.112.492.167.811.167Z" />
                        </svg>

                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">Filament
                        </h3>
                        <p class="font-interTight font-regular text-lg text-neutral-400">Creating a user-friendly and
                            dynamic admin and lecturer dashboard.</p>
                    </div>
                </div>
            </div>
            <div
                class="col-span-12 md:col-span-3 flex flex-col overflow-hidden bg-white rounded-2xl border border-neutral-200 h-full">
                <div class="flex flex-col gap-4 p-4">
                    <div class="flex justify-center items-center gap-[6px] h-[52px] w-[52px] rounded-lg bg-neutral-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="32" fill="none"
                            viewBox="0 0 26 32">
                            <path fill="#FF9100"
                                d="M8.538 30.331a12.13 12.13 0 0 0 4.114.87 12.092 12.092 0 0 0 5.511-1.111 17.164 17.164 0 0 1-5.372-3.373 9.198 9.198 0 0 1-4.253 3.614Z" />
                            <path fill="#FFC400"
                                d="M12.79 26.717a17.125 17.125 0 0 1-5.478-13.711 9.17 9.17 0 0 0-4.786.05A12.086 12.086 0 0 0 .94 18.643c-.183 5.248 2.993 9.834 7.598 11.689a9.19 9.19 0 0 0 4.253-3.615Z" />
                            <path fill="#FF9100"
                                d="M12.79 26.717a9.11 9.11 0 0 0 1.38-4.523c.153-4.375-2.788-8.138-6.858-9.189a17.125 17.125 0 0 0 5.479 13.712Z" />
                            <path fill="#DD2C00"
                                d="M13.715.708A17.12 17.12 0 0 0 7.31 13.006c4.07 1.05 7.011 4.814 6.859 9.189a9.128 9.128 0 0 1-1.38 4.523 17.134 17.134 0 0 0 5.372 3.373A12.137 12.137 0 0 0 25.21 19.49c.107-3.069-1.072-5.804-2.738-8.112C20.71 8.935 13.715.707 13.715.707Z" />

                        </svg>

                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <h3 class="font-interTight font-medium text-[24px] text-neutral-black leading-[29px]">Firebase
                            Cloud Messaging</h3>
                        <p class="font-interTight font-regular text-lg text-neutral-400">Ensuring instant notifications
                            for updates and confirmations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="team"
        class="w-svw bg-white flex flex-col items-center px-5 md:px-[60px] pb-[80px] pt-[80px] md:pb-[80px] overflow-hidden gap-14">
        <div class="flex flex-col items-center">
            <div class="flex flex-col gap-5 items-center">
                <div class="flex items-center gap-[6px] px-2 h-8 rounded-lg bg-purple-100 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                        viewBox="0 0 20 20">
                        <g clip-path="url(#a)">
                            <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8.333 10.833a1.667 1.667 0 1 0 3.334 0 1.667 1.667 0 0 0-3.334 0ZM6.667 17.5v-.833A1.666 1.666 0 0 1 8.333 15h3.334a1.667 1.667 0 0 1 1.666 1.667v.833M12.5 4.167a1.667 1.667 0 1 0 3.333 0 1.667 1.667 0 0 0-3.333 0Zm1.667 4.166h1.666A1.666 1.666 0 0 1 17.5 10v.833M4.167 4.167a1.667 1.667 0 1 0 3.333 0 1.667 1.667 0 0 0-3.333 0ZM2.5 10.833V10a1.667 1.667 0 0 1 1.667-1.667h1.666" />
                        </g>
                        <defs>
                            <clipPath id="a">
                                <path fill="#fff" d="M0 0h20v20H0z" />
                            </clipPath>
                        </defs>
                    </svg>

                    <p class="font-interTight font-medium text-base text-purple-950">
                        Xplore Team
                    </p>
                </div>
                <div class="flex flex-col items-center justify-center gap-[8px] w-full">
                    <h2
                        class="font-interTight font-medium text-[28px] md:text-[44px] text-neutral-black leading-[34px] md:leading-[53px] text-center">
                        The Team Behind Presience</h2>
                    <p class="font-interTight font-regular text-base md:text-xl text-neutral-400 text-center">
                        Transforming the Way You Experience Attendance</p>
                </div>
            </div>
        </div>
        <div class="gap-[44px] flex flex-col w-full h-fit">
            <div class="grid grid-cols-4 h-fit gap-[20px] w-full">
                <div class="md:col-span-1 col-span-4 flex flex-col gap-[20px] ">
                    <div
                        class="overflow-hidden  bg-neutral-100 hover:bg-purple-200  rounded-2xl border border-neutral-200 h-[349px] group-hover:scale-110 object-cover transition ease-in-out duration-500">
                        <img src="{{ asset('assets/images/taufiq.png') }}" alt=""
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-[12px]">
                        <div class="flex flex-col gap-[8px]">
                            <p class="font-interTight font-medium text-[28px] text-neutral-black">
                                Taufiq Hidayatulloh
                            </p>
                            <p class="font-interTight font-regular text-[20px] text-neutral-400">
                                UI/UX Designer - Frontend Engineer
                            </p>
                        </div>
                        <a href="https://www.linkedin.com/in/taufiqhidayatulloh" target="_blank" rel="noopener noreferrer" class="font-interTight font-medium text-[20px] w-fit text-purple-950 hover:text-purple-800">Get In
                            Touch</a>



                    </div>
                </div>
                <div class="md:col-span-1 col-span-4 flex flex-col gap-[20px]">
                    <div
                        class="overflow-hidden  bg-neutral-100 hover:bg-purple-200  rounded-2xl border border-neutral-200 h-[349px] group-hover:scale-110 object-cover transition ease-in-out duration-500">
                        <img src="{{ asset('assets/images/lucky.png') }}" alt=""
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-[12px]">
                        <div class="flex flex-col gap-[8px]">
                            <p class="font-interTight font-medium text-[28px] text-neutral-black">
                                Lucky Kurniawan
                            </p>
                            <p class="font-interTight font-regular text-[20px] text-neutral-400">
                                Frontend Engineer
                            </p>
                        </div>
                        <a href="https://github.com/langodayyy" target="_blank" rel="noopener noreferrer" class="font-interTight font-medium text-[20px] w-fit text-purple-950 hover:text-purple-800">Get In
                            Touch</a>



                    </div>
                </div>
                <div class="md:col-span-1 col-span-4 flex flex-col gap-[20px]">
                    <div
                        class="overflow-hidden  bg-neutral-100 hover:bg-purple-200  rounded-2xl border border-neutral-200 h-[349px] group-hover:scale-110 object-cover transition ease-in-out duration-500">
                        <img src="{{ asset('assets/images/putri.png') }}" alt=""
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-[12px]">
                        <div class="flex flex-col gap-[8px]">
                            <p class="font-interTight font-medium text-[28px] text-neutral-black">
                                Putri Norchasana
                            </p>
                            <p class="font-interTight font-regular text-[20px] text-neutral-400">
                                Backend Engineer
                            </p>
                        </div>
                        <a href="https://github.com/putricha" target="_blank" rel="noopener noreferrer" class="font-interTight font-medium text-[20px] w-fit text-purple-950 hover:text-purple-800">Get In
                            Touch</a>



                    </div>
                </div>
                <div class="md:col-span-1 col-span-4 flex flex-col gap-[20px]">
                    <div
                        class="overflow-hidden  bg-neutral-100 hover:bg-purple-200  rounded-2xl border border-neutral-200 h-[349px] group-hover:scale-110 object-cover transition ease-in-out duration-500">
                        <img src="{{ asset('assets/images/raffy.png') }}" alt=""
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-[12px]">
                        <div class="flex flex-col gap-[8px]">
                            <p class="font-interTight font-medium text-[28px] text-neutral-black">
                                Raffy Jamil Octavialdy
                            </p>
                            <p class="font-interTight font-regular text-[20px] text-neutral-400">
                                Fullstack Engineer
                            </p>
                        </div>
                        <a href="https://www.linkedin.com/in/raffyjo/" target="_blank" rel="noopener noreferrer" class="font-interTight font-medium text-[20px] w-fit text-purple-950 hover:text-purple-800">Get In
                            Touch</a>



                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center w-full">
                <div class="border-t border-neutral-200 flex-grow"></div>
                <span class="font-interTight text-[36px] text-neutral-black px-[24px] font-medium">Our Mentors</span>
                <div class="border-t border-neutral-200 flex-grow"></div>
            </div>
            <div class="grid grid-cols-6 h-fit w-full gap-[20px]">
                <div class="col-span-6 md:col-span-2 h-fit border  border-neutral-200 flex flex-col gap-3 p-4 rounded-2xl">
                    <div class="p-[6px] w-fit rounded-lg bg-purple-100 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            viewBox="0 0 20 20">
                            <g clip-path="url(#a)">
                                <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" d="M2.5 10a7.5 7.5 0 1 0 15 0 7.5 7.5 0 0 0-15 0Z" />
                                <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M7.5 8.334a2.5 2.5 0 1 0 5 0 2.5 2.5 0 0 0-5 0Zm-2.36 7.374a3.334 3.334 0 0 1 3.193-2.374h3.334a3.334 3.334 0 0 1 3.195 2.379" />
                            </g>
                            <defs>
                                <clipPath id="a">
                                    <path fill="#fff" d="M0 0h20v20H0z" />
                                </clipPath>
                            </defs>
                        </svg>

                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-interTight font-medium text-xl text-neutral-black">Atiqah Nurul Asri, S.Pd.,
                            M.Pd.</p>
                        <p class="font-interTight font-regular text-base text-neutral-400">
                            English
                        </p>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-2 h-fit border  border-neutral-200 flex flex-col gap-3 p-4 rounded-2xl">
                    <div class="p-[6px] w-fit rounded-lg bg-purple-100 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            viewBox="0 0 20 20">
                            <g clip-path="url(#a)">
                                <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" d="M2.5 10a7.5 7.5 0 1 0 15 0 7.5 7.5 0 0 0-15 0Z" />
                                <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M7.5 8.334a2.5 2.5 0 1 0 5 0 2.5 2.5 0 0 0-5 0Zm-2.36 7.374a3.334 3.334 0 0 1 3.193-2.374h3.334a3.334 3.334 0 0 1 3.195 2.379" />
                            </g>
                            <defs>
                                <clipPath id="a">
                                    <path fill="#fff" d="M0 0h20v20H0z" />
                                </clipPath>
                            </defs>
                        </svg>

                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-interTight font-medium text-xl text-neutral-black">Amalia Agung
                            Septarina.S.S.M.Tr.TT..</p>
                        <p class="font-interTight font-regular text-base text-neutral-400">
                            Machile Learning
                        </p>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-2 h-fit border  border-neutral-200 flex flex-col gap-3 p-4 rounded-2xl">
                    <div class="p-[6px] w-fit rounded-lg bg-purple-100 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            viewBox="0 0 20 20">
                            <g clip-path="url(#a)">
                                <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" d="M2.5 10a7.5 7.5 0 1 0 15 0 7.5 7.5 0 0 0-15 0Z" />
                                <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M7.5 8.334a2.5 2.5 0 1 0 5 0 2.5 2.5 0 0 0-5 0Zm-2.36 7.374a3.334 3.334 0 0 1 3.193-2.374h3.334a3.334 3.334 0 0 1 3.195 2.379" />
                            </g>
                            <defs>
                                <clipPath id="a">
                                    <path fill="#fff" d="M0 0h20v20H0z" />
                                </clipPath>
                            </defs>
                        </svg>

                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-interTight font-medium text-xl text-neutral-black">Dian Hanifudin Subhi, S.Kom.,
                            M.Kom.</p>
                        <p class="font-interTight font-regular text-base text-neutral-400">
                            Mobile Programing
                        </p>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 h-fit border  border-neutral-200 flex flex-col gap-3 p-4 rounded-2xl">
                    <div class="p-[6px] w-fit rounded-lg bg-purple-100 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            viewBox="0 0 20 20">
                            <g clip-path="url(#a)">
                                <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" d="M2.5 10a7.5 7.5 0 1 0 15 0 7.5 7.5 0 0 0-15 0Z" />
                                <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M7.5 8.334a2.5 2.5 0 1 0 5 0 2.5 2.5 0 0 0-5 0Zm-2.36 7.374a3.334 3.334 0 0 1 3.193-2.374h3.334a3.334 3.334 0 0 1 3.195 2.379" />
                            </g>
                            <defs>
                                <clipPath id="a">
                                    <path fill="#fff" d="M0 0h20v20H0z" />
                                </clipPath>
                            </defs>
                        </svg>

                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-interTight font-medium text-xl text-neutral-black">Dr. Eng. Rosa Andrie Asmara,
                            S.T., M.T.</p>
                        <p class="font-interTight font-regular text-base text-neutral-400">
                            Image Processing and Computer Vision
                        </p>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 h-fit border  border-neutral-200 flex flex-col gap-3 p-4 rounded-2xl">
                    <div class="p-[6px] w-fit rounded-lg bg-purple-100 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            viewBox="0 0 20 20">
                            <g clip-path="url(#a)">
                                <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" d="M2.5 10a7.5 7.5 0 1 0 15 0 7.5 7.5 0 0 0-15 0Z" />
                                <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M7.5 8.334a2.5 2.5 0 1 0 5 0 2.5 2.5 0 0 0-5 0Zm-2.36 7.374a3.334 3.334 0 0 1 3.193-2.374h3.334a3.334 3.334 0 0 1 3.195 2.379" />
                            </g>
                            <defs>
                                <clipPath id="a">
                                    <path fill="#fff" d="M0 0h20v20H0z" />
                                </clipPath>
                            </defs>
                        </svg>

                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-interTight font-medium text-xl text-neutral-black">Yuri Ariyanto, S.Kom., M.Kom.
                        </p>
                        <p class="font-interTight font-regular text-base text-neutral-400">
                            Network Security Administration
                        </p>
                    </div>
                </div>

            </div>
        </div>


    </section>
    <section id="download" class="w-svw bg-cover bg-center flex flex-col items-center overflow-hidden gap-14"
        style="background-image: url('../assets/images/bg.png')">
        <div class="flex flex-col gap-[32px] items-center">
            <div class="flex flex-col gap-10 items-center w-full px-5 md:px-[60px] pt-[80px]">
                <div class="flex flex-col gap-5 items-center">
                    <div class="flex items-center gap-[6px] px-2 h-8 rounded-lg bg-purple-100 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none"
                            viewBox="0 0 21 20">
                            <path stroke="#2B2464" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3.333 14.166v1.667A1.667 1.667 0 0 0 5 17.5h10a1.667 1.667 0 0 0 1.667-1.667v-1.667m-10.834-5L10 13.333l4.167-4.167M10 3.333v10" />
                        </svg>
                        <p class="font-interTight font-medium text-base text-purple-950">
                            Download Presience
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center gap-2 w-full">
                        <h2
                            class="font-interTight font-medium text-[40px] md:text-[52px] text-neutral-black leading-[48px] md:leading-[63px] text-center">
                            Start Simplifying Attendance Today</h2>
                        <p class="font-interTight font-regular text-base md:text-xl text-neutral-black text-center">
                            Experience the convenience of face recognition-powered attendance right from your mobile
                            device</p>
                    </div>
                </div>
                <a href="{{ asset('apk/presience.apk') }}" download="presience.apk"
                    class="flex items-center px-5 h-[52px] rounded-xl bg-purple-950 text-white hover:bg-purple-900 active:bg-purple-950 font-interTight font-medium text-base">
                    Download App
                </a>
            </div>
            <div class="flex flex-col items-center justify-ce w-full h-[245px] md:h-[330px] overflow-hidden">
                <img src="{{ asset('assets/images/Download App Image Content.png') }}" alt=""
                    class="w-[650px] md:w-[1110px]">
            </div>
        </div>
    </section>

    <footer class="flex flex-col md:flex-row gap-6 items-center bg-white px-5 py-5 md:py-0 md:px-[60px] h-fit md:h-20">
        <svg xmlns="http://www.w3.org/2000/svg" width="125" height="28" fill="none" viewBox="0 0 125 28"
            class="hidden md:block">
            <path fill="#2B2464"
                d="M12.8 1.2C5.73 1.2 0 6.93 0 14s5.73 12.8 12.8 12.8c6.342 0 11.607-4.613 12.623-10.666h-.092a8.533 8.533 0 1 1 0-4.267h.092C24.408 5.813 19.143 1.2 12.8 1.2Z" />
            <path fill="#C7CFFE"
                d="M0 14c0 7.07 5.73 12.8 12.8 12.8 6.342 0 11.607-4.613 12.623-10.666h-8.625A8.533 8.533 0 0 1 0 14Z" />
            <path fill="#2B2464"
                d="M38.787 16.811h-2.885V22H33.62V7.098h5.168c3.342 0 5.5 1.702 5.5 4.815 0 3.134-2.158 4.898-5.5 4.898Zm-.02-7.783h-2.865v5.853h2.864c2.014 0 3.238-1.1 3.238-2.947 0-1.848-1.224-2.906-3.238-2.906Zm9.319 7.347V22H45.99V11h1.95v2.324c.769-1.515 2.429-2.47 4.235-2.47v2.18c-2.366-.125-4.09.913-4.09 3.341Zm9.817 5.833c-3.176 0-5.314-2.304-5.314-5.77 0-3.259 2.221-5.646 5.251-5.646 3.28 0 5.459 2.657 5.085 6.227h-8.198c.166 2.241 1.287 3.549 3.134 3.549 1.557 0 2.636-.851 2.989-2.283h2.075c-.54 2.449-2.428 3.923-5.022 3.923Zm-.104-9.838c-1.681 0-2.823 1.203-3.051 3.258h5.957c-.104-2.034-1.204-3.258-2.906-3.258Zm15.657 6.35c0 2.16-1.68 3.488-4.607 3.488-2.906 0-4.629-1.433-4.836-3.799h2.013c.083 1.37 1.183 2.221 2.864 2.221 1.474 0 2.45-.519 2.45-1.556 0-.914-.561-1.308-1.931-1.578l-1.785-.332c-2.034-.394-3.175-1.432-3.175-3.093 0-1.93 1.68-3.279 4.234-3.279 2.635 0 4.42 1.412 4.607 3.674h-2.013c-.124-1.329-1.1-2.096-2.574-2.096-1.328 0-2.22.56-2.22 1.515 0 .892.56 1.307 1.888 1.556l1.868.353c2.18.395 3.217 1.35 3.217 2.927Zm4.427-10.273c0 .788-.623 1.39-1.515 1.39-.893 0-1.536-.602-1.536-1.39 0-.81.643-1.39 1.536-1.39.892 0 1.515.58 1.515 1.39ZM77.426 22H75.33V11h2.096v11Zm7.02.208c-3.176 0-5.313-2.304-5.313-5.77 0-3.259 2.22-5.646 5.25-5.646 3.28 0 5.46 2.657 5.086 6.227H81.27c.166 2.241 1.287 3.549 3.134 3.549 1.557 0 2.636-.851 2.99-2.283h2.075c-.54 2.449-2.429 3.923-5.023 3.923Zm-.104-9.838c-1.681 0-2.823 1.203-3.05 3.258h5.956c-.104-2.034-1.204-3.258-2.906-3.258Zm9.037 3.424V22h-2.097V11h1.951v1.826c.748-1.224 1.993-2.034 3.508-2.034 2.262 0 3.757 1.453 3.757 4.089V22h-2.097v-6.413c0-1.89-.83-2.948-2.386-2.948-1.433 0-2.636 1.204-2.636 3.155Zm13.825 6.434c-3.009 0-5.126-2.366-5.126-5.728 0-3.321 2.158-5.708 5.126-5.708 2.719 0 4.691 1.806 5.085 4.67h-2.2c-.228-1.764-1.328-2.823-2.864-2.823-1.806 0-2.989 1.536-2.989 3.86 0 2.346 1.183 3.861 2.989 3.861 1.557 0 2.636-1.037 2.885-2.822h2.179c-.373 2.905-2.324 4.69-5.085 4.69Zm11.204-.02c-3.176 0-5.314-2.304-5.314-5.77 0-3.259 2.221-5.646 5.251-5.646 3.28 0 5.459 2.657 5.085 6.227h-8.198c.166 2.241 1.287 3.549 3.134 3.549 1.557 0 2.636-.851 2.989-2.283h2.075c-.539 2.449-2.428 3.923-5.022 3.923Zm-.104-9.838c-1.681 0-2.823 1.203-3.051 3.258h5.957c-.104-2.034-1.204-3.258-2.906-3.258Z" />
        </svg>
        <hr class="bg-neutral-200 md:flex-grow hidden md:flex">
        </hr>
        <p class="font-interTight font-medium text-base text-neutral-200">
            &copy;XploreTeam2024
        </p>
    </footer>

</body>
<!-- JavaScript -->
{{-- navbar --}}
{{-- navbar responsive --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.querySelector('[data-collapse-toggle]');
        const navbarMenu = document.querySelector('#navbar-menu');

        if (toggleButton && navbarMenu) {
            toggleButton.addEventListener('click', () => {
                navbarMenu.classList.toggle('hidden');
                navbarMenu.classList.toggle('absolute');
            });
        }
    });
</script>

<!-- Smooth Scroll -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil elemen navbar
        const navbar = document.querySelector("nav");

        // Fungsi untuk menambahkan background pada navbar saat discroll
        window.addEventListener("scroll", function() {
            console.log(navbar);

            if (window.scrollY > 50) { // Threshold scroll
                navbar.classList.add("bg-white");
            } else {
                navbar.classList.remove("bg-white");
            }
        });
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
                        nav.classList.add("text-neutral-400"); // Kembalikan warna default
                        nav.classList.remove("font-medium");
                        nav.classList.add("font-regular"); // Kembalikan warna default
                    });
                    this.classList.add("text-purple-950"); // Beri warna active
                    this.classList.add("font-medium");
                    this.classList.remove("text-neutral-400");
                }
            });
        });
    });
</script>

</html>
