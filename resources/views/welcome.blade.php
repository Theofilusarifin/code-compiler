<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" type="text/css" href="{{ asset('codemirror') }}/lib/codemirror.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('codemirror') }}/theme/dracula.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="{{ asset('codemirror') }}/lib/codemirror.js"></script>
    <script src="{{ asset('codemirror') }}/mode/clike/clike.js"></script>
    <script src="{{ asset('codemirror') }}/mode/python/python.js"></script>
    <script src="{{ asset('codemirror') }}/mode/clike/clike.js"></script>
    <script src="{{ asset('codemirror') }}/mode/pascal/pascal.js"></script>
    <script src="{{ asset('codemirror') }}/addon/edit/closebrackets.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
</head>

<body>
    <h2><a href="https://www.youtube.com/playlist?list=PL9lRHqeCagtv-EsnrBVDRDh0QDc2LReac">Tutorial link</a></h2>
    <div class="row m-3">
        <div class="col ">
            <div class="d-flex justify-content-between mb-3 bg-dark rounded p-2">
                <div class="col-12 w-25">
                    <label class="visually-hidden" for="inlineFormSelectPref">Prefered Languange</label>
                    <select class="form-select" id="inlineFormSelectPref">
                        <option selected>Choose...</option>
                        <option value="Java">Java</option>
                        <option value="Cpp">C++</option>
                        <option value="Python">Python</option>
                        <option value="Pascal">Pascal</option>
                    </select>
                </div>
                <div>
                    <button type="button" class="btn btn-success">Code Sprint</button>
                    <button type="button" class="btn btn-success" onclick="sendCode()"><i
                            class="bi bi-play-fill"></i></button>
                </div>
            </div>
            <textarea id="editor" type="text" class="form-control" aria-label="First Name"></textarea>
        </div>
        <div class="col d-flex flex-column rounded bg-dark px-4">
            <div class="h-50">
                <label for="input" class="text-light mt-4 mb-2">Input</label>
                <textarea id="input" class="form-control h-75"></textarea>
            </div>
            <div class="h-50">
                <label for="output" class="text-light mb-2">Output</label>
                <textarea id="output" class="form-control h-75"></textarea>
            </div>
        </div>
    </div>
</body>

<script>
    // text/x-pascal.
    var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
        mode: "text/x-c++src",
        theme: "dracula",
        lineNumbers: true,
        autoCloseBrackets: true,
    })
    var width = window.innerWidth
    editor.setSize(0.7 * width, "500")

    $("#inlineFormSelectPref").change(() => {
        let lang = $("#inlineFormSelectPref").val()
        if (lang == "Java") {
            editor.setOption("mode", "text/x-java")
        } else if (lang == "Cpp") {
            editor.setOption("mode", "text/x-c++src")
        } else if (lang == "Python") {
            editor.setOption("mode", "text/x-python")
        } else if (lang == "Pascal") {
            editor.setOption("mode", "text/x-pascal")
        }
    })

    const sendCode = () => {
        var code;
        code = {
            code: editor.getValue(),
            input: document.getElementById("input").value,
            lang: $("#inlineFormSelectPref").val(),
        }
        req = JSON.stringify(code)
        console.log(req)
        console.log()
        var blob = new Blob([editor.getValue()], { type: "text/plain;charset=utf-8" });
        saveAs(blob, "dynamic.py");
        // $.ajax({
        //     type: 'POST',
        //     url: "{{ route('get.code') }}",
        //     data: {
        //         '_token': $('meta[name="csrf-token"]').attr('content'),
        //     },
        //     success: function(data) {
        //         conosole.log(data)
        //     }
        // });
    }
</script>

</html>