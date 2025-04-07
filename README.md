## Information
* Api Create & Get
* Writing Live Rendering
* DeepSeek AI Integration -> fetch.php


## DB Name
``` PHP
api_custom_data
```

## SQL Command for creating tables
``` SQL
CREATE TABLE posts (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
