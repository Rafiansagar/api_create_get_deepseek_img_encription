<div id="posts">
    <?php
    $apiUrl = 'http://localhost/api-create-get/api.php'; // Replace with your WordPress site URL

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
    } else {
        foreach ($posts as $post) {
            echo '<div class="post">';
            echo '<h2>' . htmlspecialchars($post['title']) . '</h2>';
            echo '<div>' . $post['content'] . '</div>';
            echo '</div>';
        }
    }
    ?>
</div>