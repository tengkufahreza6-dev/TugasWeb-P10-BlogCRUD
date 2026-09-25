@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <x-card>
        <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-800">
            <a href="{{ route('posts.index') }}" class="text-xs font-mono text-slate-400 hover:text-slate-200">← Kembali ke Daftar Log</a>
            <div class="space-x-2">
                <a href="{{ route('posts.edit', $post->id) }}" class="px-3 py-1 bg-amber-500/10 border border-amber-500/30 text-amber-400 rounded-md text-xs font-mono hover:bg-amber-500/20 transition">Edit</a>
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex items-center space-x-2">
                <span class="px-2 py-0.5 text-[10px] rounded font-mono font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                    {{ $post->status }}
                </span>
                <span class="text-xs font-mono text-slate-500">• {{ $post->created_at->format('d F Y, H:i') }} WIB</span>
            </div>

            <h1 class="text-2xl font-bold font-mono text-slate-100 leading-snug">{{ $post->title }}</h1>
            <p class="text-xs font-mono text-slate-400">Penulis: <span class="text-slate-200 font-semibold">{{ $post->author }}</span> | Slug: <span class="text-slate-500">{{ $post->slug }}</span></p>

            @if($post->image)
                <div class="my-6">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full max-h-96 object-cover rounded-xl border border-slate-800 shadow-2xl">
                </div>
            @endif

            <div class="pt-4 border-t border-slate-800/60 text-slate-300 leading-relaxed font-sans text-sm whitespace-pre-line">
                {{ $post->content }}
            </div>
        </div>
    </x-card>
</div>
@endsection