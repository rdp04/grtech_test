@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome back <b>"{{ auth()->user()->name }}"</b> </h1>
</div>

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
            <h2 class="mb-3">{{ $comp->company->name}}</h2>

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


<div class="container">
    <div class="row mb-5">
        <h2 class="text-bold mb-5">Companies List</h2>
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
                {{-- <td><a href="" data-toggle="modal" data-target="#detailModalCompany{{ $comp->id }}">{{ $company->name }}</a> --}}
                <td>
                    <a href="" class="link" data-toggle="modal"  data-target="#detailModalCompany{{ $company->id }}">
                    {{ $company->name }}
                    </a>
                </td>

                <td>{{ $company->email }}</td>
                <td>
                    <a href="{{ $company->website }}" target = '_blank'>{{ $company->website }}</td></a>
                </td>
                </tr>
                    
                @endforeach
            </tbody>
            </table>
            {{ $companies->links() }}
    </div>
    <hr>

    <hr>


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
    <div class="row mt-5">
        <h2 class="text-bold mb-5">Employees List</h2>

        <table class="table table-striped table-md">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
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
                <td>
                    <a href="" class="link" data-toggle="modal"  data-target="#detailModalEmployee{{ $employee->id }}">
                        {{ $employee->first_name }}</td>
                    </a>
                <td>{{ $employee->last_name }}</td>
                <td>
                    {{ $employee->company->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                </tr>
                    
                @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>
</div>
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