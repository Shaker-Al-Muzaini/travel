<x-Dashboard-layout>
    <x-slot name="pageTitle">
        Properties
    </x-slot>
    <x-slot name="pageTitle2">
        Edit
    </x-slot>
    {{--        success message--}}
    <x-alert/>
    <div style="display: flex; justify-content: center;">
<form style="width:65%" action="{{route('properties.update',$properties->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.Properties._form',[
        'button_label'=>'Update'
])
    </form>
    </div>
</x-Dashboard-layout>

