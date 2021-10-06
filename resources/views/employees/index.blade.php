@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Employees</h1>
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

{{-- CREATE MODAL --}}
<!-- Modal Employee-->
<div class="modal fade" id="createEmployee" tabindex="-1" aria-labelledby="modalUpdateEmployee" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Create Employee</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <!--FORM CREATE EMPLOYEE-->
    <form method="POST" action="/employees/" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror " id="first_name" name="first_name" required autofocus value="{{ old('first_name') }}">
            @error('first_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror " id="last_name" name="last_name" required autofocus value="{{ old('last_name') }}">
            @error('last_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company_id" class="form-label">Company</label>
            <select class="form-control" name="company_id">
                <option value="">select company..</option>

                @foreach ($companies as $company)
                    @if(old('company_id') == $company->id)
                        <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                        @else 
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endif
                @endforeach
            </select>
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
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Create Employee Data</button>
    </form>
    <!--END FORM CREATE EMPLOYEE-->
    </div>
    </div>
    </div>
</div>
{{-- END CREATE MODAL --}}

@foreach ($employees as $emp)
    
<!-- Modal Employee-->
<div class="modal fade" id="updateModal{{ $emp->id }}" tabindex="-1" aria-labelledby="modalUpdateEmployee" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Edit Employee</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <!--FORM UPDATE EMPLOYEE-->
    <form method="POST" action="/employees/{{ $emp->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror " id="first_name" name="first_name" required autofocus value="{{ old('first_name',$emp->first_name) }}">
            @error('first_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">First Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror " id="last_name" name="last_name" required autofocus value="{{ old('last_name',$emp->last_name) }}">
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
                    @if(old('company_id',$emp->company_id) == $company->id)
                        <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                        @else 
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email',$emp->email) }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{ old('phone',$emp->phone) }}">
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update employee Data</button>
    </form>
    <!--END FORM UPDATE EMPLOYEE-->
    </div>
    </div>
    </div>
</div>
    <!-- End Modal UPDATE EMPLOYEE-->
@endforeach

{{-- MODAL DETAIL Company --}}
<!-- Modal -->

@foreach ($employees as $comp)

<div class="modal fade" id="detailModalCompany{{ $comp->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <dd class="col-sm-9">:  {{ $comp->company->name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">: {{ $comp->company->email }}</dd>
                
                    <dt class="col-sm-3">Website</dt>
                    <dd class="col-sm-9">: {{ $comp->company->website }}</dd>

                    <dt class="col-sm-3 text-truncate">Company Logo</dt>
                    <dd class="col-sm-9">:  
                        
                        @if ($comp->company->logo)
                        <img class="img-preview img-fluid mb-3 col-5 d-block" src="{{ asset('storage/'.$comp->company->logo) }}">
                        <input type="hidden" name="oldImage" value="{{ $comp->company->logo }}">
                    @else
                        <img class="img-preview img-fluid mb-3 col-5">
                    @endif
                    </dd>
                </dl>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

@endforeach

{{-- END MODAL DETAIL --}}

{{-- MODAL DETAIL Employee --}}
<!-- Modal -->

@foreach ($employees as $comp)

<div class="modal fade" id="detailModalEmployee{{ $comp->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h2 class="mb-3">{{ $comp->first_name}} {{ $comp->last_name }}</h2>

                <dl class="row">
                    <dt class="col-sm-3">First Name</dt>
                    <dd class="col-sm-9">:  {{ $comp->first_name}}</dd>

                    <dt class="col-sm-3">Last Name</dt>
                    <dd class="col-sm-9">: {{ $comp->last_name }}</dd>
                
                    <dt class="col-sm-3">Company</dt>
                    <dd class="col-sm-9">: {{ $comp->company->name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">: {{ $comp->email }}</dd>

                    <dt class="col-sm-3">Phone</dt>
                    <dd class="col-sm-9">: {{ $comp->phone }}</dd>

                </dl>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

@endforeach

{{-- END MODAL DETAIL --}}



@if ($employees->count())
    
<div class="table-responsive col-lg-12">
    <a href="" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#createEmployee">Create New Employee</a>
        <table class="table table-striped table-sm">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Company</th>
            <th scope="col">email</th>
            <th scope="col">phone</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($employees as $key => $employee)
            <tr>
            <td>{{ $employees->firstItem() + $key }}</td>
            <td>{{ $employee->first_name }}</td>
            <td>{{ $employee->last_name }}</td>
            <td>
                <a href="" class="link" data-toggle="modal"  data-target="#detailModalCompany{{ $employee->id }}">
                    {{ $employee->company->name }}</td>
                </a>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
            <td>
                {{-- <a href="/employees/{{ $employee->id }}" class="badge bg-info">
                    <span data-feather="eye"></span>
                    detail
                </a> --}}
                <a class="badge bg-info" data-toggle="modal"  data-target="#detailModalEmployee{{ $employee->id }}">
                    <i class="fas fa-info-circle"></i>
                </a>
                {{-- <a href="/employees/{{ $employee->id }}/edit" class="badge bg-warning">
                    <span data-feather="edit"></span>
                    edit
                </a> --}}
                <a class="badge bg-warning" data-toggle="modal" data-target="#updateModal{{ $employee->id }}">
                    <i class="fas fa-edit"></i>
                </a>

                <form action="/employees/{{ $employee->id }}" method="POST" class="d-inline">
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
@else
<p class="text-center fs-4">No Post found.</p>
@endif
<div class="d-flex justify-content-end">
    {{ $employees->links() }}

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