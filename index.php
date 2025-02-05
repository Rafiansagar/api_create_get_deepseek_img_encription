

<?php include 'header.php'; ?>

<div class="container">
    <h2>Create a New Post</h2>
    <form action="insert.php" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" onkeyup="displayTitle(this.value)" required><br><br>
        
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" onkeyup="displayContent(this.value)" rows="4" cols="50" required></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>


    <div id="content" style="padding: 50px; border-radius: 10px; margin: 60px auto 0; width: 380px; background: linear-gradient(145deg, #e2e8ec, #ffffff); box-shadow: 5px 5px 15px #D1D9E6, -5px -5px 15px #ffffff;">

        <h2 style="margin-top: 0px;">Live Render</h2>
        <b>Title:</b>
        <span id="displayTitle"></span>
        <br>
        <br>
        <b>Content:</b>
        <span id="displayContent"></span>
        <br>
        <br>
        <br>
        <pre>Api Post Content In fetch.php</pre>
    </div>

    <pre>
    = = = = = = = = = 
    Blob Data
    = = = = = = = = = 
    </pre>

    <div class="st-encryption download-yes">
        <h2>Encrypt Image</h2>
        <input type="file" id="fileInput" />
        <button id="encryptDownload">Encrypt and Download</button>

        <h2>Decrypt Image</h2>
        <input type="file" id="decryptInput" />
        <button id="decryptDownload">Decrypt and Display</button>
        <br>
        
        <canvas id="decryptedCanvas"></canvas>
    </div>

</div>


<?php include 'footer.php'; ?>