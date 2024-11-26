@if($uploads->count() > 0)
    @foreach($uploads as $upload)
        <div class="box">
            <img src="{{ asset('storage/' . $upload->file_post) }}" 
                 alt="{{ $upload->judul_post }}" 
                 data-title="{{ $upload->judul_post }}" 
                 data-description="{{ $upload->desk_post }}" 
                 data-id="{{ $upload->id_post }}">
        </div>
    @endforeach
@else
    <p>Tidak ada hasil yang ditemukan.</p>
@endif