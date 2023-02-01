


@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                {{-- WORD NUMBER CONVERTER --}}
            </h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <form action="/" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="block">
                <input 
                    type="text"
                    class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                    name="data"
                    placeholder="word or number">

                <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                    Submit
                </button>

                <div class="mt-20 h-40 bg-gray-200 flex justify-center items-center">
                    <span>{{ dd($converted_data ?? null) }}</span>
                </div>
                
            </div>
        </form>
    </div>
@endsection