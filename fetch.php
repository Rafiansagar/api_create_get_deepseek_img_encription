<div id="posts">
    <?php

    // API Authentication key
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
            echo '<div class="post">';
            echo '<h4>' . $id++ . '</h4>';
            echo '<h2>' . htmlspecialchars($post['title']) . '</h2>';
            echo '<div>' . htmlspecialchars($post['content']) . '</div>';
            echo '<div>' . htmlspecialchars($post['created_at']) . '</div>';
            echo '</div>';
        }
    }
    ?>
</div>
