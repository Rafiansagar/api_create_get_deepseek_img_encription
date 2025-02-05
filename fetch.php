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
        <h2>Deep Seek Api Response</h2>
        <div class="section-ai">
            <p id="aiResponse">Waiting for response...</p>
            <form id="chatForm">
                <textarea type="text" id="message" name="message" required></textarea>
                <button type="submit">Ask AI</button>
            </form>
        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            $("#chatForm").submit(function (event) {
                event.preventDefault();

                let userMessage = $("#message").val();
                let thinkingMessage = $("<p class='thinking'>Thinking...</p>");
                $("#aiResponse").append(thinkingMessage);

                $.ajax({
                    type: "POST",
                    url: "deepseek.php",
                    data: { message: userMessage },
                    dataType: "json",
                    success: function (response) {
                        $(".thinking").remove();

                        if (response.success) {
                            $("#aiResponse").append("<p>" + response.message + "</p>");
                        } else {
                            $("#aiResponse").append("<p>Error: " + response.error + "</p>");
                        }
                    },
                    error: function () {
                        $(".thinking").remove();
                        $("#aiResponse").append("<p>Error: Failed to fetch response.</p>");
                    }
                });
            });
        });
    </script>
    <!-- Deep Seek Api Response End -->
</div>

<?php include 'footer.php'; ?>