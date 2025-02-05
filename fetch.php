<?php include 'header.php'; ?>

<div id="posts">
    <div class="container">
        <div class="row">
            <?php

            $apiUrl = 'http://localhost/api_create_and_get/api/?api_key=123456789';

            function fetchPosts($url) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);

                $response = curl_exec($ch);
                $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($response === false || $httpcode !== 200) {
                    return ['error' => 'Error fetching data: ' . curl_error($ch)];
                }

                curl_close($ch);
                return json_decode($response, true);
            }

            $posts = fetchPosts($apiUrl);

            if (isset($posts['error'])) {
                echo '<div class="error">' . htmlspecialchars($posts['error']) . '</div>';
            } elseif ($posts['status'] === 'error') {
                echo '<div class="error">' . htmlspecialchars($posts['message']) . '</div>';
            } else {
                $id = 1;
                foreach ($posts['api-data1'] as $post) {
                    echo '<div class="col-md-4 post mb-5">';
                    echo '<h4>' . $id++ . '</h4>';
                    echo '<h2>' . htmlspecialchars($post['title']) . '</h2>';
                    echo '<div>' . htmlspecialchars($post['content']) . '</div>';
                    echo '<div>' . htmlspecialchars($post['created_at']) . '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Deep Seek Api Response Start -->
    <div class="container">
        <h2>DeepSeek Api Response</h2>
        <div class="section-ai">
            <div id="aiResponse"></div>
            <textarea type="text" id="message" name="message" placeholder="Ask AI..." required></textarea>
            <button onclick="sendMessage()">Submit</button>
        </div>
    </div>
    <script>
        function sendMessage() {
            var userMessage = $("#message").val().trim();
            if (!userMessage) {
                alert("Please enter a message.");
                return;
            }
            $("#aiResponse").append("<p><b>You:</b> " + userMessage + "</p>");
            $.ajax({
                url: "deepseek.php",
                method: "POST", // Method type
                data: { message: userMessage },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $("#aiResponse").append("<p><b>DeepSeek:</b> " + response.message + "</p>");
                    } else {
                        $("#aiResponse").append("<p><b>Error:</b> " + response.error + "</p>");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Request failed:", status, error);
                    $("#aiResponse").append("<p><b>Error:</b> Something went wrong. Please try again.</p>");
                },
                complete: function() {
                    $("#message").val("");
                }
            });
        }
    </script>
    <!-- Deep Seek Api Response End -->
</div>

<?php include 'footer.php'; ?>