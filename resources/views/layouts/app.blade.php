<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYS_CONSOLE — Blog Engine TR 10</title>
    <!-- Import Font Modern Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#0b0f17] text-slate-200 font-sans min-h-screen flex flex-col antialiased selection:bg-emerald-500/30 selection:text-emerald-300">
    <!-- Header -->
    <header class="border-b border-slate-800/80 bg-[#0f172a]/70 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-[0_0_12px_rgba(52,211,153,0.8)] animate-pulse"></span>
                <a href="{{ route('posts.index') }}" class="font-mono font-bold tracking-tight text-slate-100 hover:text-emerald-400 transition flex items-center gap-2">
                    <span>SYS_CONSOLE</span>
                    <span class="text-[10px] px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-mono">v2.0</span>
                </a>
            </div>
            <nav class="flex items-center space-x-3 text-xs font-mono">
                <a href="{{ route('posts.index') }}" class="px-3.5 py-2 rounded-lg bg-slate-800/80 text-slate-300 hover:bg-slate-700/80 hover:text-white transition border border-slate-700/50">
                    Log Post
                </a>
                <a href="{{ route('posts.create') }}" class="px-3.5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-semibold transition shadow-lg shadow-emerald-950">
                    + Post Baru
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <x-alert />
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800/60 bg-[#080c14] py-5 text-center text-xs text-slate-500 font-mono">
        Tugas Rutin 10 — Blog CRUD Laravel | Tengku Fahreza (4252550005)
    </footer>
</body>
</html>