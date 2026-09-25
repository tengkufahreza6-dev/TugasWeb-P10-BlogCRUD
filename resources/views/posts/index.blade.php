@extends('layouts.app')

@section('content')

<!-- Grid Statistik Operasional -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-[#0f172a]/80 border border-slate-800 rounded-xl p-4 flex items-center justify-between">
        <div>
            <p class="text-[11px] font-mono text-slate-400 uppercase tracking-wider">Total Post</p>
            <p class="text-2xl font-mono font-bold text-slate-100 mt-1">{{ $posts->total() }}</p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 font-mono text-sm font-bold">
            LOG
        </div>
    </div>

    <div class="bg-[#0f172a]/80 border border-slate-800 rounded-xl p-4 flex items-center justify-between">
        <div>
            <p class="text-[11px] font-mono text-slate-400 uppercase tracking-wider">Published</p>
            <p class="text-2xl font-mono font-bold text-emerald-400 mt-1">
                {{ \App\Models\Post::where('status', 'PUBLISHED')->count() }}
            </p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 font-mono text-sm font-bold">
            PUB
        </div>
    </div>

    <div class="bg-[#0f172a]/80 border border-slate-800 rounded-xl p-4 flex items-center justify-between">
        <div>
            <p class="text-[11px] font-mono text-slate-400 uppercase tracking-wider">Draft & Archived</p>
            <p class="text-2xl font-mono font-bold text-amber-400 mt-1">
                {{ \App\Models\Post::whereIn('status', ['DRAFT', 'ARCHIVED'])->count() }}
            </p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 font-mono text-sm font-bold">
            DF/AR
        </div>
    </div>

    <div class="bg-[#0f172a]/80 border border-slate-800 rounded-xl p-4 flex items-center justify-between">
        <div>
            <p class="text-[11px] font-mono text-slate-400 uppercase tracking-wider">Soft Deleted</p>
            <p class="text-2xl font-mono font-bold text-rose-400 mt-1">
                {{ \App\Models\Post::onlyTrashed()->count() }}
            </p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-400 font-mono text-sm font-bold">
            TRSH
        </div>
    </div>
</div>

<x-card>
    <!-- Header Controls & Search Bar -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 pb-6 border-b border-slate-800">
        <div>
            <h1 class="text-xl font-bold tracking-tight text-slate-100 font-mono">Daftar Log Sistem</h1>
            <p class="text-xs text-slate-400 font-mono mt-1">Manajemen postingan dan catatan operasional blog.</p>
        </div>

        <!-- Form Pencarian (Bonus: Search Scope) -->
        <form action="{{ route('posts.index') }}" method="GET" class="flex gap-2">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Cari judul, konten, author..." 
                class="bg-slate-950 border border-slate-800 rounded-lg px-3 py-1.5 text-xs text-slate-200 focus:outline-none focus:border-emerald-500 font-mono w-64"
            >
            <button type="submit" class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-mono rounded-lg transition">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('posts.index') }}" class="px-3 py-1.5 bg-rose-950/50 hover:bg-rose-900/50 text-rose-300 border border-rose-800 text-xs font-mono rounded-lg transition">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Data Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs font-mono">
            <thead>
                <tr class="border-b border-slate-800 text-slate-400 uppercase tracking-wider bg-slate-950/50">
                    <th class="p-3">Info Post</th>
                    <th class="p-3">Penulis</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60">
                @forelse($posts as $post)
                    <tr class="hover:bg-slate-800/30 transition">
                        <td class="p-3">
                            <div class="flex items-center space-x-3">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Thumb" class="w-10 h-10 object-cover rounded-lg border border-slate-700">
                                @else
                                    <div class="w-10 h-10 bg-slate-800 border border-slate-700 rounded-lg flex items-center justify-center text-slate-500 font-bold">
                                        DOC
                                    </div>
                                @endif
                                <div>
                                    <a href="{{ route('posts.show', $post->id) }}" class="font-bold text-slate-200 hover:text-emerald-400 transition">
                                        {{ Str::limit($post->title, 40) }}
                                    </a>
                                    <p class="text-slate-500 text-[11px] font-sans line-clamp-1 mt-0.5">
                                        {{ Str::limit($post->content, 60) }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="p-3 text-slate-300">{{ $post->author }}</td>
                        <td class="p-3">
                            <span class="px-2 py-0.5 text-[10px] rounded font-bold uppercase tracking-wider
                                {{ $post->status === 'PUBLISHED' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' : '' }}
                                {{ $post->status === 'DRAFT' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/30' : '' }}
                                {{ $post->status === 'ARCHIVED' ? 'bg-slate-800 text-slate-400 border border-slate-700' : '' }}">
                                {{ $post->status }}
                            </span>
                        </td>
                        <td class="p-3 text-slate-500">{{ $post->created_at->format('d/m/Y H:i') }}</td>
                        <td class="p-3 text-right space-x-2">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-400 hover:underline">Detail</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-amber-400 hover:underline">Edit</a>
                            
                            <!-- Form Delete (@csrf + @method('DELETE')) -->
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus post ini (Soft Delete)?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-400 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-slate-500">
                            Tidak ada data log post ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 pt-4 border-t border-slate-800">
        {{ $posts->links() }}
    </div>
</x-card>
@endsection