@component('mail::message')
# Employee Management Notification

New Employee Has Been Added.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
