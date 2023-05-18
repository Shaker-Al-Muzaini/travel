<x-Dashboard-layout>
    <x-slot name="pageTitle">
        About
    </x-slot>
    <x-slot name="pageTitle2">
        Create
    </x-slot>
    <form action="{{route('about.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.Abouts._form')
    </form>

    </x-Dashboard-layout>
