    
    <script>
        function displayTitle(text) {
            document.getElementById('displayTitle').innerText = text;
        }
        function displayContent(text) {
            document.getElementById('displayContent').innerText = text;
        }
    </script>

    <!-- Blob Data https://localdost -->
    <script>
        jQuery(document).ready(function($) {
            if ($('.st-encryption.download-no').length) {
                // Encryption
                $('#encryptDownload').on('click', function() {
                    var fileInput = document.getElementById('fileInput');
                    if (fileInput.files.length === 0) {
                        alert('Please select an image first.');
                        return;
                    }
                    var file = fileInput.files[0];
                    var reader = new FileReader();
                    reader.readAsArrayBuffer(file);

                    reader.onload = function(event) {
                        var imageData = event.target.result;
                        var wordArray = CryptoJS.lib.WordArray.create(imageData);
                        var encrypted = CryptoJS.AES.encrypt(wordArray, 'U2FsdGVkX1+jUHWVHdhtZguJFTeH0cfecCP9tP').toString();
                        var encryptedBlob = new Blob([encrypted], { type: 'text/plain' });
                        var url = window.URL.createObjectURL(encryptedBlob);
                        var a = $('<a/>', {
                            href: url,
                            download: 'encrypted-image.enc'
                        }).appendTo('body');
                        a[0].click();
                        window.URL.revokeObjectURL(url);
                        a.remove();
                    };
                    reader.onerror = function() {
                        alert('Failed to read the file.');
                    };
                });

                // Encryption and display
                $('#decryptDownload').on('click', function() {
                    var decryptInput = document.getElementById('decryptInput');
                    if (decryptInput.files.length === 0) {
                        alert('Please select an encrypted file first.');
                        return;
                    }
                    var file = decryptInput.files[0];
                    var reader = new FileReader();
                    reader.readAsText(file);
                    reader.onload = function(event) {
                        var encryptedData = event.target.result;
                        try {
                            var decrypted = CryptoJS.AES.decrypt(encryptedData, 'U2FsdGVkX1+jUHWVHdhtZguJFTeH0cfecCP9tP');
                            var decryptedBytes = decrypted.toString(CryptoJS.enc.Latin1);
                            var byteNumbers = new Array(decryptedBytes.length);
                            for (var i = 0; i < decryptedBytes.length; i++) {
                                byteNumbers[i] = decryptedBytes.charCodeAt(i);
                            }
                            var byteArray = new Uint8Array(byteNumbers);
                            var blob = new Blob([byteArray], { type: 'image/png' });
                            var url = window.URL.createObjectURL(blob);
                            var img = new Image();
                            img.src = url;

                            img.onload = function() {
                                var canvas = document.getElementById('decryptedCanvas');
                                var context = canvas.getContext('2d');
                                canvas.width = img.width;
                                canvas.height = img.height;
                                context.drawImage(img, 0, 0);
                                canvas.style.display = 'block';
                                window.URL.revokeObjectURL(url);
                            };

                        } catch (error) {
                            console.log(error);
                            alert('Decryption failed or invalid key.');
                        }
                    };

                    reader.onerror = function() {
                        alert('Failed to read the file.');
                    };
                });
                $('#decryptedCanvas').on('contextmenu', function(e) {
                    e.preventDefault();
                });
            }

            /*----------------------------------------------------------
                Bottom Code Will Provide Download Option 
            ----------------------------------------------------------*/
            if ($('.st-encryption.download-yes').length) {
                // Encryption
                $('#encryptDownload').on('click', function() {
                    var fileInput = document.getElementById('fileInput');
                    if (fileInput.files.length === 0) {
                        alert('Please select an image first.');
                        return;
                    }
                    var file = fileInput.files[0];
                    var reader = new FileReader();
                    reader.readAsArrayBuffer(file);

                    reader.onload = function(event) {
                        var imageData = event.target.result;
                        var wordArray = CryptoJS.lib.WordArray.create(imageData);
                        var encrypted = CryptoJS.AES.encrypt(wordArray, 'U2FsdGVkX1+jUHWVHdhtZguJFTeH0cfecCP9tP').toString();
                        var encryptedBlob = new Blob([encrypted], { type: 'text/plain' });
                        var url = window.URL.createObjectURL(encryptedBlob);
                        var a = $('<a/>', {
                            href: url,
                            download: 'encrypted-image.enc'
                        }).appendTo('body');
                        a[0].click();
                        window.URL.revokeObjectURL(url);
                        a.remove();
                    };
                    reader.onerror = function() {
                        alert('Failed to read the file.');
                    };
                });

                // Decryption and display
                $('#decryptDownload').on('click', function() {
                    var decryptInput = document.getElementById('decryptInput');
                    if (decryptInput.files.length === 0) {
                        alert('Please select an encrypted file first.');
                        return;
                    }
                    var file = decryptInput.files[0];
                    var reader = new FileReader();
                    reader.readAsText(file);
                    reader.onload = function(event) {
                        var encryptedData = event.target.result;
                        try {
                            var decrypted = CryptoJS.AES.decrypt(encryptedData, 'U2FsdGVkX1+jUHWVHdhtZguJFTeH0cfecCP9tP');
                            var decryptedBytes = decrypted.toString(CryptoJS.enc.Latin1);
                            var byteNumbers = new Array(decryptedBytes.length);
                            for (var i = 0; i < decryptedBytes.length; i++) {
                                byteNumbers[i] = decryptedBytes.charCodeAt(i);
                            }
                            var byteArray = new Uint8Array(byteNumbers);
                            var blob = new Blob([byteArray], { type: 'image/png' });
                            var url = window.URL.createObjectURL(blob);
                            var img = new Image();
                            img.src = url;

                            img.onload = function() {
                                var canvas = document.getElementById('decryptedCanvas');
                                var context = canvas.getContext('2d');
                                canvas.width = img.width;
                                canvas.height = img.height;
                                context.drawImage(img, 0, 0);
                                canvas.style.display = 'block';

                                // Create download button for the decrypted image
                                var downloadLink = $('<a/>', {
                                    href: url,
                                    download: 'decrypted-image.png',
                                    text: 'Download Decrypted Image'
                                }).appendTo('body');
                                downloadLink.css({
                                    display: 'block',
                                    marginTop: '10px',
                                    textDecoration: 'none',
                                    color: '#007bff'
                                });

                                // Ensuring the URL is revoked only after the download link is clicked
                                downloadLink.on('click', function() {
                                    // Revoke URL after download click to avoid issues
                                    setTimeout(function() {
                                        window.URL.revokeObjectURL(url);
                                    }, 100); // Give the browser time to start the download
                                });
                            };

                        } catch (error) {
                            console.log(error);
                            alert('Decryption failed or invalid key.');
                        }
                    };

                    reader.onerror = function() {
                        alert('Failed to read the file.');
                    };
                });

                $('#decryptedCanvas').on('contextmenu', function(e) {
                    e.preventDefault();
                });
            }
        });
    </script>
</body>
</html>