@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-header bg-primary">
            <div class="row align-items-center">
                <div class="col-6">
                    <h5 class="card-title fw-semibold text-white">Edit Program</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="/admin/program" type="button" class="btn btn-warning float-end">Kembali</a>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <form method="POST" action="/admin/program/{{ $program->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="program" class="form-label">Program <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="program" id="program" value="{{ old('program', $program->program) }}">
                            @error('program')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug/Permalink <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $program->slug) }}">
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Program <span style="color: red">*</span></label>
                            <textarea class="form-control" id="editor" name="deskripsi" rows="10">{{ old('deskripsi',$program->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
               <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <img src="{{ asset('storage/' .$program->foto) }}" class="img-preview img-fluid mb-3 mt-2" id="preview" style="border-radius: 5px; max-height:300px; overflow:hidden;"><br>
                            <label for="foto" class="form-label">Foto Program <span style="color: red">*</span></label>
                            <input class="form-control" type="file" id="foto" name="foto" onchange="previewImage()">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary m-1 float-end">Update</button>
                    </div>
               </div>
            </div>
        </div>
    </form>
</div>

<!-- Generate Slug Otomatis -->
<script>
    const program     = document.querySelector('#program');
    const slug      = document.querySelector('#slug');

    program.addEventListener('change', function(){
        fetch('/admin/program/slug?program=' + program.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
</script>

<!-- Preview Image -->
<script>
    function previewImage(){
        var preview     = document.getElementById('preview');
        var fileInput   = document.getElementById('foto');
        var file        = fileInput.files[0];
        var reader      = new FileReader();

        reader.onload = function(e){
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>

<!-- Ck Editor 5 -->
<script>
    let editorInstance;
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
             editorInstance =editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection