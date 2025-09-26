<x-layouts.app.welcome :title="$title ?? null">
    <section class="h-screen w-full bg-white dark:bg-gray-900">
        <div class="h-full w-full pr-0 pl-4 lg:py-0">
            <div class="mb-6 -ml-4 bg-orange-500 py-4 lg:mb-0 lg:hidden">
                <img src="{{ asset('images/splash.svg') }}" class="h-40 w-full object-contain" alt="Splash" />
            </div>
            <div class="grid h-full items-start gap-8 lg:mb-0 lg:grid-cols-12 lg:items-center lg:gap-0">
                <div class="col-span-6 pr-4 text-center sm:mb-6 lg:mb-0 lg:pl-8 lg:text-left xl:pl-16">
                    @if (Route::has('login'))
                        <a
                            href="{{ route('login') }}"
                            class="mb-6 inline-flex items-center justify-between rounded-full bg-gray-100 px-1 py-1 pr-4 text-sm text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700"
                            role="alert"
                        >
                            <span class="mr-3 rounded-full bg-orange-600 px-3 py-1 text-xs text-white">New</span>
                            <span class="text-sm font-medium">Our client platform</span>
                            <svg
                                class="ml-2 h-5 w-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </a>
                    @endif

                    <h1
                        class="mb-4 text-4xl leading-none font-extrabold tracking-tight text-gray-900 md:text-5xl xl:text-6xl dark:text-white"
                    >
                        Client Application
                    </h1>
                    <p
                        class="mx-auto mb-6 max-w-xl font-light text-gray-500 md:text-lg lg:mx-0 xl:mb-8 xl:text-xl dark:text-gray-400"
                    >
                        This is a template for creating ACT Training applications. Please update the text and image on
                        this page.
                    </p>

                    <div>
                        <flux:button variant="primary" href="{{ route('login') }}" icon:trailing="arrow-right">
                            Sign in
                        </flux:button>
                    </div>

                    <p class="mt-12 flex items-center justify-center gap-2 text-sm text-gray-500 lg:justify-start">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="32"
                            height="32"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#f34100"
                            stroke-width="1"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M4 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M13 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M13 19l-9 0" />
                            <path d="M4 15l9 0" />
                            <path d="M8 12v-5h2a3 3 0 0 1 3 3v5" />
                            <path d="M5 15v-2a1 1 0 0 1 1 -1h7" />
                            <path d="M21.12 9.88l-3.12 -4.88l-5 5" />
                            <path d="M21.12 9.88a3 3 0 0 1 -2.12 5.12a3 3 0 0 1 -2.12 -.88l4.24 -4.24z" />
                        </svg>

                        Built and maintained by the Digital Development Team at ACT.
                    </p>
                </div>
                <div class="col-span-6 hidden h-screen bg-orange-500 px-16 py-8 lg:block">
                    <img src="{{ asset('images/splash.svg') }}" class="h-full w-full object-contain" alt="Splash" />
                </div>
            </div>
        </div>
    </section>
</x-layouts.app.welcome>
