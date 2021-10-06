@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Companies</h1>
</div>

{{-- @if (session()->has('success'))
    <div class="alert alert-success col-lg-6" role="alert">
        {{ session('success') }}
</div>
@endif --}}

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

{{-- CREATE COMAPNY Modal --}}
<!-- Modal Update Company-->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="modalUpdateEmployee" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Create Company</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <!--FORM UPDATE Company-->
    <form method="POST" action="/companies/" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" required autofocus value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" required value="{{ old('website') }}">
            @error('website')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <img class="img-preview img-fluid mb-3 col-5">
            <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo" onchange="previewImage()">
            @error('logo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Create Company Data</button>
    </form>
    <!--END FORM UPDATE Company-->
    </div>
    </div>
    </div>
</div>
{{-- END COMPANY MODAL --}}

@foreach ($companies as $comp)
    
<!-- Modal Update Company-->
<div class="modal fade" id="updateModal{{ $comp->id }}" tabindex="-1" aria-labelledby="modalUpdateEmployee" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Edit Employee</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <!--FORM UPDATE Company-->
    <form method="POST" action="/companies/{{ $comp->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" required autofocus value="{{ old('name',$comp->name) }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email',$comp->email) }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" required value="{{ old('website',$comp->website) }}">
            @error('website')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>

            @if ($comp->logo)
                <img class="img-preview img-fluid mb-3 col-5 d-block" src="{{ asset('storage/' .$comp->logo) }}">
                <input type="hidden" name="oldImage" value="{{ $comp->logo }}">
            @else
                <img class="img-preview img-fluid mb-3 col-5">
            @endif

            <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo" onchange="previewImage()">
            @error('logo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update Company Data</button>
    </form>
    <!--END FORM UPDATE Company-->
    </div>
    </div>
    </div>
</div>
    <!-- End Modal UPDATE Company-->
@endforeach

{{-- MODAL DETAIL --}}

@foreach ($companies as $company)

<div class="modal fade" id="detailModal{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Company</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <h2 class="mb-3">{{ $company->name}}</h2>

                <dl class="row">
                    <dt class="col-sm-3">Company Name</dt>
                    <dd class="col-sm-9">: {!! $company->name !!}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">: {!! $company->email !!}</dd>
                
                    <dt class="col-sm-3">Website</dt>
                    <dd class="col-sm-9">: {!! $company->website !!}</dd>

                    <dt class="col-sm-3 text-truncate">Company Logo</dt>
                    <dd class="col-sm-9">:  
                        
                        @if ($company->logo)
                        <img class="img-preview img-fluid mb-3 col-5 d-block" src="{{ asset('storage/'.$company->logo) }}">
                        <input type="hidden" name="oldImage" value="{{ $company->logo }}">
                    @else
                        <img class="img-preview img-fluid mb-3 col-5">
                    @endif
                    </dd>
                </dl>
                
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
        </div>
    </div>

@endforeach

{{-- END MODAL DETAIL --}}

<div class="table-responsive col-lg-12">
    <a href="" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#createModal">Create New Company</a>
        <table class="table table-striped table-sm">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Company Name</th>
            <th scope="col">email</th>
            <th scope="col">website</th>
            <th></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($companies as $company)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $company->name }}</td>
            <td>{{ $company->email }}</td>
            <td>
                <a href="{{ $company->website }}" target = '_blank'>{{ $company->website }}</td></a>
            <td>
                {{-- <a href="/companies/{{ $company->id }}" class="badge bg-warning">
                    detail
                </a> --}}
                <a class="badge bg-info" data-toggle="modal"  data-target="#detailModal{{ $company->id }}">
                    <i class="fas fa-info-circle"></i>
                </a>
                {{-- <a href="/companies/{{ $company->id }}/edit" class="badge bg-primary">
                    edit
                </a> --}}
                <a class="badge bg-warning" data-toggle="modal" data-target="#updateModal{{ $company->id }}">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="/companies/{{ $company->id }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Are you Sure?')">
                        <i class="fas fa-trash"></i>

                    </button>
                </form>                
                </a>
            </td>
            </tr>
                
            @endforeach
        </tbody>
        </table>
</div>

<script>

    // preview image

    function previewImage(){
        const image = document.querySelector('#logo');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFRevent){
            imgPreview.src = oFRevent.target.result;
        }
    }
    

</script>
@endsection