<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSA Encrypt Decrypt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
    body {
        padding: 32px;
    }

    * {
        font-family: sans-serif;
    }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-6 mb-3">
            <h4 for="encrypt-message" class="form-label fw-bold">Encrypt your data</h4>
            <textarea class="form-control mt-3" id="encrypt-message" rows="3" placeholder="Input message..."></textarea>
            <div class="btn-group w-100" role="group">
                <button type="button" class="btn btn-success w-75 mt-2 d-inline me-1 rounded" onclick="encryption()">Encrypt</button>
                <button type="button" class="btn btn-danger w-25 mt-2 d-inline ms-1 rounded" onclick="clearEncryption()">Clear</button>
            </div>
            <div class="mt-3" style="word-wrap: break-word;" id="encryption-result"></div>
        </div>

        <div class="col-6 mb-3">
            <h4 for="decrypt-message" class="form-label fw-bold">Decrypt your data</h4>
            <textarea class="form-control mt-3" id="decrypt-message" rows="3" placeholder="Input encrypted message..."></textarea>
            <div class="btn-group w-100" role="group">
                <button type="button" class="btn btn-success w-75 mt-2 d-inline me-1 rounded" onclick="decryption()">Decrypt</button>
                <button type="button" class="btn btn-danger w-25 mt-2 d-inline ms-1 rounded" onclick="clearDecryption()">Clear</button>
            </div>
            <div class="mt-3" style="word-wrap: break-word;" id="decryption-result"></div>
        </div>
    </div>

    <div class="modal fade" id="modal-copied" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Text copied!</h5>
                </div>
            </div>
        </div>
    </div>

    <script>
        const encryption = _ => {
            $.ajax({
                type: 'POST',
                url: '{{ route("encryption") }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'data': $(`#encrypt-message`).val()
                },
                success: data => {
                    $(`#encryption-result`).html(`
                        Encryption result: <span id="encryption-message" class="fw-bold">${data.message}</span>
                        <button type="button" class="btn btn-primary w-100 mt-2" onclick="copyEncryptedMessage()">Copy Text</button>
                    `)
                }
            })
        }

        const decryption = _ => {
            $.ajax({
                type: 'POST',
                url: '{{ route("decryption") }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'data': $(`#decrypt-message`).val()
                },
                success: data => {
                    $(`#decryption-result`).html(`Decryption result: <span class="fw-bold">${data.message}</span>`)
                }
            })
        }

        const clearEncryption = _ => {
            $(`#encrypt-message`).val("")
            $(`#encryption-result`).html("")
        }

        const clearDecryption = _ => {
            $(`#decrypt-message`).val("")
            $(`#decryption-result`).html("")
        }

        const copyEncryptedMessage = _ => {
            let message = $(`#encryption-message`).text()
            navigator.clipboard.writeText(message)
        }
    </script>
</body>

</html>