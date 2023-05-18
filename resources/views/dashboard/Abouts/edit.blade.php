<x-Dashboard-layout>
    <x-slot name="pageTitle">
        Abouts
    </x-slot>
    <x-slot name="pageTitle2">
        Edit
    </x-slot>
    {{--        success message--}}
    <x-alert/>
<form action="{{route('about.update',$abouts->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.Abouts._form',[
        'button_label'=>'Update'
])
    </form>
</x-Dashboard-layout>

