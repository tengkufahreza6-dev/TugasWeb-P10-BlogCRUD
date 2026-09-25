@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <x-card>
        <div class="mb-6 pb-4 border-b border-slate-800 flex items-center justify-between">
            <h1 class="text-lg font-bold font-mono text-slate-100">Buat Post / Log Baru</h1>
            <a href="{{ route('posts.index') }}" class="text-xs font-mono text-slate-400 hover:text-slate-200">← Kembali</a>
        </div>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Judul -->
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1">Judul Post <span class="text-rose-400">*</span></label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title') }}" 
                    class="w-full bg-slate-950 border @error('title') border-rose-500 @else border-slate-800 @enderror rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none focus:border-emerald-500 font-mono"
                    placeholder="Masukkan judul postingan..."
                >
                @error('title')
                    <p class="text-rose-400 text-[11px] font-mono mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Author & Status Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-300 mb-1">Penulis / Operator <span class="text-rose-400">*</span></label>
                    <input 
                        type="text" 
                        name="author" 
                        value="{{ old('author', 'T. Fahreza') }}" 
                        class="w-full bg-slate-950 border @error('author') border-rose-500 @else border-slate-800 @enderror rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none focus:border-emerald-500 font-mono"
                    >
                    @error('author')
                        <p class="text-rose-400 text-[11px] font-mono mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-300 mb-1">Status Visibilitas <span class="text-rose-400">*</span></label>
                    <select 
                        name="status" 
                        class="w-full bg-slate-950 border @error('status') border-rose-500 @else border-slate-800 @enderror rounded-lg px-3 py-2 text-xs text-slate-100 focus:outline-none focus:border-emerald-500 font-mono"
                    >
                        <option value="PUBLISHED" {{ old('status') == 'PUBLISHED' ? 'selected' : '' }}>PUBLISHED</option>
                        <option value="DRAFT" {{ old('status') == 'DRAFT' ? 'selected' : '' }}>DRAFT</option>
                        <option value="ARCHIVED" {{ old('status') == 'ARCHIVED' ? 'selected' : '' }}>ARCHIVED</option>
                    </select>
                    @error('status')
                        <p class="text-rose-400 text-[11px] font-mono mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Upload Gambar (Bonus) -->
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1">Upload Gambar / Lampiran (Opsional)</label>
                <input 
                    type="file" 
                    name="image" 
                    class="w-full bg-slate-950 border @error('image') border-rose-500 @else border-slate-800 @enderror rounded-lg px-3 py-1.5 text-xs text-slate-400 file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-mono file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700"
                >
                @error('image')
                    <p class="text-rose-400 text-[11px] font-mono mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konten -->
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1">Konten / Isi Post <span class="text-rose-400">*</span></label>
                <textarea 
                    name="content" 
                    rows="6" 
                    class="w-full bg-slate-950 border @error('content') border-rose-500 @else border-slate-800 @enderror rounded-lg p-3 text-xs text-slate-100 focus:outline-none focus:border-emerald-500 font-sans"
                    placeholder="Tuliskan isi laporan atau postingan di sini..."
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-rose-400 text-[11px] font-mono mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-800 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-mono text-xs font-bold rounded-lg transition shadow-lg">
                    Simpan & Publikasikan
                </button>
            </div>
        </form>
    </x-card>
</div>
@endsection