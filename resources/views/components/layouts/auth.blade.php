<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OmniCore WebStore - Sign In</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Space Grotesk', 'ui-sans-serif', 'system-ui'],
                    },
                },
            },
        };
    </script>
    <style>
        :root {
            --omni-surface: #f5f7fb;
            --omni-ink: #0f172a;
            --omni-accent: #1d4ed8;
            --omni-accent-2: #0ea5e9;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-14px);
            }
        }

        @keyframes drift {
            0%, 100% {
                transform: translateX(0px) scale(1);
            }
            50% {
                transform: translateX(18px) scale(1.05);
            }
        }
    </style>
</head>
<body class="min-h-screen bg-[var(--omni-surface)] text-[var(--omni-ink)] font-display">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute -top-28 -left-20 h-72 w-72 rounded-full bg-sky-200/70 blur-3xl motion-safe:animate-[float_8s_ease-in-out_infinite]"></div>
            <div class="absolute top-12 right-10 h-40 w-40 rounded-full bg-emerald-200/70 blur-2xl motion-safe:animate-[drift_10s_ease-in-out_infinite]"></div>
            <div class="absolute -bottom-16 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-200/60 blur-3xl"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(255,255,255,0.9),_transparent_60%)]"></div>
        </div>

        <div class="relative z-10">
            <header class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 pt-8">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-white/80 shadow-sm ring-1 ring-slate-900/5">
                        <span class="text-lg font-semibold text-sky-600">O</span>
                    </div>
                    <div>
                        <p class="text-sm uppercase tracking-[0.2em] text-slate-500">OmniCore</p>
                        <p class="text-lg font-semibold">WebStore</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <span class="text-slate-500">New to OmniCore?</span>
                    <a href="#" class="rounded-full bg-slate-900 px-4 py-2 text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-slate-800 motion-reduce:transition-none">Sign up</a>
                </div>
            </header>

            {{ $slot }}
        </div>
    </div>
</body>
</html>
