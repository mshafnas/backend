@component('mail::message')
# the following ads are going to expire in 8 days



@component('mail::table')
|Property ID | Name | Expire Date
|:-----------|:-----|:-----------|
@foreach ($properties as $property)
|{{$property['property_id']}}|{{$property['title']}}|{{$property['expiry_date']}}
@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
