<x-layouts.app>
    <div class="mx-auto flex w-full max-w-6xl flex-col items-center justify-center px-6 py-12">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-slate-900 md:text-4xl">Create your OMNICORE account</h1>
            <p class="mt-3 text-slate-500">Join thousands of shoppers for a seamless experience.</p>
        </div>

        <div class="w-full max-w-[480px] rounded-2xl bg-white p-8 shadow-xl shadow-slate-200/50 ring-1 ring-slate-100">
            <form action="#" method="POST" class="space-y-5">
                @csrf
                
                <div class="space-y-2">
                    <label for="name" class="text-sm font-medium text-slate-700">Full Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="John Doe"
                        class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        required
                    >
                </div>

                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium text-slate-700">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="name@example.com"
                        class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        required
                    >
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium text-slate-700">Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="••••••••"
                            class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                            required
                        >
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-slate-500">Minimum 8 characters with one number.</p>
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="text-sm font-medium text-slate-700">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="••••••••"
                        class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"
                        required
                    >
                </div>

                <div class="flex items-start gap-3">
                    <div class="flex h-5 items-center">
                        <input id="terms" name="terms" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" required>
                    </div>
                    <div class="text-sm">
                        <label for="terms" class="font-medium text-slate-600">I agree to the <a href="#" class="text-blue-600 hover:underline">Terms of Service</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>.</label>
                    </div>
                </div>

                <button type="submit" class="w-full rounded-xl bg-blue-600 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                    REGISTER NOW
                </button>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-white px-4 text-xs text-slate-500">Or register with</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <button type="button" class="flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-100">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-50">
                            <svg viewBox="0 0 48 48" class="h-4 w-4" aria-hidden="true">
                                <path fill="#EA4335" d="M24 9.5c3.2 0 6.1 1.1 8.4 3.2l6.3-6.3C34.9 2.3 29.8 0 24 0 14.6 0 6.5 5.3 2.4 13l7.4 5.7C11.5 13.1 17.3 9.5 24 9.5Z"/>
                                <path fill="#34A853" d="M46.5 24.5c0-1.5-.2-2.9-.5-4.3H24v8.1h12.6c-.6 3.2-2.4 5.9-5.2 7.7l7.9 6.1c4.6-4.2 7.2-10.4 7.2-17.6Z"/>
                                <path fill="#4A90E2" d="M9.8 28.1a14.6 14.6 0 0 1 0-9.3l-7.4-5.7a24 24 0 0 0 0 20.7l7.4-5.7Z"/>
                                <path fill="#FBBC05" d="M24 48c6.5 0 12-2.1 16-5.7l-7.9-6.1c-2.2 1.5-5 2.4-8.1 2.4-6.7 0-12.5-3.6-14.2-9l-7.4 5.7C6.5 42.7 14.6 48 24 48Z"/>
                            </svg>
                        </span>
                        <span class="sr-only">Google</span>
                    </button>
                    <button type="button" class="flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-100">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-50">
                            <svg viewBox="0 0 24 24" class="h-4 w-4" aria-hidden="true">
                                <path fill="currentColor" d="M16.4 12.6c0-2.4 2-3.6 2.1-3.7-1.2-1.7-3.1-1.9-3.8-1.9-1.6-.2-3.1.9-3.9.9-.8 0-2-.9-3.3-.9-1.7 0-3.3 1-4.1 2.6-1.8 3.1-.5 7.8 1.3 10.3.9 1.2 1.9 2.5 3.3 2.5 1.3 0 1.8-.8 3.4-.8 1.6 0 2 .8 3.3.8 1.4 0 2.3-1.2 3.2-2.4 1-1.5 1.4-3 1.4-3.1-.1 0-2.8-1.1-2.8-4.3ZM14.8 5.2c.7-.9 1.2-2.2 1.1-3.5-1 .1-2.3.7-3 1.6-.7.8-1.3 2.1-1.1 3.4 1.1.1 2.3-.6 3-1.5Z"/>
                            </svg>
                        </span>
                        <span class="sr-only">Apple</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 text-center text-sm text-slate-600">
            Already have an account? <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500">Log in</a>
        </div>

        <div class="mt-8 flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-3 w-3">
                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
            </svg>
            256-bit secure encryption
        </div>
    </div>
</x-layouts.app>
