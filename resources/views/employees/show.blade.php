@extends('dashboard.layouts.main')

@section('container')

<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <h2 class="mb-3">Employee Detail</h2>

                <article class="my-3 fs-5">
                    {!! $employee->first_name !!}
                    <br>
                    {!! $employee->last_name !!}
                    <br>
                    {!! $employee->company->name !!}
                    <br>
                    {!! $employee->email !!}
                    <br>
                    {!! $employee->phone !!}
                </article>
                
                <a href="/employees" class="btn btn-primary">back</a>

            
        </div>
    </div>
</div>

@endsection