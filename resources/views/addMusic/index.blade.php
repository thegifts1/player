@extends('layouts.base')

@section('title', 'Add Music')

@section('content')
    @guest
        {{ __('Log in first') }}
    @endguest

    @auth
        @if ($errors->any())
            {{ $errors }}
        @endif

        <div id="drop_area">
            <form class="my_form" id="upload_container" method="POST" action="{{ route('addMusic.store') }}"
                enctype="multipart/form-data">
                @csrf
                <p>{{ __('Drag files here or') }}</p>
                <input name="fileUpload[]" type="file" id="fileElem" multiple onchange="handleFiles(this.files)">
                <label class="button" for="fileElem">{{ __('Select files') }}</label>
                <p><input class="upload" type="submit" value="{{ __('Upload') }}"></p>
            </form>

            <div class="chatWindow">
                <div class="chatLog"></div>
            </div>
        </div>

        @section('js')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
            <script>
                document.getElementById("fileElem").addEventListener("input",function(){var e=document.getElementById("fileElem").files;for(let t=0;t<e.length;t++){var a=document.createElement("div");elemP=document.createElement("p"),(putDiv=document.querySelector('[class="chatLog"]')).appendChild(a),a.setAttribute("class","chat self"),(putElemP=document.querySelector('[class="chat self"]:last-child')).appendChild(elemP),elemP.setAttribute("class","message-time"),elemP.innerHTML=e[t].name}});let dropArea=document.getElementById("drop_area");function preventDefaults(e){e.preventDefault(),e.stopPropagation()}function highlight(e){dropArea.classList.add("highlight")}function unhighlight(e){dropArea.classList.remove("highlight")}["dragenter","dragover","dragleave","drop"].forEach(e=>{dropArea.addEventListener(e,preventDefaults,!1)}),["dragenter","dragover"].forEach(e=>{dropArea.addEventListener(e,highlight,!1)}),["dragleave","drop"].forEach(e=>{dropArea.addEventListener(e,unhighlight,!1)}),dropArea.addEventListener("drop",handleDrop,!1);var theInputFile=$('input[type="file"]');function handleDrop(e){let t=e.dataTransfer.files;for(let a=0;a<t.length;a++){var r=document.createElement("div");elemP=document.createElement("p"),(putDiv=document.querySelector('[class="chatLog"]')).appendChild(r),r.setAttribute("class","chat self"),(putElemP=document.querySelector('[class="chat self"]:last-child')).appendChild(elemP),elemP.setAttribute("class","message-time"),elemP.innerHTML=t[a].name}theInputFile[0].files=t}
            </script>
        @endsection
    @endauth
@endsection
