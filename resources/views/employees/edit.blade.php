@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Employee Data</h1>
</div>
<div class="col-lg-8">
    <form method="POST" action="/employees/{{ $employee->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror " id="first_name" name="first_name" required autofocus value="{{ old('first_name',$employee->first_name) }}">
            @error('first_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">First Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror " id="last_name" name="last_name" required autofocus value="{{ old('last_name',$employee->last_name) }}">
            @error('last_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company_id" class="form-label">Company</label>
            <select class="form-control" name="company_id">
                {{-- <option value="">select company..</option> --}}

                @foreach ($companies as $company)
                    @if(old('company_id',$employee->company_id) == $company->id)
                        <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                        @else 
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email',$employee->email) }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{ old('phone',$employee->phone) }}">
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update employee Data</button>
    </form>

</div>

<script>
    // const title = document.querySelector('#title');
    // const slug = document.querySelector('#slug');

    // title.addEventListener('change', function(){
    //     fetch('/dashboard/posts/checkSlug?title=' + title.value)
    //     .then(response => response.json())
    //     .then(data => slug.value = data.slug)
    // });

    // document.addEventListener('trix-file-accept',function(e){
    //     e.preventDefault();
    // })


    // preview image

    // function previewImage(){
    //     const image = document.querySelector('#logo');
    //     const imgPreview = document.querySelector('.img-preview');

    //     imgPreview.style.display = 'block';

    //     const oFReader = new FileReader();
    //     oFReader.readAsDataURL(image.files[0]);

    //     oFReader.onload = function(oFRevent){
    //         imgPreview.src = oFRevent.target.result;
    //     }
    // }
    

</script>

@endsection