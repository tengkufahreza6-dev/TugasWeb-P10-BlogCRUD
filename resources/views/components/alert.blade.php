@if (session()->has('success'))
    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center justify-between font-mono text-sm shadow-lg">
        <div class="flex items-center space-x-3">
            <span class="text-lg">✓</span>
            <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-300 font-bold ml-4">✕</button>
    </div>
@endif

@if (session()->has('error'))
    <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 flex items-center justify-between font-mono text-sm shadow-lg">
        <div class="flex items-center space-x-3">
            <span class="text-lg">⚠</span>
            <span>{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-300 font-bold ml-4">✕</button>
    </div>
@endif