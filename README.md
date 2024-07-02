## SQL Command for creating tables
``` PHP
// DB Name
api_custom_data
```
``` SQL
CREATE TABLE posts (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
